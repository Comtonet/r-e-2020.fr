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

/*
 * Logement collectif : conservation de la grille historique jusqu'à 25 logements,
 * puis prolongement continu sans plafond via la courbe paramétrable du config.php.
 */
$js = str_replace(
    'function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}',
    'function seuil(x,t,d){let r=d;for(const [s,v] of t)if(x>=s)r=v;return r}function collectifMetre(x){const n=num(x),lim=num(C.collective_curve_threshold||25),a=num(C.collective_curve_a||36.492),b=num(C.collective_curve_b||11.067);return n>lim?a*n+b:seuil(n,COL_METRE,0)}',
    $js
);
$js = str_replace('const m=seuil(L,COL_METRE,0)', 'const m=collectifMetre(L)', $js);
$js = str_replace('const m=seuil(N,COL_METRE,0)', 'const m=collectifMetre(N)', $js);
$js = str_replace('const m=seuil(num(v),COL_METRE,0)', 'const m=collectifMetre(num(v))', $js);

echo $js;
