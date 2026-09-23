<?php
$ecoPrice = price_ttc_label('price_eco_permis_ttc');
$permisPrice = price_ttc_label('price_pack_permis_ttc');
$finPrice = price_ttc_label('price_fin_travaux_ttc');
$finAcvPrice = price_ttc_label('price_fin_travaux_acv_ttc');
?>
<a class="skip-link" href="#tarifs-main">Aller au contenu</a>

<section class="tarifs-hero" id="tarifs-main">
  <div class="container tarifs-hero-inner">
    <div class="tarifs-breadcrumbs"><a href="/">Accueil</a><span>›</span><span>Tarifs</span></div>
    <span class="tarifs-eyebrow">Études thermiques RE2020 · France entière</span>
    <h1>Votre projet. Le bon parcours. Le bon tarif.</h1>
    <p class="tarifs-hero-lead">Maison individuelle, extension, logement collectif ou bâtiment tertiaire : choisissez votre type de projet et accédez directement au tarif ou au devis adapté.</p>
    <div class="tarifs-hero-actions">
      <a class="btn tarifs-btn-primary" href="#choisir-projet">Choisir mon projet</a>
      <a class="tarifs-phone-link" href="tel:0806110559">Une question ? <strong>0806 110 559</strong></a>
    </div>
    <div class="tarifs-trust">
      <span><b>✓</b><?= h(projects_label()) ?>+ projets étudiés</span>
      <span><b>✓</b><?= h(experience_label()) ?> d’expérience</span>
      <span><b>✓</b>Qualifié OPQIBI</span>
      <span><b>✓</b>Assurance décennale</span>
    </div>
  </div>
</section>

<section class="tarifs-choice-section" id="choisir-projet">
  <div class="container">
    <div class="tarifs-section-head">
      <span class="tarifs-eyebrow">Commencez ici</span>
      <h2>Quel est votre projet ?</h2>
      <p>Deux parcours différents pour aller directement à l’essentiel.</p>
    </div>

    <div class="tarifs-choice-grid">
      <article class="tarifs-choice-card tarifs-choice-house">
        <div class="tarifs-choice-top">
          <div class="tarifs-choice-icon">⌂</div>
          <span class="tarifs-choice-badge">Tarifs immédiats</span>
        </div>
        <h3>Maison individuelle<br>&amp; extension</h3>
        <p>Des packs prêts à commander pour le permis de construire ou l’étude RE2020 complète jusqu’à la fin du projet.</p>

        <div class="tarifs-house-highlight">
          <span>Le plus choisi pour le permis</span>
          <div><strong>Pack Permis</strong><b><?= h($permisPrice) ?></b></div>
          <small>Étude RE2020 + attestation permis générée par Keeplanet + conseils du thermicien.</small>
        </div>

        <div class="tarifs-mini-prices">
          <span>Eco’Permis <strong><?= h($ecoPrice) ?></strong></span>
          <span>Fin de travaux <strong><?= h($finPrice) ?></strong></span>
          <span>Fin de travaux + ACV <strong><?= h($finAcvPrice) ?></strong></span>
        </div>

        <a class="btn tarifs-btn-primary tarifs-full" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Voir les packs maison</a>
        <small class="tarifs-card-note">Tarifs TTC · quelle que soit la surface de la maison.</small>
      </article>

      <article class="tarifs-choice-card tarifs-choice-pro">
        <div class="tarifs-choice-top">
          <div class="tarifs-choice-icon">▦</div>
          <span class="tarifs-choice-badge">Devis personnalisé</span>
        </div>
        <h3>Logement collectif<br>&amp; tertiaire</h3>
        <p>Configurez votre opération et obtenez un chiffrage adapté à la typologie, au nombre de logements, aux surfaces et aux prestations souhaitées.</p>

        <div class="tarifs-pro-types">
          <span>Logements collectifs</span>
          <span>Bureaux</span>
          <span>Commerces</span>
          <span>ERP</span>
          <span>Extensions</span>
          <span>Projets mixtes</span>
        </div>

        <div class="tarifs-pro-highlight">
          <strong>Calculez votre devis en ligne</strong>
          <p>Décrivez votre projet, sélectionnez les prestations et obtenez le chiffrage directement depuis notre configurateur.</p>
        </div>

        <a class="btn tarifs-btn-green tarifs-full" href="/devis-en-ligne/">Calculer mon devis</a>
        <a class="tarifs-secondary-link" href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Voir aussi notre accompagnement collectif &amp; tertiaire →</a>
      </article>
    </div>
  </div>
</section>

<section class="tarifs-proof-section">
  <div class="container tarifs-proof-grid">
    <div><strong><?= h(standard_delay_label()) ?></strong><span>délai actuel sur les packs maison principaux</span></div>
    <div><strong><?= h(google_rating_label()) ?>/5</strong><span><?= h(google_reviews_label()) ?> avis Google</span></div>
    <div><strong>100 % en ligne</strong><span>documents et suivi dans votre espace client</span></div>
    <div><strong>Une vraie équipe</strong><span>thermiciens joignables par téléphone et e-mail</span></div>
  </div>
</section>

<section class="tarifs-section tarifs-how">
  <div class="container">
    <div class="tarifs-section-head tarifs-center">
      <span class="tarifs-eyebrow">Simple du début à la fin</span>
      <h2>Vous choisissez. Vous déposez vos plans. On s’occupe du reste.</h2>
    </div>

    <div class="tarifs-steps">
      <article><span>1</span><h3>Choisissez votre parcours</h3><p>Pack maison à tarif fixe ou devis selon votre opération.</p></article>
      <article><span>2</span><h3>Créez votre dossier</h3><p>Vous déposez vos plans et informations dans votre espace sécurisé.</p></article>
      <article><span>3</span><h3>Un thermicien prend le relais</h3><p>Votre étude est réalisée par l’équipe Keeplanet.</p></article>
      <article><span>4</span><h3>Recevez vos livrables</h3><p>Étude, synthèses et documents réglementaires selon la prestation choisie.</p></article>
    </div>
  </div>
</section>

<section class="tarifs-help-section">
  <div class="container tarifs-help-grid">
    <div class="tarifs-help-copy">
      <span class="tarifs-eyebrow">Vous ne savez pas quoi choisir ?</span>
      <h2>Demandez à KeePote… ou directement à un humain.</h2>
      <p>KeePote peut vous aider à comprendre les différences entre les prestations. Et si vous préférez parler à quelqu’un, notre équipe reste disponible par téléphone et par e-mail.</p>
      <div class="tarifs-help-actions">
        <button class="btn tarifs-btn-primary" type="button" data-keepote-open onclick="document.querySelector('.ai-panel').hidden=false">Demander à KeePote</button>
        <a href="tel:0806110559">☎ 0806 110 559</a>
        <a href="mailto:info@keeplanet.fr">✉ info@keeplanet.fr</a>
      </div>
    </div>
    <div class="tarifs-help-box">
      <strong>Pas besoin de connaître la RE2020.</strong>
      <p>Décrivez simplement votre projet. Le site et notre équipe vous orientent vers la prestation adaptée.</p>
      <a href="/contact/">Nous contacter →</a>
    </div>
  </div>
</section>

<section class="tarifs-final">
  <div class="container tarifs-final-inner">
    <div>
      <span class="tarifs-eyebrow tarifs-eyebrow-light">Prêt à avancer ?</span>
      <h2>Choisissez votre projet et lancez votre étude.</h2>
    </div>
    <div class="tarifs-final-buttons">
      <a class="btn tarifs-btn-white" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Maison &amp; extension</a>
      <a class="btn tarifs-btn-green" href="/devis-en-ligne/">Collectif &amp; tertiaire</a>
    </div>
  </div>
</section>
