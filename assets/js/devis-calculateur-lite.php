<?php
header('Content-Type: application/javascript; charset=UTF-8');

$source = __DIR__ . '/devis-calculateur.js';
if (!is_file($source)) {
    http_response_code(404);
    echo "console.error('Calculateur RE2020 introuvable');";
    exit;
}

/* Cache long : la version de l'URL est incrémentée à chaque évolution. */
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

/* Images d'accueil allégées : 4 JPG réutilisés au lieu des PNG lourds. */
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

/*
 * Qualification initiale strictement progressive :
 * 1 nature de l'opération -> 2 type de bâtiment.
 * Le choix Dépôt de PC / Étude totale n'est plus ici : il est placé tout en
 * bas de la saisie technique, juste avant l'accès au devis.
 */
$accueil = <<<'JS'
function renderAccueil(){
 const nature=`<section class="block"><h2>1. Quelle est la nature de l’opération ?</h2><p class="hint">Commencez par qualifier l’opération. La suite apparaît après votre choix.</p><div class="opts">${NATURES.map(n=>`<button class="opt" data-act="nature" data-id="${n.id}" aria-pressed="${S.nature===n.id}"><span class="tick"></span><span><strong>${n.t}</strong></span></button>`).join('')}</div></section>`;
 const famille=S.nature?`<section class="block"><h2>2. Quel type de bâtiment concerne l’opération ?</h2><p class="hint">Choisissez la planche correspondant au projet.</p>${FAMILLES.map(planche).join('')}</section>`:'';
 $('#quoteScreen').innerHTML=`<section class="hero"><div class="eyebrow">Devis étude thermique RE2020</div><h1>Décrivez votre opération.<em>Obtenez le bon chiffrage.</em></h1><p class="lede">La saisie se déroule étape par étape. Le niveau de prestation sera choisi seulement à la toute fin.</p></section>${nature}${famille}`
}
JS;
$js = preg_replace('~function renderAccueil\(\)\{.*?\}\nfunction field~s', $accueil . "\nfunction field", $js, 1);

/* L'accueil ne bloque plus sur la prestation : nature + famille suffisent. */
$js = str_replace(
    "if(!S.prestation)miss.push('la prestation');if(!S.nature)miss.push('la nature du dossier');if(!S.famille)miss.push('le type de bâtiment');",
    "if(!S.nature)miss.push('la nature du dossier');if(!S.famille)miss.push('le type de bâtiment');",
    $js
);
$js = str_replace(
    "txt.innerHTML=ok?`${esc(FAMILLES.find(f=>f.id===S.famille)?.t)} — ${S.prestation==='complete'?'étude complète':'permis seul'}`:`Il reste à renseigner ${miss.join(', ')}.`;",
    "txt.innerHTML=ok?`${esc(FAMILLES.find(f=>f.id===S.famille)?.t)} — vous pouvez maintenant détailler le projet`:`Il reste à renseigner ${miss.join(', ')}.`;",
    $js
);
$js = str_replace(
    "bar.classList.toggle('show',!!(S.prestation||S.nature||S.famille))",
    "bar.classList.toggle('show',!!(S.nature||S.famille))",
    $js
);

/* Le bouton d'accueil passe en saisie sans exiger le choix de prestation. */
$js = str_replace(
    "if(S.ecran==='accueil'&&S.prestation&&S.nature&&S.famille){",
    "if(S.ecran==='accueil'&&S.nature&&S.famille){",
    $js
);

/*
 * Ajout du choix de prestation à la FIN de la saisie technique.
 * On conserve les deux tarifs calculés par le moteur pendant toute la saisie.
 */
$needleSaisie = "</section>${bandeauReno()}${corps}`}";
$replacementSaisie = <<<'JS'
</section>${bandeauReno()}${corps}<section class="panel choix-prestation-final"><div class="panel-h"><span class="chip o">Dernière étape</span><h3>Que souhaitez-vous commander ?</h3></div><p class="hint">Votre projet est maintenant chiffré. Choisissez seulement maintenant le niveau de prestation.</p><div class="opts two">${PRESTATIONS.map(p=>`<button class="opt" data-act="prestation" data-id="${p.id}" aria-pressed="${S.prestation===p.id}"><span class="tick"></span><span><strong>${p.id==='permis'?'Dépôt de permis de construire':'Étude RE2020 totale'}</strong><small>${p.s}</small></span></button>`).join('')}</div><div class="grid2" style="margin-top:14px"><div class="note info"><b>Dépôt de PC</b><br><strong>${eur(total().permis)} TTC</strong></div><div class="note info"><b>Étude totale</b><br><strong>${eur(total().complete)} TTC</strong></div></div></section>`}
JS;
$js = str_replace($needleSaisie, $replacementSaisie, $js);

/* En saisie, impossible d'accéder au devis tant que le dernier choix n'est pas fait. */
$js = str_replace(
    "next.disabled=!S.lots.length;next.textContent='Voir mon devis';txt.innerHTML=`Montant estimé : <b>${eur(retenu())}</b>`",
    "next.disabled=!S.lots.length||!S.prestation;next.textContent=S.prestation?'Voir mon devis':'Choisissez votre prestation';txt.innerHTML=S.prestation?`Montant retenu : <b>${eur(retenu())}</b>`:`Projet chiffré : PC <b>${eur(total().permis)}</b> · étude totale <b>${eur(total().complete)}</b>`",
    $js
);
$js = str_replace(
    "else if(S.ecran==='saisie'&&S.lots.length){S.ecran='devis';render(true)}",
    "else if(S.ecran==='saisie'&&S.lots.length&&S.prestation){S.ecran='devis';render(true)}",
    $js
);

/*
 * PC seul : information commerciale calculée depuis le VRAI chiffrage du
 * dossier. On ne décompose pas artificiellement le supplément en montants
 * fixes : le cahier des charges prévoit des formules différentes pour les
 * maisons, le collectif et les autres usages.
 */
$needleDevis = '</div></div><div class="pay"><h4>Lancer l’étude</h4>';
$permitInfo = <<<'JS'
</div></div>${S.prestation==='permis'?(()=>{const t=total(),sup=Math.max(0,t.complete-t.permis);return `<div class="panel" style="margin:18px 0;background:#f8f9fc"><div class="panel-h"><span class="chip o">À titre informatif</span><h3>Pour aller plus loin après le dépôt de PC</h3></div><div class="note info"><b>Étude énergétique complète : Cep, Cep,nr, DH + ACV RE2020</b><br>Sur la base exacte de votre dossier, le passage de la prestation PC à l’étude totale représente <strong>+ ${eur(sup)} TTC</strong>, soit un total étude complète de <strong>${eur(t.complete)} TTC</strong>.</div><p class="hint" style="margin-top:12px">Ce montant est calculé avec la grille correspondant à votre typologie, vos logements, bâtiments et usages. Il n’est pas ajouté au total tant que vous commandez uniquement le dépôt de PC.</p></div>`})():''}<div class="pay"><h4>Lancer l’étude</h4>
JS;
$js = str_replace($needleDevis, $permitInfo, $js);

echo $js;
