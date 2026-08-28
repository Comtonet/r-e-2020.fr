<?php
/*
 * Corps éditoriaux des dossiers historiques repris depuis l'ancien r-e-2020.fr.
 * Les URLs et métadonnées restent gérées dans content/dossiers.php.
 */
return [
'fdes-donnees-environnementales-acv-carbone' => <<<'HTML'
<p>Derrière chaque calcul d'impact carbone RE2020, un document technique méconnu : la FDES. Sans elle, aucun matériau ne peut être évalué correctement dans l'Analyse de Cycle de Vie du bâtiment.</p>
<p>Savoir ce qu'est une FDES, comment la lire et comment elle s'articule avec les autres données environnementales est indispensable pour anticiper un calcul ACV et éviter les mauvaises surprises en cours de projet.</p>
<h2>1. Définition et rôle de la FDES</h2><h3>1.1 Une carte d'identité environnementale du matériau</h3><p>Une Fiche de Déclaration Environnementale et Sanitaire est un rapport normalisé conforme à la norme NF EN 15804+A2. Elle quantifie les impacts environnementaux et sanitaires d'un produit de construction sur l'ensemble de son cycle de vie.</p><h3>1.2 Le pilier de l'ACV dynamique</h3><p>Le moteur RE2020 compile les FDES du projet pour évaluer notamment l'indicateur IC Construction. Chaque fiche apporte une contribution chiffrée au bilan carbone global.</p><h3>1.3 La base INIES</h3><p>La base INIES centralise les FDES et PEP reconnues en France. Une donnée absente de cette base ne peut pas être utilisée comme une donnée environnementale réglementaire valide.</p>
<h2>2. Anatomie d'une FDES</h2><h3>2.1 L'Unité Fonctionnelle</h3><p>L'Unité Fonctionnelle constitue la référence de comparaison : par exemple 1 m² de cloison répondant à une performance donnée ou 1 m³ de béton. Comparer deux fiches n'a de sens que si leurs unités fonctionnelles sont comparables.</p><h3>2.2 La Durée de Vie Typique</h3><p>La DVT permet de déterminer combien de remplacements sont pris en compte sur la période de performance du bâtiment. Un produit à durée de vie courte peut ainsi être comptabilisé plusieurs fois.</p><h3>2.3 Les étapes du cycle de vie</h3><p>Une FDES détaille la production, le transport, la mise en œuvre, l'utilisation, la maintenance et la fin de vie du produit.</p>
<h2>3. FDES spécifique, collective et DED</h2><p>Une FDES spécifique fabricant reflète les performances réelles d'un produit. Une FDES collective décrit une moyenne de filière. À défaut de fiche adaptée, le calcul peut utiliser une Donnée Environnementale par Défaut, volontairement pénalisante.</p>
<h2>4. Impact sur l'étude et la fin de chantier</h2><p>Les références environnementales sont intégrées au calcul et assurent une traçabilité entre la conception et le contrôle final. Les matériaux relèvent des FDES ; les équipements électriques et CVC utilisent principalement des PEP Ecopassport.</p>
<h2>5. Une sélection précise des matériaux</h2><p>En RE2020, un matériau se choisit aussi pour sa donnée environnementale. Une mauvaise unité fonctionnelle ou un recours évitable à une DED peut faire grimper l'IC Construction. Keeplanet réalise cette sélection et cette optimisation dans le cadre de ses études RE2020 et ACV.</p>
HTML,
'pompe-a-chaleur-re2020-interdiction-effet-joule' => <<<'HTML'
<p>Le radiateur électrique classique n'est pas officiellement interdit par la RE2020. Dans les faits, il devient très difficile à valider sans compensation importante ailleurs dans le projet. La mécanique du Cep,nr favorise donc fortement les systèmes thermodynamiques.</p>
<h2>1. Le Cep,nr et l'effet Joule</h2><h3>1.1 Énergie finale et énergie primaire</h3><p>Le moteur Th-BCE raisonne en énergie primaire. Chaque kWh consommé au compteur est converti selon un coefficient propre à la source d'énergie.</p><h3>1.2 Le coefficient de 2,3</h3><p>Pour l'électricité, le coefficient de conversion est de 2,3. Avec un radiateur à effet Joule, 1 kWh de chaleur restituée correspond à 1 kWh d'électricité consommée : la consommation réglementaire grimpe donc rapidement.</p>
<h2>2. Pourquoi la pompe à chaleur change le calcul</h2><h3>2.1 Le COP</h3><p>Une pompe à chaleur prélève des calories dans l'environnement. Avec un COP de 4, elle peut restituer environ 4 kWh de chaleur pour 1 kWh d'électricité consommé.</p><h3>2.2 Impact sur Cep et Cep,nr</h3><p>Ce rendement réduit fortement la consommation d'énergie finale puis l'énergie primaire calculée, ce qui facilite le respect des seuils Cep et Cep,nr.</p><h3>2.3 Air-eau ou air-air</h3><p>La PAC air-eau associée à un réseau hydraulique offre un confort homogène. La PAC air-air est souvent moins coûteuse mais demande un arbitrage différent, notamment pour l'eau chaude sanitaire.</p>
<h2>3. Eau chaude sanitaire</h2><p>La production d'ECS peut être intégrée à la PAC double service ou confiée à un chauffe-eau thermodynamique séparé selon l'équilibre économique du projet.</p>
<h2>4. Points de vigilance</h2><p>Le dimensionnement doit être cohérent avec la zone climatique et l'enveloppe. Les références installées doivent rester cohérentes avec le dossier réglementaire et le contrôle final.</p>
<h2>5. Un choix à optimiser, pas à surdimensionner</h2><p>La PAC est un levier majeur de conformité mais elle doit être dimensionnée au juste besoin. Keeplanet arbitre enveloppe, systèmes et budget afin d'obtenir une solution conforme sans surcoût inutile.</p>
HTML,
'photovoltaique-re2020-impact-sur-le-bbio-et-lic-construction' => <<<'HTML'
<p>Des panneaux photovoltaïques pour compenser un bâti mal isolé ? C'est une confusion fréquente. Le photovoltaïque ne touche pas directement au Bbio ; il agit surtout sur les consommations, tout en ajoutant lui-même un impact carbone au bâtiment.</p>
<h2>1. Photovoltaïque et Bbio</h2><p>Le Bbio évalue la performance passive de l'enveloppe : isolation, compacité, orientation et vitrages. La production électrique ne modifie donc pas le Bbio. Seul un effet architectural indirect, comme un ombrage créé par les panneaux, peut influencer marginalement le comportement solaire.</p>
<h2>2. L'impact sur l'IC Construction</h2><p>Silicium, onduleur, câbles et structures de fixation ajoutent de la matière au bâtiment. Ces composants entrent dans l'ACV. L'utilisation de DED faute de fiche environnementale adaptée peut rendre ce lot inutilement pénalisant.</p>
<h2>3. La vraie valeur : Cep et Cep,nr</h2><p>L'électricité produite et autoconsommée sur site vient réduire les consommations prises en compte. La valorisation réglementaire est cependant encadrée : surdimensionner l'installation pour injecter massivement du surplus sur le réseau n'améliore pas indéfiniment le calcul.</p>
<h2>4. Faut-il le prévoir dès le permis ?</h2><p>Oui lorsqu'il fait partie de la stratégie énergétique du projet. Déclarer l'installation dès l'esquisse évite un écart entre le fichier réglementaire initial et le bâtiment livré.</p>
<h2>5. D'abord l'enveloppe, ensuite les équipements</h2><p>Le photovoltaïque complète une enveloppe déjà performante. Il ne doit pas être utilisé comme un joker pour compenser une mauvaise conception bioclimatique. Keeplanet équilibre les deux volets dans l'étude RE2020.</p>
HTML,
'sanctions-penalites-non-conformite-re2020' => <<<'HTML'
<p>Un permis refusé coûte du temps. Une attestation de fin de chantier bloquée peut coûter beaucoup plus. La non-conformité RE2020 n'a pas les mêmes conséquences selon qu'elle apparaît au permis, pendant les travaux ou à la livraison.</p>
<h2>1. Au permis de construire</h2><p>Sans attestation réglementaire conforme, le dossier peut rester incomplet et son instruction être retardée. Une reprise du calcul et parfois des ajustements architecturaux deviennent nécessaires.</p>
<h2>2. Pendant le chantier</h2><p>Les écarts les plus fréquents viennent de changements de matériaux, de systèmes ou de géométrie non reportés dans l'étude. Sur les opérations contrôlées, une mise en conformité peut devenir nécessaire avant de poursuivre.</p>
<h2>3. Le blocage de la DAACT</h2><p>Le contrôle final compare le bâtiment livré au dossier initial. Un écart significatif peut empêcher l'obtention de l'attestation finale et retarder la clôture administrative du chantier, voire certains déblocages financiers.</p>
<h2>4. Responsabilités et sanctions</h2><p>Une fausse déclaration ou une fraude caractérisée expose à des sanctions prévues par le Code de la construction. Un constructeur qui s'écarte volontairement du projet validé engage aussi sa responsabilité contractuelle.</p>
<h2>5. Prévenir plutôt que corriger</h2><p>Tout changement important en cours de chantier doit être répercuté dans l'étude. Keeplanet accompagne la cohérence entre le calcul initial, les choix d'exécution et la fin de chantier.</p>
HTML,
'difference-cep-cepnr-calcul-re2020' => <<<'HTML'
<p>La RT2012 utilisait principalement le Cep. La RE2020 ajoute le Cep,nr, qui isole la part d'énergie primaire non renouvelable. Un projet peut respecter le Cep global et échouer sur le Cep,nr.</p>
<h2>1. Énergie finale et énergie primaire</h2><p>L'énergie finale est celle consommée au compteur. L'énergie primaire remonte à l'énergie mobilisée avant transformation et transport. Le moteur réglementaire applique des coefficients de conversion, dont 2,3 pour l'électricité.</p>
<h2>2. Différence entre Cep et Cep,nr</h2><h3>2.1 Le Cep global</h3><p>Le Cep additionne l'énergie primaire nécessaire aux usages réglementaires du bâtiment.</p><h3>2.2 Le Cep,nr</h3><p>Le Cep,nr se concentre sur la part non renouvelable. Il devient donc déterminant lorsqu'un projet repose fortement sur une énergie fossile ou sur de l'électricité consommée directement.</p><h3>2.3 Biomasse</h3><p>La biomasse conserve un poids dans le Cep mais sa composante non renouvelable reste plus faible, ce qui explique son intérêt pour le Cep,nr.</p>
<h2>3. Effet Joule et gaz</h2><p>L'effet Joule direct consomme autant d'électricité que de chaleur délivrée et subit le coefficient d'énergie primaire. Le gaz fossile, lui, reste presque entièrement non renouvelable.</p>
<h2>4. Leviers d'optimisation</h2><p>Pompes à chaleur, chauffe-eau thermodynamiques, récupération d'énergie et conception performante réduisent les consommations nécessaires. Le fichier RSEE doit rester cohérent avec les équipements réellement installés.</p>
<h2>5. Concevoir avec une marge de sécurité</h2><p>Keeplanet recherche la combinaison énergétique qui permet de respecter simultanément Cep et Cep,nr au meilleur coût constructif.</p>
HTML,
'attestation-bbio-re2020-contenu-lien-bureau-etudes' => <<<'HTML'
<p>L'attestation Bbio RE2020 n'est pas un simple document administratif. Elle découle des calculs réalisés par le bureau d'études et accompagne le dépôt du permis de construire.</p>
<h2>1. Qu'est-ce que l'attestation Bbio ?</h2><p>Elle matérialise la prise en compte de la réglementation dès la conception. La RE2020 y ajoute notamment des informations liées au confort d'été et aux engagements environnementaux du projet.</p>
<h2>2. Que contient-elle ?</h2><p>Le document reprend des données administratives et géographiques, le résultat Bbio comparé au Bbiomax et différents critères réglementaires liés au projet.</p>
<h2>3. Le lien avec le bureau d'études</h2><p>Le fichier numérique RSEE produit à partir du calcul constitue le cœur technique du dossier. Il assure la traçabilité des données de l'enveloppe et des hypothèses réglementaires utilisées.</p>
<h2>4. Qui signe, qui calcule ?</h2><p>Le thermicien engage sa responsabilité professionnelle sur les calculs qu'il produit. La signature de l'attestation relève du maître d'ouvrage ou de son mandataire.</p>
<h2>5. Une chaîne de conformité jusqu'à la livraison</h2><p>Un dossier propre dès le permis facilite les mises à jour et le contrôle de fin de chantier. Keeplanet réalise le calcul, prépare les éléments réglementaires et accompagne les modifications nécessaires au cours du projet.</p>
HTML,
'qui-doit-signer-attestation-bbio-permis-construire' => <<<'HTML'
<p>Une confusion revient souvent au dépôt du permis : qui signe réellement l'attestation Bbio RE2020 ? Le thermicien produit le calcul et la preuve numérique ; l'engagement légal revient au maître d'ouvrage ou à son mandataire.</p>
<h2>1. Le bureau d'études ne signe pas l'attestation à votre place</h2><p>Le rôle du thermicien consiste à modéliser le bâtiment, calculer les indicateurs et produire le fichier réglementaire. L'attestation constitue une déclaration liée au projet et à son maître d'ouvrage.</p>
<h2>2. Le maître d'ouvrage porte l'engagement administratif</h2><p>Le propriétaire, le pétitionnaire ou son mandataire valide l'attestation générée pour le dépôt du permis. Le bureau d'études reste identifié dans les données techniques qui ont permis son édition.</p>
<h2>3. Une traçabilité numérique</h2><p>Le fichier RSEE conserve les caractéristiques prises en compte : géométrie, enveloppe, systèmes et résultats. Cette traçabilité est essentielle pour la suite du projet.</p>
<h2>4. Pourquoi cette répartition est importante</h2><p>Elle distingue clairement la responsabilité du calcul technique de l'engagement administratif du maître d'ouvrage. En cas de modification du projet, le calcul doit être actualisé avant de produire de nouveaux documents.</p>
<h2>5. Keeplanet prépare le dossier technique</h2><p>Nos thermiciens produisent le calcul et les éléments nécessaires à l'édition de l'attestation afin de sécuriser le dépôt du permis.</p>
HTML,
'permis-unique-division-logement-re2020' => <<<'HTML'
<p>Diviser une maison neuve en plusieurs appartements après un permis unique peut sembler simple. En pratique, la RE2020 suit la réalité du bâtiment et la configuration des logements jusqu'à la fin du chantier.</p>
<h2>1. Un permis unique ne simplifie pas automatiquement la conformité finale</h2><p>Un calcul réalisé sur une maison unique peut devenir incohérent si le projet est transformé ensuite en plusieurs unités de logement distinctes.</p>
<h2>2. Les conséquences thermiques d'une division</h2><p>La division modifie les zones, les usages, les distributions, les systèmes et parfois les exigences de ventilation ou de comptage. Ces changements doivent être intégrés au calcul réglementaire.</p>
<h2>3. Le risque se révèle souvent à la fin des travaux</h2><p>Lors du contrôle final, l'organisme vérifie le bâtiment réellement construit. Si la configuration ne correspond plus au fichier réglementaire, le dossier doit être repris avant l'attestation de fin de chantier.</p>
<h2>4. Anticiper avant de déposer</h2><p>Lorsque la division est prévue dès l'origine, elle doit être intégrée à la conception et au calcul. Cela évite de devoir reconstruire l'étude une fois les travaux avancés.</p>
<h2>5. Faire vérifier le montage</h2><p>Keeplanet peut analyser la configuration prévue et déterminer la modélisation réglementaire adaptée avant le dépôt ou avant une modification importante en cours de chantier.</p>
HTML,
'zones-climatiques-calcul-re2020' => <<<'HTML'
<p>La géographie influence directement les exigences RE2020. Le calcul tient compte de la zone climatique, de l'altitude et des données météorologiques de référence.</p>
<h2>1. Les zones climatiques</h2><p>La France est découpée en zones H1, H2 et H3 avec plusieurs sous-zones. Les fichiers météo RE2020 ont été actualisés pour mieux intégrer les épisodes de chaleur récents.</p>
<h2>2. Effet sur le Bbiomax</h2><p>Le Bbiomax est modulé par plusieurs coefficients, notamment la géographie, l'altitude et la surface. Une même maison n'a donc pas exactement le même seuil à Lille, Strasbourg ou Marseille.</p>
<h2>3. Le confort d'été</h2><p>Les Degrés-Heures deviennent particulièrement sensibles dans les zones chaudes. Protections solaires, inertie et orientation des baies jouent un rôle déterminant.</p>
<h2>4. Adapter enveloppe et équipements</h2><p>En climat froid, la réduction des déperditions domine. En climat chaud, le dosage des surfaces vitrées et les protections d'été prennent davantage de poids. Les équipements doivent eux aussi être dimensionnés selon ce profil climatique.</p>
<h2>5. Une simulation liée à l'adresse exacte</h2><p>La zone et l'altitude sont intégrées au moteur Th-BCE. Keeplanet modélise le projet à partir de sa localisation réelle afin de déterminer les exigences et solutions adaptées.</p>
HTML,
'calcul-degres-heures-dh-re2020' => <<<'HTML'
<p>La RE2020 remplace la logique de température intérieure conventionnelle de la RT2012 par l'indicateur Degrés-Heures, qui mesure la durée et l'intensité de l'inconfort d'été.</p>
<h2>1. Comment se calcule le DH ?</h2><p>Chaque heure de dépassement du seuil de confort ajoute des degrés-heures au score final. Par exemple, quatre heures à 30 °C pour un seuil de 28 °C représentent 8 DH.</p>
<h2>2. Les seuils</h2><p>Sous le seuil bas, le projet est considéré comme confortable sans pénalité. Dans la zone intermédiaire, le calcul applique une pénalisation liée à un besoin théorique de refroidissement. Au-delà du seuil haut, le projet n'est plus conforme.</p>
<h2>3. Ce qui fait grimper le DH</h2><p>Grandes baies mal protégées, faible inertie, orientation défavorable, protections solaires insuffisantes et mauvaise gestion de la ventilation nocturne sont des causes fréquentes.</p>
<h2>4. Les leviers de correction</h2><p>Brise-soleil, casquettes, volets, réduction ou déplacement de certaines baies, amélioration de l'inertie et travail sur la ventilation peuvent réduire fortement le score.</p>
<h2>5. Le traiter dès l'esquisse</h2><p>Le confort d'été est plus facile et moins coûteux à corriger avant le dépôt du permis. Keeplanet analyse le DH en même temps que le Bbio et les consommations.</p>
HTML,
'controle-fin-chantier-etancheite-air-re2020' => <<<'HTML'
<p>La conformité RE2020 ne s'arrête pas au permis. La fin de chantier comporte plusieurs vérifications portant sur la performance réelle du bâtiment et la cohérence avec l'étude initiale.</p>
<h2>1. Le test d'étanchéité à l'air</h2><p>Le test d'infiltrométrie mesure les fuites de l'enveloppe avec une porte soufflante. En maison individuelle, le seuil de référence reste notamment q4Pa-surf ≤ 0,60 m³/(h.m²).</p>
<h2>2. Le contrôle de ventilation</h2><p>La RE2020 renforce la vérification du système de ventilation, avec mesures de débits, pressions et examen du réseau selon le protocole applicable.</p>
<h2>3. La cohérence avec le RSEE</h2><p>Le contrôleur compare les isolants, menuiseries, systèmes de chauffage et autres éléments réellement posés avec ceux déclarés dans l'étude réglementaire.</p>
<h2>4. Pourquoi les changements de chantier doivent être remontés</h2><p>Une substitution de matériau ou d'équipement peut modifier le résultat. Mieux vaut mettre à jour l'étude pendant les travaux que découvrir l'écart au contrôle final.</p>
<h2>5. Préparer la réception</h2><p>Keeplanet accompagne la mise à jour de l'étude et la préparation des éléments nécessaires à la conformité finale.</p>
HTML,
'vmc-hygro-b-vs-double-flux-re2020' => <<<'HTML'
<p>VMC Hygro-B ou Double Flux : les deux systèmes répondent au même besoin de renouvellement d'air mais leur comportement dans le calcul RE2020 n'est pas identique à ce que l'on imagine.</p>
<h2>1. Deux philosophies techniques</h2><h3>Hygro-B</h3><p>La VMC Hygro-B extrait l'air des pièces humides et fait entrer l'air neuf par des entrées d'air passives. Les débits se modulent selon l'humidité.</p><h3>Double Flux</h3><p>La Double Flux utilise deux réseaux et un échangeur pour récupérer une partie de la chaleur de l'air extrait avant de souffler l'air neuf.</p>
<h2>2. Le choix de VMC ne corrige pas le Bbio comme un isolant</h2><p>Le Bbio évalue surtout le besoin du bâtiment et sa conception passive. La ventilation y est prise en compte selon des conventions de calcul qui ne transforment pas une Double Flux en solution miracle pour compenser une enveloppe médiocre.</p>
<h2>3. La différence se voit davantage sur les consommations</h2><p>La Double Flux récupère de la chaleur mais consomme aussi de l'électricité avec ses ventilateurs. L'Hygro-B est plus simple et moins énergivore en auxiliaires. Le résultat dépend donc des performances réelles des matériels.</p>
<h2>4. Coût, maintenance et usage</h2><p>La Double Flux implique davantage de gaines, filtres et entretien. L'Hygro-B reste plus simple et économique. Le choix doit être fait à l'échelle du projet.</p>
<h2>5. Comparer par le calcul</h2><p>Keeplanet peut tester les deux scénarios dans l'étude afin d'identifier le meilleur rapport conformité, confort et budget.</p>
HTML,
'acv-carbone-re2020-permis-construire' => <<<'HTML'
<p>L'Analyse de Cycle de Vie constitue l'un des changements majeurs de la RE2020 : le bâtiment est évalué non seulement sur ses consommations mais aussi sur l'impact des matériaux et équipements qui le composent.</p>
<h2>1. Comprendre l'ACV dynamique</h2><p>L'ACV additionne les impacts depuis l'extraction des matières premières jusqu'à la fin de vie. La méthode française applique une pondération temporelle : les émissions proches de la construction pèsent davantage que des émissions lointaines.</p>
<h2>2. Les données environnementales</h2><p>Les matériaux utilisent des FDES et les équipements des PEP. Lorsque les données spécifiques manquent, des données par défaut plus pénalisantes peuvent être appliquées.</p>
<h2>3. IC Construction et IC Énergie</h2><p>L'IC Construction mesure principalement l'empreinte des composants et du chantier. L'IC Énergie traduit l'impact carbone lié aux consommations d'énergie sur la durée de vie du bâtiment.</p>
<h2>4. Les principaux leviers</h2><p>Gros œuvre, isolation, structure, choix des fiches environnementales et précision des métrés concentrent une part importante des gains possibles.</p>
<h2>5. Une ACV à piloter jusqu'à la fin du chantier</h2><p>Le calcul doit rester cohérent avec les matériaux finalement posés. Keeplanet accompagne la conception et la mise à jour du volet carbone afin de sécuriser l'attestation finale.</p>
HTML,
'extension-re2020-seuils-surface' => <<<'HTML'
<p>Une extension ne relève pas automatiquement du même régime qu'une maison neuve. La surface créée détermine une grande partie des obligations à appliquer.</p>
<h2>1. Les principaux paliers de surface</h2><h3>Moins de 50 m²</h3><p>Les petites extensions relèvent généralement de règles allégées portant sur les performances des éléments mis en œuvre.</p><h3>Entre 50 et 80 m²</h3><p>Le projet entre dans une logique RE2020 simplifiée, avec notamment une exigence sur le besoin bioclimatique et une attestation au permis.</p><h3>Au-delà de 80 m²</h3><p>L'extension est traitée comme un projet soumis à la RE2020 complète avec l'ensemble des indicateurs applicables.</p>
<h2>2. Le Bbiomax des petites surfaces</h2><p>Le moteur module les exigences selon la taille du projet afin de tenir compte du rapport moins favorable entre enveloppe et volume sur les petits bâtiments.</p>
<h2>3. Chauffage et ventilation</h2><p>Le raccordement au système existant peut être possible mais son rendement est alors pris en compte. Le réseau de ventilation doit aussi être dimensionné pour les nouvelles pièces.</p>
<h2>4. Les pièges spécifiques</h2><p>La jonction ancien/neuf crée des ponts thermiques particuliers. Les extensions très vitrées peuvent également devenir difficiles à maîtriser en confort d'été.</p>
<h2>5. Qualifier le bon régime</h2><p>Keeplanet détermine les obligations du projet et réalise l'étude adaptée à la surface et à la configuration réelle de l'extension.</p>
HTML,
'compacite-bati-re2020' => <<<'HTML'
<p>La compacité mesure la quantité d'enveloppe nécessaire pour contenir un volume chauffé. Plus un bâtiment est compact, moins il présente de surface déperditive à surface habitable équivalente.</p>
<h2>1. Comprendre la compacité</h2><p>Un plan cubique ou à étage limite généralement les murs, toitures et planchers en contact avec l'extérieur. Un plan en L, très découpé ou très étalé multiplie les surfaces et les angles.</p>
<h2>2. Impact sur le Bbio</h2><p>Chaque mètre carré supplémentaire d'enveloppe est une surface de perte thermique supplémentaire. Une faible compacité fait donc grimper le besoin de chauffage et augmente aussi le nombre de ponts thermiques.</p>
<h2>3. Architecture et confort d'été</h2><p>La forme peut aussi créer des masques solaires ou au contraire des zones de surchauffe. L'orientation et les surfaces vitrées doivent être étudiées en même temps que la compacité.</p>
<h2>4. Optimiser dès l'esquisse</h2><p>Un R+1 est souvent plus compact qu'un plain-pied de même surface. Limiter les décrochements et sortir certains volumes non chauffés de l'enveloppe peut améliorer nettement le résultat.</p>
<h2>5. Éviter de compenser par des surcoûts</h2><p>Une mauvaise compacité se compense ensuite par davantage d'isolant, de vitrages performants ou de rupteurs. Keeplanet peut tester les variantes avant que le projet ne soit figé.</p>
HTML,
'evolution-seuils-acv-re2020' => <<<'HTML'
<p>Les seuils carbone de la RE2020 se durcissent progressivement. Cette trajectoire oblige à anticiper davantage les matériaux et les systèmes dès l'esquisse.</p>
<h2>1. Des seuils modulés</h2><p>IC Construction,max et IC Énergie,max varient selon le type de bâtiment, la surface et certaines caractéristiques du projet. Ils ne sont donc pas de simples valeurs identiques partout.</p>
<h2>2. La trajectoire de l'IC Construction</h2><p>Les paliers successifs poussent vers des bétons moins carbonés, des structures mixtes et un recours accru aux matériaux biosourcés. À chaque étape, les données environnementales par défaut deviennent plus difficiles à absorber.</p>
<h2>3. Le durcissement de l'IC Énergie</h2><p>La place des énergies fossiles se réduit fortement. Les pompes à chaleur, réseaux de chaleur performants et solutions biomasse deviennent des leviers importants selon les projets.</p>
<h2>4. Franchir les seuils sans explosion budgétaire</h2><p>Les gains les plus rentables se trouvent souvent dans le gros œuvre et l'isolation. Une saisie précise des quantités évite aussi de gonfler artificiellement le bilan carbone.</p>
<h2>5. Anticiper les futurs paliers</h2><p>Keeplanet modélise l'ACV dès l'avant-projet pour éviter qu'une solution à peine conforme aujourd'hui ne devienne trop fragile lors d'une évolution du projet.</p>
HTML,
'exemple-etude-thermique-re2020' => <<<'HTML'
<p>Une étude thermique RE2020 ne se limite pas à produire l'attestation du permis. Elle rassemble la géométrie du bâtiment, ses systèmes, les résultats énergétiques et son volet carbone.</p>
<h2>1. Le rapport réglementaire</h2><p>L'attestation Bbio résume la conformité pour le permis. Le rapport complet détaille les parois, les équipements et les résultats qui ont conduit à cette conformité.</p>
<h2>2. Les six indicateurs à lire</h2><p>Bbio, Cep, Cep,nr, DH, IC Construction et IC Énergie sont comparés à leurs seuils maximaux. Un rapport lisible permet de repérer immédiatement la marge de sécurité ou le point bloquant.</p>
<h2>3. Interpréter les résultats</h2><p>Le bilan Bbio aide à comprendre les déperditions et les apports solaires. Le Cep décompose les consommations par usage. Le DH indique le niveau de confort d'été.</p>
<h2>4. Les pièces administratives</h2><p>Le calcul sert à produire l'attestation de conception puis constitue la référence pour la mise à jour et la fin de chantier.</p>
<h2>5. Un outil pour optimiser le budget</h2><p>L'étude permet de choisir le bon levier : modifier une baie, renforcer une paroi, changer un système ou ajuster un matériau. Keeplanet fournit les documents réglementaires et les préconisations nécessaires à la conformité.</p>
HTML,
'calcul-surface-reference-thermique-srt' => <<<'HTML'
<p>Les surfaces réglementaires sont au cœur du calcul RE2020. Une erreur de quelques mètres carrés peut modifier les seuils applicables et fausser les résultats.</p>
<h2>1. De la SHONrt aux surfaces RE2020</h2><p>La RT2012 utilisait la SHONrt. La RE2020 s'appuie sur des surfaces de référence adaptées au type de bâtiment et à son usage.</p>
<h2>2. La surface de référence en résidentiel</h2><p>La surface utilisée par le moteur réglementaire n'est pas toujours exactement la surface habitable affichée dans les documents commerciaux ou fiscaux. Elle doit être déterminée selon les règles du calcul.</p>
<h2>3. Le tertiaire et la surface utile</h2><p>En tertiaire, la surface utile intervient dans les modulations et varie avec les catégories d'usage : bureaux, commerces, enseignement, etc.</p>
<h2>4. L'impact sur les seuils</h2><p>Le coefficient de modulation lié à la surface ajuste notamment le Bbiomax. Les petites surfaces disposent d'une modulation différente des grands bâtiments.</p>
<h2>5. Sécuriser les métrés</h2><p>Keeplanet vérifie les surfaces à partir des plans avant de lancer le calcul afin d'éviter qu'une simple erreur de géométrie ne bloque l'attestation.</p>
HTML,
'interdiction-effet-joule-re2020' => <<<'HTML'
<p>Le chauffage électrique direct n'est pas juridiquement interdit par la RE2020. Il est toutefois fortement pénalisé par les indicateurs de consommation et devient difficile à faire passer sur de nombreux projets.</p>
<h2>1. Pourquoi l'effet Joule pose problème</h2><p>Un radiateur électrique restitue environ 1 kWh de chaleur pour 1 kWh d'électricité consommé. Contrairement à une pompe à chaleur, il ne bénéficie pas d'un coefficient de performance supérieur à 1.</p>
<h2>2. Le coefficient d'énergie primaire</h2><p>Dans le calcul réglementaire, 1 kWh d'électricité finale est converti en 2,3 kWh d'énergie primaire. Cette conversion alourdit rapidement le Cep.</p>
<h2>3. Le Cep,nr renforce la contrainte</h2><p>La part non renouvelable de l'électricité pèse également dans le Cep,nr. Le chauffage direct peut donc échouer sur cet indicateur même avec une enveloppe correcte.</p>
<h2>4. Quelles alternatives ?</h2><p>Pompe à chaleur air-air ou air-eau, systèmes thermodynamiques pour l'ECS, biomasse et conception plus performante permettent de réduire les consommations.</p>
<h2>5. Tester avant de décider</h2><p>Il reste possible de vérifier un scénario effet Joule sur certains petits projets très performants. Keeplanet peut comparer les variantes avant le choix définitif du système.</p>
HTML,
'regle-un-sixieme-surface-vitree-re2020' => <<<'HTML'
<p>La surface des baies influence l'éclairage naturel, les apports solaires, les déperditions et le confort d'été. La règle dite des 1/6 constitue un repère majeur en maison individuelle.</p>
<h2>1. La règle des 1/6</h2><p>La surface totale des baies doit généralement atteindre au moins un sixième de la surface habitable, soit environ 16,7 %, sous réserve des cas particuliers prévus par la réglementation.</p>
<h2>2. Le facteur solaire Sw</h2><p>Le Sw mesure la part d'énergie solaire transmise à travers le vitrage. Un Sw élevé peut être favorable aux apports d'hiver mais devenir pénalisant l'été.</p>
<h2>3. Orientation et répartition</h2><p>Une baie au sud ne se comporte pas comme une baie à l'ouest. La répartition des surfaces vitrées doit donc être étudiée avec les masques, protections solaires et usages des pièces.</p>
<h2>4. Les protections solaires</h2><p>Volets, brise-soleil, casquettes et débords peuvent limiter les apports estivaux sans supprimer les bénéfices de la lumière naturelle.</p>
<h2>5. Un équilibre à trouver</h2><p>Ajouter du vitrage améliore certains apports mais augmente aussi les déperditions. Keeplanet recherche l'équilibre permettant de respecter Bbio et DH sans surdimensionner les menuiseries.</p>
HTML,
'prix-maison-re2020' => <<<'HTML'
<p>La RE2020 peut augmenter le coût de construction par rapport à la RT2012, mais le surcoût dépend fortement des choix de conception. Deux maisons de même surface peuvent afficher des écarts très différents selon la manière dont le projet est optimisé.</p>
<h2>1. Pourquoi la RE2020 coûte plus cher</h2><p>Le durcissement du Bbio pousse vers une meilleure enveloppe. Le confort d'été ajoute des besoins de protections solaires et parfois d'inertie. L'ACV carbone influence aussi le choix des matériaux.</p>
<h2>2. Les postes à surveiller</h2><p>Isolation, menuiseries, chauffage, eau chaude, ventilation et structure sont les principaux postes sur lesquels une mauvaise décision peut entraîner un surcoût important.</p>
<h2>3. Le piège du surdimensionnement</h2><p>Une non-conformité ne se corrige pas toujours en choisissant le produit le plus cher. Modifier l'orientation d'une baie, traiter un pont thermique ou sélectionner une fiche environnementale adaptée peut être plus rentable.</p>
<h2>4. Arbitrer par le calcul</h2><p>Le bon objectif n'est pas d'obtenir les performances maximales partout, mais d'atteindre les seuils avec une marge raisonnable au coût global le plus bas.</p>
<h2>5. L'étude thermique comme outil d'économie</h2><p>Keeplanet utilise le calcul pour identifier les leviers réellement utiles et éviter les dépenses qui n'améliorent pas la conformité du projet.</p>
HTML,
];
