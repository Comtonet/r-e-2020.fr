<?php
require __DIR__ . '/inc/config_helpers.php';
require __DIR__ . '/inc/site.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = '/' . trim($path, '/');
if ($path !== '/') { $path .= '/'; }

$legacyProcessPath = '/processus-de-realisation/';
$processPath = '/processus-de-realisation-dune-etude-re2020/';
if ($path === $legacyProcessPath) {
    header('Location: ' . $processPath, true, 301);
    exit;
}

// Dossiers : le catalogue PHP est la source de vérité des catégories et URL.
$GLOBALS['dossier_catalog'] = require __DIR__ . '/content/dossiers.php';
$GLOBALS['dossier_route'] = null;
$dossierCatalog = $GLOBALS['dossier_catalog'];

if ($path === '/dossiers/' || $path === '/dossiers-decryptages-re2020/') {
    if ($path === '/dossiers-decryptages-re2020/') {
        header('Location: /dossiers/', true, 301);
        exit;
    }
    $GLOBALS['dossier_route'] = ['type' => 'index'];
} else {
    foreach ($dossierCatalog['categories'] as $categorySlug => $category) {
        if ($path === '/' . $categorySlug . '/') {
            $GLOBALS['dossier_route'] = ['type' => 'category', 'category' => $categorySlug];
            break;
        }
        foreach ($dossierCatalog['articles'] as $article) {
            if ($article['category'] === $categorySlug && $path === '/' . $categorySlug . '/' . $article['slug'] . '/') {
                $GLOBALS['dossier_route'] = ['type' => 'article', 'category' => $categorySlug, 'article' => $article];
                break 2;
            }
        }
    }
}

$lookupPath = $path === $processPath ? $legacyProcessPath : $path;
$page = null;

if ($GLOBALS['dossier_route']) {
    $route = $GLOBALS['dossier_route'];
    if ($route['type'] === 'index') {
        $page = [
            'title' => 'Dossiers & décryptages RE2020 | Keeplanet',
            'description' => 'Tous les dossiers techniques RE2020 de Keeplanet classés par catégorie : réglementation, équipements, solutions techniques et optimisation budgétaire.',
            'type' => 'dossiers',
            'h1' => 'Dossiers & décryptages RE2020',
            'lead' => 'Comprendre la réglementation et les choix techniques qui font la conformité d’un projet.'
        ];
    } elseif ($route['type'] === 'category') {
        $category = $dossierCatalog['categories'][$route['category']];
        $page = [
            'title' => $category['name'] . ' | Dossiers RE2020',
            'description' => $category['description'],
            'type' => 'dossiers',
            'h1' => $category['name'],
            'lead' => $category['description']
        ];
    } else {
        $article = $route['article'];
        $page = [
            'title' => $article['title'] . ' | r-e-2020.fr',
            'description' => $article['excerpt'],
            'type' => 'dossier_article',
            'h1' => $article['title'],
            'lead' => $article['excerpt']
        ];
    }
} else {
    $page = get_page($lookupPath);
}

if (!$page) {
    http_response_code(404);
    $page = get_page('/404/');
}

$canonical = 'https://r-e-2020.fr' . ($path === '/' ? '/' : $path);
?><!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= h($page['title']) ?></title>
<meta name="description" content="<?= h($page['description']) ?>">
<link rel="canonical" href="<?= h($canonical) ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= h($page['title']) ?>">
<meta property="og:description" content="<?= h($page['description']) ?>">
<meta property="og:url" content="<?= h($canonical) ?>">
<meta name="theme-color" content="#0b4f83">
<link rel="stylesheet" href="/assets/css/app.css?v=3">
<?php if ($path === $processPath): ?><link rel="stylesheet" href="/assets/css/process.css?v=2"><?php endif; ?>
<?php if ($GLOBALS['dossier_route']): ?><link rel="stylesheet" href="/assets/css/dossiers.css?v=1"><?php endif; ?>
<script type="application/ld+json"><?= json_encode(schema_for($page, $canonical), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<header class="site-header">
  <div class="topbar"><div class="container topbar-inner"><span>Keeplanet · Bureau d’études thermiques qualifié OPQIBI · <?= h(projects_label()) ?>+ projets</span><a href="tel:0806110559">0806 110 559</a></div></div>
  <div class="container nav-wrap">
    <a class="brand" href="/" aria-label="Accueil r-e-2020.fr"><img class="brand-logo" src="/assets/img/logo-re2020.svg?v=1" alt="R-E-2020.fr" width="240" height="37"></a>
    <button class="nav-toggle" aria-expanded="false" aria-controls="main-nav">Menu</button>
    <nav id="main-nav" class="main-nav">
      <a href="/tarifs-etude-thermique-re-2020/">Tarifs</a>
      <a href="/processus-de-realisation-dune-etude-re2020/">Comment ça marche</a>
      <a href="/dossiers/">Dossiers</a>
      <a href="/actualites/">Actualités</a>
      <a href="/contact/">Contact</a>
      <a class="btn btn-small" href="https://espace-client.keeplanet.fr/">Espace client</a>
    </nav>
  </div>
</header>
<main><?php
ob_start();
if ($path === $processPath) {
    require __DIR__ . '/pages/processus.php';
} elseif ($GLOBALS['dossier_route']) {
    require __DIR__ . '/pages/dossiers.php';
} else {
    echo render_page($page, $path);
}
echo apply_dynamic_site_vars(ob_get_clean());
?></main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div><a class="brand brand-footer" href="/"><img class="brand-logo brand-logo-footer" src="/assets/img/logo-re2020.svg?v=1" alt="R-E-2020.fr" width="220" height="34"></a><p>Études thermiques RE2020, attestations permis et accompagnement réglementaire partout en France.</p><p class="footer-trust">★★★★★ <?= h(google_rating_label()) ?>/5 · <?= h(google_reviews_label()) ?> avis Google · <?= h(projects_label()) ?>+ projets</p></div>
    <div><h3>Votre projet</h3><a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Maison & extension</a><a href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Collectif & tertiaire</a><a href="/processus-de-realisation-dune-etude-re2020/">Processus</a></div>
    <div><h3>Ressources</h3><a href="/dossiers/">Dossiers techniques</a><a href="/actualites/">Actualités</a><a href="/contact/">Contact</a></div>
    <div><h3>Nous contacter</h3><a href="tel:0806110559">0806 110 559</a><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a><p>201 route d’Oberhausbergen<br>67200 Strasbourg</p></div>
  </div>
  <div class="container footer-bottom"><span>© <?= date('Y') ?> r-e-2020.fr · Keeplanet</span><span><a href="/conditions-generales-de-vente/">CGV</a> · <a href="/mentions-legales/">Mentions légales</a></span></div>
</footer>
<button class="ai-launcher" type="button" aria-label="Ouvrir l’assistant RE2020"><span>✦</span> Assistant RE2020</button>
<div class="ai-panel" hidden><div class="ai-head"><strong>Assistant RE2020</strong><button type="button" class="ai-close">×</button></div><div class="ai-body"><p>Bonjour 👋 Posez votre question sur votre projet RE2020.</p><div class="ai-note">L’assistant utilisera uniquement la base de connaissances validée du site.</div></div><form class="ai-form"><input type="text" placeholder="Ex. Mon extension fait 60 m²…" aria-label="Votre question"><button type="submit">Envoyer</button></form></div>
<script src="/assets/js/app.js?v=1" defer></script>
</body></html>
