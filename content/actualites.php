<?php
/*
 * Registre des actualités RE2020.
 * Les contenus de type « Actualité » sont gérés ici et affichés sur /actualites/.
 * Règle éditoriale : alternance dossier / actualité tous les 3 jours.
 * Sources : privilégier les sources officielles (RT-RE Bâtiment, Legifrance, CSTB, ADEME), puis la presse BTP reconnue pour le contexte.
 */
$legacy = require __DIR__ . '/actualites-archive.php';
$new = [
    [
        'slug' => 'fin-gaz-construction-neuve-2027-decret-2026-863',
        'title' => 'Fin du gaz dans la construction neuve : ce que change le décret n° 2026-863 dès 2027',
        'excerpt' => 'Le décret n° 2026-863 du 12 septembre 2026 encadre l’installation d’équipements fortement émetteurs dans les bâtiments neufs. Logements, bâtiments publics, tertiaire : calendrier, seuil de 79 gCO2e/kWh et exemptions à connaître.',
        'date' => '2026-09-16',
        'source_name' => 'RT-RE Bâtiment — Fin du gaz dans la construction neuve',
        'source_url' => 'https://rt-re-batiment.developpement-durable.gouv.fr/fin-du-gaz-dans-la-construction-neuve-a1243.html',
        'secondary_source_url' => 'https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000054834875',
        'body' => <<<'HTML'
<p><strong>Une nouvelle étape de décarbonation de la construction neuve vient d’être fixée par voie réglementaire.</strong> Le décret n° 2026-863 du 12 septembre 2026, publié au Journal officiel, introduit des exigences de performance environnementale pour l’installation des équipements de chauffage, de refroidissement et de production d’eau chaude sanitaire. Pour les logements neufs, les nouvelles dispositions entrent en vigueur dès le <strong>1er janvier 2027</strong>.</p>
<p>Le sujet prolonge directement la trajectoire engagée avec la RE2020. Dans les faits, les chaudières gaz utilisées comme chauffage principal sont déjà devenues très difficiles à intégrer en construction neuve sous l’effet des seuils énergie et carbone. Le nouveau texte va plus loin en traitant explicitement l’installation d’équipements dépassant un niveau d’émissions déterminé, y compris lorsque le gaz n’est utilisé qu’en appoint.</p>
<h2>Un seuil fixé à 79 gCO2e/kWh</h2>
<p>Le décret introduit dans le Code de la construction et de l’habitation une interdiction d’installer certains équipements lorsque leur niveau d’émissions de gaz à effet de serre dépasse <strong>79 gCO2e/kWh</strong>. Le portail officiel RT-RE Bâtiment précise que cette valeur correspond au seuil réglementaire d’émissions retenu pour l’électricité.</p>
<p>Cette évolution ne doit pas être confondue avec un simple changement d’indicateur RE2020. Il s’agit d’une exigence portant directement sur les équipements pouvant être installés dans les constructions concernées. Un projet peut donc devoir intégrer cette contrainte en plus de la vérification habituelle du <a href="/reglementaire/difference-cep-cepnr-calcul-re2020/">Cep et du Cep,nr</a>, de l’impact carbone de l’énergie et des autres exigences RE2020.</p>
<h2>Quel calendrier pour les bâtiments neufs ?</h2>
<p>L’application est progressive selon l’usage du bâtiment. Le portail réglementaire indique une entrée en vigueur au <strong>1er janvier 2027 pour les constructions de logements</strong>, au <strong>1er janvier 2028 pour les bâtiments publics</strong>, puis au <strong>1er janvier 2030 pour les autres bâtiments</strong>.</p>
<p>Pour les maîtres d’ouvrage et concepteurs, cette progressivité rend la date du projet particulièrement importante. Un système envisagé aujourd’hui peut ne plus être admissible pour une opération dont la construction relève de la nouvelle échéance. Les choix énergétiques doivent donc être sécurisés suffisamment tôt, notamment pour les opérations collectives et tertiaires ayant des phases de conception longues.</p>
<h2>Pourquoi parler de « fin du gaz » alors que la RE2020 le pénalisait déjà ?</h2>
<p>La RE2020 a fortement réduit la place des énergies fossiles grâce à ses exigences de consommation et de carbone. Selon RT-RE Bâtiment, les chaudières gaz comme système principal sont déjà interdites en pratique depuis 2022 en maison individuelle et depuis 2025 en logement collectif. En revanche, certains <strong>appoints gaz pour le chauffage ou l’eau chaude sanitaire</strong> restaient possibles.</p>
<p>Le décret de septembre 2026 ferme progressivement cette possibilité dans la construction neuve. Pour une étude thermique, cela renforce l’intérêt d’étudier dès l’amont des solutions compatibles avec la trajectoire réglementaire : pompe à chaleur, réseau de chaleur adapté ou autres systèmes bas carbone selon la configuration du projet.</p>
<h2>Des exemptions sont prévues</h2>
<p>Le texte n’instaure pas une interdiction sans exception. Le portail officiel mentionne notamment des exemptions pour les <strong>systèmes utilisés en secours</strong>, certains systèmes techniques <strong>raccordés à des réseaux de chaleur</strong> et les bâtiments soumis à des servitudes de sol ou de propriété particulières rendant la mesure impossible à mettre en œuvre.</p>
<p>Une dérogation vise également certaines extensions de surface réduite lorsqu’elles sont raccordées au système énergétique existant : le portail RT-RE Bâtiment indique une surface inférieure à <strong>150 m² ou 30 % de la surface initiale du bâtiment</strong>. L’éligibilité doit être vérifiée au cas par cas et ne doit pas être déduite du seul type de projet.</p>
<h2>Le décret supprime aussi une possibilité concernant le fioul</h2>
<p>Le décret modifie également les règles relatives aux chaudières fioul en supprimant la possibilité de recourir à certains systèmes hybrides pour contourner le niveau maximal d’émissions applicable. La logique réglementaire est donc plus large qu’une seule sortie du gaz : elle vise la réduction des équipements fossiles fortement émetteurs dans le bâtiment.</p>
<h2>Quelles conséquences pour une étude RE2020 en 2026-2027 ?</h2>
<p>Pour KeePlanet, la conséquence pratique est claire : le système énergétique doit être choisi en tenant compte non seulement du résultat du calcul RE2020, mais aussi de la date d’application des nouvelles exigences sur les équipements. Sur un projet proche d’une échéance, conserver une chaudière ou un appoint fossile dans les hypothèses peut conduire à devoir revoir la conception technique plus tard.</p>
<p>La solution la plus robuste consiste à comparer les variantes dès l’étude : incidence sur le <a href="/reglementaire/difference-cep-cepnr-calcul-re2020/">Cep et le Cep,nr</a>, impact carbone de l’énergie, puissance nécessaire, production d’eau chaude sanitaire et cohérence avec l’enveloppe. Notre dossier consacré aux <a href="/equipements-solutions-techniques/pompe-a-chaleur-re2020-interdiction-effet-joule/">pompes à chaleur en RE2020</a> détaille les principaux points de vigilance pour les solutions thermodynamiques.</p>
<h2>Faire vérifier votre solution énergétique avant de figer le projet</h2>
<p>KeePlanet accompagne les maîtres d’ouvrage, architectes et constructeurs dans les études énergétiques et environnementales RE2020. Pour une maison individuelle, consultez nos <a href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/"><strong>prestations RE2020 maison et extension</strong></a>. Pour un immeuble collectif, un commerce, des bureaux ou un autre bâtiment tertiaire, demandez une <a href="/tarifs-etude-thermique-re-2020/collectif-tertiaire/"><strong>étude RE2020 collectif / tertiaire</strong></a> afin de sécuriser les choix de systèmes avant consultation des entreprises.</p>
HTML
    ],
];
return array_merge($new, $legacy);
