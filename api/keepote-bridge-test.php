<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, max-age=0');
header('X-Robots-Tag: noindex, nofollow');
require_once __DIR__.'/../inc/keepote_history_bridge.php';

$cfg=keepote_bridge_settings();
if($cfg['base_url']===''||$cfg['token']===''){
    http_response_code(503);
    echo json_encode([
        'ok'=>false,
        'code'=>'SITE_NOT_CONFIGURED',
        'message'=>'La liaison KeePote n’est pas complètement configurée côté site.',
        'base_url_configured'=>$cfg['base_url']!=='',
        'token_configured'=>$cfg['token']!=='',
    ],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    exit;
}
if(!function_exists('curl_init')){
    http_response_code(503);
    echo json_encode(['ok'=>false,'code'=>'CURL_MISSING','message'=>'cURL PHP n’est pas disponible côté site.'],JSON_UNESCAPED_UNICODE);
    exit;
}
$ch=curl_init($cfg['base_url'].'/api/keepote-ping.php');
curl_setopt_array($ch,[
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_CONNECTTIMEOUT=>4,
    CURLOPT_TIMEOUT=>8,
    CURLOPT_HTTPHEADER=>[
        'Authorization: Bearer '.$cfg['token'],
        'Accept: application/json',
    ],
]);
$body=curl_exec($ch);$error=curl_error($ch);$errno=curl_errno($ch);$status=(int)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);curl_close($ch);
if($body===false||$error!==''){
    http_response_code(502);
    echo json_encode(['ok'=>false,'code'=>'CURL_ERROR','message'=>'Impossible de joindre la gestion.','curl_errno'=>$errno,'curl_error'=>$error,'target'=>$cfg['base_url']],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    exit;
}
$json=json_decode((string)$body,true);
if(!is_array($json)){
    http_response_code(502);
    echo json_encode(['ok'=>false,'code'=>'INVALID_RESPONSE','message'=>'La gestion répond mais pas en JSON valide.','http_status'=>$status,'body'=>mb_substr((string)$body,0,500)],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    exit;
}
http_response_code($status>=200&&$status<300?200:502);
echo json_encode([
    'ok'=>!empty($json['ok'])&&$status>=200&&$status<300,
    'code'=>$json['code']??('HTTP_'.$status),
    'message'=>$json['message']??'Réponse reçue.',
    'http_status'=>$status,
    'target'=>$cfg['base_url'],
    'server_time'=>$json['server_time']??null,
],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
