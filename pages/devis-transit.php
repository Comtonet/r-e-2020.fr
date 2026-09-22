<?php
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: /devis-en-ligne/', true, 302);
    exit;
}

$required = [
    'nom' => 'Nom et prénom',
    'email' => 'E-mail',
    'adresse' => 'Adresse',
    'code_postal' => 'Code postal',
    'ville' => 'Ville',
];

$missing = [];
foreach ($required as $key => $label) {
    if (trim((string)($_POST[$key] ?? '')) === '') $missing[] = $label;
}

$email = trim((string)($_POST['email'] ?? ''));
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $missing[] = 'E-mail valide';
}

$payloadRaw = trim((string)($_POST['devis_payload'] ?? ''));
$payload = $payloadRaw !== '' ? json_decode($payloadRaw, true) : null;
if (!is_array($payload)) {
    $missing[] = 'Données du devis';
}

if ($missing) {
    http_response_code(422);
    $missing = array_values(array_unique($missing));
    ?>
    <section class="section">
      <div class="container narrow">
        <div class="card" style="max-width:720px;margin:40px auto;padding:34px">
          <span class="eyebrow">Devis RE2020</span>
          <h1 style="margin-top:12px">Coordonnées incomplètes</h1>
          <p class="big-p">Le devis ne peut pas être validé tant que les coordonnées obligatoires ne sont pas renseignées.</p>
          <p style="color:#6b7180">À compléter : <?= h(implode(', ', $missing)) ?>.</p>
          <p style="margin-top:24px"><a class="btn btn-p" href="/devis-en-ligne/">Retour au configurateur</a></p>
        </div>
      </div>
    </section>
    <?php
    return;
}

$target = 'https://espace-client.keeplanet.fr/pages/ajout-projet/traitement-devis-re2020-public.php';

$fields = [];
foreach ($_POST as $key => $value) {
    if (is_scalar($value)) $fields[$key] = (string)$value;
}
?>
<section class="section">
  <div class="container narrow">
    <div class="card" style="text-align:center;max-width:720px;margin:40px auto;padding:34px">
      <span class="eyebrow">Devis RE2020</span>
      <h1 style="margin-top:12px">Votre devis est en cours de préparation</h1>
      <p class="big-p">Nous créons votre accès gratuit et transmettons votre demande à Keeplanet.</p>
      <p style="color:#6b7180">Vous allez être redirigé automatiquement.</p>
    </div>
  </div>
</section>

<form id="quote-transit-form" method="post" action="<?= h($target) ?>" style="display:none">
<?php foreach ($fields as $key => $value): ?>
  <input type="hidden" name="<?= h($key) ?>" value="<?= h($value) ?>">
<?php endforeach; ?>
</form>

<script>
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({
  event: 'devis_re2020_submit',
  devis_source: 'calculateur_public'
});

/*
 * Si Google Ads est installé avec gtag(), l'événement est également
 * disponible immédiatement. L'ID de conversion peut être ajouté ici
 * sans changer le parcours.
 */
if (typeof window.gtag === 'function') {
  window.gtag('event', 'devis_re2020_submit', {
    event_category: 'lead',
    event_label: 'calculateur_public'
  });
}

window.setTimeout(function () {
  var form = document.getElementById('quote-transit-form');
  if (form) form.submit();
}, 650);
</script>
