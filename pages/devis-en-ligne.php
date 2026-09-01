<?php
$quoteConfig = [
    'mi_forfait' => (float) cfg('quote_mi_forfait', 50),
    'mi_logement' => (float) cfg('quote_mi_logement', 75),
    'mi_modele' => (float) cfg('quote_mi_modele', 74),
    'mi_complete_forfait' => (float) cfg('quote_mi_complete_forfait', 125),
    'mi_complete_unite' => (float) cfg('quote_mi_complete_unite', 149),
    'ext_permis' => (float) cfg('quote_ext_permis', 199),
    'ext_fdc' => (float) cfg('quote_ext_fdc', 274),
    'ext_complete' => (float) cfg('quote_ext_complete', 423),
    'article_metre' => (float) cfg('quote_article_metre', 100),
    'tertiaire_fdc_complement' => (float) cfg('quote_tertiaire_fdc_complement', 130),
    'tertiaire_complete_complement' => (float) cfg('quote_tertiaire_complete_complement', 429),
    'collective_fdc_forfait_delta' => (float) cfg('quote_collective_fdc_forfait_delta', 180),
    'power_a' => (float) cfg('quote_power_a', 39.18),
    'power_k' => (float) cfg('quote_power_k', 0.43),
    'collective_curve_threshold' => (float) cfg('quote_collective_curve_threshold', 25),
    'collective_curve_a' => (float) cfg('quote_collective_curve_a', 36.492),
    'collective_curve_b' => (float) cfg('quote_collective_curve_b', 11.067),
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
  --shadow-s:0 8px 24px rgba(35,27,84,.06);
  --shadow-m:0 18px 50px rgba(35,27,84,.10);
  min-height:0;
  margin:0;
  padding:0;
  background:transparent;
}
.devis-app .top{display:none!important}
.devis-app .quote-steps-hook{display:none!important}
.devis-app .wrap{max-width:1120px;padding:20px 20px 42px}
.devis-app .cols{display:block!important}
.devis-app #quoteScreen{width:100%!important;max-width:none!important}
.devis-app #quoteRail{display:none!important}
.devis-app .hero{margin:0 0 30px;padding:0 2px}
.devis-app .hero h1{max-width:820px;line-height:1.05;letter-spacing:-.035em}
.devis-app .hero .lede{max-width:760px;font-size:16px;line-height:1.65;color:#5d6473}
.devis-app .block{margin-bottom:28px}
.devis-app .block>h2{margin-bottom:12px;font-size:22px;letter-spacing:-.02em}
.devis-app .panel{border:1px solid rgba(56,34,126,.09);border-radius:18px;box-shadow:var(--shadow-s);padding:20px;margin-bottom:14px;background:#fff}
.devis-app .planche{border:1px solid rgba(56,34,126,.10)!important;border-radius:18px!important;box-shadow:none;transform:none!important;padding:14px;margin-bottom:12px;content-visibility:auto;contain-intrinsic-size:220px;background:#fff;transition:border-color .18s ease,box-shadow .18s ease,transform .18s ease!important}
.devis-app .planche:hover{border-color:rgba(56,34,126,.25)!important;box-shadow:var(--shadow-s);transform:translateY(-1px)!important}
.devis-app .planche[aria-pressed="true"]{border-color:#38227e!important;box-shadow:0 0 0 3px rgba(56,34,126,.08),var(--shadow-s)}
.devis-app .planche-h{margin-bottom:8px}
.devis-app .tiles-lite{grid-template-columns:1fr!important}
.devis-app .tiles-lite .tile{display:grid;grid-template-columns:142px 1fr;align-items:center;padding:6px;border-radius:14px;overflow:hidden}
.devis-app .tiles-lite .thumb{height:84px;border-radius:10px;overflow:hidden}
.devis-app .tiles-lite img{max-height:84px;width:100%;object-fit:cover}
.devis-app .tiles-lite .cap{margin:0;padding:10px 14px;border-top:0;border-left:0}
.devis-app .opts,.devis-app .upick{gap:12px}
.devis-app .opt,.devis-app .ucard{border-radius:15px!important;border:1px solid rgba(56,34,126,.11)!important;transition:border-color .16s ease,box-shadow .16s ease,transform .16s ease,background .16s ease!important}
.devis-app .opt:hover,.devis-app .ucard:hover{border-color:rgba(56,34,126,.28)!important;box-shadow:0 8px 22px rgba(35,27,84,.07);transform:translateY(-1px)}
.devis-app .opt[aria-pressed="true"],.devis-app .ucard[aria-pressed="true"]{border-color:#38227e!important;background:linear-gradient(180deg,#fff 0%,#faf9ff 100%);box-shadow:0 0 0 3px rgba(56,34,126,.08)}
.devis-app .lot-f{display:none!important}
.devis-app .rows .val{visibility:hidden!important}
.devis-app .final-prestation-lite{position:relative;margin-top:30px;border:1px solid rgba(56,34,126,.13)!important;border-radius:22px!important;background:linear-gradient(180deg,#fff 0%,#fbfaff 100%);box-shadow:var(--shadow-m)!important;padding:26px!important;overflow:hidden}
.devis-app .final-prestation-lite:before{content:"";position:absolute;right:-80px;top:-90px;width:230px;height:230px;border-radius:50%;background:radial-gradient(circle,rgba(152,191,36,.12),rgba(152,191,36,0) 70%);pointer-events:none}
.devis-app .quote-final-head{position:relative;display:flex;justify-content:space-between;gap:24px;align-items:flex-start;margin-bottom:18px}
.devis-app .quote-final-head h3{font-size:25px;line-height:1.15;letter-spacing:-.025em;margin:8px 0 7px}
.devis-app .quote-final-head p{margin:0;color:#697080;line-height:1.5;max-width:650px}
.devis-app .quote-final-step{display:grid;place-items:center;min-width:46px;height:46px;border-radius:14px;background:#f1eef9;color:#38227e;font-weight:800;font-size:14px}
.devis-app .quote-final-step.done{background:#eef6dd;color:#587900;font-size:20px}
.devis-app .final-presta-grid{position:relative;grid-template-columns:repeat(3,minmax(0,1fr))!important;gap:14px;margin-top:20px}
.devis-app .final-presta-grid .quote-offer{position:relative;height:100%;min-height:230px;align-items:flex-start;padding:22px 18px!important;background:#fff}
.devis-app .final-presta-grid .quote-offer>span:last-child{display:flex;flex-direction:column;height:100%;width:100%}
.devis-app .final-presta-grid .quote-offer strong{font-size:19px;letter-spacing:-.015em}
.devis-app .final-presta-grid .quote-offer small{display:block;margin-top:8px;line-height:1.5;min-height:66px}
.devis-app .final-presta-grid .quote-offer em{display:block;margin-top:auto;padding-top:18px;color:#38227e;font-style:normal;font-size:24px;font-weight:850;letter-spacing:-.02em}
.devis-app .final-presta-grid .quote-offer i{display:block;margin-top:8px;color:#697080;font-style:normal;font-size:12px;font-weight:700}
.devis-app .quote-offer-mid{border-color:rgba(152,191,36,.65)!important;background:linear-gradient(180deg,#fff 0%,#fbfdf4 100%)!important}
.devis-app .quote-badge{position:absolute!important;top:12px!important;right:12px!important;width:auto!important;height:auto!important;padding:5px 8px!important;border-radius:999px;background:#eef6dd;color:#587900;font-size:10px;font-weight:800;letter-spacing:.03em;text-transform:uppercase}
.devis-app .quote-calculate-btn{position:relative;width:100%;margin-top:4px;min-height:58px;border-radius:15px!important;font-size:16px;font-weight:800;display:flex;align-items:center;justify-content:center;gap:12px;box-shadow:0 12px 28px rgba(56,34,126,.18);transition:transform .16s ease,box-shadow .16s ease!important}
.devis-app .quote-calculate-btn:hover{transform:translateY(-1px);box-shadow:0 16px 34px rgba(56,34,126,.23)}
.devis-app .quote-calculate-btn b{font-size:20px;line-height:1}
.devis-app .quote-calc-note{text-align:center;margin-top:10px;color:#7b8190;font-size:12px;font-weight:600}
.devis-app .permit-info-lite{margin-top:18px;background:#f8fafc}
.devis-app .bar{position:static;left:auto;right:auto;bottom:auto;z-index:auto;margin-top:20px;background:transparent;border-top:1px solid rgba(56,34,126,.08);transform:none;transition:none;box-shadow:none}
.devis-app .bar:not(.show){display:none}
.devis-app .bar-in{max-width:none;padding:16px 0 0}
.devis-app .bar-txt{font-size:12.5px;color:#747b88}
.devis-app .toast{bottom:22px}
.devis-app .quote-loader{position:fixed;inset:0;z-index:10050;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(250,250,252,.72);backdrop-filter:blur(8px);opacity:0;visibility:hidden;transition:opacity .18s ease,visibility .18s ease}
.devis-app .quote-loader.show{opacity:1;visibility:visible}
.devis-app .quote-loader-card{width:min(390px,100%);padding:30px 26px;text-align:center;border:1px solid rgba(56,34,126,.10);border-radius:24px;background:rgba(255,255,255,.96);box-shadow:0 24px 70px rgba(35,27,84,.16)}
.devis-app .quote-loader-card strong{display:block;margin-top:14px;font-size:19px;letter-spacing:-.015em;color:#2c2640}
.devis-app .quote-loader-card>span{display:block;margin-top:7px;font-size:13px;line-height:1.5;color:#737988}
.devis-app .quote-infinity{position:relative;width:76px;height:38px;margin:0 auto}
.devis-app .quote-infinity i{position:absolute;top:4px;width:30px;height:30px;border:4px solid #38227e;border-radius:50%;box-sizing:border-box;animation:quoteInfinity 1s ease-in-out infinite}
.devis-app .quote-infinity i:first-child{left:7px;border-right-color:#98bf24;transform:rotate(45deg)}
.devis-app .quote-infinity i:last-child{right:7px;border-left-color:#98bf24;transform:rotate(-45deg);animation-delay:-.5s}
@keyframes quoteInfinity{0%,100%{opacity:.45;transform:scale(.92) rotate(45deg)}50%{opacity:1;transform:scale(1.06) rotate(45deg)}}
.devis-app .quote-infinity i:last-child{animation-name:quoteInfinityRight}
@keyframes quoteInfinityRight{0%,100%{opacity:.45;transform:scale(.92) rotate(-45deg)}50%{opacity:1;transform:scale(1.06) rotate(-45deg)}}
.devis-app.is-calculating{cursor:progress}
@media(max-width:900px){
  .devis-app .wrap{padding-left:16px;padding-right:16px}
  .devis-app .final-presta-grid{grid-template-columns:1fr!important}
  .devis-app .final-presta-grid .quote-offer{min-height:0}
  .devis-app .final-presta-grid .quote-offer small{min-height:0}
}
@media(max-width:700px){
  .devis-app .tiles-lite .tile{grid-template-columns:96px 1fr}
  .devis-app .tiles-lite .thumb{height:68px}
  .devis-app .tiles-lite img{max-height:68px}
  .devis-app .final-prestation-lite{padding:20px!important;border-radius:18px!important}
  .devis-app .quote-final-head h3{font-size:22px}
  .devis-app .quote-final-step{min-width:40px;height:40px}
  .devis-app .bar-in{flex-wrap:wrap;gap:8px}
  .devis-app .bar-txt{width:100%}
  .devis-app .btn{min-height:44px}
}
@media(prefers-reduced-motion:reduce){
  .devis-app *, .devis-app *:before, .devis-app *:after{scroll-behavior:auto!important;animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}
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
<script src="/assets/js/devis-calculateur-lite.php?v=9" defer></script>
<script src="/assets/js/devis-site-lite.js?v=4" defer></script>
