<?php
/**
 * One-shot migration of historical dossier bodies from the legacy WordPress REST API.
 * Source IDs and slugs come from content/dossiers.php.
 * Triggered on main to snapshot the historical content before the legacy WordPress disappears.
 *
 * Usage: php scripts/import_wordpress_dossiers.php
 */

$root = dirname(__DIR__);
$catalog = require $root . '/content/dossiers.php';
$outFile = $root . '/content/dossier_bodies.php';
$apiBase = 'https://r-e-2020.fr/wp-json/wp/v2/posts/';

function fetch_json($url) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 15,
        CURLOPT_TIMEOUT => 45,
        CURLOPT_USERAGENT => 'Keeplanet-r-e-2020-content-migrator/1.0',
        CURLOPT_HTTPHEADER => ['Accept: application/json'],
    ]);
    $body = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($body === false || $status < 200 || $status >= 300) {
        throw new RuntimeException("HTTP $status for $url" . ($error ? ": $error" : ''));
    }
    $json = json_decode($body, true);
    if (!is_array($json)) {
        throw new RuntimeException("Invalid JSON for $url");
    }
    return $json;
}

function inner_html(DOMNode $node) {
    $html = '';
    foreach ($node->childNodes as $child) {
        $html .= $node->ownerDocument->saveHTML($child);
    }
    return $html;
}

function sanitize_article_html($html) {
    libxml_use_internal_errors(true);
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->loadHTML('<?xml encoding="utf-8" ?><div id="migration-root">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $xpath = new DOMXPath($dom);

    // Prefer the actual historical article container inserted in Elementor HTML widgets.
    $nodes = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' kp-article-container ')]");
    $container = ($nodes && $nodes->length) ? $nodes->item(0) : $dom->getElementById('migration-root');

    // Avoid a duplicate H1: the new dossier template already renders the catalogue title as H1.
    $h1s = $xpath->query('.//h1', $container);
    if ($h1s) {
        $toRemove = [];
        foreach ($h1s as $h1) { $toRemove[] = $h1; }
        foreach ($toRemove as $h1) { $h1->parentNode->removeChild($h1); }
    }

    // Remove Elementor-only wrappers/scripts if fallback content is used.
    foreach (['script','style','noscript'] as $tag) {
        $els = $xpath->query('.//' . $tag, $container);
        if ($els) {
            $toRemove = [];
            foreach ($els as $el) { $toRemove[] = $el; }
            foreach ($toRemove as $el) { $el->parentNode->removeChild($el); }
        }
    }

    // Keep semantic HTML and links, but drop legacy presentation/data attributes.
    $all = $xpath->query('.//*', $container);
    if ($all) {
        foreach ($all as $el) {
            if (!$el->hasAttributes()) continue;
            $remove = [];
            foreach ($el->attributes as $attr) {
                $name = strtolower($attr->name);
                if ($el->nodeName === 'a' && in_array($name, ['href','title','target','rel'], true)) continue;
                if ($el->nodeName === 'img' && in_array($name, ['src','alt','width','height','loading'], true)) continue;
                $remove[] = $attr->name;
            }
            foreach ($remove as $name) { $el->removeAttribute($name); }
        }
    }

    $clean = trim(inner_html($container));
    $clean = preg_replace('/\n{3,}/', "\n\n", $clean);
    return $clean;
}

$articles = [];
$errors = [];
foreach ($catalog['articles'] as $article) {
    $slug = $article['slug'];
    $id = (int) $article['wp_id'];
    try {
        fwrite(STDOUT, "Importing $id $slug...\n");
        $post = fetch_json($apiBase . $id . '?_fields=id,slug,content');
        if (($post['slug'] ?? '') !== $slug) {
            throw new RuntimeException("Slug mismatch: API=" . ($post['slug'] ?? 'missing') . " catalogue=$slug");
        }
        $rendered = $post['content']['rendered'] ?? '';
        if (trim($rendered) === '') {
            throw new RuntimeException('Empty rendered content');
        }
        $clean = sanitize_article_html($rendered);
        if (mb_strlen(strip_tags($clean), 'UTF-8') < 300) {
            throw new RuntimeException('Extracted article body is unexpectedly short');
        }
        $articles[$slug] = $clean;
    } catch (Throwable $e) {
        $errors[] = "$id $slug: " . $e->getMessage();
    }
}

if ($errors) {
    fwrite(STDERR, "Migration aborted; no output written.\n" . implode("\n", $errors) . "\n");
    exit(1);
}

$php = "<?php\n/*\n * Corps éditoriaux historiques importés automatiquement depuis l'ancien WordPress r-e-2020.fr.\n * Généré par scripts/import_wordpress_dossiers.php : ne pas éditer manuellement sans raison.\n */\nreturn [\n";
foreach ($articles as $slug => $body) {
    $delimiter = 'HTML_' . strtoupper(substr(sha1($slug), 0, 12));
    $php .= var_export($slug, true) . " => <<<'$delimiter'\n" . $body . "\n$delimiter,\n";
}
$php .= "];\n";

file_put_contents($outFile, $php);
fwrite(STDOUT, 'Imported ' . count($articles) . " dossier bodies into content/dossier_bodies.php\n");
