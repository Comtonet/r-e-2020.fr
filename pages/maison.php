<?php
$ecoPrice = price_ttc_label('price_eco_permis_ttc');
$permisPrice = price_ttc_label('price_pack_permis_ttc');
$finPrice = price_ttc_label('price_fin_travaux_ttc');
$finAcvPrice = price_ttc_label('price_fin_travaux_acv_ttc');
$extensionPrice = price_ttc_label('price_small_extension_attestation_ttc');
?>
<section class="house-hero">
  <div class="container house-hero-grid">
    <div class="house-hero-copy">
      <div class="house-badge">Étude RE2020 · délai standard <?= h(standard_delay_label()) ?></div>
      <h1>Votre attestation RE2020 pour le permis, <span>sans perdre de temps.</span></h1>
      <p class="house-lead">Vous déposez vos plans en ligne. Les ingénieurs thermiques de <strong>Keeplanet à Strasbourg</strong> réalisent votre étude RE2020 et vous accompagnent jusqu’à l’obtention des documents nécessaires à votre permis de construire.</p>
      <div class="house-actions">
        <a class="btn house-primary" href="#packs">Voir les packs & tarifs</a>
        <a class="btn btn-ghost" href="https://espace-client.keeplanet.fr/">Créer mon dossier</a>
      </div>
      <div class="house-microtrust"><span>✓ Qualifié OPQIBI</span><span>✓ Assurance décennale</span><span>✓ Espace client sécurisé</span></div>
    </div>
    <aside class="house-hero-offer">
      <div class="offer-kicker">Étude RE2020 dès</div>
      <div class="offer-price"><?= h($ecoPrice) ?></div>
      <div class="offer-delay">Eco’Permis : <?= h(eco_delay_label()) ?></div>
      <ul>
        <li>Calcul Bbio + DH</li>
        <li>Quelle que soit la surface</li>
        <li>RC Pro & décennale</li>
        <li>2 variantes incluses</li>
      </ul>
      <a class="btn house-primary full" href="#packs">Choisir mon pack</a>
      <small>Besoin de conseils et de l’attestation générée par Keeplanet ? Le Pack Permis est fait pour vous.</small>
    </aside>
  </div>
</section>

<section class="house-proofbar">
  <div class="container house-proof-grid">
    <div><strong><?= h(projects_label()) ?>+</strong><span>projets étudiés</span></div>
    <div><strong><?= h(google_rating_label()) ?>/5</strong><span><?= h(google_reviews_label()) ?> avis Google</span></div>
    <div><strong>OPQIBI</strong><span>qualifications 1331 & 1332</span></div>
    <div><strong>Strasbourg</strong><span>ingénieurs thermiques Keeplanet</span></div>
  </div>
</section>

<section class="house-section house-intro">
  <div class="container house-intro-grid">
    <div>
      <span class="eyebrow">r-e-2020.fr · un service Keeplanet</span>
      <h2>Une étude thermique en ligne, réalisée par un vrai bureau d’études.</h2>
    </div>
    <div>
      <p>Keeplanet est un bureau d’études basé à Strasbourg, spécialisé dans la thermique du bâtiment et la réglementation environnementale. Le site r-e-2020.fr permet de lancer votre étude simplement, tout en conservant un accompagnement humain par nos équipes techniques.</p>
      <p><strong>Vous pouvez commencer par la phase permis puis évoluer vers un pack supérieur à tout moment :</strong> seule la différence de tarif est à régler.</p>
    </div>
  </div>
</section>

<section class="house-section house-packs-section" id="packs">
  <div class="container">
    <div class="house-section-head">
      <span class="eyebrow">Tarifs maison individuelle & extension</span>
      <h2>Choisissez le niveau d’accompagnement qui vous convient.</h2>
      <p>Deux formules pour le permis, puis deux formules complètes pour anticiper la conformité jusqu’à la fin du chantier.</p>
    </div>

    <div class="pack-family-head" id="bbio"><div><span>Phase permis de construire</span><h3>Obtenir votre attestation Bbio – PCMI 14</h3></div><p>Idéal pour déposer votre permis rapidement. Vous pourrez compléter l’étude plus tard si nécessaire.</p></div>
    <div class="house-packs house-packs-permit">
      <article class="house-pack">
        <div class="pack-top"><span class="pack-label">Essentiel</span><h3>Eco’Permis</h3><div class="pack-price"><?= h($ecoPrice) ?></div><div class="pack-delay"><?= h(eco_delay_label()) ?></div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Étude thermique RE2020 : <strong>Bbio + DH</strong></span></li>
          <li><b>✓</b><span>Quelle que soit la surface</span></li>
          <li><b>✓</b><span>RC Pro & assurance décennale</span></li>
          <li><b>✓</b><span>Fichiers permettant de générer votre attestation permis</span></li>
          <li><b>✓</b><span><strong>2 variantes</strong> de l’étude incluses</span></li>
          <li class="muted"><b>○</b><span>Pas de conseil thermicien inclus</span></li>
          <li class="muted"><b>○</b><span>ACV disponible en option</span></li>
        </ul>
        <a class="btn btn-ghost full" href="https://espace-client.keeplanet.fr/">Choisir Eco’Permis</a>
      </article>

      <article class="house-pack featured-pack">
        <div class="pack-ribbon">Le plus choisi pour le permis</div>
        <div class="pack-top"><span class="pack-label">Accompagné</span><h3>Pack Permis</h3><div class="pack-price"><?= h($permisPrice) ?></div><div class="pack-delay"><?= h(standard_delay_label()) ?></div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Étude thermique RE2020 : <strong>Bbio + DH</strong></span></li>
          <li><b>✓</b><span>Quelle que soit la surface</span></li>
          <li><b>✓</b><span>RC Pro & assurance décennale</span></li>
          <li><b>✓</b><span><strong>Attestation permis générée par Keeplanet</strong></span></li>
          <li><b>✓</b><span><strong>Modifications gratuites et illimitées</strong></span></li>
          <li><b>✓</b><span>Conseils de votre thermicien</span></li>
          <li class="muted"><b>○</b><span>ACV disponible en option</span></li>
        </ul>
        <a class="btn house-primary full" href="https://espace-client.keeplanet.fr/">Démarrer avec le Pack Permis</a>
      </article>
    </div>

    <div class="pack-family-head complete" id="fdc"><div><span>Étude thermique complète</span><h3>Anticiper la conformité jusqu’à la fin des travaux</h3></div><p>Nous recommandons de traiter l’étude complète dès le départ pour intégrer les systèmes, consommations, confort d’été et choix définitifs du projet.</p></div>
    <div class="house-packs house-packs-complete">
      <article class="house-pack">
        <div class="pack-top"><span class="pack-label">Complet</span><h3>Pack Fin de travaux</h3><div class="pack-price"><?= h($finPrice) ?></div><div class="pack-delay"><?= h(standard_delay_label()) ?></div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Étude complète : <strong>Bbio + Cep + DH</strong></span></li>
          <li><b>✓</b><span>Attestation permis générée par Keeplanet</span></li>
          <li><b>✓</b><span>Modifications illimitées + conseils thermicien</span></li>
          <li><b>✓</b><span>Fichiers pour l’attestation de fin de travaux</span></li>
          <li><b>✓</b><span>Suivi estimatif des consommations</span></li>
          <li><b>✓</b><span>Keep’Home offert <small>(val. <?= h(price_ttc_label('value_keephome_ttc')) ?>)</small></span></li>
          <li><b>✓</b><span>Dimensionnement chauffage offert <small>(val. <?= h(price_ttc_label('value_heating_sizing_ttc')) ?>)</small></span></li>
          <li class="muted"><b>○</b><span>ACV disponible en option</span></li>
        </ul>
        <a class="btn btn-ghost full" href="https://espace-client.keeplanet.fr/">Choisir le Pack Fin de travaux</a>
      </article>

      <article class="house-pack featured-pack green-feature">
        <div class="pack-ribbon">Le plus complet</div>
        <div class="pack-top"><span class="pack-label">Complet + carbone</span><h3>Fin de travaux + ACV</h3><div class="pack-price"><?= h($finAcvPrice) ?></div><div class="pack-delay"><?= h(standard_delay_label()) ?></div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Étude complète : <strong>Bbio + Cep + DH</strong></span></li>
          <li><b>✓</b><span><strong>ACV incluse : Ic énergie + Ic bâtiment</strong></span></li>
          <li><b>✓</b><span>Attestation permis générée par Keeplanet</span></li>
          <li><b>✓</b><span>Modifications illimitées + conseils thermicien</span></li>
          <li><b>✓</b><span>Fichiers pour l’attestation de fin de travaux</span></li>
          <li><b>✓</b><span>Suivi estimatif des consommations</span></li>
          <li><b>✓</b><span>Keep’Home offert <small>(val. <?= h(price_ttc_label('value_keephome_ttc')) ?>)</small></span></li>
          <li><b>✓</b><span>Dimensionnement chauffage offert <small>(val. <?= h(price_ttc_label('value_heating_sizing_ttc')) ?>)</small></span></li>
        </ul>
        <a class="btn house-primary full" href="https://espace-client.keeplanet.fr/">Choisir le Pack complet + ACV</a>
      </article>
    </div>
    <div class="upgrade-note"><strong>Vous changez d’avis plus tard ?</strong> Passez à un pack supérieur depuis votre espace client. Vous ne payez que la différence de tarif.</div>
  </div>
</section>

<section class="house-section house-deliverables">
  <div class="container deliverables-grid">
    <div>
      <span class="eyebrow">Concrètement</span>
      <h2>Ce que vous recevez.</h2>
      <p>Vos documents, messages et versions restent centralisés dans votre espace client sécurisé.</p>
      <div class="sample-links">
        <a href="https://espace-client.keeplanet.fr/exemple-recapitulatif-standardise-re2020.pdf" target="_blank" rel="noopener">Voir un récapitulatif standardisé ↗</a>
        <a href="https://espace-client.keeplanet.fr/exemple-synthese-simplifiee-re2020.pdf" target="_blank" rel="noopener">Voir une synthèse simplifiée ↗</a>
        <a href="https://espace-client.keeplanet.fr/exemple-attestation-re2020.pdf" target="_blank" rel="noopener">Voir une attestation permis ↗</a>
      </div>
    </div>
    <div class="deliverable-list">
      <div><span>01</span><p><strong>Attestation RE2020 pour le permis</strong><small>Bbio – PCMI 14 selon la formule choisie</small></p></div>
      <div><span>02</span><p><strong>Synthèse simplifiée</strong><small>Pour comprendre les choix techniques du projet</small></p></div>
      <div><span>03</span><p><strong>Récapitulatif standardisé</strong><small>Isolation, chauffage, ECS, confort d’été…</small></p></div>
      <div><span>04</span><p><strong>Historique du dossier</strong><small>Documents et échanges avec votre thermicien au même endroit</small></p></div>
    </div>
  </div>
</section>

<section class="house-section house-process">
  <div class="container">
    <div class="house-section-head"><span class="eyebrow">Simple & 100 % en ligne</span><h2>Votre étude démarre en quelques minutes.</h2></div>
    <div class="house-steps">
      <article><span>1</span><h3>Vous ouvrez votre dossier</h3><p>Création de votre espace client sécurisé.</p></article>
      <article><span>2</span><h3>Vous déposez vos plans</h3><p>Plans, surfaces, orientation et systèmes envisagés.</p></article>
      <article><span>3</span><h3>Un thermicien prend en charge</h3><p>Calcul RE2020 : Bbio, Cep selon pack, DH et ACV selon formule.</p></article>
      <article><span>4</span><h3>Vous récupérez vos documents</h3><p>Attestation permis et synthèses accessibles depuis votre espace.</p></article>
      <article><span>5</span><h3>Nous restons à vos côtés</h3><p>Évolutions et accompagnement jusqu’à la phase de fin de travaux selon votre pack.</p></article>
    </div>
    <div class="center-action"><a class="btn house-primary" href="https://espace-client.keeplanet.fr/">Créer mon dossier maintenant</a></div>
  </div>
</section>

<section class="house-section house-reviews">
  <div class="container">
    <div class="house-section-head"><span class="eyebrow">Ils travaillent avec Keeplanet</span><h2>La réactivité compte autant que le calcul.</h2><p>Note Google : <strong><?= h(google_rating_label()) ?>/5</strong> sur <strong><?= h(google_reviews_label()) ?> avis</strong>.</p></div>
    <div class="review-grid">
      <blockquote><div class="stars">★★★★★</div><p>« Une collaboration sur 346 projets à ce jour… Conseil, disponibilité, réactivité, tout est parfait. »</p><footer>Gael Pacalet</footer></blockquote>
      <blockquote><div class="stars">★★★★★</div><p>« Entreprise sérieuse et professionnelle, toujours disponible pour répondre à vos questions. »</p><footer>Stella MG</footer></blockquote>
      <blockquote><div class="stars">★★★★★</div><p>« Client depuis des années. C’est efficace et rapide. Continuez ainsi ! »</p><footer>Predrag TISIC · CTB67</footer></blockquote>
    </div>
  </div>
</section>

<section class="house-section house-extension" id="extensions">
  <div class="container extension-card">
    <div>
      <span class="eyebrow">Extension & petite construction</span>
      <h2>Projet de moins de 50 m² ?</h2>
      <p>Pour les extensions et petites constructions concernées par ce parcours simplifié, vous pouvez générer gratuitement votre attestation de dépôt de permis. Si vous préférez nous confier la démarche, Keeplanet peut l’établir après saisie de vos informations administratives.</p>
    </div>
    <div class="extension-offer"><strong><?= h($extensionPrice) ?></strong><span>attestation réalisée par Keeplanet</span><small>Délai : moins de <?= h(small_extension_delay_label()) ?></small><a class="btn house-primary" href="https://espace-client.keeplanet.fr/">Accéder à l’espace client</a></div>
  </div>
</section>

<section class="house-section house-faq">
  <div class="container faq-grid">
    <div><span class="eyebrow">Questions fréquentes</span><h2>Avant de commander.</h2><p>Vous hésitez ? Vous pouvez aussi créer votre compte sans sélectionner immédiatement un pack et demander à l’équipe Keeplanet de vous orienter.</p></div>
    <div class="faq-items">
      <details open><summary>Quel pack choisir pour mon permis ?</summary><p>Eco’Permis convient si vous souhaitez aller à l’essentiel et générer vous-même l’attestation à partir des fichiers fournis. Le Pack Permis ajoute l’attestation générée par Keeplanet, les modifications illimitées et les conseils du thermicien.</p></details>
      <details><summary>Puis-je compléter mon étude plus tard ?</summary><p>Oui. Vous pouvez évoluer vers un pack supérieur depuis votre espace client et ne régler que la différence de prix.</p></details>
      <details><summary>Qui réalise réellement l’étude ?</summary><p>r-e-2020.fr est un service de Keeplanet. Les études sont prises en charge par les équipes techniques du bureau d’études Keeplanet basé à Strasbourg.</p></details>
      <details><summary>Keeplanet délivre-t-il l’attestation de fin de travaux ?</summary><p>Non. Pour éviter d’être juge et partie, l’attestation finale doit être établie par un professionnel habilité (diagnostiqueur DPE, contrôleur technique ou architecte) à partir notamment de l’étude thermique réalisée par Keeplanet.</p></details>
    </div>
  </div>
</section>

<section class="house-final-cta">
  <div class="container final-cta-inner">
    <div><span class="eyebrow light">Votre permis peut avancer</span><h2>Déposez vos plans. Keeplanet s’occupe de l’étude RE2020.</h2><p>À partir de <?= h($ecoPrice) ?> · bureau d’études à Strasbourg · intervention partout en France.</p></div>
    <div class="house-actions"><a class="btn btn-white" href="#packs">Comparer les packs</a><a class="btn house-green" href="https://espace-client.keeplanet.fr/">Je lance mon étude</a></div>
  </div>
</section>

<div class="house-mobile-cta"><span>Étude RE2020 dès <strong><?= h($ecoPrice) ?></strong></span><a href="https://espace-client.keeplanet.fr/">Démarrer</a></div>
