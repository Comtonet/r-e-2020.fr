<?php
$actualites = $GLOBALS['actualites_catalog'] ?? [];
$route = $GLOBALS['actualites_route'] ?? ['type' => 'index'];
?>
<?php if ($route['type'] === 'index'): ?>
<section class="dossier-hero"><div class="container"><span class="eyebrow">Actualités RE2020</span><h1>L’actualité RE2020 qui impacte vraiment vos projets</h1><p>Évolutions réglementaires, moteur de calcul, base INIES et données environnementales : Keeplanet suit les changements utiles à vos projets.</p></div></section>
<section class="section dossier-section"><div class="container">
  <div class="dossier-group-head"><div><span class="eyebrow">Veille technique & réglementaire</span><h2>Les dernières actualités</h2></div></div>
  <div class="dossier-grid">
    <?php foreach ($actualites as $actualite): ?>
      <article class="dossier-card">
        <span class="pill">Actualité</span>
        <?php if (!empty($actualite['date'])): ?><small><?= h(date('d/m/Y', strtotime($actualite['date']))) ?></small><?php endif; ?>
        <h2><a href="/actualites/<?= h($actualite['slug']) ?>/"><?= h($actualite['title']) ?></a></h2>
        <p><?= h($actualite['excerpt']) ?></p>
        <a class="dossier-link" href="/actualites/<?= h($actualite['slug']) ?>/">Lire l’actualité →</a>
      </article>
    <?php endforeach; ?>
  </div>
</div></section>
<?php else: $actualite = $route['article']; ?>
<article class="dossier-article">
<header class="dossier-article-hero"><div class="container narrow"><div class="breadcrumbs"><a href="/actualites/">Actualités</a></div><span class="pill">Actualité</span><h1><?= h($actualite['title']) ?></h1><p><?= h($actualite['excerpt']) ?></p><?php if (!empty($actualite['date'])): ?><small>Publié le <?= h(date('d/m/Y', strtotime($actualite['date']))) ?></small><?php endif; ?></div></header>
<section class="section"><div class="container narrow article-body"><div class="migration-note"><strong>Actualité historique intégrée à la nouvelle rubrique Actualités.</strong><p>L’URL historique est conservée. Le corps éditorial complet sera repris depuis l’ancien site dans le cadre de la migration des contenus.</p></div><div class="article-cta"><div><span class="eyebrow">Un projet RE2020 ?</span><h2>Faites valider votre projet par un thermicien.</h2></div><a class="btn" href="/tarifs-etude-thermique-re-2020/">Voir nos prestations</a></div></div></section>
</article>
<?php endif; ?>
