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
    'tertiaire_complete_complement' => (float) cfg('quote_tertiaire_complete_complement', 429),
    'power_a' => (float) cfg('quote_power_a', 39.18),
    'power_k' => (float) cfg('quote_power_k', 0.43),
];
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/devis-calculateur.css?v=2">

<section class="devis-app" id="devis-app">
  <header class="top noprint">
    <div class="top-in">
      <div class="brand">
        <svg width="30" height="30" viewBox="0 0 32 32" aria-hidden="true">
          <path d="M16 3 29 10.5v11L16 29 3 21.5v-11z" fill="#E6ECF8" stroke="#1E3A6E" stroke-width="1.4" stroke-linejoin="round"/>
          <path d="M16 3v13m0 0 13-5.5M16 16 3 10.5M16 16v13" stroke="#1E3A6E" stroke-width="1.4" stroke-linejoin="round" fill="none"/>
          <path d="M16 16 29 10.5v11L16 29z" fill="#1E3A6E" fill-opacity=".12"/>
        </svg>
        <div><b>Étude thermique RE2020</b><span>Devis en ligne</span></div>
      </div>
      <nav class="steps" id="quoteSteps" aria-label="Étapes"></nav>
    </div>
  </header>

  <main class="wrap">
    <div class="cols">
      <div id="quoteScreen"></div>
      <aside class="rail noprint" id="quoteRail"></aside>
    </div>
  </main>

  <div class="bar noprint" id="quoteBar">
    <div class="bar-in">
      <div class="bar-txt" id="quoteBarTxt"></div>
      <button class="btn btn-g" id="quoteBack" hidden>Retour</button>
      <button class="btn btn-p ml" id="quoteNext">Continuer</button>
    </div>
  </div>

  <div class="toast" id="quoteToast" role="status" aria-live="polite"></div>
  <div class="modal noprint" id="quoteModal" hidden>
    <div class="modal-card" role="alertdialog" aria-modal="true">
      <div class="modal-ico">!</div><h3 id="quoteModalTitle"></h3><p id="quoteModalText"></p>
      <button class="btn btn-p" data-act="modalok">J’ai compris, continuer</button>
    </div>
  </div>
  <div class="infotip noprint" id="quoteInfotip" role="tooltip"><div class="infotip-body"></div></div>
</section>

<script>window.QUOTE_CONFIG = <?= json_encode($quoteConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;</script>
<script src="/assets/js/devis-calculateur.js?v=2" defer></script>
<script src="/assets/js/devis-calculateur-fidelite.js?v=1" defer></script>
