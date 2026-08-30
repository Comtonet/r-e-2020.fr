<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, max-age=0');
header('X-Robots-Tag: noindex, nofollow');

if(($_SERVER['REQUEST_METHOD']??'')!=='POST'){http_response_code(405);echo json_encode(['ok'=>false,'error'=>'POST requis.']);exit;}

$secretsFile=__DIR__.'/../inc/secrets.php';
$secrets=is_file($secretsFile)?require $secretsFile:[];
if(!is_array($secrets))$secrets=[];
$token=trim((string)($secrets['keepote_log_token']??''));
$auth=(string)($_SERVER['HTTP_AUTHORIZATION']??$_SERVER['REDIRECT_HTTP_AUTHORIZATION']??'');
$xToken=trim((string)($_SERVER['HTTP_X_KEEPOTE_TOKEN']??''));
$accepted=$token!==''&&(hash_equals('Bearer '.$token,$auth)||hash_equals($token,$xToken));
if(!$accepted){http_response_code(403);echo json_encode(['ok'=>false,'error'=>'Token refusé.']);exit;}

$apiKey=trim((string)getenv('OPENAI_API_KEY'));
if($apiKey==='')$apiKey=trim((string)($secrets['openai_api_key']??''));
if($apiKey===''){http_response_code(503);echo json_encode(['ok'=>false,'error'=>'Clé IA absente côté site.']);exit;}

$input=json_decode((string)file_get_contents('php://input'),true);
if(!is_array($input)){http_response_code(400);echo json_encode(['ok'=>false,'error'=>'Requête invalide.']);exit;}
$instructions=mb_substr((string)($input['instructions']??''),0,120000);
$messages=$input['input']??[];
if(!is_array($messages)||$instructions===''){http_response_code(422);echo json_encode(['ok'=>false,'error'=>'Contexte invalide.']);exit;}
$model=trim((string)($input['model']??'gpt-5.6-luna')) ?: 'gpt-5.6-luna';
$max=max(100,min(1400,(int)($input['max_output_tokens']??900)));
$payload=['model'=>$model,'instructions'=>$instructions,'input'=>$messages,'max_output_tokens'=>$max];

$ch=curl_init('https://api.openai.com/v1/responses');
curl_setopt_array($ch,[CURLOPT_POST=>true,CURLOPT_RETURNTRANSFER=>true,CURLOPT_CONNECTTIMEOUT=>10,CURLOPT_TIMEOUT=>45,CURLOPT_HTTPHEADER=>['Authorization: Bearer '.$apiKey,'Content-Type: application/json'],CURLOPT_POSTFIELDS=>json_encode($payload,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)]);
$body=curl_exec($ch);$error=curl_error($ch);$status=(int)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);curl_close($ch);
if($body===false||$error!==''){http_response_code(502);echo json_encode(['ok'=>false,'error'=>'Service IA injoignable.']);exit;}
$response=json_decode((string)$body,true);
if($status<200||$status>=300||!is_array($response)){http_response_code(502);echo json_encode(['ok'=>false,'error'=>'Erreur du service IA.']);exit;}
$answer='';
foreach(($response['output']??[]) as $out){if(!is_array($out))continue;foreach(($out['content']??[]) as $c){if(is_array($c)&&($c['type']??'')==='output_text'&&isset($c['text'])){$answer=trim((string)$c['text']);break 2;}}}
if($answer===''){http_response_code(502);echo json_encode(['ok'=>false,'error'=>'Réponse IA vide.']);exit;}
echo json_encode(['ok'=>true,'answer'=>$answer,'response_id'=>(string)($response['id']??''),'model'=>$model],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
