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
    <h1>Tarifs des études thermiques RE2020</h1>
    <p class="tarifs-hero-lead">Maison individuelle, extension, logement collectif ou bâtiment tertiaire : choisissez votre type de projet et accédez directement au tarif ou au devis adapté.</p>
    <div class="tarifs-hero-actions">
      <a class="btn tarifs-btn-primary" href="#choisir-projet" data-no-signup-popup>Choisir mon projet</a>
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
      <span class="tarifs-eyebrow">Type de projet</span>
      <h2>Quel est votre projet ?</h2>
      <p>Les modalités de chiffrage dépendent de la typologie et du périmètre de l’étude.</p>
    </div>

    <div class="tarifs-choice-grid">
      <article class="tarifs-choice-card tarifs-choice-house">
        <div class="tarifs-choice-top">
          <div class="tarifs-choice-icon">⌂</div>
          <span class="tarifs-choice-badge">Tarifs forfaitaires</span>
        </div>
        <h3>Maison individuelle<br>&amp; extension</h3>
        <p>Des prestations définies pour la phase permis de construire ou pour l’étude RE2020 complète jusqu’à la fin des travaux.</p>

        <div class="tarifs-house-highlight">
          <span>Étude pour le dépôt du permis</span>
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
    <div><strong>Espace client sécurisé</strong><span>documents, échanges et suivi du dossier</span></div>
    <div><strong>Équipe technique dédiée</strong><span>thermiciens joignables par téléphone et e-mail</span></div>
  </div>
</section>

<section class="tarifs-section tarifs-how">
  <div class="container">
    <div class="tarifs-section-head tarifs-center">
      <span class="tarifs-eyebrow">Déroulement de la prestation</span>
      <h2>De l’ouverture du dossier à la remise des livrables.</h2>
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
      <span class="tarifs-eyebrow">Besoin d’identifier la prestation adaptée ?</span>
      <h2>Consultez KeePote ou échangez avec notre équipe.</h2>
      <p>KeePote peut vous aider à comprendre les différences entre les prestations. Et si vous préférez parler à quelqu’un, notre équipe reste disponible par téléphone et par e-mail.</p>
      <div class="tarifs-help-actions">
        <button class="btn tarifs-btn-primary" type="button" data-keepote-open onclick="document.querySelector('.ai-panel').hidden=false">Demander à KeePote</button>
        <a href="tel:0806110559">☎ 0806 110 559</a>
        <a href="mailto:info@keeplanet.fr">✉ info@keeplanet.fr</a>
      </div>
    </div>
    <div class="tarifs-help-box">
      <strong>Notre équipe vous accompagne dans la définition de votre besoin.</strong>
      <p>Décrivez votre projet : nous vous orientons vers la prestation correspondant à sa typologie et à son stade d’avancement.</p>
      <a href="/contact/">Nous contacter →</a>
    </div>
  </div>
</section>

<section class="tarifs-final">
  <div class="container tarifs-final-inner">
    <div>
      <span class="tarifs-eyebrow tarifs-eyebrow-light">Votre étude RE2020</span>
      <h2>Sélectionnez votre type de projet pour consulter la prestation correspondante.</h2>
    </div>
    <div class="tarifs-final-buttons">
      <a class="btn tarifs-btn-white" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Maison &amp; extension</a>
      <a class="btn tarifs-btn-green" href="/devis-en-ligne/">Collectif &amp; tertiaire</a>
    </div>
  </div>
</section>
