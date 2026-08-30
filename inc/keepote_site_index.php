<?php
/**
 * Index runtime du contenu public du site pour KeePote.
 *
 * Il lit directement les sources du site à chaque requête : une modification
 * de page, de dossier ou d'actualité est donc immédiatement disponible pour
 * KeePote sans étape manuelle de synchronisation.
 */

function keepote_site_index_chunks(array $questionTokens): array
{
    $root = dirname(__DIR__);
    $chunks = [];

    // Faits de contact explicitement présents dans le site / schema / footer.
    $chunks[] = 'Keeplanet contact coordonnées : e-mail email mail info@keeplanet.fr ; téléphone 0806 110 559 ; adresse 201 route d’Oberhausbergen, 67200 Strasbourg ; site https://r-e-2020.fr/ ; espace client https://espace-client.keeplanet.fr/.';

    $files = [
        $root . '/inc/site.php',
        $root . '/pages/home.php',
        $root . '/pages/tarifs.php',
        $root . '/pages/maison.php',
        $root . '/pages/collectif.php',
        $root . '/pages/processus.php',
        $root . '/pages/confiance.php',
        $root . '/pages/devis-en-ligne.php',
        $root . '/pages/a-propos-keeplanet.php',
        $root . '/content/dossiers.php',
        $root . '/content/actualites.php',
    ];

    foreach ($files as $file) {
        if (!is_file($file)) {
            continue;
        }
        $source = (string) @file_get_contents($file);
        if ($source === '') {
            continue;
        }

        // Récupère principalement les chaînes éditoriales PHP et le texte HTML.
        if (preg_match_all('/([\'\"])(.{4,}?)\1/us', $source, $matches)) {
            foreach ($matches[2] as $text) {
                $text = html_entity_decode(strip_tags((string) $text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $text = preg_replace('/\s+/u', ' ', trim($text));
                if ($text !== '' && mb_strlen($text, 'UTF-8') >= 4 && mb_strlen($text, 'UTF-8') <= 1800) {
                    $chunks[] = '[site:' . basename($file) . '] ' . $text;
                }
            }
        }
    }

    $scored = [];
    foreach ($chunks as $chunk) {
        $haystack = mb_strtolower($chunk, 'UTF-8');
        $score = 0;
        foreach ($questionTokens as $token) {
            if (mb_strpos($haystack, $token) !== false) {
                $score += 2;
            }
        }

        // Les coordonnées sont suffisamment importantes pour rester accessibles
        // même avec des formulations comme « votre mail ? » ou « vous êtes où ? ».
        if (str_contains($haystack, 'info@keeplanet.fr')) {
            foreach (['mail','email','e-mail','contact','téléphone','telephone','adresse','coordonnée','coordonnee'] as $contactWord) {
                if (in_array($contactWord, $questionTokens, true)) {
                    $score += 12;
                }
            }
        }

        if ($score > 0) {
            $scored[] = ['score' => $score, 'text' => $chunk];
        }
    }

    usort($scored, static fn($a, $b) => $b['score'] <=> $a['score']);
    return array_slice($scored, 0, 18);
}
