<?php

declare(strict_types=1);

function keepote_bridge_settings(): array
{
    $settings = [
        'base_url' => 'https://priceless-mahavira.51-77-215-132.plesk.page',
        'token' => '',
    ];
    $file = __DIR__ . '/secrets.php';
    if (is_file($file)) {
        $s = require $file;
        if (is_array($s)) {
            $customUrl = rtrim(trim((string)($s['keepote_log_url'] ?? '')), '/');
            if ($customUrl !== '') $settings['base_url'] = $customUrl;
            $settings['token'] = trim((string)($s['keepote_log_token'] ?? ''));
        }
    }
    return $settings;
}

function keepote_current_origin(): string
{
    $host=preg_replace('/[^A-Za-z0-9.:-]/','',(string)($_SERVER['HTTP_HOST']??''));
    if($host==='') return '';
    $scheme=(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')?'https':'http';
    return $scheme.'://'.$host;
}

function keepote_register_site_origin(): void
{
    static $done=false;
    if($done) return;
    $done=true;
    $cfg=keepote_bridge_settings();
    $origin=keepote_current_origin();
    if($cfg['base_url']===''||$cfg['token']===''||$origin===''||!function_exists('curl_init')) return;
    $ch=curl_init($cfg['base_url'].'/api/keepote-site-register.php');
    curl_setopt_array($ch,[
        CURLOPT_POST=>true,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_CONNECTTIMEOUT=>2,
        CURLOPT_TIMEOUT=>4,
        CURLOPT_HTTPHEADER=>['Authorization: Bearer '.$cfg['token'],'X-Keepote-Token: '.$cfg['token'],'Content-Type: application/json','Accept: application/json'],
        CURLOPT_POSTFIELDS=>json_encode(['site_origin'=>$origin],JSON_UNESCAPED_SLASHES),
    ]);
    curl_exec($ch);curl_close($ch);
}

function keepote_pending_file(): string
{
    $dir = dirname(__DIR__) . '/data/ai';
    if (is_dir($dir) && is_writable($dir)) return $dir . '/keepote-pending.ndjson';
    return sys_get_temp_dir() . '/keepote-pending.ndjson';
}

function keepote_bridge_post(string $path, array $payload, int $timeout = 3): ?array
{
    $cfg = keepote_bridge_settings();
    if ($cfg['base_url']==='' || $cfg['token']==='' || !function_exists('curl_init')) return null;
    $ch = curl_init($cfg['base_url'] . $path);
    curl_setopt_array($ch,[
        CURLOPT_POST=>true,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_CONNECTTIMEOUT=>2,
        CURLOPT_TIMEOUT=>$timeout,
        CURLOPT_HTTPHEADER=>[
            'Authorization: Bearer '.$cfg['token'],
            'X-Keepote-Token: '.$cfg['token'],
            'Content-Type: application/json',
            'Accept: application/json',
        ],
        CURLOPT_POSTFIELDS=>json_encode($payload,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
    ]);
    $body=curl_exec($ch);$status=(int)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);$error=curl_error($ch);curl_close($ch);
    if($body===false||$error!==''||$status<200||$status>=300){
        error_log('[KeePote history bridge] '.$path.' failed HTTP '.$status.($error!==''?' '.$error:''));
        return null;
    }
    $json=json_decode((string)$body,true);
    return is_array($json)?$json:null;
}

function keepote_queue_exchange(array $payload): void
{
    $line=json_encode($payload,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    if($line!==false) @file_put_contents(keepote_pending_file(),$line."\n",FILE_APPEND|LOCK_EX);
}

function keepote_flush_pending(): void
{
    $file=keepote_pending_file();
    if(!is_file($file)||filesize($file)===0) return;
    $lines=@file($file,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    if(!is_array($lines)||!$lines) return;
    $remaining=[];$sent=0;
    foreach(array_slice($lines,0,50) as $line){
        $payload=json_decode($line,true);
        if(!is_array($payload)){continue;}
        $res=keepote_bridge_post('/api/keepote-log.php',$payload,2);
        if($res&& !empty($res['ok'])){$sent++;}else{$remaining[]=$line;}
    }
    foreach(array_slice($lines,50) as $line)$remaining[]=$line;
    if($sent>0) @file_put_contents($file,$remaining?implode("\n",$remaining)."\n":'',LOCK_EX);
}

function keepote_conversation_id(): string
{
    $existing=preg_replace('/[^a-zA-Z0-9_-]/','',(string)($_COOKIE['keepote_conversation_id']??''));
    if(strlen($existing)>=16&&strlen($existing)<=80) return $existing;
    $id='kp_'.bin2hex(random_bytes(16));
    setcookie('keepote_conversation_id',$id,[
        'expires'=>time()+86400*30,
        'path'=>'/',
        'secure'=>(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off'),
        'httponly'=>true,
        'samesite'=>'Lax',
    ]);
    return $id;
}

function keepote_admin_corrections(string $question): string
{
    $data=keepote_bridge_post('/api/keepote-corrections.php',['question'=>$question],3);
    if(!$data||empty($data['ok'])||empty($data['corrections'])||!is_array($data['corrections'])) return '';
    $lines=['CORRECTIONS VALIDÉES PAR LA DIRECTION — PRIORITAIRES :'];
    foreach(array_slice($data['corrections'],0,8) as $row){
        if(!is_array($row)) continue;
        $q=trim((string)($row['question']??''));$a=trim((string)($row['answer']??''));
        if($a==='') continue;
        $lines[]='- Pour une question proche de « '.$q.' », la réponse validée est : '.$a;
    }
    return count($lines)>1?implode("\n",$lines):'';
}

function keepote_log_exchange(string $conversationId,string $question,string $answer,string $page,string $model,string $responseId): bool
{
    $payload=[
        'conversation_id'=>$conversationId,
        'visitor_hash'=>hash('sha256',(string)($_SERVER['REMOTE_ADDR']??'unknown')),
        'page_path'=>$page,
        'question'=>$question,
        'answer'=>$answer,
        'model'=>$model,
        'response_id'=>$responseId,
    ];
    keepote_register_site_origin();
    keepote_flush_pending();
    $res=keepote_bridge_post('/api/keepote-log.php',$payload,2);
    if($res&& !empty($res['ok'])) return true;
    keepote_queue_exchange($payload);
    return false;
}
