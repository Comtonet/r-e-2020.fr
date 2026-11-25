<?php
// Contrat indépendant des inscriptions maison et devis. Aucun accès SQL ici.
$proError = '';
$fields = [];
if (!cfg('pro_signup_enabled',false)) {
    http_response_code(503); $proError = 'L’inscription professionnelle en ligne n’est pas encore disponible.';
} elseif (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405); $proError = 'Veuillez utiliser le formulaire d’inscription professionnelle.';
} else {
    $limits = ['societe'=>180,'prenom'=>100,'nom'=>100,'email'=>254,'telephone'=>40,'adresse'=>240,'code_postal'=>5,'ville'=>120];
    foreach ($limits as $key=>$max) {
        $v=$_POST[$key] ?? '';
        if (!is_string($v) || strlen($v)>$max*4 || !preg_match('//u',$v) || preg_match('/[\x00-\x1f\x7f]/',$v)) { $proError='Une information est invalide.'; break; }
        $v=trim($v);
        if ((function_exists('mb_strlen')?mb_strlen($v,'UTF-8'):strlen($v))>$max) { $proError='Une information est trop longue.'; break; }
        $fields[$key]=$v;
    }
    if (!$proError && ($fields['societe']===''||$fields['prenom']===''||$fields['nom']===''||!filter_var($fields['email'],FILTER_VALIDATE_EMAIL)||$fields['adresse']===''||!preg_match('/^[0-9]{5}$/D',$fields['code_postal'])||$fields['ville']==='')) $proError='Merci de vérifier vos coordonnées et celles de votre entreprise.';
    if ($proError) http_response_code(422);
}
?>
<section class="kp-pro-page"><div class="kp-pro-services"><div class="container">
<?php if ($proError): ?>
<div class="kp-pro-registration" style="max-width:620px;margin:auto"><h2>Inscription professionnelle</h2><p><?= h($proError) ?></p><a class="btn kp-pro-submit" href="/professionnels-du-batiment/#compte-pro" data-no-signup-popup>Revenir à l’inscription</a><div class="kp-pro-login"><a href="mailto:info@keeplanet.fr">Contacter notre équipe</a></div></div>
<?php else: ?>
<div class="kp-pro-registration" style="max-width:620px;margin:auto"><h2>Transmission de votre inscription</h2><p>Nous transmettons vos informations à notre espace client sécurisé. La création du compte vous sera confirmée par KeePlanet.</p>
<form id="kp-pro-transit" method="post" action="https://espace-client.keeplanet.fr/pages/ajout-projet/traitement-inscription-pro-public.php">
<?php foreach ($fields as $key=>$val): ?><input type="hidden" name="<?= h($key) ?>" value="<?= h($val) ?>"><?php endforeach; ?>
<input type="hidden" name="origine" value="r-e-2020.fr"><input type="hidden" name="profil" value="professionnel"><input type="hidden" name="creation_entite" value="1">
<button type="submit" class="btn kp-pro-submit" data-no-signup-popup>Continuer</button></form></div>
<script>(function(){var f=document.getElementById('kp-pro-transit');if(f){window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'inscription_pro_submit'});window.setTimeout(function(){f.submit()},900);}})();</script>
<?php endif; ?>
</div></div></section>