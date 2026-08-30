<?php

declare(strict_types=1);

function keepote_bridge_settings(): array
{
    $settings = ['base_url'=>'','token'=>''];
    $file = __DIR__ . '/secrets.php';
    if (is_file($file)) {
        $s = require $file;
        if (is_array($s)) {
            $settings['base_url'] = rtrim(trim((string)($s['keepote_log_url'] ?? '')), '/');
            $settings['token'] = trim((string)($s['keepote_log_token'] ?? ''));
        }
    }
    return $settings;
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
            'Content-Type: application/json',
            'Accept: application/json',
        ],
        CURLOPT_POSTFIELDS=>json_encode($payload,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
    ]);
    $body=curl_exec($ch);$status=(int)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);$error=curl_error($ch);curl_close($ch);
    if($body===false||$error!==''||$status<200||$status>=300) return null;
    $json=json_decode((string)$body,true);
    return is_array($json)?$json:null;
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

function keepote_log_exchange(string $conversationId,string $question,string $answer,string $page,string $model,string $responseId): void
{
    keepote_bridge_post('/api/keepote-log.php',[
        'conversation_id'=>$conversationId,
        'visitor_hash'=>hash('sha256',(string)($_SERVER['REMOTE_ADDR']??'unknown')),
        'page_path'=>$page,
        'question'=>$question,
        'answer'=>$answer,
        'model'=>$model,
        'response_id'=>$responseId,
    ],2);
}
