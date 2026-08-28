<?php
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function pages(){
return [
'/' => [
 'title'=>'Bureau d’étude thermique RE2020 | Attestation permis',
 'description'=>'Étude RE2020 et attestation pour permis de construire. Bureau d’études Keeplanet, qualifié OPQIBI, accompagnement partout en France.',
 'type'=>'home','h1'=>'Votre étude RE2020, claire, rapide et prête pour votre permis',
 'lead'=>'Maison, extension, collectif ou tertiaire : déposez vos pièces, nos thermiciens prennent le relais.',
],
'/tarifs-etude-thermique-re-2020/' => [
 'title'=>'Tarifs étude thermique RE2020 | Maison, collectif, tertiaire',
 'description'=>'Consultez les solutions Keeplanet pour votre étude thermique RE2020, votre attestation permis, une maison, une extension, un collectif ou un projet tertiaire.',
 'type'=>'tarifs','h1'=>'Choisissez le parcours adapté à votre projet','lead'=>'Des offres lisibles pour la maison individuelle et des études sur mesure pour le collectif et le tertiaire.'
],
'/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/' => [
 'title'=>'Étude RE2020 maison & extension | Tarifs et attestation permis',
 'description'=>'Étude thermique RE2020 pour maison individuelle ou extension, attestation permis, accompagnement par un thermicien et espace client sécurisé.',
 'type'=>'maison','h1'=>'Votre étude RE2020 pour maison ou extension','lead'=>'Un parcours conçu pour aller vite, avec un thermicien qui vous accompagne jusqu’à la conformité de votre projet.'
],
'/tarifs-etude-thermique-re-2020/collectif-tertiaire/' => [
 'title'=>'Étude RE2020 collectif & tertiaire | Devis Keeplanet',
 'description'=>'Études RE2020 sur mesure pour logements collectifs, bureaux, commerces, écoles, ERP et bâtiments tertiaires.',
 'type'=>'collectif','h1'=>'RE2020 collectif & tertiaire : une étude sur mesure','lead'=>'Bureaux, commerces, logements collectifs, écoles ou bâtiments complexes : échangez avec notre équipe pour cadrer votre besoin.'
],
'/processus-de-realisation/' => [
 'title'=>'Processus étude RE2020 | De la commande à l’attestation',
 'description'=>'Découvrez les étapes d’une étude RE2020 Keeplanet : choix de la prestation, dépôt des plans, étude thermique, échanges et attestation.',
 'type'=>'process','h1'=>'Votre étude RE2020 en 3 étapes simples','lead'=>'Vous envoyez vos documents, nous réalisons l’étude et vous suivez tout depuis votre espace client.'
],
'/dossiers/' => [
 'title'=>'Dossiers techniques RE2020 | Guides et réglementation',
 'description'=>'Guides techniques RE2020 : Bbio, Cep, DH, ACV, attestations, enveloppe, équipements et conformité réglementaire.',
 'type'=>'dossiers','h1'=>'Comprendre la RE2020 sans jargon inutile','lead'=>'Des dossiers techniques structurés, utiles aux particuliers comme aux professionnels.'
],
'/actualites/' => [
 'title'=>'Actualités RE2020 | Réglementation, moteur de calcul, INIES',
 'description'=>'Suivez les évolutions de la RE2020, des moteurs de calcul, de la base INIES et des règles qui impactent vos projets.',
 'type'=>'actualites','h1'=>'L’actualité RE2020 qui impacte vraiment vos projets','lead'=>'Nous décryptons les changements réglementaires et techniques avec un regard opérationnel.'
],
'/contact/' => [
 'title'=>'Contact Keeplanet | Thermiciens RE2020',
 'description'=>'Contactez Keeplanet pour votre étude thermique RE2020, votre attestation permis ou une question sur votre projet.',
 'type'=>'contact','h1'=>'Parlez-nous de votre projet','lead'=>'Une question technique ou commerciale ? Notre équipe vous répond rapidement.'
],
'/conditions-generales-de-vente/' => [
 'title'=>'Conditions générales de vente | r-e-2020.fr','description'=>'Conditions générales de vente du service r-e-2020.fr proposé par Keeplanet.','type'=>'legal','h1'=>'Conditions générales de vente','lead'=>'Version complète à migrer depuis le site actuel avant mise en production définitive.'
],
'/mentions-legales/' => [
 'title'=>'Mentions légales | r-e-2020.fr','description'=>'Mentions légales du site r-e-2020.fr proposé par Keeplanet.','type'=>'legal','h1'=>'Mentions légales','lead'=>'Les mentions complètes seront reprises et vérifiées avant la bascule en production.'
],
'/404/' => ['title'=>'Page introuvable | r-e-2020.fr','description'=>'La page demandée est introuvable.','type'=>'404','h1'=>'Cette page n’existe pas encore','lead'=>'Utilisez le menu ou revenez à l’accueil.']
];}
function get_page($path){ $p=pages(); return $p[$path] ?? null; }

function schema_for($page,$canonical){
 $base=['@context'=>'https://schema.org','@type'=>'WebPage','name'=>$page['title'],'description'=>$page['description'],'url'=>$canonical];
 if(($page['type']??'')==='home'){
   $base=['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'Organization','name'=>'Keeplanet','url'=>'https://r-e-2020.fr/','telephone'=>'0806110559','email'=>'info@keeplanet.fr','address'=>['@type'=>'PostalAddress','streetAddress'=>'201 route d’Oberhausbergen','postalCode'=>'67200','addressLocality'=>'Strasbourg','addressCountry'=>'FR']],
    ['@type'=>'WebSite','name'=>'r-e-2020.fr','url'=>'https://r-e-2020.fr/'],
    ['@type'=>'WebPage','name'=>$page['title'],'description'=>$page['description'],'url'=>$canonical]
   ]];
 }
 return $base;
}

function hero($page,$eyebrow='Bureau d’études thermiques RE2020'){
 ob_start(); ?>
<section class="hero"><div class="hero-glow"></div><div class="container hero-grid"><div class="hero-copy"><span class="eyebrow"><?=h($eyebrow)?></span><h1><?=h($page['h1'])?></h1><p class="hero-lead"><?=h($page['lead'])?></p><div class="hero-actions"><a class="btn" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Démarrer mon étude</a><a class="btn btn-ghost" href="/contact/">Parler à un thermicien</a></div><div class="trust-line"><span>★★★★★</span><strong>89 000+ projets étudiés</strong><span>·</span><strong>OPQIBI</strong><span>·</span><strong>Décennale</strong></div></div><div class="hero-card"><div class="mini-label">Votre parcours</div><div class="step-row"><b>01</b><span><strong>Choisissez</strong><small>la prestation adaptée</small></span></div><div class="step-row"><b>02</b><span><strong>Déposez</strong><small>vos plans en ligne</small></span></div><div class="step-row"><b>03</b><span><strong>Recevez</strong><small>votre étude et vos documents</small></span></div><a href="https://espace-client.keeplanet.fr/" class="card-link">Accéder à mon espace →</a></div></div></section>
<?php return ob_get_clean(); }

function render_page($page,$path){
 $t=$page['type']; ob_start();
 if($t==='home'){
 echo hero($page);
 ?>
<section class="metric-strip"><div class="container metrics"><div><strong>1 jour</strong><span>délai cible maison</span></div><div><strong>15+ ans</strong><span>d’expérience</span></div><div><strong>89 000+</strong><span>projets étudiés</span></div><div><strong>France</strong><span>accompagnement en ligne</span></div></div></section>
<section class="section"><div class="container"><div class="section-head"><span class="eyebrow">Votre besoin</span><h2>Un parcours clair, quel que soit votre projet</h2><p>Le nouveau r-e-2020.fr est pensé pour vous amener directement vers la bonne prestation, sans vous perdre dans la réglementation.</p></div><div class="cards three"><article class="card"><span class="card-kicker">Maison</span><h3>Construction neuve</h3><p>Étude RE2020, attestation permis et accompagnement jusqu’à la conformité.</p><a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Voir les solutions →</a></article><article class="card"><span class="card-kicker">Extension</span><h3>Agrandissement</h3><p>Identifiez rapidement les exigences applicables à votre projet et la prestation utile.</p><a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Étudier mon extension →</a></article><article class="card dark-card"><span class="card-kicker">Pro</span><h3>Collectif & tertiaire</h3><p>Une approche sur mesure pour les bâtiments complexes et les opérations professionnelles.</p><a href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Demander un devis →</a></article></div></div></section>
<section class="section soft"><div class="container split"><div><span class="eyebrow">Pourquoi Keeplanet</span><h2>De la technique, mais surtout des réponses concrètes</h2><p class="big-p">Notre rôle ne s’arrête pas au calcul : nous vous aidons à comprendre les arbitrages qui rendent votre projet conforme sans le surdimensionner inutilement.</p><a class="text-link" href="/processus-de-realisation/">Découvrir notre méthode →</a></div><div class="check-list"><div><b>✓</b><span><strong>Rapide</strong><small>un parcours 100 % en ligne</small></span></div><div><b>✓</b><span><strong>Lisible</strong><small>des livrables et étapes identifiés</small></span></div><div><b>✓</b><span><strong>Accompagné</strong><small>des thermiciens pour vos questions</small></span></div><div><b>✓</b><span><strong>Documenté</strong><small>des dossiers techniques et FAQ utiles</small></span></div></div></div></section>
<section class="section"><div class="container"><div class="section-head row-head"><div><span class="eyebrow">Conseils & expertise</span><h2>La RE2020 expliquée simplement</h2></div><a class="btn btn-ghost" href="/dossiers/">Voir tous les dossiers</a></div><div class="cards three"><article class="card article-card"><span class="pill">Dossier</span><h3>Bbio, Cep, DH : à quoi servent les indicateurs RE2020 ?</h3><p>Une lecture simple des principaux indicateurs réglementaires et de ce qu’ils changent dans votre projet.</p><a href="/dossiers/">Lire le dossier →</a></article><article class="card article-card"><span class="pill">Guide</span><h3>Attestation permis : quels documents préparer ?</h3><p>Les pièces utiles pour lancer votre étude dans de bonnes conditions et éviter les allers-retours.</p><a href="/dossiers/">Voir les guides →</a></article><article class="card article-card"><span class="pill">Actualité</span><h3>Évolutions réglementaires et moteur RE2020</h3><p>Suivez les changements qui peuvent avoir un impact concret sur les calculs et la conformité.</p><a href="/actualites/">Voir les actualités →</a></article></div></div></section>
<section class="cta-band"><div class="container cta-inner"><div><span class="eyebrow light">Votre projet peut avancer aujourd’hui</span><h2>Commencez par la bonne étude.</h2></div><a class="btn btn-white" href="/tarifs-etude-thermique-re-2020/">Voir les tarifs et prestations</a></div></section>
<?php
 } elseif($t==='tarifs'){
 echo hero($page,'Tarifs & prestations'); ?>
<section class="section"><div class="container"><div class="cards two"><article class="card pricing-choice"><span class="card-kicker">Particulier / Constructeur</span><h2>Maison individuelle & extension</h2><p>Des prestations packagées pour les projets de maison et d’agrandissement.</p><ul><li>Étude RE2020</li><li>Attestation permis selon formule</li><li>Espace client sécurisé</li><li>Accompagnement thermicien</li></ul><a class="btn" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">Voir les offres maison</a></article><article class="card pricing-choice dark-card"><span class="card-kicker">Professionnel</span><h2>Collectif & tertiaire</h2><p>Une étude sur mesure selon la typologie, l’usage et la complexité de l’opération.</p><ul><li>Collectif</li><li>Bureaux & commerces</li><li>Écoles & ERP</li><li>Projets complexes</li></ul><a class="btn btn-white" href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">Demander un devis</a></article></div></div></section><?php
 } elseif($t==='maison'){
 echo hero($page,'Maison individuelle & extensions'); ?>
<section class="section"><div class="container"><div class="section-head"><span class="eyebrow">V1 commerciale</span><h2>Des offres simples à comparer</h2><p>Les tarifs exacts et conditions de chaque pack seront migrés et validés depuis le site actuel avant la bascule.</p></div><div class="cards four"><article class="card price-card"><span class="pill">Permis</span><h3>Eco’Permis</h3><p>Pour aller à l’essentiel sur la phase permis.</p><a href="https://espace-client.keeplanet.fr/">Choisir cette formule →</a></article><article class="card price-card featured"><span class="pill">Recommandé</span><h3>Pack Permis</h3><p>Étude permis avec accompagnement et gestion simplifiée.</p><a href="https://espace-client.keeplanet.fr/">Démarrer →</a></article><article class="card price-card"><span class="pill">Complet</span><h3>Fin de travaux</h3><p>Pour préparer la suite du projet avec une étude complète.</p><a href="https://espace-client.keeplanet.fr/">Voir la formule →</a></article><article class="card price-card"><span class="pill">Carbone</span><h3>Fin de travaux + ACV</h3><p>Une approche complète intégrant l’analyse carbone.</p><a href="https://espace-client.keeplanet.fr/">Voir la formule →</a></article></div></div></section><?php
 } elseif($t==='collectif'){
 echo hero($page,'Collectif & tertiaire'); ?>
<section class="section"><div class="container split"><div><h2>Une étude adaptée à votre opération</h2><p class="big-p">La complexité d’un collectif ou d’un bâtiment tertiaire impose un cadrage technique avant chiffrage. Nous identifions avec vous le périmètre, les usages et les livrables attendus.</p><a class="btn" href="/contact/">Recevoir un devis</a></div><div class="cards-stack"><div class="mini-card"><strong>Logements collectifs</strong><span>Opérations neuves et programmes résidentiels</span></div><div class="mini-card"><strong>Bureaux & commerces</strong><span>Usages tertiaires et systèmes spécifiques</span></div><div class="mini-card"><strong>ERP & bâtiments complexes</strong><span>Écoles, hôtels, établissements et projets multi-usages</span></div></div></div></section><?php
 } elseif($t==='process'){
 echo hero($page,'Processus'); ?>
<section class="section"><div class="container timeline"><article><span>01</span><div><h2>Vous choisissez votre prestation</h2><p>Selon le type de bâtiment et le stade de votre projet.</p></div></article><article><span>02</span><div><h2>Vous déposez vos documents</h2><p>Plans et informations projet sont centralisés dans votre espace client.</p></div></article><article><span>03</span><div><h2>Nos thermiciens réalisent l’étude</h2><p>Vous suivez l’avancement et recevez vos livrables depuis le même espace.</p></div></article></div></section><?php
 } elseif(in_array($t,['dossiers','actualites'],true)){
 echo hero($page,$t==='dossiers'?'Dossiers techniques':'Actualités'); ?>
<section class="section"><div class="container"><div class="cards three"><article class="card article-card"><span class="pill"><?= $t==='dossiers'?'Guide':'Actualité' ?></span><h2>Premier contenu en préparation</h2><p>Cette V1 installe déjà la structure éditoriale. Les contenus historiques prioritaires seront ensuite migrés sans casser les URL SEO utiles.</p></article><article class="card article-card"><span class="pill">SEO</span><h2>Publication régulière</h2><p>Un article et un dossier tous les 4 jours en alternance, soit une publication tous les 2 jours.</p></article><article class="card article-card"><span class="pill">Maillage</span><h2>Des contenus reliés aux prestations</h2><p>Chaque contenu doit aider le lecteur et l’orienter vers le bon service lorsque c’est pertinent.</p></article></div></div></section><?php
 } elseif($t==='contact'){
 echo hero($page,'Contact'); ?>
<section class="section"><div class="container contact-grid"><div class="card"><h2>Téléphone</h2><a class="contact-big" href="tel:0806110559">0806 110 559</a><p>Du lundi au vendredi<br>9h–12h30 / 13h30–17h30</p></div><div class="card"><h2>Email</h2><a class="contact-big smaller" href="mailto:info@keeplanet.fr">info@keeplanet.fr</a><p>Pour une question sur votre étude ou votre projet.</p></div><div class="card"><h2>Adresse</h2><p class="contact-big smaller">Keeplanet<br>201 route d’Oberhausbergen<br>67200 Strasbourg</p></div></div></section><?php
 } elseif($t==='legal'){
 ?> <section class="section legal-page"><div class="container narrow"><span class="eyebrow">Informations légales</span><h1><?=h($page['h1'])?></h1><p class="big-p"><?=h($page['lead'])?></p><a class="btn btn-ghost" href="/contact/">Nous contacter</a></div></section><?php
 } else {
 ?> <section class="section"><div class="container narrow"><h1><?=h($page['h1'])?></h1><p class="big-p"><?=h($page['lead'])?></p><a class="btn" href="/">Retour à l’accueil</a></div></section><?php
 }
 return ob_get_clean();
}
