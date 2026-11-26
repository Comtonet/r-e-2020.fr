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
$isGeneralSignup = isset($signupFlow) && $signupFlow === 'general' && $payloadRaw === '' && empty($_POST['devis_depuis_calculateur']) && empty($_POST['public_signup']);
if (!$isGeneralSignup && !is_array($payload)) {
    $missing[] = 'Données du devis';
}

// Le formulaire ne presente pas l'acompte. Calcul serveur sur le TTC final,
// supplément express compris. Le traitement de création doit recalculer le
// devis et son acompte à partir de sa propre grille, sans faire confiance au POST.
if (!$isGeneralSignup && is_array($payload)) {
    $total = $payload['prix']['total_ttc'] ?? null;
    $minimumCentimes = (int) round((float) cfg('quote_minimum_ttc', 262.50) * 100);
    if (!is_numeric($total) || !is_finite((float) $total) || (float) $total < 0 || round((float) $total * 100) < $minimumCentimes) {
        $missing[] = 'Montant du devis invalide (minimum ' . number_format($minimumCentimes / 100, 2, ',', ' ') . ' € TTC)';
    } else {
        $centimes = (int) round((float) $total * 100);
        $seuil = (int) round((float) cfg('quote_acompte_seuil_ttc', 300.00) * 100);
        $pct = $centimes < $seuil ? (float) cfg('quote_acompte_pct_sous_seuil', 100) : (float) cfg('quote_acompte_pct_standard', 30);
        $payload['prix']['total_ttc'] = $centimes / 100;
        $payload['prix']['total_ht'] = round($centimes / 120, 2);
        $payload['prix']['acompte_pct'] = $pct;
        $payload['prix']['acompte_ttc'] = round($centimes * $pct / 100) / 100;
    }
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
if (!$isGeneralSignup && is_array($payload)) {
    $fields['devis_payload'] = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
?>
<section class="section">
  <div class="container narrow">
    <div class="card" style="text-align:center;max-width:720px;margin:40px auto;padding:34px">
      <span class="eyebrow">Devis RE2020</span>
      <h1 style="margin-top:12px"><?= $isGeneralSignup ? 'Votre inscription est en cours' : 'Votre devis est en cours de préparation' ?></h1>
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
  event: <?= json_encode($isGeneralSignup ? 'inscription_generale_submit' : 'devis_re2020_submit') ?>,
  devis_source: <?= json_encode($isGeneralSignup ? 'popup_generale' : 'calculateur_public') ?>
});

var form=document.getElementById('quote-transit-form');
if(typeof window.KP_SUBMIT_SIGNUP==='function')window.KP_SUBMIT_SIGNUP(form,650);
else window.setTimeout(function(){if(form)form.submit();},650);
</script>
