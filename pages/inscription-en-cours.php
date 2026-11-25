<?php
// Route publique commune ; les traitements et POST vers KeePlanet restent distincts.
if ($signupFlow === 'maison') {
    require __DIR__.'/inscription-maison-transit.php';
} elseif ($signupFlow === 'devis' || $signupFlow === 'general') {
    require __DIR__.'/devis-transit.php';
} elseif ($signupFlow === 'pro') {
    require __DIR__.'/inscription-pro-transit.php';
} else {
    ?>
    <section class="section"><div class="container narrow"><div class="card" style="text-align:center;max-width:720px;margin:40px auto;padding:34px">
      <h1>Inscription en cours</h1>
      <p>Aucune demande à transmettre. Pour continuer, choisissez votre prestation ou ouvrez votre espace client.</p>
      <p><a class="btn btn-p" href="/tarifs-etude-thermique-re-2020/" data-no-signup-popup>Voir nos prestations</a></p>
      <p><a href="https://espace-client.keeplanet.fr/" data-no-signup-popup>Accéder à mon espace client</a></p>
    </div></div></section>
    <?php
}
