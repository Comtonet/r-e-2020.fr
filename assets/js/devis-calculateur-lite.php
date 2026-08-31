<?php
header('Content-Type: application/javascript; charset=UTF-8');
header('Cache-Control: public, max-age=300');

$source = __DIR__ . '/devis-calculateur.js';
if (!is_file($source)) {
    http_response_code(404);
    echo "console.error('Calculateur RE2020 introuvable');";
    exit;
}

$js = file_get_contents($source);

/*
 * Les PNG détaillés fournis pour les planches sont très lourds à décoder dans
 * le navigateur (plusieurs Mo chacun). On conserve exactement le moteur et
 * les libellés, mais on utilise les aperçus JPG légers pour l'écran d'accueil.
 * Les fichiers source détaillés restent disponibles dans Git pour une future
 * génération de miniatures optimisées.
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

/* Décodage non bloquant des images. */
$js = str_replace(' loading="lazy">', ' loading="lazy" decoding="async" fetchpriority="low">', $js);

echo $js;
