<?php
header('Content-Type: application/javascript; charset=UTF-8');

$source = __DIR__ . '/devis-calculateur.js';
if (!is_file($source)) {
    http_response_code(404);
    echo "console.error('Calculateur RE2020 introuvable');";
    exit;
}

/*
 * Le moteur change uniquement lors d'un déploiement Git : on autorise donc
 * un cache navigateur/CDN long. La version dans l'URL est incrémentée lors
 * des modifications pour invalider immédiatement l'ancien fichier.
 */
$mtime = (int) @filemtime($source);
$etag = '"devis-' . md5($mtime . ':' . (int) @filesize($source)) . '"';
header('Cache-Control: public, max-age=31536000, immutable');
header('ETag: ' . $etag);
if ($mtime > 0) {
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
}
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
    http_response_code(304);
    exit;
}

$js = file_get_contents($source);

/*
 * Les visuels détaillés originaux pèsent jusqu'à plusieurs Mo chacun.
 * Pour l'écran de sélection, on utilise les quatre aperçus JPG légers déjà
 * présents dans Git. Le navigateur ne télécharge donc que quatre images,
 * même si elles apparaissent plusieurs fois dans les planches.
 */
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

/* Décodage non bloquant, priorité réseau basse et dimensions réservées. */
$js = str_replace(
    ' loading="lazy">',
    ' loading="lazy" decoding="async" fetchpriority="low" width="320" height="180">',
    $js
);

echo $js;
