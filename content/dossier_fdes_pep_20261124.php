<?php
/* Dossier du 24 novembre 2026. Contribution KeePlanet "Fiche_ACV_FDES_PEP_INIES.pdf" (Denis), vérifiée avec INIES et FAQ officielle RE2020. */
return ['verifier-fdes-pep-inies-acv-re2020-declaration-valide' => <<<'HTML'
<p><strong>Une fiche FDES ou PEP ne se choisit pas uniquement parce qu'elle affiche un bilan carbone favorable.</strong> Pour une ACV RE2020, il faut d'abord vérifier qu'elle représente réellement le produit prévu au chantier, que son périmètre et son unité correspondent au métré et que la donnée peut être utilisée dans le calcul. Ce travail est particulièrement utile entre l'esquisse, le dépôt du permis et la sélection définitive des entreprises.</p>
<p>Ce guide se concentre sur <strong>le choix et la vérification des données dans INIES</strong>. Pour l'interprétation des résultats du bâtiment et des contributeurs, consulter notre dossier <a href="/reglementaire/lire-rapport-acv-re2020-ic-construction-contributeurs/">comment lire un rapport ACV RE2020</a>.</p>
<h2>FDES, PEP et DED : trois types de données à ne pas confondre</h2>
<p><strong>La FDES</strong> (fiche de déclaration environnementale et sanitaire) documente les produits de construction et de décoration ; <strong>le PEP</strong> (profil environnemental produit) concerne les équipements, notamment électriques, électroniques et de génie climatique. Ces déclarations peuvent être individuelles, pour un produit ou une gamme définie, ou collectives, pour une famille de produits représentative.</p>
<p>Lorsqu'aucune donnée spécifique pertinente n'est disponible, le calcul peut devoir recourir à une <strong>DED</strong>, une donnée environnementale par défaut. INIES précise que ces données intègrent un coefficient de sécurité pour couvrir l'incertitude sur le produit réellement installé. Une DED n'est donc pas un renseignement environnemental mesuré sur votre référence commerciale.</p>
<p>Le réflexe à éviter : retenir automatiquement la fiche qui porte la valeur carbone la plus basse. Une donnée individuelle n'est pas nécessairement meilleure qu'une collective pour tout indicateur ; c'est d'abord <strong>la correspondance technique</strong> qui permet de défendre une sélection.</p>
<h2>Les six contrôles avant d'intégrer une fiche au calcul</h2>
<h3>1. Identifier exactement le produit ou le système prévu</h3>
<p>Noter fabricant, gamme, référence, famille, composition, puissance ou épaisseur, et les caractéristiques qui dimensionnent le produit. Pour un isolant, par exemple, comparer la nature du matériau et les dimensions couvertes ; pour un équipement, relever aussi les caractéristiques techniques réellement déclarées.</p>
<h3>2. Vérifier si la déclaration est individuelle ou collective</h3>
<p>Une FDES ou un PEP individuel porte sur le périmètre déclaré par son fabricant ; une donnée collective représente les produits couverts par une déclaration commune. Il faut lire le domaine d'application et non supposer qu'un intitulé proche suffit. Une fiche collective peut être adaptée si le produit choisi entre effectivement dans son champ.</p>
<h3>3. Contrôler l'unité fonctionnelle et les quantités</h3>
<p>L'ACV ne peut pas additionner correctement des données si les quantités sont incohérentes : m² de paroi, kg de matériau, unité d'équipement ou autre unité de référence. Vérifier les conversions, les performances déclarées et les éléments de calcul associés. Une fiche destinée à une configuration différente ne doit pas être transposée sans justification prévue par les règles.</p>
<h3>4. Vérifier le statut et la période de validité</h3>
<p>Consulter directement la fiche INIES, sa version et son statut. Une fiche archivée ou expirée ne doit pas être assimilée sans vérification à une fiche active : des règles particulières existent pour les ACV réalisées à différentes étapes. La <a href="https://rt-re-batiment.developpement-durable.gouv.fr/donnees-environnementales-fdes-pep-ded-lots-r357.html" target="_blank" rel="noopener">rubrique officielle des FAQ sur les données environnementales</a> permet notamment de retrouver les questions relatives aux données archivées.</p>
<h3>5. Contrôler les composants oubliés</h3>
<p>Au-delà des produits principaux, examiner les accessoires, revêtements, isolants complémentaires, systèmes techniques et remplacements à intégrer selon les règles de calcul. Une FDES sur un matériau ne couvre pas nécessairement tous les produits qui composent une solution constructive complète.</p>
<h3>6. Conserver la traçabilité des choix</h3>
<p>Archiver l'identifiant, la version et le périmètre de chaque fiche retenue, avec les quantités utilisées. Cette traçabilité simplifie les échanges entre thermicien, économiste, maître d'œuvre et entreprises, notamment si une référence change entre l'étude de conception et les travaux.</p>
<h2>Que faire si la référence choisie ne dispose pas de FDES ou de PEP ?</h2>
<p>Rechercher d'abord les déclarations spécifiques applicables dans la base, en vérifiant leur champ réel. Si aucune donnée spécifique ne correspond, utiliser la donnée réglementaire de substitution pertinente plutôt que d'inventer un équivalent flatteur. La <a href="https://rt-re-batiment.developpement-durable.gouv.fr/faq-re2020-088-peut-on-modifier-la-quantite-d-un-a709.html" target="_blank" rel="noopener">FAQ RE2020 n°088</a> précise certains cas d'utilisation d'une donnée majorante et les démarches lorsqu'une donnée par défaut adaptée manque.</p>
<p>Si le résultat <em>Ic construction</em> est proche du seuil, il est d'autant plus pertinent de regarder les composants à fort impact, les déclarations retenues et les alternatives réellement disponibles. Il ne s'agit pas de remplacer arbitrairement une DED pour gagner des points, mais de caractériser correctement le produit et, lorsque c'est encore possible, de choisir une solution documentée.</p>
<h2>À quel moment travailler les données environnementales ?</h2>
<ul>
<li><strong>Esquisse :</strong> repérer les principaux lots et tester les solutions structurantes (structure, isolation, systèmes), même lorsque les marques ne sont pas arrêtées.</li>
<li><strong>Avant dépôt du permis :</strong> stabiliser suffisamment les choix pour disposer d'un calcul cohérent avec le projet présenté.</li>
<li><strong>Consultation des entreprises :</strong> demander les références exactes et les justificatifs environnementaux, surtout sur les lots contributeurs.</li>
<li><strong>Fin de chantier :</strong> confronter les équipements et produits réellement posés aux hypothèses et conserver les documents de traçabilité nécessaires.</li>
</ul>
<p>Une ACV préparée tôt laisse une marge pour comparer les variantes. La repousser au moment de la réception peut transformer un écart documentaire en difficulté coûteuse. Pour comprendre la logique générale des déclarations, lire également <a href="/reglementaire/fdes-donnees-environnementales-acv-carbone/">notre introduction aux FDES et à l'ACV carbone</a>.</p>
<h2>Checklist avant validation de la donnée INIES</h2>
<ul>
<li>Le produit réel entre-t-il dans le périmètre déclaré ?</li>
<li>La déclaration est-elle individuelle, collective ou s'agit-il d'une DED ?</li>
<li>L'unité fonctionnelle et les quantités correspondent-elles au calcul ?</li>
<li>La version et le statut de la fiche sont-ils vérifiés ?</li>
<li>Les accessoires et composants non couverts sont-ils traités à part ?</li>
<li>Le choix est-il traçable jusqu'à la référence prévue puis posée ?</li>
</ul>
<p>Pour sécuriser le volet énergétique et environnemental d'un projet, KeePlanet réalise les <a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/">études RE2020 de maisons</a> ainsi que les <a href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/">études pour bâtiments collectifs et tertiaires</a>.</p>
<p><strong>Sources :</strong> fiche technique KeePlanet « Comprendre l'ACV et bien choisir ses données environnementales » ; <a href="https://www.inies.fr/qui-sommes-nous/nos-activites/" target="_blank" rel="noopener">INIES, présentation des données</a> ; <a href="https://www.inies.fr/ressources-faq/glossaire/" target="_blank" rel="noopener">INIES, glossaire FDES, PEP et DED</a> ; <a href="https://rt-re-batiment.developpement-durable.gouv.fr/donnees-environnementales-fdes-pep-ded-lots-r357.html" target="_blank" rel="noopener">portail officiel RE2020, FAQ données environnementales</a>.</p>
HTML
];