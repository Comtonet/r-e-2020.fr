<?php
$ecoPrice = price_ttc_label('price_eco_permis_ttc');
$permisPrice = price_ttc_label('price_pack_permis_ttc');
$finPrice = price_ttc_label('price_fin_travaux_ttc');
$finAcvPrice = price_ttc_label('price_fin_travaux_acv_ttc');
$extensionPrice = price_ttc_label('price_small_extension_attestation_ttc');
?>
<a class="skip-link" href="#contenu-maison">Aller au contenu</a>

<section class="house-hero" id="contenu-maison">
  <div class="container house-hero-grid">
    <div class="house-hero-copy">
      <div class="house-badge">RE2020 - Bureau d'études thermiques</div>
      <p class="eyebrow">Étude RE2020 livrée en <?= h(standard_delay_label()) ?></p>
      <h1>Votre attestation RE2020 prête pour la mairie dès demain.</h1>
      <p class="house-lead">Thermiciens qualifiés OPQIBI, assurance décennale, plus de 85 000 projets suivis. Vous déposez vos plans, on gère le calcul RE2020 et on vous délivre l’attestation Bbio PCMI 14.</p>
      <div class="house-actions">
        <a class="btn house-primary" href="https://espace-client.keeplanet.fr/">Je lance mon étude</a>
      </div>
      <p class="house-secure-note">Suivi dans votre espace client sécurisé (documents, messages, historique).</p>
    </div>
    <aside class="house-hero-offer">
      <div class="offer-kicker">Étude RE2020</div>
      <div class="offer-price">dès <?= h($ecoPrice) ?></div>
      <ul>
        <li>16 ans d’expérience</li>
        <li>Qualifié OPQIBI</li>
        <li>Assurance décennale</li>
        <li>Dossier conforme mairie</li>
      </ul>
      <a class="btn house-primary full" href="https://espace-client.keeplanet.fr/">Je lance mon étude</a>
    </aside>
  </div>
</section>

<section class="house-proofbar">
  <div class="container house-proof-grid">
    <div><strong>📄</strong><span>Attestation Bbio – PCMI 14 incluse</span></div>
    <div><strong>🔐</strong><span>Espace client sécurisé</span></div>
    <div><strong>👷</strong><span>Thermicien dédié</span></div>
    <div><strong>🏗</strong><span>Suivi jusqu’à la fin des travaux</span></div>
  </div>
</section>

<section class="house-section house-intro">
  <div class="container house-intro-grid">
    <div>
      <span class="eyebrow">Keeplanet</span>
      <h2>r-e-2020.fr est un service proposé par Keeplanet</h2>
    </div>
    <div>
      <p>Bureau d’études spécialisé depuis 2009 dans les études thermiques et l’accompagnement réglementaire RE2020.</p>
    </div>
  </div>
</section>

<section class="house-section house-packs-section">
  <div class="container">
    <div class="house-section-head">
      <span class="eyebrow">Des tarifs pensés pour chaque projet</span>
      <h2>Des tarifs pensés pour chaque projet</h2>
      <p>Nos packs sont conçus pour s’adapter à vos besoins et à l’avancement de votre projet. Les premiers packs « Permis » couvrent la phase du dépôt du permis de construire, jusqu’à l’obtention de l’attestation Bbio – PCMI 14.</p>
      <p>D’un point de vue réglementaire, l’étude complète reste indispensable : c’est le Pack « Fin de travaux ». Nous recommandons de l’effectuer dès le départ afin d’analyser la performance globale du bâtiment (chauffage, eau chaude, confort d’été…) et garantir la conformité finale.</p>
      <p>Vous pouvez à tout moment évoluer vers un pack supérieur, sans frais supplémentaires : seule la différence de tarif est à régler.</p>
    </div>

    <div class="house-intro-grid house-delay-block">
      <div>
        <span class="eyebrow">Des délais adaptés à vos impératifs</span>
        <h2>Des délais adaptés à vos impératifs</h2>
      </div>
      <div>
        <p>Nos délais actuels sont de <?= h(standard_delay_label()) ?> pour la réalisation de votre étude thermique RE2020. Chaque client dispose d’un espace en ligne sécurisé pour suivre l’avancement, échanger avec nos thermiciens et récupérer ses documents dès qu’ils sont disponibles.</p>
      </div>
    </div>

    <div class="house-section-head house-render-head">
      <span class="eyebrow">Exemples de rendu</span>
      <h2>Exemples de rendu</h2>
      <p>Récapitulatif standardisé • Synthèse simplifiée • Attestation pour le dépôt du permis</p>
    </div>

    <div class="house-section-head" id="packs">
      <span class="eyebrow">Nos packs disponibles</span>
      <h2>Nos packs disponibles</h2>
    </div>

    <div class="pack-family-head"><div><span>Packs Permis</span><h3>Packs Permis</h3></div></div>

    <div class="house-process compact-process">
      <div class="house-steps">
        <article><span>1</span><h3>Vous ouvrez votre dossier</h3><p>On crée votre espace sécurisé et on vous donne accès.</p></article>
        <article><span>2</span><h3>Vous déposez vos plans</h3><p>Plans, surfaces, orientation, systèmes envisagés.</p></article>
        <article><span>3</span><h3>Un thermicien prend en charge</h3><p>Calcul RE2020 (Bbio, CEP, ACV, confort d’été DH ...).</p></article>
        <article><span>4</span><h3>Vous récupérez vos documents</h3><p>Attestation pour le permis + synthèse claire des choix techniques.</p></article>
        <article><span>5</span><h3>Accompagnement jusqu’à la fin des travaux</h3><p>On reste là pour garantir la conformité finale RE2020.</p></article>
      </div>
    </div>

    <div class="pack-family-head complete"><div><span>CE QUE VOUS RECEVEZ</span><h3>Livrables fournis</h3></div></div>
    <div class="deliverable-list">
      <div><span>01</span><p><strong>Attestation RE2020 pour dépôt du permis (Bbio – PCMI 14)</strong></p></div>
      <div><span>02</span><p><strong>Synthèse simplifiée pour comprendre vos choix techniques</strong></p></div>
      <div><span>03</span><p><strong>Récapitulatif standardisé (chauffage, ECS, isolation, confort d’été…)</strong></p></div>
      <div><span>04</span><p><strong>Historique et messages avec le thermicien dans l’espace client</strong></p></div>
    </div>
    <p class="upgrade-note">Tous les documents restent disponibles en permanence dans votre espace.</p>

    <div class="qualification-card">
      <span class="eyebrow">Fiche de qualification professionnelle OPQIBI</span>
      <h2>Notre qualification OPQIBI (1331 & 1332)</h2>
    </div>

    <div class="pack-family-head" id="bbio"><div><span>Tarifs – Phase permis de construire</span><h3>Tarifs – Phase permis de construire</h3></div></div>
    <div class="house-copy-block">
      <p>Cette étude RE2020 permet d’obtenir l’attestation de prise en compte de la réglementation environnementale, nécessaire au dépôt de votre permis de construire.</p>
      <p>Vous pouvez choisir de ne réaliser que cette première étape, appelée pré-étude, correspondant à la phase « permis de construire ». Par la suite, vous pourrez facilement évoluer vers l’étude thermique complète directement depuis votre espace client, sans refaire de démarche.</p>
    </div>

    <div class="help-card">
      <h3>👋 Besoin d’aide ?</h3>
      <p>Si vous êtes un peu perdu, contactez-nous directement par téléphone ou via notre page de contact.</p>
      <p>Vous pouvez aussi découvrir, étape par étape, notre processus de réalisation.</p>
      <div class="house-actions"><a class="btn btn-ghost" href="/contact/">Nous contacter</a><a class="btn btn-ghost" href="/processus-de-realisation-dune-etude-re2020/">Voir le processus</a></div>
    </div>

    <div class="house-packs house-packs-permit">
      <article class="house-pack">
        <div class="pack-top"><h3>Pack Eco'Permis</h3><div class="pack-price"><?= h($ecoPrice) ?></div><div class="pack-delay">TTC</div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Etude thermique RE 2020</span></li>
          <li><b>✓</b><span>Calcul du Bbio et du DH</span></li>
          <li><b>✓</b><span>Délai de <?= h(eco_delay_label()) ?></span></li>
          <li><b>✓</b><span>Quelle que soit la surface</span></li>
          <li><b>✓</b><span>Etude garantie</span></li>
          <li><b>✓</b><span>RC Pro & décennale</span></li>
          <li><b>✓</b><span>Attestation du permis de construire<br>générée par vos soins avec nos fichiers</span></li>
          <li><b>✓</b><span>Modifications de votre étude<br>2 variantes - Pas de conseils du thermicien</span></li>
          <li><b>✓</b><span>Calcul ACV disponible en option</span></li>
        </ul>
        <a class="btn btn-ghost full" href="https://espace-client.keeplanet.fr/">Cliquer ici</a>
      </article>

      <article class="house-pack featured-pack">
        <div class="pack-top"><h3>Pack Permis</h3><div class="pack-price"><?= h($permisPrice) ?></div><div class="pack-delay">TTC</div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Etude thermique RE 2020</span></li>
          <li><b>✓</b><span>Calcul du Bbio et du DH</span></li>
          <li><b>✓</b><span>Délai de <?= h(standard_delay_label()) ?></span></li>
          <li><b>✓</b><span>Quelle que soit la surface</span></li>
          <li><b>✓</b><span>Etude garantie</span></li>
          <li><b>✓</b><span>RC Pro & décennale</span></li>
          <li><b>✓</b><span>Attestation du permis de construire<br>générée par nos services</span></li>
          <li><b>✓</b><span>Modifications de votre étude<br>gratuites et illimitées + conseils du thermicien</span></li>
          <li><b>✓</b><span>Calcul ACV disponible en option</span></li>
        </ul>
        <a class="btn house-primary full" href="https://espace-client.keeplanet.fr/">Cliquer ici</a>
      </article>
    </div>

    <div class="pack-family-head complete" id="fdc"><div><span>Prix – Étude thermique complète</span><h3>Prix – Étude thermique complète</h3></div></div>
    <div class="house-copy-block">
      <p>Ce pack inclut la pré-étude du premier pack, l’attestation pour le dépôt du permis de construire, ainsi que l’étude thermique complète nécessaire à la génération de votre attestation de fin de travaux.</p>
      <p>Le Pack Fin de Travaux + ACV comprend en plus l’analyse du cycle de vie (ACV), un coefficient désormais obligatoire dans la réglementation RE2020. Réaliser ce calcul dès le début permet d’assurer la conformité de votre projet et d’éviter toute mauvaise surprise ultérieure.</p>
      <p><strong>Nouveau !</strong> L’option dimensionnement pièce par pièce est désormais incluse gratuitement dans notre pack Fin de Travaux, ainsi que le carnet numérique du logement (valeur totale : 100 € TTC).</p>
    </div>

    <div class="help-card warning-card">
      <h3>Concernant l'attestation de fin de travaux</h3>
      <p>Nous ne réalisons pas l'attestation de fin de chantier afin de ne pas être juge et partie. Il faudra vous adresser à un diagnostiqueur DPE, un contrôleur technique ou un architecte. Ce dernier utilisera notre étude thermique afin de vérifier la cohérence entre celle-ci et la réalité du chantier pour vous délivrer l'attestation de fin de travaux.</p>
    </div>

    <div class="house-packs house-packs-complete">
      <article class="house-pack">
        <div class="pack-top"><h3>Pack Fin de travaux</h3><div class="pack-price"><?= h($finPrice) ?></div><div class="pack-delay">TTC</div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Etude thermique RE 2020</span></li>
          <li><b>✓</b><span>Calcul du Bbio, du Cep et du DH</span></li>
          <li><b>✓</b><span>Délai de <?= h(standard_delay_label()) ?></span></li>
          <li><b>✓</b><span>Quelle que soit la surface</span></li>
          <li><b>✓</b><span>Etude garantie</span></li>
          <li><b>✓</b><span>RC Pro & décennale - OPQIBI 1331 1332</span></li>
          <li><b>✓</b><span>Attestation du permis de construire<br>générée par nos services</span></li>
          <li><b>✓</b><span>Modifications de votre étude<br>gratuites et illimitées + conseils du thermicien</span></li>
          <li><b>✓</b><span>Calcul ACV disponible en option</span></li>
          <li><b>✓</b><span>Attestation de Fin de travaux<br>Remise des fichiers pour son édition par le contrôleur</span></li>
          <li><b>✓</b><span>Suivi estimatif des consommations<br>Compris</span></li>
          <li><b>✓</b><span>Carnet numérique Keep'Home<br>Offert (Val. 50€ TTC)</span></li>
          <li><b>✓</b><span>Dimensionnement de puissance de chauffage<br>Offert (Val. 50€ TTC)</span></li>
        </ul>
        <a class="btn btn-ghost full" href="https://espace-client.keeplanet.fr/">Cliquer ici</a>
      </article>

      <article class="house-pack featured-pack green-feature">
        <div class="pack-top"><h3>Pack Fin de travaux + ACV</h3><div class="pack-price"><?= h($finAcvPrice) ?></div><div class="pack-delay">TTC</div></div>
        <ul class="pack-list">
          <li><b>✓</b><span>Etude thermique RE 2020</span></li>
          <li><b>✓</b><span>Calcul du Bbio, du Cep et du DH</span></li>
          <li><b>✓</b><span>Délai de <?= h(standard_delay_label()) ?></span></li>
          <li><b>✓</b><span>Quelle que soit la surface</span></li>
          <li><b>✓</b><span>Etude garantie</span></li>
          <li><b>✓</b><span>RC Pro & décennale - OPQIBI 1331 1332</span></li>
          <li><b>✓</b><span>Attestation du permis de construire<br>générée par nos services</span></li>
          <li><b>✓</b><span>Modifications de votre étude<br>gratuites et illimitées + conseils du thermicien</span></li>
          <li><b>✓</b><span>Calcul ACV<br>Ic énergie et Ic bâtiment compris</span></li>
          <li><b>✓</b><span>Attestation de Fin de travaux<br>Remise des fichiers pour son édition par le contrôleur</span></li>
          <li><b>✓</b><span>Suivi estimatif des consommations<br>Compris</span></li>
          <li><b>✓</b><span>Carnet numérique Keep'Home<br>Offert (Val. 50€ TTC)</span></li>
          <li><b>✓</b><span>Dimensionnement de puissance de chauffage<br>Offert (Val. 50€ TTC)</span></li>
        </ul>
        <a class="btn house-primary full" href="https://espace-client.keeplanet.fr/">Cliquer ici</a>
      </article>
    </div>
  </div>
</section>

<section class="house-section">
  <div class="container extension-card">
    <div>
      <span class="eyebrow">Étude thermique complète + opérateur d’étanchéité</span>
      <h2>Étude thermique complète + opérateur d’étanchéité</h2>
      <p>Depuis votre espace client sécurisé, vous pouvez également bénéficier d’une mise en relation directe avec nos partenaires opérateurs d’étanchéité à l’air. Nous avons négocié pour vous des tarifs préférentiels afin de simplifier la réalisation de votre test final.</p>
      <p>Un seul interlocuteur, des partenaires fiables et des prix négociés : tout est centralisé dans votre espace client pour un gain de temps et de sérénité.</p>
    </div>
    <div class="extension-offer"><strong>Tout centralisé</strong><span>dans votre espace client</span></div>
  </div>
</section>

<section class="house-section house-reviews" id="extensions">
  <div class="container extension-card">
    <div>
      <span class="eyebrow">Extensions inférieures à 50 m² et petites constructions</span>
      <h2>Extensions inférieures à 50 m² et petites constructions</h2>
      <p>Pour vos projets d’extension ou de petite construction de moins de 50 m², aucune étude thermique n’est exigée par la réglementation. Vous pouvez donc générer gratuitement votre attestation de dépôt de permis de construire.</p>
      <p>Si vous préférez nous confier cette démarche, notre équipe peut s’en charger pour vous : une fois vos informations administratives saisies dans votre espace client, vous recevrez votre attestation par e-mail en moins de 2 heures ouvrées, pour seulement <?= h($extensionPrice) ?>.</p>
      <p>Inscrivez-vous gratuitement pour accéder à l’espace client et consulter l’ensemble de nos tarifs.</p>
    </div>
    <div class="extension-offer"><strong><?= h($extensionPrice) ?></strong><span>attestation gérée par notre équipe</span><small>moins de 2 heures ouvrées</small><a class="btn house-primary full" href="https://espace-client.keeplanet.fr/">Inscription gratuite</a></div>
  </div>
</section>

<section class="house-section">
  <div class="container faq-grid">
    <div>
      <span class="eyebrow">Vous hésitez encore ?</span>
      <h2>Vous hésitez encore ?</h2>
    </div>
    <div>
      <p>Aucune inquiétude : vous pouvez créer votre compte gratuitement sans sélectionner de pack immédiatement. Notre équipe vous contactera pour vous orienter vers la solution la plus adaptée à votre projet et conforme à la réglementation RE 2020.</p>
      <p>Un accompagnement personnalisé, sans engagement, pour avancer sereinement dans votre démarche.</p>
      <a class="btn house-primary" href="https://espace-client.keeplanet.fr/">Inscription gratuite</a>
    </div>
  </div>
</section>

<section class="house-final-cta">
  <div class="container final-cta-inner">
    <div>
      <span class="eyebrow light">A propos</span>
      <h2>Obtenez en quelques clics votre étude RE 2020 et votre attestation pour votre permis de construire.</h2>
      <p>Déjà plus de 89 000 projets étudiés et plus de 15 ans d’expérience.</p>
      <p>Site appartenant à la Société Keeplanet, bureau d’étude thermique en ligne.</p>
      <p>Avis clients Google - r-e-2020.fr</p>
    </div>
    <div class="house-contact-panel">
      <h3>Nous contacter</h3>
      <p><a href="tel:0806110559">0806 110 559</a></p>
      <p>Du lundi au vendredi<br>9h - 12h30 / 13h30 - 17h30</p>
      <p><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a></p>
      <p>Keeplanet<br>201, route d'Oberhausbergen<br>67200 - Strasbourg</p>
    </div>
  </div>
</section>

<section class="house-page-legal">
  <div class="container">Copyright © r-e-2020.fr – Un site du groupe Keeplanet – Tous droits réservés. <a href="/conditions-generales-de-vente/">Conditions générales de ventes</a> – <a href="/mentions-legales/">Mentions légales</a></div>
</section>

<div class="house-mobile-cta"><span>Étude RE2020 · dès <strong><?= h($ecoPrice) ?></strong></span><a href="https://espace-client.keeplanet.fr/">Je lance mon étude</a></div>
