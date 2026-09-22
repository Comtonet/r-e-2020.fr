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
header('Cache-Control: public, max-age=0, must-revalidate');
header('ETag: ' . $etag);
if ($mtime > 0) header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
    http_response_code(304);
    exit;
}

$js = file_get_contents($source);

function qreplace(&$js, $from, $to) {
    if (strpos($js, $from) !== false) $js = str_replace($from, $to, $js);
}

/* Assets légers du site plutôt que les images base64 du prototype. */
$js = strtr($js, [
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
]);
qreplace($js, ' loading="lazy">', ' loading="lazy" decoding="async" fetchpriority="low" width="320" height="180">');

/* Données initiales : champs vides comme dans la version 11/09/2026. */
qreplace($js, "const F_SURF={k:'S',l:'Surface totale chauffée',u:'m²',t:'number',d:200,min:0,step:10};", "const F_SURF={k:'S',l:'Surface totale chauffée',u:'m²',t:'number',d:'',min:0,step:10};");
qreplace($js, "const F_SREF={k:'S',l:'Surface de référence totale',u:'m²',t:'number',d:500,min:0,step:10};", "const F_SREF={k:'S',l:'Surface de référence totale',u:'m²',t:'number',d:'',min:0,step:10};");
qreplace($js, "{k:'N',l:'Nombre total de logements',t:'number',d:2,min:1,step:1}", "{k:'N',l:'Nombre total de logements',t:'number',d:'',min:1,step:1}");
qreplace($js, "{k:'M',l:'Nombre total de modèles',t:'number',d:1,min:1,step:1", "{k:'M',l:'Nombre total de modèles',t:'number',d:'',min:1,step:1");
qreplace($js, "{k:'bats',l:'Logements par bâtiment',t:'bats',d:[18]}", "{k:'bats',l:'Logements par bâtiment',t:'bats',d:['']}");

/* Collectif : paliers jusqu'à 25 puis formule continue arrondie au multiple de 5. */
$old = <<<'JS'
function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}
JS;
$new = <<<'JS'
function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}function collectifMetre(x){const n=num(x),lim=num(C.collective_curve_threshold||25),a=num(C.collective_curve_a||36.492),b=num(C.collective_curve_b||11.067);return n>lim?Math.round((a*n+b)/5)*5:seuil(n,COL_METRE,0)}function avecPlancher(total,lignes,plancher){if(total<plancher){lignes.push({t:'Complément minimum de facturation',d:`pour atteindre le minimum de ${nb(plancher)} €`,v:plancher-total});return plancher}return total}
JS;
qreplace($js, trim($old), trim($new));
qreplace($js, 'const m=seuil(L,COL_METRE,0)', 'const m=collectifMetre(L)');
qreplace($js, 'const m=seuil(N,COL_METRE,0)', 'const m=collectifMetre(N)');
qreplace($js, 'const m=seuil(num(v),COL_METRE,0)', 'const m=collectifMetre(num(v))');

/* Bureaux : minimum de facturation 262,50 €. */
$old = <<<'JS'
return{permis:base+reu+circ+san,pu:p,lignes:[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:base},{t:'Salle de réunion',d:'10 % de la surface',v:reu},{t:'Circulation et accueil',d:'25 % de la surface',v:circ},{t:'Sanitaires collectifs',d:'3,5 % de la surface',v:san}]}
JS;
$new = <<<'JS'
const lignes=[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:base},{t:'Salle de réunion',d:'10 % de la surface',v:reu},{t:'Circulation et accueil',d:'25 % de la surface',v:circ},{t:'Sanitaires collectifs',d:'3,5 % de la surface',v:san}];return{permis:avecPlancher(base+reu+circ+san,lignes,262.5),pu:p,lignes}
JS;
qreplace($js, trim($old), trim($new));

/* Cabinet de santé : restauration + minimum de facturation. */
$old = <<<'JS'
SAN:{code:'SAN',nom:'Cabinet de santé',fam:'tertiaire',desc:'Cabinets médicaux, maisons de santé, salles de soins.',champs:[F_SURF,{k:'n',l:'Nombre de cabinets ou salles de soins',t:'number',d:6,min:0,step:1}],notes:[],calc:parLocal(1.25,GRILLE_LOCAL)},
JS;
$new = <<<'JS'
SAN:{code:'SAN',nom:'Cabinet de santé (dont kiné, véto, ...)',fam:'tertiaire',desc:'Cabinets médicaux, maisons de santé, salles de soins.',champs:[F_SURF,{k:'n',l:'Nombre de cabinets ou salles de soins',t:'number',d:6,min:0,step:1},F_RESTO],notes:[],calc(v){const S=num(v.S),n=num(v.n),p=n<=0?1.25:seuil(S/n,GRILLE_LOCAL,3.5),met=v.resto==='oui'?(C.article_metre||100):0,lignes=[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:S*p}];const base=avecPlancher(S*p,lignes,262.5);if(met)lignes.push({t:'Article de métré – restauration',d:'1 × 100 €',v:met});return{permis:base+met,pu:p,lignes}}},
JS;
qreplace($js, trim($old), trim($new));

/* Foyers / chambres : même plancher de 262,50 €. */
$old = <<<'JS'
return{permis:S*p+met,pu:p,lignes:[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:S*p},...(met?[{t:'Article de métré – réfectoire',d:'1 × 100 €',v:met}]:[])]}
JS;
$new = <<<'JS'
const lignes=[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:S*p},...(met?[{t:'Article de métré – réfectoire',d:'1 × 100 €',v:met}]:[])];return{permis:avecPlancher(S*p+met,lignes,262.5),pu:p,lignes}
JS;
qreplace($js, trim($old), trim($new));

/* Enseignement primaire / secondaire : nouvelle grille. */
qreplace($js, 'seuil(S/n,[[0,3],[20,1.5],[30,1.1]],3)', 'seuil(S/n,[[0,1.5],[25,1.1]],1.5)');

/* Université / enseignement supérieur. */
$uni = <<<'JS'
UNI:{code:'UNI',nom:'Université / enseignement supérieur',fam:'tertiaire',desc:'Facultés, écoles supérieures, amphithéâtres.',champs:[F_SURF,{k:'n',l:'Nombre de salles de cours',t:'number',d:10,min:0,step:1},{k:'amphi',l:'Amphithéâtre',t:'yesno',d:'non'},F_RESTO],notes:[],calc(v){const S=num(v.S),n=num(v.n),p=n<=1?3:seuil(S/n,[[0,1.1],[25,1.05]],1.1),pc=v.amphi==='oui'?.7:1,pa=v.amphi==='oui'?.3:0,met=v.resto==='oui'?(C.article_metre||100):0,lignes=[{t:'Salles de cours',d:`${nb(S*pc)} m² × ${nb(p)} €/m²`,v:S*pc*p}];if(pa)lignes.push({t:'Amphithéâtre',d:`${nb(S*pa)} m² × 0,80 €/m²`,v:S*pa*.8});if(met)lignes.push({t:'Article de métré – restauration',d:'1 × 100 €',v:met});return{permis:S*pc*p+S*pa*.8+met,pu:p,lignes}}},
JS;
qreplace($js, "HOT:{code:'HOT'", trim($uni) . "HOT:{code:'HOT'");

/* Locaux sociaux : forfait 200 € + 1,25 €/m². */
$soc = <<<'JS'
SOC:{code:'SOC',nom:'Locaux sociaux ou du personnel (vestiaire, bureaux, ...)',fam:'tertiaire',desc:'Vestiaires et espace de restauration du personnel.',champs:[F_SURF],notes:[],calc(v){const S=num(v.S);return{permis:200+S*1.25,pu:1.25,lignes:[{t:'Surface × prix unitaire',d:`${nb(S)} m² × 1,25 €/m²`,v:S*1.25},{t:'Forfait',d:'200 €',v:200}]}}},
VEN:{
JS;
$js = preg_replace("~SOC:\{code:'SOC'.*?\},\nVEN:\{~s", trim($soc), $js, 1);

/* Trois niveaux du site : Bbio / Bbio + FDC / totale avec ACV. */
$old = <<<'JS'
function prixLot(l){const r=USAGES[l.usage].calc(l.v)||{},permis=r.permis||0,complete=('complete'in r)?r.complete:permis+COMPL;return{...r,permis,complete,lignesC:r.lignesC||[...(r.lignes||[]),{t:'Complément étude complète',d:'130 € + 299 €',v:COMPL}]}}
JS;
$new = <<<'JS'
function prixLot(l){const r=USAGES[l.usage].calc(l.v)||{},permis=r.permis||0,complete=('complete'in r)?r.complete:permis+COMPL;let fdc;if('fdc'in r)fdc=r.fdc;else if(l.usage==='EXT')fdc=num(C.ext_fdc||274);else if(l.usage==='MI'||(l.usage==='LOG'&&num(l.v.N)<3)){const N=Math.max(1,num(l.v.N)||1);fdc=(C.mi_complete_forfait||125)+(C.mi_complete_unite||149)*N}else if(l.usage==='COL'||(l.usage==='LOG'&&num(l.v.N)>=3))fdc=permis+num(C.collective_fdc_forfait_delta||180);else fdc=permis+num(C.tertiaire_fdc_complement||130);fdc=Math.min(Math.max(permis,fdc),complete);const lignesF=[...(r.lignes||[])];if(fdc>permis)lignesF.push({t:'Complément fin de travaux',d:'Cep, Cep,nr, DH et livrables de fin de travaux',v:fdc-permis});return{...r,permis,fdc,complete,lignesF,lignesC:r.lignesC||[...(r.lignes||[]),{t:'Complément étude complète',d:'FDC + ACV',v:complete-permis}]}}
JS;
qreplace($js, trim($old), trim($new));

$old = <<<'JS'
function total(){let permis=0,complete=0;S.lots.forEach(l=>{const p=prixLot(l);permis+=p.permis*l.qte;complete+=p.complete*l.qte});const coef=S.famille==='mixte'&&!S.moaUnique?1.2:1;return{sousPermis:permis,sousComplete:complete,coef,permis:permis*coef,complete:complete*coef}}
JS;
$new = <<<'JS'
function total(){let permis=0,fdc=0,complete=0;S.lots.forEach(l=>{const p=prixLot(l);permis+=p.permis*l.qte;fdc+=p.fdc*l.qte;complete+=p.complete*l.qte});const coef=S.famille==='mixte'&&!S.moaUnique?1.2:1;return{sousPermis:permis,sousFdc:fdc,sousComplete:complete,coef,permis:permis*coef,fdc:fdc*coef,complete:complete*coef}}
JS;
qreplace($js, trim($old), trim($new));
qreplace($js, "const retenu=()=>S.prestation==='complete'?total().complete:total().permis;", "const retenu=()=>S.prestation==='complete'?total().complete:S.prestation==='fdc'?total().fdc:total().permis;");

$old = <<<'JS'
function resultLines(){let lines=[];S.lots.forEach(l=>{const p=prixLot(l),src=S.prestation==='complete'?p.lignesC:p.lignes;(src||[]).forEach(x=>lines.push({...x,t:(S.lots.length>1?USAGES[l.usage].nom+' — ':'')+x.t,v:x.v*l.qte}))});if(S.famille==='mixte'&&!S.moaUnique)lines.push({t:'Majoration multi-maîtrise d’ouvrage',d:'20 % sur l’ensemble de l’opération',v:(S.prestation==='complete'?total().sousComplete:total().sousPermis)*.2});return lines}
JS;
$new = <<<'JS'
function resultLines(){let lines=[];S.lots.forEach(l=>{const p=prixLot(l),src=S.prestation==='complete'?p.lignesC:S.prestation==='fdc'?p.lignesF:p.lignes;(src||[]).forEach(x=>lines.push({...x,t:(S.lots.length>1?USAGES[l.usage].nom+' — ':'')+x.t,v:x.v*l.qte}))});if(S.famille==='mixte'&&!S.moaUnique){const t=total(),base=S.prestation==='complete'?t.sousComplete:S.prestation==='fdc'?t.sousFdc:t.sousPermis;lines.push({t:'Majoration multi-maîtrise d’ouvrage',d:'20 % sur l’ensemble de l’opération',v:base*.2})}return lines}
JS;
qreplace($js, trim($old), trim($new));

$old = <<<'JS'
<div class="money ${S.prestation==='permis'?'hi':'mut'}"><span class="lbl">Permis</span><span class="amt">${eur(t.permis)}</span></div><div class="money ${S.prestation==='complete'?'hi':'mut'}"><span class="lbl">Étude complète</span><span class="amt">${eur(t.complete)}</span></div>
JS;
$new = <<<'JS'
<div class="money ${S.prestation==='permis'?'hi':'mut'}"><span class="lbl">Bbio</span><span class="amt">${eur(t.permis)}</span></div><div class="money ${S.prestation==='fdc'?'hi':'mut'}"><span class="lbl">Bbio + FDC</span><span class="amt">${eur(t.fdc)}</span></div><div class="money ${S.prestation==='complete'?'hi':'mut'}"><span class="lbl">Bbio + FDC + ACV</span><span class="amt">${eur(t.complete)}</span></div>
JS;
qreplace($js, trim($old), trim($new));

/* Libellés plus précis de la nouvelle version. */
qreplace($js, 'Bureaux, open space, coworking, coques.', 'Bureaux individuels, open space, co-working, coque vide.');
qreplace($js, 'Un modèle devient différent par sa surface (écart supérieur à 5 %), son nombre de niveaux, sa toiture ou son nombre de pièces principales.', 'Un modèle devient différent par sa surface (écart supérieur à 5 %), son nombre de niveaux, sa toiture ou son nombre de pièces principales. Une même enveloppe brute aménagée pour accueillir davantage de pièces principales constitue un nouveau modèle ; une façade orientée 5° plus au nord ou des baies élargies de 20 cm restent dans le même modèle.');

/* Nature supplémentaire : surélévation. Elle utilise le parcours de saisie neuf du moteur actuel. */
qreplace($js, "{id:'reno-neuf',t:'Une opération mixte de rénovation ou réhabilitation avec nouveau bâtiment neuf'}];", "{id:'reno-neuf',t:'Une opération mixte de rénovation ou réhabilitation avec nouveau bâtiment neuf'},{id:'sur',t:'Une surélévation seule'}];");
qreplace($js, "const aPartieNeuve=n=>['neuf','mixte-ne','reno-neuf'].includes(n)", "const aPartieNeuve=n=>['neuf','mixte-ne','reno-neuf','sur'].includes(n)");

/* Expose un état de lecture seule pour le parcours public : le site peut
   conserver le chiffrage lors de la création du compte sans dupliquer
   le moteur de calcul. */
qreplace($js, "render();\n})();", "window.KP_QUOTE_ENGINE={getState:()=>JSON.parse(JSON.stringify(S)),getTotals:()=>({...total()}),getRetained:()=>retenu()};\nrender();\n})();");

echo $js;
