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
<link rel="stylesheet" href="/assets/css/devis-calculateur.css?v=4">
<style>
.devis-app{
  --display:system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
  --body:system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
  --mono:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;
  --paper:transparent;
  --card:#fff;
  --shadow-s:0 1px 3px rgba(19,26,46,.05);
  --shadow-m:0 4px 14px rgba(19,26,46,.07);
  min-height:0;
  margin:0;
  padding:0;
  background:transparent;
}
.devis-app .top{display:none!important}
.devis-app .quote-steps-hook{display:none!important}
.devis-app .wrap{max-width:1180px;padding:18px 20px 34px}
.devis-app .hero{margin-bottom:26px}
.devis-app .block{margin-bottom:26px}
.devis-app .panel{box-shadow:var(--shadow-s);padding:18px;margin-bottom:12px}
.devis-app .planche{box-shadow:none;transform:none!important;padding:14px;margin-bottom:10px;content-visibility:auto;contain-intrinsic-size:220px}
.devis-app .planche:hover{box-shadow:var(--shadow-s)}
.devis-app .planche-h{margin-bottom:8px}
.devis-app .tiles-lite{grid-template-columns:1fr!important}
.devis-app .tiles-lite .tile{display:grid;grid-template-columns:150px 1fr;align-items:center;padding:6px}
.devis-app .tiles-lite .thumb{height:88px}
.devis-app .tiles-lite img{max-height:84px}
.devis-app .tiles-lite .cap{margin:0;padding:10px;border-top:0;border-left:1px solid var(--line2)}
.devis-app .final-prestation-lite{margin-top:24px;border:2px solid var(--indigo-soft);background:#fff}
.devis-app .final-presta-grid .opt em{display:block;margin-top:8px;color:var(--indigo);font-style:normal;font-size:18px;font-weight:700}
.devis-app .permit-info-lite{margin-top:18px;background:#f8fafc}
.devis-app .rail{top:20px}
.devis-app .bar{
  position:static;
  left:auto;
  right:auto;
  bottom:auto;
  z-index:auto;
  margin-top:18px;
  background:transparent;
  border-top:1px solid var(--line2);
  transform:none;
  transition:none;
  box-shadow:none;
}
.devis-app .bar:not(.show){display:none}
.devis-app .bar-in{max-width:none;padding:16px 0 0}
.devis-app .bar-txt{font-size:12.5px}
.devis-app .toast{bottom:22px}
@media(max-width:900px){
  .devis-app .wrap{padding-left:16px;padding-right:16px}
  .devis-app .cols{gap:20px}
}
@media(max-width:700px){
  .devis-app .tiles-lite .tile{grid-template-columns:100px 1fr}
  .devis-app .tiles-lite .thumb{height:68px}
  .devis-app .tiles-lite img{max-height:64px}
  .devis-app .final-presta-grid{grid-template-columns:1fr!important}
  .devis-app .bar-in{flex-wrap:wrap;gap:8px}
  .devis-app .bar-txt{width:100%}
  .devis-app .btn{min-height:44px}
}
</style>

<section class="devis-app" id="devis-app">
  <nav class="quote-steps-hook" id="quoteSteps" aria-label="Étapes"></nav>

  <main class="wrap">
    <div class="cols">
      <div id="quoteScreen"></div>
      <aside class="rail noprint" id="quoteRail"></aside>
    </div>

    <div class="bar noprint" id="quoteBar">
      <div class="bar-in">
        <div class="bar-txt" id="quoteBarTxt"></div>
        <button class="btn btn-g" id="quoteBack" hidden>Retour</button>
        <button class="btn btn-p ml" id="quoteNext">Continuer</button>
      </div>
    </div>
  </main>

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
<script src="/assets/js/devis-calculateur-lite.php?v=7" defer></script>
<script src="/assets/js/devis-site-lite.js?v=1" defer></script>
