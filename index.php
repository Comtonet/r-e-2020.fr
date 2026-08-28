<?php
require __DIR__ . '/inc/config_helpers.php';
require __DIR__ . '/inc/site.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = '/' . trim($path, '/');
if ($path !== '/') { $path .= '/'; }

$legacyProcessPath = '/processus-de-realisation/';
$processPath = '/processus-de-realisation-dune-etude-re2020/';
$dossiersPath = '/dossiers-decryptages-re2020/';
$actualitesPath = '/actualites/';
$aboutPath = '/a-propos-keeplanet/';
$maisonPath = '/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/';
$collectifPath = '/tarifs-etude-thermique-re-2020/collectif-tertiaire/';
$tarifsPath = '/tarifs-etude-thermique-re-2020/';
$devisPath = '/devis-en-ligne/';
$trustPaths = ['/qualifications-assurances-garanties/','/exemples-livrables-re2020/','/questions-frequentes-re2020/'];

if ($path === $legacyProcessPath) { header('Location: ' . $processPath, true, 301); exit; }
if ($path === '/dossiers/') { header('Location: ' . $dossiersPath, true, 301); exit; }

$GLOBALS['dossier_catalog'] = require __DIR__ . '/content/dossiers.php';
$GLOBALS['dossier_route'] = null;
$dossierCatalog = $GLOBALS['dossier_catalog'];
if ($path === $dossiersPath) {
    $GLOBALS['dossier_route'] = ['type' => 'index'];
} else {
    foreach ($dossierCatalog['categories'] as $categorySlug => $category) {
        if ($path === '/' . $categorySlug . '/') { $GLOBALS['dossier_route'] = ['type'=>'category','category'=>$categorySlug]; break; }
        foreach ($dossierCatalog['articles'] as $article) {
            if ($article['category'] === $categorySlug && $path === '/' . $categorySlug . '/' . $article['slug'] . '/') {
                $GLOBALS['dossier_route'] = ['type'=>'article','category'=>$categorySlug,'article'=>$article]; break 2;
            }
        }
    }
}

$GLOBALS['actualites_catalog'] = require __DIR__ . '/content/actualites.php';
$GLOBALS['actualites_route'] = null;
if ($path === $actualitesPath) {
    $GLOBALS['actualites_route'] = ['type'=>'index'];
} else {
    foreach ($GLOBALS['actualites_catalog'] as $actualite) {
        if ($path === '/actualites/' . $actualite['slug'] . '/') { $GLOBALS['actualites_route'] = ['type'=>'article','article'=>$actualite]; break; }
    }
}

$lookupPath = $path === $processPath ? $legacyProcessPath : $path;
$page = null;
if ($path === $maisonPath) {
    $page = ['title'=>'Étude RE2020 maison | Tarifs et attestation permis','description'=>'Étude thermique RE2020 pour maison individuelle : Pack Permis, étude complète, ACV et accompagnement Keeplanet.','type'=>'maison','h1'=>'Étude RE2020 maison','lead'=>'Tarifs et accompagnement pour votre projet.'];
} elseif ($path === $devisPath) {
    $page = ['title'=>'Générateur de devis RE2020 en ligne | Keeplanet','description'=>'Préparation du futur générateur de devis en ligne Keeplanet pour les études RE2020 et prestations associées.','type'=>'devis','h1'=>'Votre devis RE2020 directement en ligne.','lead'=>'Le futur générateur permettra de configurer votre projet et d’obtenir un devis adapté.'];
} elseif ($path === '/qualifications-assurances-garanties/') {
    $page = ['title'=>'Qualifications OPQIBI & assurances | Keeplanet','description'=>'Vérifiez les qualifications OPQIBI 1331 et 1332 de Keeplanet et découvrez le cadre professionnel des études RE2020.','type'=>'trust','h1'=>'Qualifications et assurances','lead'=>'Les preuves professionnelles de Keeplanet.'];
} elseif ($path === '/exemples-livrables-re2020/') {
    $page = ['title'=>'Exemples de livrables RE2020 | Keeplanet','description'=>'Consultez des exemples d’attestation RE2020, synthèse simplifiée et récapitulatif standardisé.','type'=>'deliverables','h1'=>'Exemples de livrables RE2020','lead'=>'Découvrez les documents remis selon votre prestation.'];
} elseif ($path === '/questions-frequentes-re2020/') {
    $page = ['title'=>'FAQ RE2020 | Permis, Bbio, étude et fin de travaux','description'=>'Réponses aux questions fréquentes sur l’étude RE2020, le permis, l’attestation Bbio, les délais et la fin de travaux.','type'=>'faq','h1'=>'Questions fréquentes RE2020','lead'=>'Les réponses essentielles avant de lancer votre étude.'];
} elseif ($path === $aboutPath) {
    $page = ['title'=>'À propos de Keeplanet | Bureau d’études thermiques RE2020','description'=>'Découvrez Keeplanet, bureau d’études thermiques spécialisé en RE2020, études thermiques, attestations réglementaires et accompagnement des projets de construction.','type'=>'about','h1'=>'À propos de Keeplanet','lead'=>'Un bureau d’études thermiques spécialisé dans la RE2020, avec une approche rapide, fiable et accessible.'];
} elseif ($GLOBALS['actualites_route']) {
    $route = $GLOBALS['actualites_route'];
    if ($route['type']==='index') $page=['title'=>'Actualités RE2020 | Réglementation, moteur de calcul, INIES','description'=>'Suivez les évolutions de la RE2020, des moteurs de calcul, de la base INIES et des règles qui impactent vos projets.','type'=>'actualites','h1'=>'L’actualité RE2020 qui impacte vraiment vos projets','lead'=>'Nous décryptons les changements réglementaires et techniques avec un regard opérationnel.'];
    else { $article=$route['article']; $page=['title'=>$article['title'].' | Actualités RE2020','description'=>$article['excerpt'],'type'=>'actualite_article','h1'=>$article['title'],'lead'=>$article['excerpt']]; }
} elseif ($GLOBALS['dossier_route']) {
    $route=$GLOBALS['dossier_route'];
    if ($route['type']==='index') $page=['title'=>'Dossiers & décryptages RE2020 | Keeplanet','description'=>'Tous les dossiers techniques RE2020 de Keeplanet classés par catégorie.','type'=>'dossiers','h1'=>'Dossiers & décryptages RE2020','lead'=>'Comprendre la réglementation et les choix techniques qui font la conformité d’un projet.'];
    elseif ($route['type']==='category') { $category=$dossierCatalog['categories'][$route['category']]; $page=['title'=>$category['name'].' | Dossiers RE2020','description'=>$category['description'],'type'=>'dossiers','h1'=>$category['name'],'lead'=>$category['description']]; }
    else { $article=$route['article']; $page=['title'=>$article['title'].' | r-e-2020.fr','description'=>$article['excerpt'],'type'=>'dossier_article','h1'=>$article['title'],'lead'=>$article['excerpt']]; }
} else {
    $page = get_page($lookupPath);
}
if (!$page) { http_response_code(404); $page=get_page('/404/'); }
$canonical='https://r-e-2020.fr'.($path==='/'?'/':$path);

$extraSchema=[];
if (in_array($page['type'], ['maison','collectif','tarifs'], true)) {
    $extraSchema[]=['@context'=>'https://schema.org','@type'=>'Service','name'=>$page['h1'],'provider'=>['@type'=>'Organization','name'=>'Keeplanet'],'areaServed'=>['@type'=>'Country','name'=>'France'],'url'=>$canonical];
}
if ($page['type']==='actualite_article' && !empty($GLOBALS['actualites_route']['article'])) {
    $a=$GLOBALS['actualites_route']['article'];
    $extraSchema[]=['@context'=>'https://schema.org','@type'=>'NewsArticle','headline'=>$a['title'],'description'=>$a['excerpt'],'datePublished'=>$a['date']??null,'mainEntityOfPage'=>$canonical,'publisher'=>['@type'=>'Organization','name'=>'Keeplanet','url'=>'https://r-e-2020.fr/']];
}
if ($page['type']==='dossier_article') {
    $extraSchema[]=['@context'=>'https://schema.org','@type'=>'Article','headline'=>$page['h1'],'description'=>$page['description'],'mainEntityOfPage'=>$canonical,'publisher'=>['@type'=>'Organization','name'=>'Keeplanet','url'=>'https://r-e-2020.fr/']];
}
if ($page['type']==='faq') {
    $extraSchema[]=['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>[
        ['@type'=>'Question','name'=>'À quoi sert l’attestation Bbio – PCMI 14 ?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Elle matérialise la prise en compte des exigences réglementaires demandées au stade du dépôt du permis de construire.']],
        ['@type'=>'Question','name'=>'Est-ce que l’étude complète est utile dès le début ?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Oui. Elle permet d’intégrer plus tôt les systèmes, consommations, confort d’été et indicateurs utiles à la conformité finale.']],
        ['@type'=>'Question','name'=>'Puis-je commencer par le Pack Permis puis évoluer ?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Oui. Sur les offres maison, le passage à un pack supérieur est possible en réglant la différence de tarif prévue.']]
    ]];
}
?><!doctype html><html lang="fr"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= h($page['title']) ?></title><meta name="description" content="<?= h($page['description']) ?>"><link rel="canonical" href="<?= h($canonical) ?>">
<?php if ($path===$devisPath): ?><meta name="robots" content="noindex,nofollow"><?php endif; ?>
<meta property="og:type" content="website"><meta property="og:title" content="<?= h($page['title']) ?>"><meta property="og:description" content="<?= h($page['description']) ?>"><meta property="og:url" content="<?= h($canonical) ?>"><meta name="theme-color" content="#38227E">
<link rel="stylesheet" href="/assets/css/app.css?v=4"><?php if ($path===$processPath): ?><link rel="stylesheet" href="/assets/css/process.css?v=2"><?php endif; ?><?php if ($GLOBALS['dossier_route']||$GLOBALS['actualites_route']): ?><link rel="stylesheet" href="/assets/css/dossiers.css?v=2"><?php endif; ?><?php if ($path===$aboutPath): ?><link rel="stylesheet" href="/assets/css/about.css?v=1"><?php endif; ?><?php if ($path===$maisonPath): ?><link rel="stylesheet" href="/assets/css/maison.css?v=3"><?php endif; ?><link rel="stylesheet" href="/assets/css/commercial.css?v=1"><link rel="stylesheet" href="/assets/css/theme.css?v=1"><link rel="stylesheet" href="/assets/css/identity.css?v=1">
<script type="application/ld+json"><?= json_encode(schema_for($page,$canonical),JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script><?php foreach($extraSchema as $schema): ?><script type="application/ld+json"><?= json_encode($schema,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script><?php endforeach; ?>
</head><body>
<header class="site-header"><div class="topbar"><div class="container topbar-inner"><span>Keeplanet · Bureau d’études thermiques qualifié OPQIBI · <?= h(projects_label()) ?>+ projets</span><a href="tel:0806110559">0806 110 559</a></div></div><div class="container nav-wrap"><a class="brand" href="/" aria-label="Accueil r-e-2020.fr"><span class="brand-text-logo"><span class="brand-text-main">r-e-2020</span><span class="brand-text-fr">.fr</span></span></a><button class="nav-toggle" aria-expanded="false" aria-controls="main-nav">Menu</button><nav id="main-nav" class="main-nav"><a href="/tarifs-etude-thermique-re-2020/">Tarifs</a><a href="/processus-de-realisation-dune-etude-re2020/">Comment ça marche</a><a href="/dossiers-decryptages-re2020/">Dossiers</a><a href="/actualites/">Actualités</a><a href="/a-propos-keeplanet/">À propos</a><a href="/contact/">Contact</a><a class="btn btn-small" href="https://espace-client.keeplanet.fr/">Espace client</a></nav></div></header>
<main><?php ob_start();
if ($path==='/') require __DIR__.'/pages/home.php';
elseif ($path===$tarifsPath) require __DIR__.'/pages/tarifs.php';
elseif ($path===$maisonPath) require __DIR__.'/pages/maison.php';
elseif ($path===$collectifPath) require __DIR__.'/pages/collectif.php';
elseif (in_array($path,$trustPaths,true)) require __DIR__.'/pages/confiance.php';
elseif ($path===$devisPath) require __DIR__.'/pages/devis-en-ligne.php';
elseif ($path===$processPath) require __DIR__.'/pages/processus.php';
elseif ($path===$aboutPath) require __DIR__.'/pages/a-propos-keeplanet.php';
elseif ($GLOBALS['actualites_route']) require __DIR__.'/pages/actualites.php';
elseif ($GLOBALS['dossier_route']) require __DIR__.'/pages/dossiers.php';
else echo render_page($page,$path);
echo apply_dynamic_site_vars(ob_get_clean()); ?></main>
<footer class="site-footer"><div class="container footer-grid"><div><a class="brand brand-footer" href="/"><span class="brand-text-logo brand-text-logo-footer"><span class="brand-text-main">r-e-2020</span><span class="brand-text-fr">.fr</span></span></a><p>Études thermiques RE2020, attestations permis et accompagnement réglementaire partout en France.</p><p class="footer-trust">★★★★★ <?= h(google_rating_label()) ?>/5 · <?= h(google_reviews_label()) ?> avis Google · <?= h(projects_label()) ?>+ projets</p></div><div><h3>Votre projet</h3><a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Maison & extension</a><a href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Collectif & tertiaire</a><a href="/processus-de-realisation-dune-etude-re2020/">Processus</a></div><div><h3>Confiance & ressources</h3><a href="/qualifications-assurances-garanties/">Qualifications & assurances</a><a href="/exemples-livrables-re2020/">Exemples de livrables</a><a href="/questions-frequentes-re2020/">FAQ RE2020</a><a href="/dossiers-decryptages-re2020/">Dossiers techniques</a><a href="/actualites/">Actualités</a></div><div><h3>Nous contacter</h3><a href="tel:0806110559">0806 110 559</a><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a><p>201 route d’Oberhausbergen<br>67200 Strasbourg</p></div></div><div class="container footer-bottom"><span>© <?= date('Y') ?> r-e-2020.fr · Keeplanet</span><span><a href="/conditions-generales-de-vente/">CGV</a> · <a href="/mentions-legales/">Mentions légales</a></span></div></footer>
<div class="mobile-conversion-bar" aria-label="Actions rapides"><a href="tel:0806110559">Appeler</a><a class="primary" href="/tarifs-etude-thermique-re-2020/">Tarifs</a><a href="https://espace-client.keeplanet.fr/">Dossier</a></div>
<button class="ai-launcher" type="button" aria-label="Ouvrir l’assistant RE2020"><span>✦</span> Assistant RE2020</button><div class="ai-panel" hidden><div class="ai-head"><strong>Assistant RE2020</strong><button type="button" class="ai-close">×</button></div><div class="ai-body"><p>Bonjour 👋 Posez votre question sur votre projet RE2020.</p><div class="ai-note">L’assistant utilisera uniquement la base de connaissances validée du site.</div></div><form class="ai-form"><input type="text" placeholder="Ex. Mon extension fait 60 m²…" aria-label="Votre question"><button type="submit">Envoyer</button></form></div><script src="/assets/js/app.js?v=1" defer></script></body></html>