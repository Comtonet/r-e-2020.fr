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
/* Le moteur évolue régulièrement : revalidation plutôt qu'un cache immutable d'un an. */
header('Cache-Control: public, max-age=0, must-revalidate');
header('ETag: ' . $etag);
if ($mtime > 0) header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
    http_response_code(304);
    exit;
}

$js = file_get_contents($source);

/* Images d'accueil allégées : on conserve les assets du site plutôt que les base64 du prototype. */
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

/* -------------------------------------------------------------------------
   Evolutions provenant du calculateur transmis le 11/09/2026.
   ------------------------------------------------------------------------- */

/* 1) Les champs principaux démarrent vides : pas de devis artificiel pré-rempli. */
$js = str_replace("const F_SURF={k:'S',l:'Surface totale chauffée',u:'m²',t:'number',d:200,min:0,step:10};", "const F_SURF={k:'S',l:'Surface totale chauffée',u:'m²',t:'number',d:'',min:0,step:10};", $js);
$js = str_replace("const F_SREF={k:'S',l:'Surface de référence totale',u:'m²',t:'number',d:500,min:0,step:10};", "const F_SREF={k:'S',l:'Surface de référence totale',u:'m²',t:'number',d:'',min:0,step:10};", $js);
$js = str_replace("{k:'N',l:'Nombre total de logements',t:'number',d:2,min:1,step:1}", "{k:'N',l:'Nombre total de logements',t:'number',d:'',min:1,step:1}", $js);
$js = str_replace("{k:'M',l:'Nombre total de modèles',t:'number',d:1,min:1,step:1", "{k:'M',l:'Nombre total de modèles',t:'number',d:'',min:1,step:1", $js);
$js = str_replace("{k:'bats',l:'Logements par bâtiment',t:'bats',d:[18]}", "{k:'bats',l:'Logements par bâtiment',t:'bats',d:['']}", $js);

/* 2) Collectif : grille historique jusqu'à 25 logements puis formule continue,
      arrondie au multiple de 5 le plus proche à partir de 26 logements. */
$js = str_replace(
    'function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}',
    'function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}function collectifMetre(x){const n=num(x),lim=num(C.collective_curve_threshold||25),a=num(C.collective_curve_a||36.492),b=num(C.collective_curve_b||11.067);return n>lim?Math.round((a*n+b)/5)*5:seuil(n,COL_METRE,0)}function avecPlancher(total,lignes,plancher){if(total<plancher){lignes.push({t:\'Complément minimum de facturation\',d:`pour atteindre le minimum de ${nb(plancher)} €`,v:plancher-total});return plancher}return total}',
    $js
);
$js = str_replace('const m=seuil(L,COL_METRE,0)', 'const m=collectifMetre(L)', $js);
$js = str_replace('const m=seuil(N,COL_METRE,0)', 'const m=collectifMetre(N)', $js);
$js = str_replace('const m=seuil(num(v),COL_METRE,0)', 'const m=collectifMetre(num(v))', $js);

/* 3) Petits tertiaires : minimum de facturation à 262,50 € sur bureaux,
      cabinets de santé et foyers/chambres lorsque leur calcul est inférieur. */
$js = str_replace(
    "return{permis:base+reu+circ+san,pu:p,lignes:[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:base},{t:'Salle de réunion',d:'10 % de la surface',v:reu},{t:'Circulation et accueil',d:'25 % de la surface',v:circ},{t:'Sanitaires collectifs',d:'3,5 % de la surface',v:san}]}",
    "const lignes=[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:base},{t:'Salle de réunion',d:'10 % de la surface',v:reu},{t:'Circulation et accueil',d:'25 % de la surface',v:circ},{t:'Sanitaires collectifs',d:'3,5 % de la surface',v:san}];return{permis:avecPlancher(base+reu+circ+san,lignes,262.5),pu:p,lignes}",
    $js
);
$js = str_replace(
    "SAN:{code:'SAN',nom:'Cabinet de santé',fam:'tertiaire',desc:'Cabinets médicaux, maisons de santé, salles de soins.',champs:[F_SURF,{k:'n',l:'Nombre de cabinets ou salles de soins',t:'number',d:6,min:0,step:1}],notes:[],calc:parLocal(1.25,GRILLE_LOCAL)},",
    "SAN:{code:'SAN',nom:'Cabinet de santé (dont kiné, véto, ...)',fam:'tertiaire',desc:'Cabinets médicaux, maisons de santé, salles de soins.',champs:[F_SURF,{k:'n',l:'Nombre de cabinets ou salles de soins',t:'number',d:'',min:0,step:1},F_RESTO],notes:[],calc(v){const S=num(v.S),n=num(v.n),p=n<=0?1.25:seuil(S/n,GRILLE_LOCAL,3.5),met=v.resto==='oui'?(C.article_metre||100):0,lignes=[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:S*p}];const base=avecPlancher(S*p,lignes,262.5);if(met)lignes.push({t:'Article de métré – restauration',d:'1 × 100 €',v:met});return{permis:base+met,pu:p,lignes}}},",
    $js
);
$js = str_replace(
    "return{permis:S*p+met,pu:p,lignes:[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:S*p},...(met?[{t:'Article de métré – réfectoire',d:'1 × 100 €',v:met}]:[])]}",
    "const lignes=[{t:'Surface × prix unitaire',d:`${nb(S)} m² × ${nb(p)} €/m²`,v:S*p},...(met?[{t:'Article de métré – réfectoire',d:'1 × 100 €',v:met}]:[])];return{permis:avecPlancher(S*p+met,lignes,262.5),pu:p,lignes}",
    $js
);

/* 4) Enseignement : grille révisée du fichier 11/09. */
$js = str_replace("seuil(S/n,[[0,3],[20,1.5],[30,1.1]],3)", "seuil(S/n,[[0,1.5],[25,1.1]],1.5)", $js);

/* 5) Université / enseignement supérieur : nouvel usage. */
$uni = <<<'JS'
UNI:{code:'UNI',nom:'Université / enseignement supérieur',fam:'tertiaire',desc:'Facultés, écoles supérieures, amphithéâtres.',champs:[F_SURF,{k:'n',l:'Nombre de salles de cours',t:'number',d:'',min:0,step:1},{k:'amphi',l:'Amphithéâtre',t:'yesno',d:'non'},F_RESTO],notes:[],calc(v){const S=num(v.S),n=num(v.n),p=n<=1?3:seuil(S/n,[[0,1.1],[25,1.05]],1.1),pc=v.amphi==='oui'?.7:1,pa=v.amphi==='oui'?.3:0,met=v.resto==='oui'?(C.article_metre||100):0,lignes=[{t:'Salles de cours',d:`${nb(S*pc)} m² × ${nb(p)} €/m²`,v:S*pc*p}];if(pa)lignes.push({t:'Amphithéâtre',d:`${nb(S*pa)} m² × 0,80 €/m²`,v:S*pa*.8});if(met)lignes.push({t:'Article de métré – restauration',d:'1 × 100 €',v:met});return{permis:S*pc*p+S*pa*.8+met,pu:p,lignes}}},
JS;
$js = str_replace("HOT:{code:'HOT'", $uni . "HOT:{code:'HOT'", $js);

/* 6) Locaux sociaux : forfait 200 € + 1,25 €/m² (version du 11/09). */
$js = preg_replace(
    "~SOC:\{code:'SOC'.*?\},\nVEN:\{~s",
    "SOC:{code:'SOC',nom:'Locaux sociaux ou du personnel (vestiaire, bureaux, ...)',fam:'tertiaire',desc:'Vestiaires et espace de restauration du personnel.',champs:[F_SURF],notes:[],calc(v){const S=num(v.S);return{permis:200+S*1.25,pu:1.25,lignes:[{t:'Surface × prix unitaire',d:`${nb(S)} m² × 1,25 €/m²`,v:S*1.25},{t:'Forfait',d:'200 €',v:200}]}}},\nVEN:{",
    $js,
    1
);

/* 7) Trois niveaux conservés sur le site : Bbio, Bbio + FDC, puis totale avec ACV. */
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
$js = str_replace(
    '<div class="money ${S.prestation===\'permis\'?\'hi\':\'mut\'}"><span class="lbl">Permis</span><span class="amt">${eur(t.permis)}</span></div><div class="money ${S.prestation===\'complete\'?\'hi\':\'mut\'}"><span class="lbl">Étude complète</span><span class="amt">${eur(t.complete)}</span></div>',
    '<div class="money ${S.prestation===\'permis\'?\'hi\':\'mut\'}"><span class="lbl">Bbio</span><span class="amt">${eur(t.permis)}</span></div><div class="money ${S.prestation===\'fdc\'?\'hi\':\'mut\'}"><span class="lbl">Bbio + FDC</span><span class="amt">${eur(t.fdc)}</span></div><div class="money ${S.prestation===\'complete\'?\'hi\':\'mut\'}"><span class="lbl">Bbio + FDC + ACV</span><span class="amt">${eur(t.complete)}</span></div>',
    $js
);

/* 8) Quelques libellés / explications issus de la nouvelle version. */
$js = str_replace('Bureaux, open space, coworking, coques.', 'Bureaux individuels, open space, co-working, coque vide.', $js);
$js = str_replace('Cabinet de santé', 'Cabinet de santé (dont kiné, véto, ...)', $js);
$js = str_replace('Un modèle devient différent par sa surface (écart supérieur à 5 %), son nombre de niveaux, sa toiture ou son nombre de pièces principales.', 'Un modèle devient différent par sa surface (écart supérieur à 5 %), son nombre de niveaux, sa toiture ou son nombre de pièces principales. Une même enveloppe brute aménagée pour accueillir davantage de pièces principales constitue un nouveau modèle ; une façade orientée 5° plus au nord ou des baies élargies de 20 cm restent dans le même modèle.', $js);

/* Surélévation : la nouvelle version l'identifie désormais comme nature distincte.
   On l'expose dans le choix et on la traite comme une partie neuve pour conserver
   un parcours fonctionnel avec le moteur du site ; le chiffrage détaillé spécifique
   reste piloté par les données saisies dans le lot. */
$js = str_replace("{id:'reno-neuf',t:'Une opération mixte de rénovation ou réhabilitation avec nouveau bâtiment neuf'}];", "{id:'reno-neuf',t:'Une opération mixte de rénovation ou réhabilitation avec nouveau bâtiment neuf'},{id:'sur',t:'Une surélévation seule'}];", $js);
$js = str_replace("const aPartieNeuve=n=>['neuf','mixte-ne','reno-neuf'].includes(n)", "const aPartieNeuve=n=>['neuf','mixte-ne','reno-neuf','sur'].includes(n)", $js);

/* CSS complémentaire requis par les nouveaux choix. */
$css = <<<'JS'
const qvStyle=document.createElement('style');qvStyle.textContent=`
.devis-app .sameas select{font-size:12.5px;padding:7px 9px;border-radius:8px;border:1px solid var(--line);background:var(--card);color:var(--indigo);font-weight:600;cursor:pointer;max-width:100%}
.devis-app .sameas select.off{border-style:dashed;background:#fbfcfe}
.devis-app .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
.devis-app .note.clignote{background:#fbedE9;border-left:3px solid var(--brick);color:#7c2d1b;font-weight:600}
.devis-app .choix-ex{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}.devis-app .choix-ex.two{grid-template-columns:repeat(2,1fr)}
@media(max-width:720px){.devis-app .choix-ex,.devis-app .choix-ex.two{grid-template-columns:1fr}}
`;document.head.appendChild(qvStyle);
JS;
$js = str_replace("'use strict';", "'use strict';\n" . $css, $js);

echo $js;
