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
 * Qualification strictement étape par étape :
 * 1 nature de l'opération -> 2 type de bâtiment -> 3 niveau de prestation.
 * Le choix de prestation, anciennement en premier, passe volontairement en dernier.
 */
$accueil = <<<'JS'
function renderAccueil(){
 const nature=`<section class="block"><h2>1. Quelle est la nature de l’opération ?</h2><p class="hint">Commencez par qualifier l’opération. La suite apparaît après votre choix.</p><div class="opts">${NATURES.map(n=>`<button class="opt" data-act="nature" data-id="${n.id}" aria-pressed="${S.nature===n.id}"><span class="tick"></span><span><strong>${n.t}</strong></span></button>`).join('')}</div></section>`;
 const famille=S.nature?`<section class="block"><h2>2. Quel type de bâtiment concerne l’opération ?</h2><p class="hint">Choisissez la planche correspondant au projet.</p>${FAMILLES.map(planche).join('')}</section>`:'';
 const prestation=S.famille?`<section class="block"><h2>3. Jusqu’où souhaitez-vous aller ?</h2><p class="hint">Dernière étape avant la saisie détaillée. Le permis seul et l’étude complète sont deux niveaux distincts.</p><div class="opts two">${PRESTATIONS.map(p=>`<button class="opt" data-act="prestation" data-id="${p.id}" aria-pressed="${S.prestation===p.id}"><span class="tick"></span><span><strong>${p.t}</strong><small>${p.s}</small></span></button>`).join('')}</div></section>`:'';
 $('#quoteScreen').innerHTML=`<section class="hero"><div class="eyebrow">Devis étude thermique RE2020</div><h1>Décrivez votre opération.<em>Obtenez le bon chiffrage.</em></h1><p class="lede">Chaque étape devient accessible uniquement lorsque la précédente est renseignée.</p></section>${nature}${famille}${prestation}`
}
JS;
$js = preg_replace('~function renderAccueil\(\)\{.*?\}\nfunction field~s', $accueil . "\nfunction field", $js, 1);

/*
 * Pour un permis seul, le devis affiche des compléments purement informatifs.
 * Ils ne sont jamais ajoutés au total : CEP / CEP,nr 130 € et ACV indicative 299 €.
 */
$needle = '</div></div><div class="pay"><h4>Lancer l’étude</h4>';
$permitInfo = <<<'JS'
</div></div>${S.prestation==='permis'?`<div class="panel" style="margin:18px 0;background:#f8f9fc"><div class="panel-h"><span class="chip o">À titre informatif</span><h3>Si vous souhaitez aller au-delà du permis</h3></div><div class="grid2"><div class="note info"><b>CEP / CEP,nr</b><br>Complément énergétique indicatif : <strong>130 € TTC</strong>.</div><div class="note info"><b>ACV RE2020</b><br>Prix indicatif du complément ACV : <strong>299 € TTC</strong>.</div></div><p class="hint" style="margin-top:12px">Ces montants sont indiqués séparément et ne sont pas ajoutés au total du permis seul.</p></div>`:''}<div class="pay"><h4>Lancer l’étude</h4>
JS;
$js = str_replace($needle, $permitInfo, $js);

echo $js;
