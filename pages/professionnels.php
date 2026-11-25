<?php $proReady = (bool)cfg('pro_signup_enabled',false); ?>
<div class="kp-pro-page">
<section class="kp-pro-intro">
 <div class="container kp-pro-layout">
  <div class="kp-pro-main">
   <span class="kp-pro-kicker"><i></i> L’offre KeePlanet pour les professionnels</span>
   <h1>Vos projets.<br>Notre expertise <em>RE2020.</em></h1>
   <p class="kp-pro-lead">Architectes, constructeurs, maîtres d’œuvre, dessinateurs : gagnez du temps sur vos études thermiques et retrouvez vos dossiers au même endroit.</p>
   <div class="kp-pro-benefits"><span>✓ Un compte pour vos projets</span><span>✓ Des conditions professionnelles adaptées</span><span>✓ Des thermiciens à votre écoute</span></div>
   <figure class="kp-pro-visual"><img src="/assets/img/editorial/etude-collectif.webp" alt="Plans et maquette d’un projet immobilier" width="1200" height="675" fetchpriority="high" decoding="async"><figcaption><span>OPQIBI 1331 &amp; 1332</span><a href="https://www.opqibi.com/fiche/3545" target="_blank" rel="noopener" data-no-signup-popup>Nos qualifications ↗</a></figcaption></figure>
  </div>
  <aside class="kp-pro-registration" id="compte-pro" aria-labelledby="pro-title">
   <span class="kp-pro-form-eyebrow">Sans engagement · Aucun paiement</span>
   <h2 id="pro-title">Créez votre compte pro.</h2>
   <p>Renseignez vos coordonnées : votre compte et votre fiche entreprise seront créés ensemble. Vous recevrez vos accès par e-mail.</p>
   <?php if (!$proReady): ?><p class="kp-pro-pending" role="status">L’inscription professionnelle en ligne sera disponible prochainement. En attendant, notre équipe peut vous accompagner dans l’ouverture de votre compte.</p><?php endif; ?>
   <form action="/inscription-en-cours/" method="post" data-pro-signup-form>
    <input type="hidden" name="_kp_signup_flow" value="pro">
    <fieldset <?= $proReady ? '' : 'disabled' ?>>
    <label>Entreprise / nom commercial <span>*</span><input type="text" name="societe" autocomplete="organization" maxlength="180" required placeholder="Votre entreprise"></label>
    <div class="kp-pro-fields"><label>Prénom <span>*</span><input name="prenom" autocomplete="given-name" maxlength="100" required placeholder="Prénom"></label><label>Nom <span>*</span><input name="nom" autocomplete="family-name" maxlength="100" required placeholder="Nom"></label></div>
    <label>Adresse e-mail professionnelle <span>*</span><input type="email" name="email" autocomplete="email" maxlength="254" required placeholder="vous@entreprise.fr"></label>
    <label>Téléphone <small>facultatif</small><input type="tel" name="telephone" autocomplete="tel" maxlength="40" placeholder="Votre numéro"></label>
    <label>Adresse de l’entreprise <span>*</span><input type="text" name="adresse" autocomplete="street-address" maxlength="240" required placeholder="Numéro et rue"></label>
    <div class="kp-pro-fields kp-pro-address-fields"><label>Code postal <span>*</span><input type="text" name="code_postal" autocomplete="postal-code" inputmode="numeric" maxlength="5" pattern="[0-9]{5}" required placeholder="67000"></label><label>Ville <span>*</span><input type="text" name="ville" autocomplete="address-level2" maxlength="120" required placeholder="Ville"></label></div>
    <button type="submit" class="btn kp-pro-submit" data-no-signup-popup>Créer mon compte professionnel <span aria-hidden="true">→</span></button>
    </fieldset>
    <?php if (!$proReady): ?><a class="btn kp-pro-submit" href="mailto:info@keeplanet.fr?subject=Ouverture%20compte%20professionnel%20RE2020" data-no-signup-popup>Demander l’ouverture de mon compte →</a><?php endif; ?>
    <p class="kp-pro-form-note">Vos informations servent à traiter votre inscription. <a href="/mentions-legales/" data-no-signup-popup>Informations sur vos données</a>.</p>
   </form>
   <div class="kp-pro-login">Déjà client ? <a href="https://espace-client.keeplanet.fr/" data-no-signup-popup>Connectez-vous</a></div>
  </aside>
 </div>
</section>
<section class="kp-pro-proof"><div class="container"><div><strong><?= h(projects_label()) ?>+</strong><span>projets étudiés</span></div><div><strong><?= h(experience_label()) ?></strong><span>d’expérience</span></div><div><strong><?= h(google_rating_label()) ?>/5</strong><span>avis Google</span></div><div><strong><?= h(standard_delay_label()) ?></strong><span>packs maison principaux</span></div></div></section>
<section class="kp-pro-services"><div class="container"><div class="kp-pro-heading"><span class="eyebrow">Un seul partenaire, plusieurs prestations</span><h2>De la maison individuelle aux opérations collectives.</h2><p>Nous réalisons vos études selon la typologie et les besoins de chaque projet.</p></div>
 <div class="kp-pro-services-grid"><article><span class="kp-pro-service-no">01 / MAISON</span><h3>Maisons et extensions</h3><p>Étude permis, étude complète et ACV. Des packs à tarif forfaitaire et des conditions professionnelles définies avec notre équipe.</p><a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/" data-no-signup-popup>Voir les packs maison →</a></article><article><span class="kp-pro-service-no">02 / OPÉRATIONS</span><h3>Collectif et tertiaire</h3><p>Calculez le devis de vos opérations en fonction des surfaces, des logements et des usages.</p><a href="/devis-en-ligne/" data-no-signup-popup>Calculer un devis →</a></article><article><span class="kp-pro-service-no">03 / SUIVI</span><h3>Vos dossiers au même endroit</h3><p>Retrouvez vos documents et les échanges avec notre équipe dans votre espace client.</p><a href="#compte-pro" data-no-signup-popup>Ouvrir mon espace pro →</a></article></div>
</div></section>
<?php require __DIR__.'/../inc/conversion-reviews.php'; ?>
<section class="kp-pro-bottom"><div class="container kp-pro-bottom-grid"><div><h2>Parlons de vos prochains projets.</h2><p>Notre équipe vous accompagne pour définir vos besoins et les conditions commerciales de votre entreprise.</p><a class="btn kp-pro-submit" href="#compte-pro" data-no-signup-popup>Créer mon compte pro →</a><div class="kp-pro-contact"><a href="tel:0806110559">0806 110 559</a><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a></div></div><img src="/assets/img/editorial/thermicien-conseil.webp" alt="Échange téléphonique autour de plans" width="1200" height="675" loading="lazy" decoding="async"></div></section>
</div>