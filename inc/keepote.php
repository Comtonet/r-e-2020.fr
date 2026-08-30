<?php
function keepote_block($context = 'general') {
    $texts = [
        'general' => [
            'title' => 'Besoin d’aide ? Demandez à KeePote.',
            'body' => 'KeePote est l’assistant Keeplanet entraîné sur la RE2020 et notre documentation validée. Il peut vous orienter, expliquer les notions réglementaires et vous aider à comprendre les différentes étapes de votre projet.',
        ],
        'tarifs' => [
            'title' => 'Vous hésitez entre plusieurs prestations ? Demandez à KeePote.',
            'body' => 'KeePote peut vous aider à comprendre les différences entre les packs, les livrables et les étapes de l’étude RE2020. Si votre situation nécessite un avis humain, notre équipe reste bien entendu disponible.',
        ],
        'suivi' => [
            'title' => 'KeePote vous accompagne aussi après la commande.',
            'body' => 'Dans votre espace client, KeePote pourra vous aider à comprendre un rapport, expliquer un indicateur comme le Bbio, le Cep ou le DH, résumer un document et vous guider dans le suivi de votre dossier. Nos thermiciens restent disponibles dès qu’une intervention humaine est nécessaire.',
        ],
        'livrables' => [
            'title' => 'Un rapport vous paraît trop technique ? Demandez à KeePote.',
            'body' => 'KeePote peut vous aider à lire vos documents RE2020, reformuler les résultats et expliquer les principaux indicateurs. Il complète l’accompagnement de Keeplanet ; il ne remplace pas votre thermicien.',
        ],
    ];
    $copy = $texts[$context] ?? $texts['general'];
    ob_start(); ?>
    <section class="keepote-block">
      <div class="container keepote-inner">
        <div class="keepote-visual"><img src="/assets/img/keepote-nu-assis-simple.webp?v=1" width="360" height="360" alt="KeePote assis, assistant Keeplanet" loading="lazy"></div>
        <div class="keepote-copy">
          <span class="eyebrow">KeePote · Assistant Keeplanet</span>
          <h2><?= h($copy['title']) ?></h2>
          <p><?= h($copy['body']) ?></p>
          <p class="keepote-human"><strong>Et si vous préférez parler à quelqu’un :</strong> l’équipe Keeplanet reste disponible par téléphone, message ou depuis votre espace client.</p>
        </div>
        <button class="btn keepote-open" type="button" data-keepote-open>Parler à KeePote</button>
      </div>
    </section>
    <?php return ob_get_clean();
}
