<?php

declare(strict_types=1);

header('Cache-Control: no-store, max-age=0');
header('X-Robots-Tag: noindex, nofollow');
require_once __DIR__.'/inc/keepote_history_bridge.php';

$result=null;
if(($_SERVER['REQUEST_METHOD']??'GET')==='POST'){
    $cfg=keepote_bridge_settings();
    if($cfg['base_url']===''||$cfg['token']===''){
        $result=['ok'=>false,'title'=>'Configuration incomplète','message'=>'keepote_log_url ou keepote_log_token manque dans inc/secrets.php.'];
    }elseif(!function_exists('curl_init')){
        $result=['ok'=>false,'title'=>'cURL indisponible','message'=>'L’extension cURL PHP n’est pas active sur le site.'];
    }else{
        $ch=curl_init($cfg['base_url'].'/api/keepote-ping.php');
        curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_CONNECTTIMEOUT=>4,CURLOPT_TIMEOUT=>8,CURLOPT_HTTPHEADER=>['Authorization: Bearer '.$cfg['token'],'X-Keepote-Token: '.$cfg['token'],'Accept: application/json']]);
        $body=curl_exec($ch);$error=curl_error($ch);$errno=curl_errno($ch);$status=(int)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);curl_close($ch);
        $json=is_string($body)?json_decode($body,true):null;
        if($error!=='')$result=['ok'=>false,'title'=>'Connexion impossible','message'=>'cURL '.$errno.' : '.$error];
        elseif(!is_array($json))$result=['ok'=>false,'title'=>'Réponse invalide','message'=>'HTTP '.$status.' · '.mb_substr((string)$body,0,500)];
        else {
            $extra='';
            if(isset($json['authorization_received'])||isset($json['x_keepote_token_received']))$extra=' · Authorization reçu: '.($json['authorization_received']??'?').' · X-Keepote-Token reçu: '.($json['x_keepote_token_received']??'?');
            $result=['ok'=>!empty($json['ok'])&&$status>=200&&$status<300,'title'=>!empty($json['ok'])?'Liaison opérationnelle':'Liaison refusée','message'=>(string)($json['message']??('HTTP '.$status)).$extra,'status'=>$status];
        }
    }
}
$cfg=keepote_bridge_settings();
$pendingFile=keepote_pending_file();
$pending=0;
if(is_file($pendingFile)){$lines=file($pendingFile,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);$pending=is_array($lines)?count($lines):0;}
?><!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Test liaison KeePote</title><style>body{font-family:system-ui,-apple-system,sans-serif;background:#f5f7fa;color:#172033;margin:0;padding:40px}.wrap{max-width:760px;margin:auto}.card{background:#fff;border:1px solid #e3e8ef;border-radius:18px;padding:24px;margin-bottom:18px;box-shadow:0 8px 30px rgba(17,32,51,.06)}h1{margin-top:0}.grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}.item{background:#f8fafc;border-radius:12px;padding:14px}.ok{border-left:5px solid #178a55}.bad{border-left:5px solid #b42318}button{border:0;border-radius:10px;padding:12px 18px;background:#163d6b;color:#fff;font-weight:700;cursor:pointer}code{word-break:break-all}@media(max-width:650px){body{padding:20px}.grid{grid-template-columns:1fr}}</style></head><body><div class="wrap"><div class="card"><h1>Test liaison KeePote → Gestion</h1><p>Cette page teste directement la connexion serveur-à-serveur utilisée pour enregistrer les conversations.</p><div class="grid"><div class="item"><strong>URL gestion</strong><br><code><?=htmlspecialchars($cfg['base_url']?:'non configurée',ENT_QUOTES,'UTF-8')?></code></div><div class="item"><strong>Token côté site</strong><br><?=$cfg['token']!==''?'Configuré':'Absent'?></div><div class="item"><strong>cURL PHP</strong><br><?=function_exists('curl_init')?'Disponible':'Absent'?></div><div class="item"><strong>Échanges en attente</strong><br><?=$pending?></div></div><form method="post" style="margin-top:20px"><button type="submit">Tester maintenant</button></form></div><?php if($result):?><div class="card <?=$result['ok']?'ok':'bad'?>"><h2><?=htmlspecialchars($result['title'],ENT_QUOTES,'UTF-8')?></h2><p><?=htmlspecialchars($result['message'],ENT_QUOTES,'UTF-8')?></p><?php if(isset($result['status'])):?><p>HTTP : <?=intval($result['status'])?></p><?php endif;?></div><?php endif;?><div class="card"><strong>Quand un échange est-il enregistré ?</strong><p>Après chaque réponse réussie de KeePote. Si la gestion est momentanément inaccessible, l’échange est conservé dans la file d’attente locale puis renvoyé automatiquement lors d’un prochain échange.</p></div></div></body></html>