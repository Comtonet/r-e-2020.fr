<?php
$kpGoogleAdsId = (string)cfg('google_ads_id', '');
if (preg_match('/^AW-[0-9]+$/D', $kpGoogleAdsId)):
?>
<script>window.KP_GOOGLE_ADS_ID=<?= json_encode($kpGoogleAdsId) ?>;</script>
<script src="/assets/js/google-ads.js?v=1"></script>
<?php endif; ?>
