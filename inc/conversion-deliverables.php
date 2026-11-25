<section class="kp-cro-documents"><div class="container"><div class="kp-cro-section-head"><div><span class="eyebrow">Avant de commander</span><h2>Découvrez vos futurs documents.</h2><p>Consultez des exemples réels de livrables RE2020. Les documents remis dépendent du pack choisi.</p></div></div><div class="kp-cro-doc-grid">
<?php foreach([
 ['Attestation de dépôt du permis','Permis de construire','exemple-attestation-re2020.pdf'],
 ['Synthèse simplifiée','Résultats de l’étude','exemple-synthese-simplifiee-re2020.pdf'],
 ['Récapitulatif standardisé','Rapport réglementaire','exemple-recapitulatif-standardise-re2020.pdf']
] as $doc): ?>
<a class="kp-cro-doc" href="https://espace-client.keeplanet.fr/<?= h($doc[2]) ?>" target="_blank" rel="noopener" data-no-signup-popup data-cro-doc="<?= h($doc[2]) ?>"><span class="kp-cro-doc-icon" aria-hidden="true"><svg viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h12l6 6v20H7zM19 3v7h6M11 15h10m-10 5h10m-10 5h6"/></svg></span><span><small><?= h($doc[1]) ?></small><strong><?= h($doc[0]) ?></strong><span>Consulter le PDF ↗</span></span></a>
<?php endforeach; ?></div><a class="kp-cro-compare-link" href="/exemples-livrables-re2020/" data-no-signup-popup>En savoir plus sur les livrables →</a></div></section>