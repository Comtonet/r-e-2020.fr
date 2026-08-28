<?php
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

$lookupPath = $path === $processPath ? $legacyProcessPath : $path;
$page = get_page($lookupPath);
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
<link rel="stylesheet" href="/assets/css/app.css?v=2">
<?php if ($path === $processPath): ?>
<link rel="stylesheet" href="/assets/css/process.css?v=1">
<?php endif; ?>
<script type="application/ld+json"><?= json_encode(schema_for($page, $canonical), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<header class="site-header">
  <div class="topbar"><div class="container topbar-inner"><span>Keeplanet · Bureau d’études thermiques qualifié OPQIBI</span><a href="tel:0806110559">0806 110 559</a></div></div>
  <div class="container nav-wrap">
    <a class="brand" href="/" aria-label="Accueil r-e-2020.fr"><img class="brand-logo" src="/assets/img/logo-re2020.webp" alt="R-E-2020.fr" width="240" height="37"></a>
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
<main><?php if ($path === $processPath) { require __DIR__ . '/pages/processus.php'; } else { echo render_page($page, $path); } ?></main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div><a class="brand brand-footer" href="/"><img class="brand-logo brand-logo-footer" src="/assets/img/logo-re2020.webp" alt="R-E-2020.fr" width="220" height="34"></a><p>Études thermiques RE2020, attestations permis et accompagnement réglementaire partout en France.</p></div>
    <div><h3>Votre projet</h3><a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Maison & extension</a><a href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Collectif & tertiaire</a><a href="/processus-de-realisation-dune-etude-re2020/">Processus</a></div>
    <div><h3>Ressources</h3><a href="/dossiers/">Dossiers techniques</a><a href="/actualites/">Actualités</a><a href="/contact/">Contact</a></div>
    <div><h3>Nous contacter</h3><a href="tel:0806110559">0806 110 559</a><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a><p>201 route d’Oberhausbergen<br>67200 Strasbourg</p></div>
  </div>
  <div class="container footer-bottom"><span>© <?= date('Y') ?> r-e-2020.fr · Keeplanet</span><span><a href="/conditions-generales-de-vente/">CGV</a> · <a href="/mentions-legales/">Mentions légales</a></span></div>
</footer>
<button class="ai-launcher" type="button" aria-label="Ouvrir l’assistant RE2020"><span>✦</span> Assistant RE2020</button>
<div class="ai-panel" hidden><div class="ai-head"><strong>Assistant RE2020</strong><button type="button" class="ai-close">×</button></div><div class="ai-body"><p>Bonjour 👋 Posez votre question sur votre projet RE2020.</p><div class="ai-note">V1 : interface prête. La connexion à l’API IA et aux fichiers JSON validés sera ajoutée à l’étape suivante.</div></div><form class="ai-form"><input type="text" placeholder="Ex. Mon extension fait 60 m²…" aria-label="Votre question"><button type="submit">Envoyer</button></form></div>
<script src="/assets/js/app.js?v=1" defer></script>
</body></html>
