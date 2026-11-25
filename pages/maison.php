<?php
$ecoPrice = price_ttc_label('price_eco_permis_ttc');
$permisPrice = price_ttc_label('price_pack_permis_ttc');
$finPrice = price_ttc_label('price_fin_travaux_ttc');
$finAcvPrice = price_ttc_label('price_fin_travaux_acv_ttc');
$extensionPrice = price_ttc_label('price_small_extension_attestation_ttc');
$exitOfferEnabled = house_exit_offer_enabled();
$exitOfferPercent = house_exit_offer_percent();
$bonusValue = (float) cfg('value_keephome_ttc', 50) + (float) cfg('value_heating_sizing_ttc', 50);
$bonusValueLabel = number_format($bonusValue, 0, ',', ' ') . ' € TTC';
?>
<a class="skip-link" href="#contenu-maison">Aller au contenu</a>

<section class="mi-hero" id="contenu-maison">
  <div class="container mi-hero-grid">
    <div class="mi-hero-copy">
      <div class="mi-badge">Maison individuelle · RE2020</div>
      <h1>Étude thermique RE2020 <em>pour votre maison.</em></h1>
      <p class="mi-hero-lead">Choisissez le niveau d’accompagnement dont vous avez besoin. Vous déposez vos plans en ligne, un thermicien Keeplanet réalise l’étude et vous retrouvez tous vos documents dans votre espace client.</p>

      <div class="mi-hero-actions">
        <a class="btn mi-btn-primary" href="#packs" data-no-signup-popup>Voir les packs et les tarifs</a>
        <a class="mi-link-call" href="tel:0806110559">Besoin d’aide ? <strong>0806 110 559</strong></a>
      </div>

<p class="kp-cro-reassure"><span>✓ Création de compte gratuite</span><span>✓ Aucun paiement à l’inscription</span><span>✓ Déposez vos plans ensuite</span></p>
      <div class="mi-trust-row">
        <span><b>✓</b><?= h(projects_label()) ?>+ projets étudiés</span>
        <span><b>✓</b>OPQIBI 1331 &amp; 1332</span>
        <span><b>✓</b>Assurance décennale</span>
        <span><b>✓</b><?= h(standard_delay_label()) ?> sur les packs principaux</span>
      </div>
    </div>

    <aside class="mi-hero-offer" aria-label="Pack Permis">
      <span class="mi-offer-label">Pour déposer votre permis</span>
      <h2>Pack Permis</h2>
      <div class="mi-offer-price"><?= h($permisPrice) ?></div>
      <p class="mi-offer-delay">Étude livrée en <?= h(standard_delay_label()) ?></p>
      <ul>
        <li>Calcul Bbio + DH</li>
        <li>Attestation permis générée par Keeplanet</li>
        <li>Modifications gratuites et illimitées</li>
        <li>Conseils d’un thermicien</li>
      </ul>
      <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=permis" data-no-signup-popup data-house-pack="permis">Choisir le Pack Permis</a>
      <small>Vous pourrez passer à un pack supérieur plus tard en réglant uniquement la différence.</small>
      <a class="mi-hero-eco" href="#pack-eco" data-no-signup-popup><span><strong>Eco’Permis</strong><small>L’essentiel pour le permis, en autonomie</small></span><span class="mi-hero-eco-price"><?= h($ecoPrice) ?> <span aria-hidden="true">→</span></span></a>
    </aside>
  </div>
</section>




<section class="mi-proofbar" aria-label="Garanties">
  <div class="container mi-proof-grid">
    <div><strong><?= h(experience_label()) ?></strong><span>d’expérience</span></div>
    <div><strong><?= h(projects_label()) ?>+</strong><span>projets étudiés</span></div>
    <div><strong><?= h(google_rating_label()) ?>/5</strong><span><?= h(google_reviews_label()) ?> avis Google</span></div>
    <div><strong>Suivi en ligne</strong><span>avec une équipe joignable par téléphone et e-mail</span></div>
  </div>
</section>



<section class="mi-section mi-packs-section" id="packs">
  <div class="container">
    <div class="mi-section-head">
      <span class="mi-eyebrow">Tarifs maison individuelle</span>
      <h2>Les 4 packs RE2020</h2>
      <p>Prix TTC, quelle que soit la surface de la maison. Commencez par le permis ou choisissez l’étude complète dès aujourd’hui.</p><a class="kp-cro-compare-link" href="#comparatif-packs" data-no-signup-popup>Comparer les 4 packs en détail ↓</a>
    </div>

    <article class="mi-eco-strip" id="pack-eco" aria-labelledby="pack-eco-title">
      <div class="mi-eco-copy">
        <span class="mi-eco-label">Formule économique · phase permis</span>
        <h3 id="pack-eco-title">Pack Eco’Permis</h3>
        <p>Calcul Bbio + DH en <strong><?= h(eco_delay_label()) ?></strong>, 2 variantes incluses et accès à KeePote.</p>
        <p class="mi-eco-limit">Attestation à générer vous-même · conseils du thermicien non inclus.</p>
      </div>
      <div class="mi-eco-purchase">
        <strong class="mi-eco-price"><?= h($ecoPrice) ?></strong>
        <a class="btn mi-btn-soft" href="/inscription-maison/?pack=eco" data-no-signup-popup data-house-pack="eco">Choisir Eco’Permis <span aria-hidden="true">→</span></a>
      </div>
    </article>

    <div class="mi-pack-grid">
      <article class="mi-pack-card" id="pack-permis">
        <div class="mi-pack-head">
          <span class="mi-pack-tag">Phase permis</span>
          <h3>Pack Permis</h3>
          <p class="mi-pack-for">Votre permis de construire, avec accompagnement.</p>
          <div class="mi-pack-price"><?= h($permisPrice) ?></div>
          <span class="mi-pack-delay"><?= h(standard_delay_label()) ?></span>
        </div>
        <ul class="mi-pack-list">
          <li><b>✓</b><span><strong>Étude RE2020</strong><small>Bbio + DH</small></span></li>
          <li><b>✓</b><span><strong>Attestation permis</strong><small>générée par Keeplanet</small></span></li>
          <li><b>✓</b><span><strong>Modifications illimitées</strong><small>et conseils du thermicien</small></span></li>
          <li><b>✓</b><span><strong>RC Pro &amp; décennale</strong></span></li>
          <li><b>✓</b><span><strong>KeePote inclus</strong></span></li>
          <li class="mi-pack-muted"><b>+</b><span><strong>ACV disponible en option</strong></span></li>
          <li class="mi-pack-muted"><b>+</b><span><strong>Fin de travaux disponible en option</strong></span></li>
        </ul>
        <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=permis" data-no-signup-popup data-house-pack="permis">Choisir le Pack Permis</a>
        <a class="kp-pack-doc-link" href="https://espace-client.keeplanet.fr/exemple-attestation-re2020.pdf" target="_blank" rel="noopener" data-no-signup-popup data-cro-doc="exemple-attestation-re2020.pdf">Exemple d’attestation PDF ↗</a>
      </article>

      <article class="mi-pack-card mi-pack-featured" id="pack-fdc">
        <div class="mi-featured-ribbon">Notre recommandation</div>
        <div class="mi-pack-head">
          <span class="mi-pack-tag">Étude complète</span>
          <h3>Pack Fin de travaux</h3>
          <p class="mi-pack-for">L’étude complète dès le départ, jusqu’à la fin des travaux.</p>
          <div class="mi-pack-price"><?= h($finPrice) ?></div>
          <span class="mi-pack-delay"><?= h(standard_delay_label()) ?></span>
        </div>
        <ul class="mi-pack-list">
          <li><b>✓</b><span><strong>Tout le Pack Permis</strong></span></li>
          <li><b>✓</b><span><strong>KeePote inclus</strong></span></li>
          <li><b>✓</b><span><strong>Calcul complet RE2020</strong><small>Bbio + Cep + DH</small></span></li>
          <li><b>✓</b><span><strong>Fichiers pour la fin de travaux</strong><small>Pour le professionnel habilité</small></span></li>
          <li><b>✓</b><span><strong>Dimensionnement chauffage</strong><small>offert</small></span></li>
          <li><b>✓</b><span><strong>Carnet numérique Keep’Home</strong><small>Suivi des consommations · offert</small></span></li>
        </ul>
        <div class="mi-bonus">Soit <?= h($bonusValueLabel) ?> de services offerts</div>
        <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=fdc" data-no-signup-popup data-house-pack="fdc">Choisir le Pack Fin de travaux</a>
        <a class="kp-pack-doc-link" href="https://espace-client.keeplanet.fr/exemple-synthese-simplifiee-re2020.pdf" target="_blank" rel="noopener" data-no-signup-popup data-cro-doc="exemple-synthese-simplifiee-re2020.pdf">Exemple de synthèse PDF ↗</a>
      </article>

      <article class="mi-pack-card" id="pack-fdc-acv">
        <div class="mi-pack-head">
          <span class="mi-pack-tag">Le plus complet</span>
          <h3>Fin de travaux + ACV</h3>
          <p class="mi-pack-for">L’étude complète avec le calcul carbone (ACV).</p>
          <div class="mi-pack-price"><?= h($finAcvPrice) ?></div>
          <span class="mi-pack-delay"><?= h(standard_delay_label()) ?></span>
        </div>
        <ul class="mi-pack-list">
          <li><b>✓</b><span><strong>Tout le Pack Fin de travaux</strong></span></li>
          <li><b>✓</b><span><strong>KeePote inclus</strong></span></li>
          <li><b>✓</b><span><strong>Calcul ACV inclus</strong><small>Ic énergie + Ic bâtiment</small></span></li>
          <li><b>✓</b><span><strong>Modifications illimitées</strong><small>et conseils du thermicien</small></span></li>
          <li><b>✓</b><span><strong>Dimensionnement chauffage</strong><small>offert</small></span></li>
          <li><b>✓</b><span><strong>Carnet numérique Keep’Home</strong><small>Suivi des consommations · offert</small></span></li>
        </ul>
        <div class="mi-bonus">Soit <?= h($bonusValueLabel) ?> de services offerts</div>
        <a class="btn mi-btn-outline mi-full" href="/inscription-maison/?pack=fdc-acv" data-no-signup-popup data-house-pack="fdc-acv">Choisir le pack complet + ACV</a>
        <a class="kp-pack-doc-link" href="https://espace-client.keeplanet.fr/exemple-recapitulatif-standardise-re2020.pdf" target="_blank" rel="noopener" data-no-signup-popup data-cro-doc="exemple-recapitulatif-standardise-re2020.pdf">Exemple de rapport PDF ↗</a>
      </article>
    </div>

    <div class="kp-cro-pack-security"><p class="kp-cro-reassure"><span>✓ Création de compte gratuite</span><span>✓ Aucun paiement à l’inscription</span><span>✓ Déposez vos plans ensuite</span></p><span>Évolution vers un pack supérieur en réglant la différence de tarif applicable.</span></div>
    <aside class="mi-quote-panel" aria-labelledby="mi-quote-title">
      <div class="mi-quote-symbol" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="3" width="20" height="26" rx="3"/><path d="M10 8h12v5H10zM11 18h2m6 0h2m-10 5h2m6 0h2"/></svg>
      </div>
      <div class="mi-quote-content">
        <h3 id="mi-quote-title">Vous avez besoin d’un devis ?</h3>
        <p>Plusieurs maisons, maisons jumelées, lotissement, extension ou projet particulier ? Calculez votre devis RE2020 en ligne et recevez-le par e-mail.</p>
        <small>Gratuit et sans engagement.</small>
      </div>
      <a class="btn mi-quote-link" href="/devis-en-ligne/" data-no-signup-popup>Calculer mon devis <span aria-hidden="true">→</span></a>
    </aside>
  </div>
</section>

<?php $croReviewContext='maison'; require __DIR__.'/../inc/conversion-reviews.php'; ?>
<?php require __DIR__.'/../inc/conversion-deliverables.php'; ?>
<section class="mi-section mi-compare-section" id="comparatif-packs">
  <div class="container">
    <div class="mi-section-head mi-center">
      <span class="mi-eyebrow">Comparer les prestations</span>
      <h2>Périmètre détaillé de chaque formule</h2>
    </div>

    <div class="mi-table-wrap" role="region" aria-label="Comparatif des packs RE2020" tabindex="0">
      <table class="mi-compare-table">
        <thead>
          <tr>
            <th>Inclus</th>
            <th>Eco’Permis<br><strong><?= h($ecoPrice) ?></strong></th>
            <th>Permis<br><strong><?= h($permisPrice) ?></strong></th>
            <th class="mi-th-featured">Fin de travaux<br><strong><?= h($finPrice) ?></strong></th>
            <th>Fin de travaux + ACV<br><strong><?= h($finAcvPrice) ?></strong></th>
          </tr>
        </thead>
        <tbody>
          <tr><td>KeePote · assistant RE2020</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Calcul Bbio + DH</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Attestation permis générée par Keeplanet</td><td>—</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Conseils du thermicien</td><td>—</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Modifications illimitées</td><td>—</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Calcul Cep / étude complète</td><td>—</td><td>—</td><td>✓</td><td>✓</td></tr>
          <tr><td>Fichiers pour l’attestation de fin de travaux</td><td>—</td><td>Option</td><td>✓</td><td>✓</td></tr>
          <tr><td>Dimensionnement chauffage + carnet numérique Keep’Home avec suivi des consommations</td><td>—</td><td>—</td><td>✓ offert</td><td>✓ offert</td></tr>
          <tr><td>Calcul ACV (Ic énergie + Ic bâtiment)</td><td>Option</td><td>Option</td><td>Option</td><td>✓</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php require __DIR__.'/../inc/conversion-pro.php'; ?>
<section class="mi-section mi-how-section">
  <div class="container">
    <div class="mi-section-head mi-center">
      <span class="mi-eyebrow">Déroulement</span>
      <h2>Les étapes de votre étude RE2020</h2>
    </div>

    <div class="mi-how-grid">
      <article><span>1</span><h3>Vous choisissez votre pack</h3><p>Créez votre compte et ouvrez votre dossier RE2020.</p></article>
      <article><span>2</span><h3>Vous déposez vos plans</h3><p>Tout se fait depuis votre espace client sécurisé.</p></article>
      <article><span>3</span><h3>Un thermicien réalise l’étude</h3><p>Nous calculons votre projet et échangeons avec vous si nécessaire.</p></article>
      <article><span>4</span><h3>Vous récupérez vos documents</h3><p>Étude, synthèse et attestation permis selon le pack choisi.</p></article>
    </div>
  </div>
</section>

<section class="kp-editorial-support kp-editorial-support-photo"><div class="container kp-editorial-support-inner"><figure class="kp-editorial-photo"><img src="/assets/img/editorial/thermicien-conseil.webp" alt="Illustration d’un échange téléphonique autour des plans d’une maison" width="1200" height="675" loading="lazy" decoding="async"></figure><div><h2>Votre étude se fait en ligne. Les échanges aussi, si vous le souhaitez.</h2><p>Notre équipe reste joignable par téléphone et par e-mail. Nos thermiciens réalisent les études et, selon le pack choisi, vous conseillent sur les solutions techniques. KeePote peut aussi répondre à vos questions générales.</p><div class="kp-editorial-contact"><a href="tel:0806110559">0806 110 559</a><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a><button type="button" class="kp-editorial-chat" data-keepote-open>Poser une question à KeePote →</button></div></div></div></section>
<section class="mi-section mi-info-section">
  <div class="container mi-info-grid">
    <div class="mi-info-card">
      <span class="mi-eyebrow">À savoir</span>
      <h2>Nous restons disponibles, même si tout se fait en ligne.</h2>
      <p>Votre espace client centralise les documents, messages et versions de l’étude. Pour vos questions, vous pouvez choisir KeePote, appeler notre équipe ou nous écrire par e-mail.</p>
      <div class="mi-contact-links">
        <a href="tel:0806110559">☎ 0806 110 559</a>
        <a href="mailto:info@keeplanet.fr">✉ info@keeplanet.fr</a>
      </div>
    </div>

    <div class="mi-warning-card">
      <strong>Attestation de fin de travaux : qui la délivre ?</strong>
      <p>Keeplanet réalise l’étude thermique et fournit les fichiers nécessaires au contrôle de fin de chantier. L’attestation finale doit être éditée par un professionnel habilité indépendant, par exemple un diagnostiqueur DPE, un contrôleur technique ou un architecte.</p>
    </div>
  </div>
</section>

<section class="mi-section mi-extension-section" id="extensions">
  <div class="container mi-extension-grid">
    <div>
      <span class="mi-eyebrow">Extension / petite construction</span>
      <h2>Votre projet fait moins de 50 m² ?</h2>
      <p>Pour les petites constructions concernées par la procédure simplifiée, vous pouvez générer vous-même l’attestation de dépôt. Si vous préférez nous confier cette formalité, notre équipe peut la préparer à partir des informations saisies dans votre espace.</p>
      <p class="mi-extension-time">Délai indicatif : <strong><?= h(small_extension_delay_label()) ?></strong>.</p>
    </div>
    <div class="mi-extension-offer">
      <span>Prise en charge par notre équipe</span>
      <strong><?= h($extensionPrice) ?></strong>
      <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=inf50" data-no-signup-popup data-house-pack="inf50">Créer mon dossier</a>
    </div>
  </div>
</section>

<section class="mi-section mi-faq-section">
  <div class="container mi-faq-grid">
    <div class="mi-section-head">
      <span class="mi-eyebrow">Questions fréquentes</span>
      <h2>Les réponses avant de commander.</h2>
      <p>Et si votre cas est particulier, notre équipe peut vous orienter avant toute commande.</p>
    </div>
    <div class="mi-faq-list">
      <details>
        <summary>Je peux commencer par le Pack Permis puis passer à l’étude complète ?</summary>
        <p>Oui. Vous pouvez évoluer vers un pack supérieur depuis votre parcours client. Vous ne payez alors que la différence de tarif applicable.</p>
      </details>
      <details>
        <summary>Les tarifs dépendent-ils de la surface de ma maison ?</summary>
        <p>Non pour les packs maison présentés sur cette page : le tarif affiché reste le même quelle que soit la surface du projet.</p>
      </details>
      <details>
        <summary>Que faut-il fournir pour commencer ?</summary>
        <p>Principalement vos plans et les informations disponibles sur le projet. Votre espace client vous guide pour déposer les éléments nécessaires.</p>
      </details>
      <details>
        <summary>Qui génère l’attestation pour le permis ?</summary>
        <p>Sur le Pack Permis et les packs complets, Keeplanet la génère pour vous. Avec Eco’Permis, nous fournissons les fichiers qui vous permettent de la générer vous-même.</p>
      </details>
      <details>
        <summary>Pourquoi choisir l’étude complète dès le début ?</summary>
        <p>Elle permet d’intégrer plus tôt les équipements, consommations et contrôles utiles à la conformité finale, plutôt que de ne regarder que la phase permis.</p>
      </details>
    </div>
  </div>
</section>

<section class="mi-final-cta">
  <div class="container mi-final-inner">
    <div>
      <span class="mi-eyebrow mi-eyebrow-light">Votre dossier RE2020</span>
      <h2>Choisissez la prestation correspondant à votre projet.</h2>
      <p>Vous hésitez encore ? La création de compte est gratuite et notre équipe peut vous aider à sélectionner la bonne formule.</p>
    </div>
    <div class="mi-final-actions">
      <a class="btn mi-btn-white" href="#packs">Comparer les packs</a>
      <a class="mi-final-contact" href="tel:0806110559">Ou appelez-nous au <strong>0806 110 559</strong></a>
    </div>
  </div>
</section>

<?php if ($exitOfferEnabled && $exitOfferPercent > 0): ?>
<div class="house-exit-offer" hidden data-house-exit-offer data-offer-percent="<?= h($exitOfferPercent) ?>">
  <div class="house-exit-offer-backdrop" data-house-exit-close></div>
  <div class="house-exit-offer-dialog" role="dialog" aria-modal="true" aria-labelledby="house-exit-offer-title">
    <button class="house-exit-offer-close" type="button" aria-label="Fermer l'offre" data-house-exit-close>×</button>
    <div class="house-exit-offer-badge">Offre immédiate</div>
    <div class="house-exit-offer-value">-<?= h($exitOfferPercent) ?>%</div>
    <h2 id="house-exit-offer-title">Avant de partir, profitez de <?= h($exitOfferPercent) ?> % sur votre pack maison.</h2>
    <p>Créez votre compte maintenant : votre remise sera automatiquement rattachée à votre inscription.</p>
    <ul>
      <li>Pack Permis</li>
      <li>Pack Fin de travaux</li>
      <li>Pack Fin de travaux + ACV</li>
    </ul>
    <p class="house-exit-offer-exclusion">Hors Pack Eco'Permis.</p>
    <a class="btn house-exit-offer-cta" href="/inscription-maison/?offre=<?= (int)$exitOfferPercent ?>" data-house-exit-claim data-no-signup-popup>Créer mon compte et profiter de -<?= h($exitOfferPercent) ?> %</a>
    <button class="house-exit-offer-skip" type="button" data-house-exit-close>Non merci</button>
  </div>
</div>
<?php endif; ?>

<dialog class="kp-house-dialog" id="kp-house-dialog" aria-labelledby="kp-house-dialog-title">
  <div class="kp-house-dialog-inner">
    <button class="kp-house-dialog-close" type="button" aria-label="Fermer" data-house-dialog-close>×</button>
    <span class="eyebrow">Espace client KeePlanet</span>
    <h2 id="kp-house-dialog-title">Démarrez votre étude RE2020</h2>
    <div class="kp-house-selected"><div><strong data-house-label></strong><small data-house-desc></small></div><b data-house-price></b></div>
    <form method="post" action="/inscription-maison/envoi/" data-house-signup-form>
      <input type="hidden" name="pack" value="">
      <input type="hidden" name="offre_maison" value="0">
      <input type="hidden" name="retour_site" value="" data-return-site>
      <label>Nom ou nom de société *<input type="text" name="nom" autocomplete="name" required></label>
      <label>E-mail *<input type="email" name="email" autocomplete="email" required></label>
      <label>Téléphone <small>(facultatif)</small><input type="tel" name="telephone" autocomplete="tel"></label>
      <button type="submit" class="btn mi-btn-primary mi-full" data-no-signup-popup>Créer mon compte gratuitement</button>
      <p class="kp-house-dialog-note">Aucun paiement à cette étape. Vous serez redirigé vers notre page de validation, puis votre dossier sera créé.</p>
    </form>
    <a class="kp-house-fallback" href="/inscription-maison/" data-no-signup-popup>Changer de pack</a>
  </div>
</dialog>
<script type="application/json" id="kp-house-pack-data"><?= json_encode(array_map(function($p){return ['label'=>$p['label'],'description'=>$p['description'],'price'=>house_signup_price_label($p)];}, house_signup_packs()), JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE) ?></script>
<div class="house-mobile-cta">
  <span><small>Étude RE2020 dès</small><strong><?= h($ecoPrice) ?></strong></span>
  <a href="#packs" data-no-signup-popup>Voir les packs →</a>
</div>
