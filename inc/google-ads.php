<?php
$kpGoogleAdsId = (string)cfg('google_ads_id', '');
if (preg_match('/^AW-[0-9]+$/D', $kpGoogleAdsId)):
?>
<script>window.KP_GOOGLE_ADS_ID=<?= json_encode($kpGoogleAdsId) ?>;window.KP_GOOGLE_ADS_SIGNUP_LABEL=<?= json_encode((string)cfg('google_ads_signup_label', ''), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;</script>
<script src="/assets/js/google-ads.js?v=3"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($kpGoogleAdsId, ENT_QUOTES, 'UTF-8') ?>"></script>
<?php endif; ?>
