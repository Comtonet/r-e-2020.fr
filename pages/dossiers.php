<?php
$catalog = $GLOBALS['dossier_catalog'];
$route = $GLOBALS['dossier_route'];
$categories = $catalog['categories'];
$articles = $catalog['articles'];
$dossiersIndex = '/dossiers-decryptages-re2020/';

function dossier_articles_for($articles, $category) {
    return array_values(array_filter($articles, function($a) use ($category) { return $a['category'] === $category; }));
}
?>
<?php if ($route['type'] === 'index'): ?>
<section class="dossier-hero"><div class="container"><span class="eyebrow">Dossiers & décryptages RE2020</span><h1>Comprendre la RE2020, sujet par sujet</h1><p>Retrouvez nos dossiers techniques classés par catégorie. Chaque nouveau dossier publié est obligatoirement rattaché à l’une de ces catégories pour conserver une arborescence SEO cohérente.</p></div></section>
<section class="section dossier-section"><div class="container">
  <div class="dossier-categories">
    <?php foreach ($categories as $slug => $category): $count = count(dossier_articles_for($articles, $slug)); ?>
      <a class="dossier-category" href="/<?= h($slug) ?>/"><span class="dossier-count"><?= $count ?> dossier<?= $count > 1 ? 's' : '' ?></span><h2><?= h($category['name']) ?></h2><p><?= h($category['description']) ?></p><strong>Voir la catégorie →</strong></a>
    <?php endforeach; ?>
  </div>
  <?php foreach ($categories as $slug => $category): $items = dossier_articles_for($articles, $slug); ?>
    <section class="dossier-group"><div class="dossier-group-head"><div><span class="eyebrow"><?= h($category['name']) ?></span><h2>Derniers dossiers</h2></div><a href="/<?= h($slug) ?>/">Tout voir →</a></div>
    <div class="dossier-grid">
      <?php foreach ($items as $article): ?>
        <article class="dossier-card"><span class="pill"><?= h($category['name']) ?></span><h3><a href="/<?= h($article['category']) ?>/<?= h($article['slug']) ?>/"><?= h($article['title']) ?></a></h3><p><?= h($article['excerpt']) ?></p><a class="dossier-link" href="/<?= h($article['category']) ?>/<?= h($article['slug']) ?>/">Lire le dossier →</a></article>
      <?php endforeach; ?>
    </div></section>
  <?php endforeach; ?>
</div></section>

<?php elseif ($route['type'] === 'category'): $cat = $categories[$route['category']]; $items = dossier_articles_for($articles, $route['category']); ?>
<section class="dossier-hero compact"><div class="container"><a class="breadcrumb" href="<?= h($dossiersIndex) ?>">Dossiers</a><span class="eyebrow"><?= h($cat['name']) ?></span><h1><?= h($cat['name']) ?></h1><p><?= h($cat['description']) ?></p></div></section>
<section class="section dossier-section"><div class="container"><div class="dossier-grid">
<?php foreach ($items as $article): ?><article class="dossier-card"><span class="pill"><?= h($cat['name']) ?></span><h2><a href="/<?= h($article['category']) ?>/<?= h($article['slug']) ?>/"><?= h($article['title']) ?></a></h2><p><?= h($article['excerpt']) ?></p><a class="dossier-link" href="/<?= h($article['category']) ?>/<?= h($article['slug']) ?>/">Lire le dossier →</a></article><?php endforeach; ?>
</div></div></section>

<?php elseif ($route['type'] === 'article'): $article = $route['article']; $cat = $categories[$article['category']]; ?>
<article class="dossier-article"><header class="dossier-article-hero"><div class="container narrow"><div class="breadcrumbs"><a href="<?= h($dossiersIndex) ?>">Dossiers</a><span>›</span><a href="/<?= h($article['category']) ?>/"><?= h($cat['name']) ?></a></div><span class="pill"><?= h($cat['name']) ?></span><h1><?= h($article['title']) ?></h1><p><?= h($article['excerpt']) ?></p></div></header>
<section class="section"><div class="container narrow article-body"><div class="migration-note"><strong>Dossier historique intégré à la nouvelle arborescence.</strong><p>Cette URL est conservée à l’identique. Le contenu éditorial complet est en cours de reprise depuis l’ancien site ; sa catégorie, son titre, son positionnement SEO et son maillage sont déjà intégrés à la nouvelle architecture.</p></div><div class="article-cta"><div><span class="eyebrow">Besoin d’aller plus loin ?</span><h2>Faites valider votre projet par un thermicien.</h2></div><a class="btn" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Démarrer mon étude</a></div></div></section></article>
<?php endif; ?>
