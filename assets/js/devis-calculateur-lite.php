<?php
header('Content-Type: application/javascript; charset=UTF-8');

$source = __DIR__ . '/devis-calculateur.js';
if (!is_file($source)) {
    http_response_code(404);
    echo "console.error('Calculateur RE2020 introuvable');";
    exit;
}

$mtime = max((int) @filemtime($source), (int) @filemtime(__FILE__));
$etag = '"devis-' . md5($mtime . ':' . (int) @filesize($source) . ':' . (int) @filesize(__FILE__)) . '"';
header('Cache-Control: public, max-age=31536000, immutable');
header('ETag: ' . $etag);
if ($mtime > 0) header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
    http_response_code(304);
    exit;
}

$js = file_get_contents($source);

/* Images d'accueil allégées. */
$replacements = [
    'Collectif/Collectif classique.png' => 'Collectif.jpg',
    'Collectif/Collectif simple de 2x2.png' => 'Collectif.jpg',
    'Collectif/Collectif simple superposés 1-1-1.png' => 'Collectif.jpg',
    'Maisons/1 maison sur deux.jpg' => 'Maisons.jpg',
    'Maisons/Lotissement.png' => 'Maisons.jpg',
    'Maisons/Maison jumelées.png' => 'Maisons.jpg',
    'Tertiaire/Atelier.png' => 'Tertiaire.jpg',
    'Tertiaire/Café.png' => 'Tertiaire.jpg',
    'Tertiaire/Industrie.png' => 'Tertiaire.jpg',
    'Mixte/Unité/Lots tertiaire + collectif + maison.png' => 'Mixte.jpg',
    'Mixte/Unité/Multizone café + collectif.png' => 'Mixte.jpg',
    'Mixte/Unité/Tertiaire + logement de fonction.png' => 'Mixte.jpg',
];
$js = strtr($js, $replacements);
$js = str_replace(' loading="lazy">', ' loading="lazy" decoding="async" fetchpriority="low" width="320" height="180">', $js);

/* Logement collectif : grille historique puis prolongement sans plafond. */
$js = str_replace(
    'function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}',
    'function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}function collectifMetre(x){const n=num(x),lim=num(C.collective_curve_threshold||25),a=num(C.collective_curve_a||36.492),b=num(C.collective_curve_b||11.067);return n>lim?a*n+b:seuil(n,COL_METRE,0)}',
    $js
);
$js = str_replace('const m=seuil(L,COL_METRE,0)', 'const m=collectifMetre(L)', $js);
$js = str_replace('const m=seuil(N,COL_METRE,0)', 'const m=collectifMetre(N)', $js);
$js = str_replace('const m=seuil(num(v),COL_METRE,0)', 'const m=collectifMetre(num(v))', $js);

/* Trois niveaux : Bbio, Bbio + FDC, puis étude totale avec ACV. */
$js = str_replace(
    "function prixLot(l){const r=USAGES[l.usage].calc(l.v)||{},permis=r.permis||0,complete=('complete'in r)?r.complete:permis+COMPL;return{...r,permis,complete,lignesC:r.lignesC||[...(r.lignes||[]),{t:'Complément étude complète',d:'130 € + 299 €',v:COMPL}]}}",
    "function prixLot(l){const r=USAGES[l.usage].calc(l.v)||{},permis=r.permis||0,complete=('complete'in r)?r.complete:permis+COMPL;let fdc;if('fdc'in r)fdc=r.fdc;else if(l.usage==='EXT')fdc=num(C.ext_fdc||274);else if(l.usage==='MI'||(l.usage==='LOG'&&num(l.v.N)<3)){const N=Math.max(1,num(l.v.N)||1);fdc=(C.mi_complete_forfait||125)+(C.mi_complete_unite||149)*N}else if(l.usage==='COL'||(l.usage==='LOG'&&num(l.v.N)>=3))fdc=permis+num(C.collective_fdc_forfait_delta||180);else fdc=permis+num(C.tertiaire_fdc_complement||130);fdc=Math.min(Math.max(permis,fdc),complete);const lignesF=[...(r.lignes||[])];if(fdc>permis)lignesF.push({t:'Complément fin de travaux',d:'Cep, Cep,nr, DH et livrables de fin de travaux',v:fdc-permis});return{...r,permis,fdc,complete,lignesF,lignesC:r.lignesC||[...(r.lignes||[]),{t:'Complément étude complète',d:'FDC + ACV',v:complete-permis}]}}",
    $js
);
$js = str_replace(
    "function total(){let permis=0,complete=0;S.lots.forEach(l=>{const p=prixLot(l);permis+=p.permis*l.qte;complete+=p.complete*l.qte});const coef=S.famille==='mixte'&&!S.moaUnique?1.2:1;return{sousPermis:permis,sousComplete:complete,coef,permis:permis*coef,complete:complete*coef}}",
    "function total(){let permis=0,fdc=0,complete=0;S.lots.forEach(l=>{const p=prixLot(l);permis+=p.permis*l.qte;fdc+=p.fdc*l.qte;complete+=p.complete*l.qte});const coef=S.famille==='mixte'&&!S.moaUnique?1.2:1;return{sousPermis:permis,sousFdc:fdc,sousComplete:complete,coef,permis:permis*coef,fdc:fdc*coef,complete:complete*coef}}",
    $js
);
$js = str_replace(
    "const retenu=()=>S.prestation==='complete'?total().complete:total().permis;",
    "const retenu=()=>S.prestation==='complete'?total().complete:S.prestation==='fdc'?total().fdc:total().permis;",
    $js
);
$js = str_replace(
    "function resultLines(){let lines=[];S.lots.forEach(l=>{const p=prixLot(l),src=S.prestation==='complete'?p.lignesC:p.lignes;(src||[]).forEach(x=>lines.push({...x,t:(S.lots.length>1?USAGES[l.usage].nom+' — ':'')+x.t,v:x.v*l.qte}))});if(S.famille==='mixte'&&!S.moaUnique)lines.push({t:'Majoration multi-maîtrise d’ouvrage',d:'20 % sur l’ensemble de l’opération',v:(S.prestation==='complete'?total().sousComplete:total().sousPermis)*.2});return lines}",
    "function resultLines(){let lines=[];S.lots.forEach(l=>{const p=prixLot(l),src=S.prestation==='complete'?p.lignesC:S.prestation==='fdc'?p.lignesF:p.lignes;(src||[]).forEach(x=>lines.push({...x,t:(S.lots.length>1?USAGES[l.usage].nom+' — ':'')+x.t,v:x.v*l.qte}))});if(S.famille==='mixte'&&!S.moaUnique){const t=total(),base=S.prestation==='complete'?t.sousComplete:S.prestation==='fdc'?t.sousFdc:t.sousPermis;lines.push({t:'Majoration multi-maîtrise d’ouvrage',d:'20 % sur l’ensemble de l’opération',v:base*.2})}return lines}",
    $js
);

/* Le récapitulatif reste caché visuellement mais fournit les trois montants à l'interface finale. */
$js = str_replace(
    "<div class=\"money ${S.prestation==='permis'?'hi':'mut'}\"><span class=\"lbl\">Permis</span><span class=\"amt\">${eur(t.permis)}</span></div><div class=\"money ${S.prestation==='complete'?'hi':'mut'}\"><span class=\"lbl\">Étude complète</span><span class=\"amt\">${eur(t.complete)}</span></div>",
    "<div class=\"money ${S.prestation==='permis'?'hi':'mut'}\"><span class=\"lbl\">Bbio</span><span class=\"amt\">${eur(t.permis)}</span></div><div class=\"money ${S.prestation==='fdc'?'hi':'mut'}\"><span class=\"lbl\">Bbio + FDC</span><span class=\"amt\">${eur(t.fdc)}</span></div><div class=\"money ${S.prestation==='complete'?'hi':'mut'}\"><span class=\"lbl\">Bbio + FDC + ACV</span><span class=\"amt\">${eur(t.complete)}</span></div>",
    $js
);
$js = str_replace("S.prestation==='complete'?'Étude complète':S.prestation==='permis'?'Permis seul':'—'", "S.prestation==='complete'?'Bbio + FDC + ACV':S.prestation==='fdc'?'Bbio + FDC':S.prestation==='permis'?'Bbio':'—'", $js);
$js = str_replace("S.prestation==='complete'?'Étude complète':'Permis uniquement'", "S.prestation==='complete'?'Bbio + FDC + ACV':S.prestation==='fdc'?'Bbio + FDC':'Bbio'", $js);
$js = str_replace("${S.prestation==='complete'?'étude complète':'permis seul'}", "${S.prestation==='complete'?'Bbio + FDC + ACV':S.prestation==='fdc'?'Bbio + FDC':'Bbio'}", $js);

echo $js;
