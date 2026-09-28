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
 'title'=>'Conditions générales de vente | r-e-2020.fr','description'=>'Conditions générales de vente du service r-e-2020.fr proposé par Keeplanet.','type'=>'cgv','h1'=>'Conditions générales de vente (CGV)','lead'=>'Conditions applicables aux prestations de services fournies par Keeplanet.'
],
'/mentions-legales/' => [
 'title'=>'Mentions légales | r-e-2020.fr','description'=>'Mentions légales du site r-e-2020.fr proposé par Keeplanet.','type'=>'mentions','h1'=>'Mentions légales','lead'=>'Informations légales, conditions d’utilisation et politique de confidentialité de r-e-2020.fr.'
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
 } elseif($t==='cgv'){
 ?>
<section class="commercial-simple-hero"><div class="container"><div class="breadcrumbs"><a href="/">Accueil</a><span>›</span><span>CGV</span></div><span class="eyebrow">Informations légales</span><h1>Conditions générales de vente (CGV)</h1><p>Conditions applicables aux prestations de services fournies par Keeplanet.</p></div></section>
<section class="section legal-page"><div class="container narrow legal-content">
<h2>Article 1 – Champ d’application</h2>
<p>Les présentes Conditions Générales de Vente (ci-après « CGV ») s’appliquent, sans restriction ni réserve, à l’ensemble des prestations de services fournies par la société <strong>Keeplanet</strong>, SARL au capital social de 30 000 euros, dont le siège social est situé <strong>201 route d’Oberhausbergen – 67200 Strasbourg</strong>, immatriculée au Registre du Commerce et des Sociétés de Strasbourg sous le numéro <strong>515 123 800</strong>, TVA intracommunautaire <strong>FR04 515 123 800</strong>, ci-après dénommée « le Prestataire ».</p>
<p>Elles s’appliquent à toute commande passée par un client professionnel ou consommateur, quels que soient le site internet, la plateforme ou le canal de commercialisation utilisé par le Prestataire.</p>
<p>Toute commande implique l’acceptation pleine et entière des présentes CGV, à l’exclusion de tout autre document.</p>

<h2>Article 2 – Informations précontractuelles</h2>
<p>Le client reconnaît avoir pris connaissance, avant toute commande, des caractéristiques essentielles des prestations proposées, de leur prix, des délais de réalisation indicatifs et des modalités de paiement.</p>
<p>Le client est seul responsable de l’adéquation des prestations commandées à ses besoins.</p>

<h2>Article 3 – Commandes</h2>
<p>La commande est réputée ferme et définitive dès validation du paiement ou acceptation écrite du devis par tout moyen (signature électronique, email, validation en ligne).</p>
<p>Toute modification ou annulation demandée par le client après le démarrage de la prestation pourra entraîner une facturation complémentaire ou un refus de modification.</p>

<h2>Article 4 – Prix</h2>
<p>Les prix sont exprimés en euros, toutes taxes comprises (TTC), et sont ceux en vigueur au jour de la commande.</p>
<p>Le Prestataire se réserve le droit de modifier ses tarifs à tout moment, sans effet rétroactif sur les commandes déjà validées.</p>
<p>Pour nos packs RE2020, les tarifs sont indiqués pour une maison individuelle d’une surface habitable (d’un seul logement) maximale de 300 m², au-delà nous nous réservons le droit d’appliquer une majoration.</p>

<h2>Article 5 – Modalités de paiement</h2>
<p>Le paiement s’effectue selon les modalités proposées lors de la commande :</p>
<ul><li>carte bancaire,</li><li>virement bancaire,</li><li>chèque,</li><li>ou tout autre moyen proposé par le Prestataire.</li></ul>
<p>Sauf indication contraire, le paiement est exigible à la commande. En cas de paiement différé, le solde devra être réglé dans un délai maximal de <strong>30 jours</strong> à compter de la date de facturation.</p>

<h2>Article 6 – Retard de paiement</h2>
<p>Tout retard de paiement entraîne, de plein droit et sans mise en demeure préalable :</p>
<ul><li>l’application de pénalités de retard au taux légal majoré,</li><li>ainsi qu’une indemnité forfaitaire pour frais de recouvrement de <strong>40 €</strong>, conformément à l’article L.441-10 du Code de commerce.</li></ul>

<h2>Article 7 – Délais de réalisation</h2>
<p>Les délais de réalisation sont donnés à titre indicatif. Ils peuvent être suspendus ou prolongés en cas de :</p>
<ul><li>informations manquantes ou erronées transmises par le client,</li><li>retard de paiement,</li><li>force majeure ou événement indépendant de la volonté du Prestataire.</li></ul>
<p>Aucun retard ne pourra donner lieu à indemnisation ou annulation de commande.</p>

<h2>Article 8 – Obligations du client</h2>
<p>Le client s’engage à fournir des informations exactes, complètes et exploitables dans les délais demandés.</p>
<p>Le Prestataire ne saurait être tenu responsable des conséquences liées à des informations erronées, incomplètes ou transmises tardivement.</p>

<h2>Article 9 – Droit de rétractation</h2>
<p>Conformément aux articles L.221-18 et suivants du Code de la consommation, le client consommateur dispose d’un <strong>délai de rétractation de 14 jours</strong> à compter de la commande.</p>
<p>Toutefois, conformément à l’article L.221-28 du Code de la consommation, <strong>le client renonce expressément à son droit de rétractation</strong> lorsque l’exécution de la prestation commence avant la fin de ce délai, avec son accord.</p>

<h2>Article 10 – Responsabilité</h2>
<p>La responsabilité du Prestataire est strictement limitée au montant de la prestation commandée.</p>
<p>Le Prestataire ne saurait être tenu responsable des dommages indirects, pertes d’exploitation, pertes de données ou préjudices commerciaux.</p>

<h2>Article 11 – Propriété intellectuelle</h2>
<p>L’ensemble des livrables, méthodes, outils, documents et contenus produits par le Prestataire demeure sa propriété intellectuelle exclusive, sauf mention contraire expresse.</p>
<p>Toute reproduction ou exploitation non autorisée est interdite.</p>

<h2>Article 12 – Sécurité informatique</h2>
<p>Le Prestataire met en œuvre les moyens raisonnables pour sécuriser ses systèmes. Il ne saurait toutefois être tenu responsable en cas de piratage, virus ou intrusion résultant de facteurs extérieurs.</p>

<h2>Article 13 – Données personnelles</h2>
<p>Les données personnelles collectées sont utilisées uniquement pour la gestion des commandes, la relation client et les obligations légales.</p>
<p>Conformément à la réglementation en vigueur, le client dispose d’un droit d’accès, de rectification et de suppression de ses données en contactant : <a href="mailto:info@keeplanet.fr"><strong>info@keeplanet.fr</strong></a>.</p>

<h2>Article 14 – Facturation électronique</h2>
<p>Le client accepte expressément la réception des factures au format électronique (PDF), transmises par email ou via un espace client sécurisé.</p>

<h2>Article 15 – Médiation de la consommation</h2>
<p>Conformément aux articles L.611-1 et suivants du Code de la consommation, le client peut recourir gratuitement à un médiateur de la consommation après réclamation écrite restée sans solution.</p>
<p>Le médiateur désigné est :<br><strong>CM2C</strong><br>49 rue de Ponthieu – 75008 Paris<br>Tél. 01 89 47 00 14<br><a href="https://www.cm2c.net/declarer-un-litige.php" target="_blank" rel="noopener">Déclarer un litige auprès de CM2C</a><br><a href="mailto:litiges@cm2c.net">litiges@cm2c.net</a></p>

<h2>Article 16 – Opposition au démarchage téléphonique (Bloctel)</h2>
<p>Conformément à l’article L.223-2 du Code de la consommation, le consommateur peut s’inscrire gratuitement sur la liste d’opposition au démarchage téléphonique <strong>Bloctel</strong> : <a href="https://www.bloctel.gouv.fr" target="_blank" rel="noopener">bloctel.gouv.fr</a>.</p>

<h2>Article 17 – Droit applicable – Litiges</h2>
<p>Les présentes CGV sont soumises au droit français.</p>
<p>En cas de litige, une solution amiable sera recherchée en priorité. À défaut, les tribunaux compétents seront ceux du ressort du siège social du Prestataire.</p>

<div class="legal-update"><strong>CGV mises à jour le : 31/03/2026</strong></div>
</div></section><?php
 } elseif($t==='mentions'){
 ?>
<section class="commercial-simple-hero"><div class="container"><div class="breadcrumbs"><a href="/">Accueil</a><span>›</span><span>Mentions légales</span></div><span class="eyebrow">Informations légales</span><h1>Mentions légales</h1><p>Informations légales, conditions d’utilisation et politique de confidentialité de r-e-2020.fr.</p></div></section>
<section class="section legal-page"><div class="container narrow legal-content">
<h2>I. Site</h2><p>Le site r-e-2020.fr est édité pour la société <strong>KEEPLANET</strong>.<br>N° SIREN : <strong>515 123 800</strong><br>201 route d’Oberhausbergen – 67200 Strasbourg<br><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a> · <a href="tel:0806110559">0806 110 559</a></p>
<h2>II. Créateur du site</h2><p><strong>Keeplanet SARL</strong></p>
<h2>III. Hébergeur du site</h2><p><strong>OVH</strong>, société au capital de 10 059 500 €, située 2 rue Kellermann, BP 80157, 59053 Roubaix Cedex 1.</p>

<h2>Politique de confidentialité</h2>
<h3>Définitions</h3>
<p><strong>Client :</strong> tout professionnel ou personne physique capable au sens des articles 1123 et suivants du Code civil, ou personne morale, qui visite le Site.</p>
<p><strong>Prestations et Services :</strong> les prestations et services mis à disposition des Clients par le Site.</p>
<p><strong>Contenu :</strong> ensemble des éléments constituant l’information présente sur le Site, notamment textes, images et vidéos.</p>
<p><strong>Informations clients :</strong> ensemble des données personnelles susceptibles d’être détenues par le Site pour la gestion du compte, de la relation client et à des fins d’analyses et de statistiques.</p>
<p><strong>Utilisateur :</strong> internaute se connectant et utilisant le Site.</p>
<p><strong>Informations personnelles :</strong> informations permettant, directement ou indirectement, l’identification des personnes physiques auxquelles elles s’appliquent. Les termes « données à caractère personnel », « personne concernée », « sous-traitant » et « données sensibles » ont le sens défini par le RGPD (UE 2016/679).</p>

<h2>1. Présentation du site internet</h2>
<p>En vertu de l’article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique, les présentes mentions précisent aux utilisateurs l’identité des différents intervenants dans le cadre de la réalisation et du suivi du Site.</p>

<h2>2. Conditions générales d’utilisation du site et des services proposés</h2>
<p>Le Site constitue une œuvre de l’esprit protégée par les dispositions du Code de la propriété intellectuelle et les réglementations internationales applicables. Le Client ne peut réutiliser, céder ou exploiter pour son propre compte tout ou partie des éléments ou travaux du Site sans autorisation.</p>
<p>L’utilisation du Site implique l’acceptation pleine et entière des présentes conditions d’utilisation. Elles peuvent être modifiées ou complétées à tout moment ; les utilisateurs sont donc invités à les consulter régulièrement.</p>
<p>Le Site est normalement accessible à tout moment. Une interruption pour maintenance technique peut toutefois être décidée. Le Site et les présentes mentions légales peuvent être mis à jour à tout moment.</p>

<h2>3. Description des services fournis</h2>
<p>Le Site a pour objet de fournir une information concernant l’ensemble des activités de la société. Malgré le soin apporté à son contenu, il ne pourra être tenu responsable des oublis, inexactitudes ou carences de mise à jour, qu’elles soient de son fait ou de celui de tiers partenaires.</p>
<p>Les informations publiées sont données à titre indicatif, sont susceptibles d’évoluer et ne sont pas exhaustives.</p>

<h2>4. Limitations contractuelles sur les données techniques</h2>
<p>Le Site utilise notamment la technologie JavaScript. Il ne pourra être tenu responsable de dommages matériels liés à son utilisation. L’utilisateur s’engage à accéder au Site avec un matériel récent, exempt de virus et un navigateur à jour.</p>
<p>Le Site est hébergé chez un prestataire situé sur le territoire de l’Union européenne. L’hébergeur assure la continuité de son service mais peut l’interrompre notamment pour maintenance, amélioration de ses infrastructures, défaillance ou trafic anormal. Le Site et l’hébergeur ne peuvent être tenus responsables des dysfonctionnements du réseau Internet ou des équipements empêchant l’accès au serveur.</p>

<h2>5. Propriété intellectuelle et contrefaçons</h2>
<p>Le Site détient les droits de propriété intellectuelle ou les droits d’usage sur les éléments accessibles sur le Site, notamment les textes, images, graphismes, logos, vidéos, icônes et sons. Toute reproduction, représentation, modification, publication ou adaptation de tout ou partie de ces éléments est interdite sans autorisation écrite préalable.</p>
<p>Toute exploitation non autorisée pourra être considérée comme constitutive d’une contrefaçon conformément aux articles L.335-2 et suivants du Code de la propriété intellectuelle.</p>

<h2>6. Limitations de responsabilité</h2>
<p>Le Site ne pourra être tenu responsable des dommages directs ou indirects causés au matériel de l’utilisateur lors de l’accès au Site, notamment en cas d’utilisation d’un matériel inadapté, d’un bug ou d’une incompatibilité.</p>
<p>Le Site ne pourra également être tenu responsable des dommages indirects consécutifs à son utilisation. Dans les espaces interactifs, le Site se réserve le droit de supprimer tout contenu contraire à la législation applicable et, le cas échéant, de mettre en cause la responsabilité civile et/ou pénale de son auteur.</p>

<h2>7. Gestion des données personnelles</h2>
<p>Le Client est informé de la réglementation applicable en matière de données personnelles, notamment la loi Informatique et Libertés et le Règlement Général sur la Protection des Données (RGPD : UE 2016/679).</p>
<h3>7.1 Responsable de la collecte</h3>
<p>Pour les données collectées lors de la création d’un compte ou de la navigation sur le Site, le responsable du traitement est <strong>Keeplanet SARL</strong>. Keeplanet s’engage à respecter le cadre légal applicable, à définir les finalités des traitements, à informer les personnes concernées et à maintenir un registre des traitements conforme à la réalité.</p>
<h3>7.2 Finalités des données collectées</h3>
<p>Le Site est susceptible de traiter les données nécessaires pour :</p>
<ul><li>permettre la navigation, la gestion et la traçabilité des prestations et services commandés, notamment les données de connexion, facturation et historique des commandes ;</li><li>prévenir et lutter contre la fraude informatique ;</li><li>améliorer la navigation et l’expérience utilisateur ;</li><li>mener des enquêtes de satisfaction facultatives ;</li><li>mener des campagnes de communication par e-mail ou SMS lorsque cela est permis.</li></ul>
<p>Le Site ne commercialise pas les données personnelles de ses utilisateurs.</p>
<h3>7.3 Droits des utilisateurs</h3>
<p>Conformément à la réglementation européenne, les utilisateurs disposent notamment des droits d’accès, de rectification, d’effacement, de retrait du consentement, de limitation, d’opposition et, lorsque les conditions sont réunies, de portabilité de leurs données.</p>
<p>Pour exercer ces droits ou obtenir des informations sur l’utilisation de ses données, l’Utilisateur peut écrire à <a href="mailto:info@keeplanet.fr"><strong>info@keeplanet.fr</strong></a> ou à Keeplanet, 201 route d’Oberhausbergen, 67200 Strasbourg. Les demandes restent soumises aux obligations légales de conservation et d’archivage. L’utilisateur peut également adresser une réclamation à la CNIL.</p>
<h3>7.4 Non-communication des données personnelles</h3>
<p>Le Site prend les précautions nécessaires pour préserver la sécurité des informations et éviter leur communication à des personnes non autorisées. Les sous-traitants techniques et commerciaux sont choisis sous réserve de garanties suffisantes au regard du RGPD. En cas d’incident affectant l’intégrité ou la confidentialité des informations, les mesures requises seront prises conformément aux obligations applicables.</p>
<h3>7.5 Types de données collectées</h3>
<p>Dans le cadre du fonctionnement du service, le Site peut notamment collecter le nom, le numéro de téléphone, l’adresse e-mail ainsi que les données nécessaires à la gestion du compte et des prestations. Des données de navigation et de mesure d’audience peuvent également être collectées selon les choix de consentement de l’utilisateur.</p>

<h2>8. Notification d’incident et sécurité</h2>
<p>Aucune méthode de transmission sur Internet ou de stockage électronique ne peut garantir une sécurité absolue. Si une violation de sécurité nécessitant une information des personnes concernées était constatée, Keeplanet appliquerait les procédures de notification prévues par la réglementation.</p>
<p>Aucune information personnelle n’est publiée à l’insu de l’utilisateur, échangée, cédée ou vendue à des tiers. Le Site met en œuvre des mesures techniques et organisationnelles raisonnables visant à protéger les données contre la perte, l’utilisation détournée, l’accès non autorisé, la divulgation, l’altération ou la destruction.</p>

<h2>9. Cookies et balises internet</h2>
<h3>9.1 Cookies</h3>
<p>Un cookie est un petit fichier d’information enregistré sur le terminal de l’Utilisateur. Le Site peut utiliser des cookies ou technologies similaires afin d’assurer son fonctionnement, mémoriser certains choix, mesurer l’audience et améliorer le contenu et la navigation.</p>
<p>Lorsque le consentement est requis, les cookies concernés ne sont déposés qu’après le choix de l’utilisateur. Celui-ci peut accepter, refuser ou modifier ses préférences. Le refus de certains cookies peut limiter certaines fonctionnalités du Site.</p>
<h3>9.2 Balises (« tags ») internet</h3>
<p>Le Site peut employer des balises ou technologies similaires pour mesurer l’utilisation du Site et l’efficacité de certaines actions. Lorsque ces technologies impliquent un traitement soumis au consentement, elles sont utilisées conformément aux choix exprimés par l’Utilisateur.</p>

<div class="legal-update"><strong>Keeplanet · 201 route d’Oberhausbergen · 67200 Strasbourg</strong><br>0806 110 559 · <a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a></div>
</div></section><?php
 } elseif($t==='legal'){
 ?> <section class="section legal-page"><div class="container narrow"><span class="eyebrow">Informations légales</span><h1><?=h($page['h1'])?></h1><p class="big-p"><?=h($page['lead'])?></p><a class="btn btn-ghost" href="/contact/">Nous contacter</a></div></section><?php
 } else {
 ?> <section class="section"><div class="container narrow"><h1><?=h($page['h1'])?></h1><p class="big-p"><?=h($page['lead'])?></p><a class="btn" href="/">Retour à l’accueil</a></div></section><?php
 }
 return ob_get_clean();
}
