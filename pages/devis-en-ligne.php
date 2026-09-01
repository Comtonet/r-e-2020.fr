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
  --paper:transparent;--card:#fff;
  --shadow-s:0 10px 30px rgba(35,27,84,.06);
  --shadow-m:0 22px 60px rgba(35,27,84,.12);
  --shadow-l:0 30px 90px rgba(35,27,84,.16);
  min-height:0;margin:0;padding:0;background:transparent;
}
.devis-app .top,.devis-app .quote-steps-hook{display:none!important}
.devis-app .wrap{max-width:1140px;padding:22px 22px 46px}
.devis-app .cols{display:block!important}
.devis-app #quoteScreen{width:100%!important;max-width:none!important}
.devis-app #quoteRail{display:none!important}
.devis-app .hero{margin:0 0 32px;padding:0 2px}
.devis-app .hero .eyebrow{display:inline-flex;align-items:center;gap:8px;padding:7px 11px;border-radius:999px;background:#f3f1fb;color:#38227e;font-size:11px;font-weight:800;letter-spacing:.05em;text-transform:uppercase}
.devis-app .hero h1{max-width:860px;line-height:1.03;letter-spacing:-.045em;font-size:clamp(34px,5vw,58px)}
.devis-app .hero h1 em{display:block;color:#98bf24;font-style:normal}
.devis-app .hero .lede{max-width:760px;font-size:16px;line-height:1.7;color:#646b79}
.devis-app .block{margin-bottom:30px}
.devis-app .block>h2{margin-bottom:12px;font-size:23px;letter-spacing:-.025em}
.devis-app .panel{border:1px solid rgba(56,34,126,.09);border-radius:20px;box-shadow:var(--shadow-s);padding:22px;margin-bottom:15px;background:linear-gradient(180deg,#fff 0%,#fefeff 100%)}
.devis-app .planche{border:1px solid rgba(56,34,126,.10)!important;border-radius:20px!important;box-shadow:none;transform:none!important;padding:14px;margin-bottom:13px;content-visibility:auto;contain-intrinsic-size:220px;background:#fff;transition:border-color .18s ease,box-shadow .18s ease,transform .18s ease!important}
.devis-app .planche:hover{border-color:rgba(56,34,126,.26)!important;box-shadow:var(--shadow-s);transform:translateY(-2px)!important}
.devis-app .planche[aria-pressed="true"]{border-color:#38227e!important;box-shadow:0 0 0 4px rgba(56,34,126,.075),var(--shadow-s)}
.devis-app .planche-h{margin-bottom:9px}
.devis-app .tiles-lite{grid-template-columns:1fr!important}
.devis-app .tiles-lite .tile{display:grid;grid-template-columns:146px 1fr;align-items:center;padding:7px;border-radius:16px;overflow:hidden;background:#fbfbfd}
.devis-app .tiles-lite .thumb{height:86px;border-radius:12px;overflow:hidden}
.devis-app .tiles-lite img{max-height:86px;width:100%;object-fit:cover;transition:transform .25s ease}
.devis-app .planche:hover .tiles-lite img{transform:scale(1.02)}
.devis-app .tiles-lite .cap{margin:0;padding:10px 15px;border:0}
.devis-app .opts,.devis-app .upick{gap:13px}
.devis-app .opt,.devis-app .ucard{border-radius:17px!important;border:1px solid rgba(56,34,126,.11)!important;background:#fff;transition:border-color .16s ease,box-shadow .16s ease,transform .16s ease,background .16s ease!important}
.devis-app .opt:hover,.devis-app .ucard:hover{border-color:rgba(56,34,126,.30)!important;box-shadow:0 12px 30px rgba(35,27,84,.08);transform:translateY(-2px)}
.devis-app .opt[aria-pressed="true"],.devis-app .ucard[aria-pressed="true"]{border-color:#38227e!important;background:linear-gradient(180deg,#fff 0%,#faf9ff 100%);box-shadow:0 0 0 4px rgba(56,34,126,.075)}
.devis-app .lot-f{display:none!important}
.devis-app .rows .val{visibility:hidden!important}
.devis-app input,.devis-app select,.devis-app textarea{border-radius:13px!important;border:1px solid rgba(56,34,126,.14)!important;background:#fff!important;box-shadow:inset 0 1px 0 rgba(255,255,255,.9);transition:border-color .16s ease,box-shadow .16s ease,background .16s ease!important}
.devis-app input:hover,.devis-app select:hover{border-color:rgba(56,34,126,.28)!important}
.devis-app input:focus,.devis-app select:focus,.devis-app textarea:focus{outline:none!important;border-color:#38227e!important;box-shadow:0 0 0 4px rgba(56,34,126,.09)!important;background:#fff!important}
.devis-app .quote-field-enhanced{transition:background .16s ease}
.devis-app .quote-progress-lite{margin:0 0 30px;padding:0 2px}
.devis-app .quote-progress-track{height:5px;border-radius:999px;background:#eceaf4;overflow:hidden}
.devis-app .quote-progress-track i{display:block;height:100%;border-radius:999px;background:linear-gradient(90deg,#38227e 0%,#6a57aa 50%,#98bf24 100%);transition:width .28s ease}
.devis-app .quote-progress-labels{display:flex;justify-content:space-between;margin-top:8px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.05em;color:#a0a4ae}
.devis-app .quote-progress-labels span.on{color:#38227e}
.devis-app .final-prestation-lite{position:relative;margin-top:32px;border:1px solid rgba(56,34,126,.13)!important;border-radius:24px!important;background:linear-gradient(180deg,#fff 0%,#fbfaff 100%);box-shadow:var(--shadow-m)!important;padding:28px!important;overflow:hidden}
.devis-app .final-prestation-lite:before{content:"";position:absolute;right:-90px;top:-110px;width:270px;height:270px;border-radius:50%;background:radial-gradient(circle,rgba(152,191,36,.15),rgba(152,191,36,0) 68%);pointer-events:none}
.devis-app .final-prestation-lite:after{content:"";position:absolute;left:-130px;bottom:-160px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(56,34,126,.07),rgba(56,34,126,0) 70%);pointer-events:none}
.devis-app .quote-final-head{position:relative;z-index:1;display:flex;justify-content:space-between;gap:24px;align-items:flex-start;margin-bottom:20px}
.devis-app .quote-final-head h3{font-size:27px;line-height:1.12;letter-spacing:-.03em;margin:8px 0 7px}
.devis-app .quote-final-head p{margin:0;color:#697080;line-height:1.55;max-width:670px}
.devis-app .quote-final-step{display:grid;place-items:center;min-width:48px;height:48px;border-radius:15px;background:#f1eef9;color:#38227e;font-weight:850;font-size:14px;box-shadow:inset 0 0 0 1px rgba(56,34,126,.05)}
.devis-app .quote-final-step.done{background:#eef6dd;color:#587900;font-size:20px}
.devis-app .final-presta-grid{position:relative;z-index:1;grid-template-columns:repeat(3,minmax(0,1fr))!important;gap:15px;margin-top:22px}
.devis-app .final-presta-grid .quote-offer{position:relative;height:100%;min-height:238px;align-items:flex-start;padding:23px 19px!important;background:rgba(255,255,255,.95)}
.devis-app .final-presta-grid .quote-offer>span:last-child{display:flex;flex-direction:column;height:100%;width:100%}
.devis-app .final-presta-grid .quote-offer strong{font-size:20px;letter-spacing:-.02em}
.devis-app .final-presta-grid .quote-offer small{display:block;margin-top:9px;line-height:1.55;min-height:68px;color:#6b7180}
.devis-app .final-presta-grid .quote-offer em{display:block;margin-top:auto;padding-top:18px;color:#38227e;font-style:normal;font-size:27px;font-weight:900;letter-spacing:-.035em}
.devis-app .final-presta-grid .quote-offer i{display:block;margin-top:9px;color:#7b8190;font-style:normal;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.035em}
.devis-app .quote-offer-mid{border-color:rgba(152,191,36,.75)!important;background:linear-gradient(180deg,#fff 0%,#fbfdf3 100%)!important;box-shadow:0 18px 42px rgba(107,140,12,.10)!important}
.devis-app .quote-offer-mid:hover{box-shadow:0 22px 50px rgba(107,140,12,.15)!important}
.devis-app .quote-badge{position:absolute!important;top:12px!important;right:12px!important;width:auto!important;height:auto!important;padding:6px 9px!important;border-radius:999px;background:#eef6dd;color:#587900;font-size:10px;font-weight:850;letter-spacing:.035em;text-transform:uppercase}
.devis-app .quote-calculate-btn{position:relative;z-index:1;width:100%;margin-top:5px;min-height:62px;border-radius:16px!important;font-size:17px;font-weight:850;display:flex;align-items:center;justify-content:center;gap:12px;box-shadow:0 14px 34px rgba(56,34,126,.21);transition:transform .16s ease,box-shadow .16s ease!important}
.devis-app .quote-calculate-btn:hover{transform:translateY(-2px);box-shadow:0 18px 42px rgba(56,34,126,.27)}
.devis-app .quote-calculate-btn b{font-size:21px;line-height:1}
.devis-app .quote-calc-note{position:relative;z-index:1;display:flex;justify-content:center;gap:18px;flex-wrap:wrap;text-align:center;margin-top:12px;color:#7b8190;font-size:11px;font-weight:700}
.devis-app .permit-info-lite{margin-top:18px;background:#f8fafc}
.devis-app .bar{position:static;margin-top:22px;background:transparent;border-top:1px solid rgba(56,34,126,.08);transform:none;transition:none;box-shadow:none}
.devis-app .bar:not(.show){display:none}
.devis-app .bar-in{max-width:none;padding:17px 0 0}
.devis-app .bar-txt{font-size:12.5px;color:#747b88}
.devis-app .toast{bottom:22px}
.devis-app .quote-loader{position:fixed;inset:0;z-index:10050;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(248,248,252,.76);backdrop-filter:blur(10px);opacity:0;visibility:hidden;transition:opacity .18s ease,visibility .18s ease}
.devis-app .quote-loader.show{opacity:1;visibility:visible}
.devis-app .quote-loader-card{width:min(410px,100%);padding:32px 28px;text-align:center;border:1px solid rgba(56,34,126,.10);border-radius:26px;background:rgba(255,255,255,.97);box-shadow:var(--shadow-l)}
.devis-app .quote-loader-card strong{display:block;margin-top:15px;font-size:20px;letter-spacing:-.02em;color:#2c2640}
.devis-app .quote-loader-card>span{display:block;margin-top:7px;font-size:13px;line-height:1.5;color:#737988}
.devis-app .quote-loader-line{height:4px;margin-top:20px;border-radius:999px;background:#eceaf4;overflow:hidden}
.devis-app .quote-loader-line b{display:block;width:42%;height:100%;border-radius:999px;background:linear-gradient(90deg,#38227e,#98bf24);animation:quoteLoaderLine .9s ease-in-out infinite}
@keyframes quoteLoaderLine{0%{transform:translateX(-110%)}100%{transform:translateX(345%)}}
.devis-app .quote-infinity{position:relative;width:82px;height:40px;margin:0 auto}
.devis-app .quote-infinity i{position:absolute;top:4px;width:32px;height:32px;border:4px solid #38227e;border-radius:50%;box-sizing:border-box;animation:quoteInfinity 1s ease-in-out infinite}
.devis-app .quote-infinity i:first-child{left:7px;border-right-color:#98bf24;transform:rotate(45deg)}
.devis-app .quote-infinity i:last-child{right:7px;border-left-color:#98bf24;transform:rotate(-45deg);animation-name:quoteInfinityRight;animation-delay:-.5s}
@keyframes quoteInfinity{0%,100%{opacity:.42;transform:scale(.92) rotate(45deg)}50%{opacity:1;transform:scale(1.08) rotate(45deg)}}
@keyframes quoteInfinityRight{0%,100%{opacity:.42;transform:scale(.92) rotate(-45deg)}50%{opacity:1;transform:scale(1.08) rotate(-45deg)}}
.devis-app.is-calculating{cursor:progress}
@media(max-width:900px){.devis-app .wrap{padding-left:16px;padding-right:16px}.devis-app .final-presta-grid{grid-template-columns:1fr!important}.devis-app .final-presta-grid .quote-offer{min-height:0}.devis-app .final-presta-grid .quote-offer small{min-height:0}}
@media(max-width:700px){.devis-app .hero h1{font-size:36px}.devis-app .tiles-lite .tile{grid-template-columns:98px 1fr}.devis-app .tiles-lite .thumb{height:70px}.devis-app .tiles-lite img{max-height:70px}.devis-app .final-prestation-lite{padding:21px!important;border-radius:20px!important}.devis-app .quote-final-head h3{font-size:23px}.devis-app .quote-final-step{min-width:40px;height:40px}.devis-app .quote-calc-note{gap:8px 14px}.devis-app .bar-in{flex-wrap:wrap;gap:8px}.devis-app .bar-txt{width:100%}.devis-app .btn{min-height:44px}}
@media(prefers-reduced-motion:reduce){.devis-app *, .devis-app *:before, .devis-app *:after{scroll-behavior:auto!important;animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}}
</style>
<section class="devis-app" id="devis-app">
  <nav class="quote-steps-hook" id="quoteSteps" aria-label="Étapes"></nav>
  <main class="wrap">
    <div class="cols"><div id="quoteScreen"></div><aside class="rail noprint" id="quoteRail"></aside></div>
    <div class="bar noprint" id="quoteBar"><div class="bar-in"><div class="bar-txt" id="quoteBarTxt"></div><button class="btn btn-g" id="quoteBack" hidden>Retour</button><button class="btn btn-p ml" id="quoteNext">Continuer</button></div></div>
  </main>
  <div class="toast" id="quoteToast" role="status" aria-live="polite"></div>
  <div class="modal noprint" id="quoteModal" hidden><div class="modal-card" role="alertdialog" aria-modal="true"><div class="modal-ico">!</div><h3 id="quoteModalTitle"></h3><p id="quoteModalText"></p><button class="btn btn-p" data-act="modalok">J’ai compris, continuer</button></div></div>
  <div class="infotip noprint" id="quoteInfotip" role="tooltip"><div class="infotip-body"></div></div>
</section>
<script>window.QUOTE_CONFIG = <?= json_encode($quoteConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;</script>
<script src="/assets/js/devis-calculateur-lite.php?v=9" defer></script>
<script src="/assets/js/devis-site-lite.js?v=5" defer></script>
