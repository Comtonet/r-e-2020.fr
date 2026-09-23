<?php
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: /inscription-maison/', true, 302);
    exit;
}

$packSlug = trim((string)($_POST['pack'] ?? ''));
$pack = house_signup_pack($packSlug);

$required = [
    'nom' => 'Nom ou nom de société',
    'email' => 'E-mail',
];

$missing = [];
foreach ($required as $key => $label) {
    if (trim((string)($_POST[$key] ?? '')) === '') $missing[] = $label;
}

$email = trim((string)($_POST['email'] ?? ''));
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $missing[] = 'E-mail valide';
if (!$pack) $missing[] = 'Pack maison valide';

if ($missing) {
    http_response_code(422);
    $missing = array_values(array_unique($missing));
    ?>
    <section class="house-signup">
      <div class="container signup-shell">
        <div class="signup-card">
          <span class="eyebrow">Inscription maison</span>
          <h1>Informations incomplètes</h1>
          <p>Votre dossier n’a pas été créé. Merci de compléter les informations obligatoires.</p>
          <p class="signup-error">À vérifier : <?= h(implode(', ', $missing)) ?>.</p>
          <a class="btn btn-p" data-no-signup-popup href="/inscription-maison/<?= $packSlug !== '' ? '?pack=' . rawurlencode($packSlug) : '' ?>">Retour à l’inscription</a>
        </div>
      </div>
    </section>
    <?php
    return;
}

/*
 * Le type_demande vient exclusivement de la configuration serveur.
 * On ignore toute valeur type_demande éventuellement injectée dans le POST.
 *
 * Le formulaire public reste volontairement court pour favoriser la conversion.
 * Les champs historiques non demandés à cette étape sont conservés vides dans
 * le POST de sortie afin de ne pas casser le traitement côté espace client.
 */
$fields = [
    'pack' => $packSlug,
    'type_demande' => (string)$pack['type_demande'],
    'nom' => trim((string)$_POST['nom']),
    'societe' => '',
    'email' => $email,
    'telephone' => trim((string)($_POST['telephone'] ?? '')),
    'adresse' => '',
    'code_postal' => '',
    'ville' => '',
    'offre_maison' => max(0, min(100, (int)($_POST['offre_maison'] ?? 0))),
    'retour_site' => trim((string)($_POST['retour_site'] ?? '')),
    'origine' => 'r-e-2020.fr',
];

$target = 'https://espace-client.keeplanet.fr/pages/ajout-projet/traitement-inscription-maison-public.php';
?>
<section class="house-signup">
  <div class="container signup-shell">
    <div class="signup-card signup-transit-card">
      <div class="signup-transit-spinner" aria-hidden="true"></div>
      <span class="eyebrow">Création de votre dossier</span>
      <h1><?= h($pack['label']) ?></h1>
      <p>Votre demande est bien prise en compte. Nous préparons maintenant votre accès KeePlanet.</p>
      <p class="signup-transit-note">Redirection automatique en cours…</p>
    </div>
  </div>
</section>

<form id="house-signup-transit" method="post" action="<?= h($target) ?>" style="display:none">
<?php foreach ($fields as $key => $value): ?>
  <input type="hidden" name="<?= h($key) ?>" value="<?= h($value) ?>">
<?php endforeach; ?>
</form>

<script>
window.dataLayer=window.dataLayer||[];
window.dataLayer.push({
  event:'inscription_maison_submit',
  pack:<?= json_encode($packSlug) ?>
});

/*
 * On laisse volontairement la page de transit se charger avant l'envoi final :
 * les scripts de mesure / Ads ont ainsi le temps d'enregistrer l'étape.
 */
window.setTimeout(function(){
  var form=document.getElementById('house-signup-transit');
  if(form)form.submit();
},900);
</script>
