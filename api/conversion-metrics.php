<?php
// First-party aggregate counts only. No client identifier, URL parameters, IP or form values persisted.
require_once dirname(__DIR__).'/inc/config_helpers.php';
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');
header('Content-Type: application/json; charset=utf-8');
function kp_metrics_stop($status){http_response_code($status);exit;}
if(($_SERVER['REQUEST_METHOD']??'')!=='POST')kp_metrics_stop(405);
$origin=parse_url((string)($_SERVER['HTTP_ORIGIN']??''));
$host=strtolower((string)($_SERVER['HTTP_HOST']??''));
$originHost=strtolower((string)($origin['host']??'')).(isset($origin['port'])?':'.$origin['port']:'');
if(!$host||$originHost!==$host||!in_array($origin['scheme']??'', ['https','http'], true)||($_SERVER['HTTP_SEC_FETCH_SITE']??'same-origin')!=='same-origin')kp_metrics_stop(403);
if((int)($_SERVER['CONTENT_LENGTH']??0)>1024)kp_metrics_stop(413);
$raw=file_get_contents('php://input',false,null,0,1025);
if(strlen((string)$raw)>1024)kp_metrics_stop(413);
$d=json_decode((string)$raw,true);
if(!is_array($d))kp_metrics_stop(400);
$events=['kp_page_view'=>['kp_route'=>['home','packs','tarifs','devis','pro','inscription']],
'kp_packs_view'=>[],'kp_quote_view'=>[],
'kp_pack_click'=>['kp_pack'=>['eco','permis','fdc','fdc-acv','inf50']],
'kp_signup_start'=>['kp_pack'=>['eco','permis','fdc','fdc-acv','inf50'],'kp_method'=>['page','modal']],
'kp_signup_submit_attempt'=>['kp_pack'=>['eco','permis','fdc','fdc-acv','inf50'],'kp_method'=>['page','modal'],'kp_offer'=>['yes','no']],
'kp_quote_calculate_click'=>[],'kp_quote_pack_click'=>['kp_pack'=>['permis','complete','fdc']],
'kp_quote_submit_attempt'=>[],'kp_exit_offer_shown'=>[],'kp_exit_offer_claim'=>[],
'kp_document_click'=>['kp_document'=>['exemple-attestation-re2020.pdf','exemple-synthese-simplifiee-re2020.pdf','exemple-recapitulatif-standardise-re2020.pdf']],
'kp_pro_click'=>[]];
$event=$d['event']??null;if(!is_string($event)||!isset($events[$event]))kp_metrics_stop(400);
$key=$event;foreach($events[$event] as $field=>$allowed){if(!isset($d[$field])||!in_array($d[$field],$allowed,true))kp_metrics_stop(400);$key.='|'.$d[$field];}
if(count($d)!==count($events[$event])+1)kp_metrics_stop(400);
$dir=(string)cfg('conversion_metrics_dir','');
if($dir==='')kp_metrics_stop(204);
$dir=realpath($dir);$root=realpath(dirname(__DIR__));
if(!$dir||!$root||$dir===$root||strpos($dir.DIRECTORY_SEPARATOR,$root.DIRECTORY_SEPARATOR)===0||!is_dir($dir)||!is_writable($dir))kp_metrics_stop(503);
$docRoot=realpath((string)($_SERVER['DOCUMENT_ROOT']??''));
if($docRoot&&($dir===$docRoot||strpos($dir.DIRECTORY_SEPARATOR,$docRoot.DIRECTORY_SEPARATOR)===0))kp_metrics_stop(503);
$day=(new DateTimeImmutable('now',new DateTimeZone('Europe/Paris')))->format('Y-m-d');
$file=$dir.DIRECTORY_SEPARATOR.$day.'.json';$lock=$dir.DIRECTORY_SEPARATOR.'metrics.lock';
if(is_link($file)||is_link($lock))kp_metrics_stop(503);
$fh=@fopen($lock,'c');if(!$fh)kp_metrics_stop(503);
if(!flock($fh,LOCK_EX)){fclose($fh);kp_metrics_stop(503);}
$counts=is_file($file)?json_decode((string)@file_get_contents($file),true):[];
if(!is_array($counts)){$counts=[];}
$counts[$key]=min(PHP_INT_MAX-1,(int)($counts[$key]??0)+1);
$tmp=@tempnam($dir,'kp_');$ok=false;
if($tmp!==false){@chmod($tmp,0600);$ok=@file_put_contents($tmp,json_encode($counts,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE))!==false&&@rename($tmp,$file);if(!$ok)@unlink($tmp);}
flock($fh,LOCK_UN);fclose($fh);
kp_metrics_stop($ok?204:503);
