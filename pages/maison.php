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
      <h1>Votre étude RE2020, prête pour faire avancer votre permis.</h1>
      <p class="mi-hero-lead">Choisissez le niveau d’accompagnement dont vous avez besoin. Vous déposez vos plans en ligne, un thermicien Keeplanet réalise l’étude et vous retrouvez tous vos documents dans votre espace client.</p>

      <div class="mi-hero-actions">
        <a class="btn mi-btn-primary" href="#packs">Voir les packs et les tarifs</a>
        <a class="mi-link-call" href="tel:0806110559">Besoin d’aide ? <strong>0806 110 559</strong></a>
      </div>

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
      <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=permis" data-no-signup-popup>Choisir le Pack Permis</a>
      <small>Vous pourrez passer à un pack supérieur plus tard en réglant uniquement la différence.</small>
    </aside>
  </div>
</section>

<section class="mi-proofbar" aria-label="Garanties">
  <div class="container mi-proof-grid">
    <div><strong><?= h(experience_label()) ?></strong><span>d’expérience</span></div>
    <div><strong><?= h(projects_label()) ?>+</strong><span>projets étudiés</span></div>
    <div><strong><?= h(google_rating_label()) ?>/5</strong><span><?= h(google_reviews_label()) ?> avis Google</span></div>
    <div><strong>100 % en ligne</strong><span>avec une équipe joignable par téléphone et e-mail</span></div>
  </div>
</section>

<section class="mi-section mi-choice-section">
  <div class="container">
    <div class="mi-section-head mi-center">
      <span class="mi-eyebrow">Quel pack choisir ?</span>
      <h2>Partez simplement de votre besoin.</h2>
      <p>Pas besoin de connaître la RE2020 pour commander la bonne prestation.</p>
    </div>

    <div class="mi-choice-grid">
      <a class="mi-choice-card" href="#pack-permis">
        <span class="mi-choice-number">1</span>
        <div>
          <strong>Je veux déposer mon permis</strong>
          <p>Choisissez le <b>Pack Permis</b>. C’est la formule simple pour obtenir l’étude et l’attestation nécessaires au dépôt.</p>
          <span class="mi-choice-price"><?= h($permisPrice) ?> →</span>
        </div>
      </a>

      <a class="mi-choice-card mi-choice-recommended" href="#pack-fdc">
        <span class="mi-choice-number">2</span>
        <div>
          <span class="mi-mini-badge">Recommandé</span>
          <strong>Je veux sécuriser mon projet jusqu’à la fin des travaux</strong>
          <p>Choisissez le <b>Pack Fin de travaux</b> : calcul complet, conseils, suivi et fichiers nécessaires pour le contrôle final.</p>
          <span class="mi-choice-price"><?= h($finPrice) ?> →</span>
        </div>
      </a>

      <a class="mi-choice-card" href="#pack-fdc-acv">
        <span class="mi-choice-number">3</span>
        <div>
          <strong>Je veux tout intégrer dès le départ, y compris l’ACV</strong>
          <p>Choisissez le <b>Pack Fin de travaux + ACV</b> pour intégrer également les indicateurs carbone réglementaires.</p>
          <span class="mi-choice-price"><?= h($finAcvPrice) ?> →</span>
        </div>
      </a>
    </div>

    <p class="mi-choice-note">Petit budget et uniquement la phase permis ? Le <a href="#pack-eco">Pack Eco’Permis à <?= h($ecoPrice) ?></a> reste disponible avec un accompagnement réduit.</p>
  </div>
</section>

<section class="mi-section mi-packs-section" id="packs">
  <div class="container">
    <div class="mi-section-head">
      <span class="mi-eyebrow">Tarifs maison individuelle</span>
      <h2>Des packs clairs, sans tarif caché.</h2>
      <p>Tous les prix sont TTC et valables quelle que soit la surface de la maison. Les packs principaux incluent l’accès à votre espace client et les échanges avec notre équipe.</p>
    </div>

    <div class="mi-pack-grid">
      <article class="mi-pack-card" id="pack-permis">
        <div class="mi-pack-head">
          <span class="mi-pack-tag">Phase permis</span>
          <h3>Pack Permis</h3>
          <p class="mi-pack-for">Pour obtenir votre étude et votre attestation de dépôt du permis.</p>
          <div class="mi-pack-price"><?= h($permisPrice) ?></div>
          <span class="mi-pack-delay"><?= h(standard_delay_label()) ?></span>
        </div>
        <ul class="mi-pack-list">
          <li><b>✓</b><span><strong>Étude RE2020</strong><small>Bbio + DH</small></span></li>
          <li><b>✓</b><span><strong>Attestation permis</strong><small>générée par Keeplanet</small></span></li>
          <li><b>✓</b><span><strong>Modifications illimitées</strong><small>et conseils du thermicien</small></span></li>
          <li><b>✓</b><span><strong>RC Pro &amp; décennale</strong></span></li>
          <li class="mi-pack-muted"><b>+</b><span>ACV disponible en option</span></li>
        </ul>
        <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=permis" data-no-signup-popup>Choisir le Pack Permis</a>
      </article>

      <article class="mi-pack-card mi-pack-featured" id="pack-fdc">
        <div class="mi-featured-ribbon">Notre recommandation</div>
        <div class="mi-pack-head">
          <span class="mi-pack-tag">Étude complète</span>
          <h3>Pack Fin de travaux</h3>
          <p class="mi-pack-for">Pour vérifier la performance globale du projet dès le départ et préparer la conformité finale.</p>
          <div class="mi-pack-price"><?= h($finPrice) ?></div>
          <span class="mi-pack-delay"><?= h(standard_delay_label()) ?></span>
        </div>
        <ul class="mi-pack-list">
          <li><b>✓</b><span><strong>Tout le Pack Permis</strong></span></li>
          <li><b>✓</b><span><strong>Calcul complet RE2020</strong><small>Bbio + Cep + DH</small></span></li>
          <li><b>✓</b><span><strong>Fichiers pour la fin de travaux</strong><small>utilisés par le professionnel qui édite l’attestation finale</small></span></li>
          <li><b>✓</b><span><strong>Suivi estimatif des consommations</strong></span></li>
          <li><b>✓</b><span><strong>Dimensionnement chauffage</strong><small>offert</small></span></li>
          <li><b>✓</b><span><strong>Carnet numérique Keep’Home</strong><small>offert</small></span></li>
        </ul>
        <div class="mi-bonus">Soit <?= h($bonusValueLabel) ?> de services offerts</div>
        <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=fdc" data-no-signup-popup>Choisir le Pack Fin de travaux</a>
      </article>

      <article class="mi-pack-card" id="pack-fdc-acv">
        <div class="mi-pack-head">
          <span class="mi-pack-tag">Le plus complet</span>
          <h3>Fin de travaux + ACV</h3>
          <p class="mi-pack-for">Pour intégrer dès maintenant la partie énergie, confort et carbone de la RE2020.</p>
          <div class="mi-pack-price"><?= h($finAcvPrice) ?></div>
          <span class="mi-pack-delay"><?= h(standard_delay_label()) ?></span>
        </div>
        <ul class="mi-pack-list">
          <li><b>✓</b><span><strong>Tout le Pack Fin de travaux</strong></span></li>
          <li><b>✓</b><span><strong>Calcul ACV inclus</strong><small>Ic énergie + Ic bâtiment</small></span></li>
          <li><b>✓</b><span><strong>Modifications illimitées</strong><small>et conseils du thermicien</small></span></li>
          <li><b>✓</b><span><strong>Dimensionnement chauffage</strong><small>offert</small></span></li>
          <li><b>✓</b><span><strong>Carnet numérique Keep’Home</strong><small>offert</small></span></li>
        </ul>
        <a class="btn mi-btn-outline mi-full" href="/inscription-maison/?pack=fdc-acv" data-no-signup-popup>Choisir le pack complet + ACV</a>
      </article>
    </div>

    <article class="mi-eco-strip" id="pack-eco">
      <div class="mi-eco-copy">
        <span class="mi-pack-tag">Option économique</span>
        <h3>Pack Eco’Permis <strong><?= h($ecoPrice) ?></strong></h3>
        <p>Calcul Bbio + DH en <?= h(eco_delay_label()) ?>, 2 variantes incluses. Vous générez vous-même l’attestation permis avec les fichiers fournis et la formule ne comprend pas les conseils du thermicien.</p>
      </div>
      <a class="btn mi-btn-soft" href="/inscription-maison/?pack=eco" data-no-signup-popup>Choisir Eco’Permis</a>
    </article>
  </div>
</section>

<section class="mi-section mi-compare-section">
  <div class="container">
    <div class="mi-section-head mi-center">
      <span class="mi-eyebrow">Comparer les packs</span>
      <h2>Tout voir en un coup d’œil.</h2>
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
          <tr><td>Calcul Bbio + DH</td><td>✓</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Attestation permis générée par Keeplanet</td><td>—</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Conseils du thermicien</td><td>—</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Modifications illimitées</td><td>—</td><td>✓</td><td>✓</td><td>✓</td></tr>
          <tr><td>Calcul Cep / étude complète</td><td>—</td><td>—</td><td>✓</td><td>✓</td></tr>
          <tr><td>Fichiers pour l’attestation de fin de travaux</td><td>—</td><td>—</td><td>✓</td><td>✓</td></tr>
          <tr><td>Dimensionnement chauffage + Keep’Home</td><td>—</td><td>—</td><td>✓</td><td>✓</td></tr>
          <tr><td>Calcul ACV (Ic énergie + Ic bâtiment)</td><td>Option</td><td>Option</td><td>Option</td><td>✓</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="mi-section mi-how-section">
  <div class="container">
    <div class="mi-section-head mi-center">
      <span class="mi-eyebrow">Comment ça marche ?</span>
      <h2>Votre dossier démarre en quelques minutes.</h2>
    </div>

    <div class="mi-how-grid">
      <article><span>1</span><h3>Vous choisissez votre pack</h3><p>Créez votre compte et ouvrez votre dossier RE2020.</p></article>
      <article><span>2</span><h3>Vous déposez vos plans</h3><p>Tout se fait depuis votre espace client sécurisé.</p></article>
      <article><span>3</span><h3>Un thermicien réalise l’étude</h3><p>Nous calculons votre projet et échangeons avec vous si nécessaire.</p></article>
      <article><span>4</span><h3>Vous récupérez vos documents</h3><p>Étude, synthèse et attestation permis selon le pack choisi.</p></article>
    </div>
  </div>
</section>

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
      <a class="btn mi-btn-primary mi-full" href="/inscription-maison/?pack=inf50" data-no-signup-popup>Créer mon dossier</a>
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
      <span class="mi-eyebrow mi-eyebrow-light">Prêt à avancer ?</span>
      <h2>Choisissez votre pack et ouvrez votre dossier maintenant.</h2>
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

<div class="house-mobile-cta">
  <span><small>Pack Permis</small><strong><?= h($permisPrice) ?></strong></span>
  <a href="/inscription-maison/?pack=permis" data-no-signup-popup>Choisir</a>
</div>
