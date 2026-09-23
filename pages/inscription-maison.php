<?php
$packs = house_signup_packs();
$packSlug = trim((string)($_GET['pack'] ?? ''));
$pack = house_signup_pack($packSlug);
$offer = max(0, min(100, (int)($_GET['offre'] ?? 0)));
?>
<section class="house-signup">
  <div class="container signup-shell">
    <div class="signup-head">
      <span class="eyebrow">Espace client KeePlanet</span>
      <h1><?= $pack ? 'Ouvrez votre dossier RE2020' : 'Choisissez votre pack maison' ?></h1>
      <p><?= $pack ? 'Votre nom, votre e-mail et c’est presque terminé. Le téléphone est facultatif.' : 'Sélectionnez la prestation souhaitée. Vous renseignerez ensuite uniquement les coordonnées nécessaires pour ouvrir votre dossier.' ?></p>
    </div>

    <?php if (!$pack): ?>
      <?php if ($offer > 0): ?>
        <div class="offer-note">Votre offre de -<?= h($offer) ?> % sera rattachée à votre inscription. Pack Eco'Permis exclu.</div>
      <?php endif; ?>
      <div class="signup-grid">
        <?php foreach ($packs as $slug => $item): ?>
          <?php if ($offer > 0 && $slug === 'eco') continue; ?>
          <a class="signup-pack" data-no-signup-popup href="/inscription-maison/?pack=<?= rawurlencode($slug) ?><?= $offer > 0 ? '&offre=' . (int)$offer : '' ?>">
            <strong><?= h($item['label'] ?? $slug) ?></strong>
            <span><?= h($item['description'] ?? '') ?></span>
            <b><?= h(house_signup_price_label($item)) ?></b>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="signup-card">
        <?php if ($offer > 0 && $packSlug !== 'eco'): ?>
          <div class="offer-note">Offre de -<?= h($offer) ?> % rattachée à cette inscription.</div>
        <?php endif; ?>

        <div class="selected-pack">
          <div>
            <strong><?= h($pack['label'] ?? '') ?></strong>
            <span><?= h($pack['description'] ?? '') ?></span>
          </div>
          <b><?= h(house_signup_price_label($pack)) ?></b>
        </div>

        <a class="change-pack" data-no-signup-popup href="/inscription-maison/<?= $offer > 0 ? '?offre=' . (int)$offer : '' ?>">← Changer de pack</a>

        <form method="post" action="/inscription-maison/envoi/" data-house-signup-form>
          <input type="hidden" name="pack" value="<?= h($packSlug) ?>">
          <input type="hidden" name="offre_maison" value="<?= (int)$offer ?>">
          <input type="hidden" name="retour_site" value="" data-return-site>

          <div class="signup-form-grid signup-form-grid-simple">
            <label class="wide">
              <span>Nom ou nom de société *</span>
              <input type="text" name="nom" autocomplete="name" required>
            </label>
            <label class="wide">
              <span>E-mail *</span>
              <input type="email" name="email" autocomplete="email" required>
            </label>
            <label class="wide">
              <span>Téléphone <small>(facultatif)</small></span>
              <input type="tel" name="telephone" autocomplete="tel">
            </label>
          </div>

          <button type="submit" class="btn btn-p signup-submit" data-no-signup-popup>Continuer et ouvrir mon dossier</button>
          <p class="signup-note">Aucun paiement à cette étape. Vous serez d’abord redirigé vers notre page de validation, puis votre dossier sera créé.</p>
        </form>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if ($pack): ?>
<script>
(function(){
  var form=document.querySelector('[data-house-signup-form]');
  if(!form)return;
  var ret=form.querySelector('[data-return-site]');
  if(ret)ret.value=window.location.origin;
})();
</script>
<?php endif; ?>
