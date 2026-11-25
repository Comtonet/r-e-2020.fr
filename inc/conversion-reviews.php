<?php
$reviews = [
 ['name'=>'Guy Le Bihan','text'=>'Parfaite écoute, réponse rapide , très efficace. Pédagogue dans la norme.'],
 ['name'=>'VMA','text'=>"J'ai particulièrement apprécié le soutien téléphonique : lorsque nous appelons KeePlanet, on nous donne toutes les informations nécessaires au bon déroulé de notre projet, étape par étape (vma)"],
 ['name'=>'S LC','text'=>"Impeccable! Je travaille avec eux depuis 2012. Rien a dire, ils ont toujours été très pro et de très bon conseils (il arrive que finalement l'étude thermique ne soit pas nécessaire et dans ce cas ils vous préviennent). On ne change pas une équipe que gagne."]
];
?>
<section class="kp-cro-reviews"><div class="container">
 <div class="kp-cro-section-head"><div><span class="eyebrow">Avis clients</span><h2>Ils nous ont confié leur étude.</h2></div><div class="kp-cro-rating"><span aria-hidden="true">★★★★★</span><strong><?= h(google_rating_label()) ?>/5</strong><small><?= h(google_reviews_label()) ?> avis Google</small></div></div>
 <div class="kp-cro-review-grid"><?php foreach($reviews as $review): ?><figure class="kp-cro-review"><div class="kp-cro-review-stars" aria-label="5 étoiles sur 5">★★★★★</div><blockquote><?= h($review['text']) ?></blockquote><figcaption><strong><?= h($review['name']) ?></strong><small>Avis Google · 5/5</small></figcaption></figure><?php endforeach; ?></div>
 <p class="kp-cro-source">Sélection de trois avis Google communiqués par KeePlanet.</p>
</div></section>