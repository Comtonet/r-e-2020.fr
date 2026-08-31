<?php
$quoteConfig = [
    'mi_forfait' => (float) cfg('quote_mi_forfait', 50),
    'mi_logement' => (float) cfg('quote_mi_logement', 75),
    'mi_modele' => (float) cfg('quote_mi_modele', 74),
    'mi_complete_forfait' => (float) cfg('quote_mi_complete_forfait', 125),
    'mi_complete_unite' => (float) cfg('quote_mi_complete_unite', 149),
    'ext_permis' => (float) cfg('quote_ext_permis', 199),
    'ext_complete' => (float) cfg('quote_ext_complete', 423),
    'article_metre' => (float) cfg('quote_article_metre', 100),
    'social_m2' => (float) cfg('quote_social_m2', 1.25),
    'vestiaire_forfait' => (float) cfg('quote_vestiaire_forfait', 130),
    'tertiaire_complete_complement' => (float) cfg('quote_tertiaire_complete_complement', 429),
    'power_a' => (float) cfg('quote_power_a', 39.18),
    'power_k' => (float) cfg('quote_power_k', 0.43),
];
?>
<link rel="stylesheet" href="/assets/css/devis-calculateur.css?v=1">

<section class="quote-tool" id="quote-calculator">
  <div class="quote-shell">
    <div class="quote-head">
      <div>
        <span class="quote-badge">Devis RE2020 immédiat</span>
        <h1>Calculez votre devis RE2020 en ligne.</h1>
        <p>Décrivez votre opération, choisissez l’usage du bâtiment et obtenez une estimation immédiate pour les maisons, extensions, bâtiments tertiaires et opérations mixtes hors logement collectif d’habitation.</p>
      </div>
      <div class="quote-proof">
        <strong>Calcul guidé, sans attendre</strong>
        <span>Le prix évolue automatiquement selon la configuration de votre projet.</span>
      </div>
    </div>

    <div class="quote-progress" aria-label="Étapes du calculateur">
      <span class="is-active">1 · Besoin</span>
      <span>2 · Projet</span>
      <span>3 · Données</span>
      <span>4 · Devis</span>
    </div>

    <div class="quote-layout">
      <div class="quote-main" aria-live="polite"></div>
      <aside class="quote-recap" aria-label="Récapitulatif du devis">
        <div class="recap-box"></div>
      </aside>
    </div>
  </div>
</section>

<section class="section soft">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Un chiffrage adapté au projet</span>
      <h2>Le questionnaire change selon l’usage du bâtiment.</h2>
      <p>Le calculateur distingue notamment les bureaux, l’enseignement, les commerces, l’industrie et l’artisanat, les établissements d’hébergement, la restauration, les équipements sportifs, les crèches, les vestiaires et les maisons.</p>
    </div>
    <div class="cards three">
      <article class="card">
        <span class="card-kicker">Simple</span>
        <h3>Quelques données suffisent</h3>
        <p>Surface, nombre de locaux, chambres ou modèles : seules les informations utiles à la grille choisie sont demandées.</p>
      </article>
      <article class="card">
        <span class="card-kicker">Mixte</span>
        <h3>Plusieurs usages dans un même projet</h3>
        <p>Ajoutez plusieurs parties tertiaires et obtenez un récapitulatif unique pour l’opération.</p>
      </article>
      <article class="card">
        <span class="card-kicker">Collectif</span>
        <h3>Immeuble collectif d’habitation ?</h3>
        <p>Le logement collectif d’habitation reste volontairement hors de ce calculateur et fait l’objet d’un chiffrage dédié.</p>
        <a class="text-link" href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Voir le collectif →</a>
      </article>
    </div>
  </div>
</section>

<script>
window.QUOTE_CONFIG = <?= json_encode($quoteConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
<script src="/assets/js/devis-calculateur.js?v=1" defer></script>
