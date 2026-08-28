<?php
/*
 * Catalogue des dossiers RE2020.
 * Règle de publication : tout nouveau dossier doit obligatoirement utiliser
 * une catégorie déclarée ci-dessous. Son URL est /{categorie}/{slug}/.
 */
return [
    'categories' => [
        'reglementaire' => [
            'name' => 'Réglementaire',
            'description' => 'Seuils, attestations, indicateurs et contrôles de conformité RE2020.',
        ],
        'equipements-solutions-techniques' => [
            'name' => 'Équipements & solutions techniques',
            'description' => 'Chauffage, ventilation, vitrages et choix techniques qui influencent les calculs.',
        ],
        'couts-optimisation-budgetaire' => [
            'name' => 'Coûts & optimisation budgétaire',
            'description' => 'Arbitrages technico-économiques pour rester conforme sans surdimensionner le projet.',
        ],
    ],
    'articles' => [
        [
            'category' => 'reglementaire',
            'slug' => 'zones-climatiques-calcul-re2020',
            'title' => 'Zones climatiques RE2020 : l’impact de la géographie sur vos obligations',
            'excerpt' => 'Comprendre les zones climatiques, les modulations géographiques, l’altitude et leur influence sur le Bbiomax.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/zones-climatiques-calcul-re2020/',
            'wp_id' => 1675,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'calcul-degres-heures-dh-re2020',
            'title' => 'Degrés-Heures (DH) RE2020 : maîtriser le confort d’été',
            'excerpt' => 'Pourquoi l’indicateur DH a remplacé la Tic et comment limiter la surchauffe estivale.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/calcul-degres-heures-dh-re2020/',
            'wp_id' => 1330,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'controle-fin-chantier-etancheite-air-re2020',
            'title' => 'Contrôle de fin de chantier et test d’étanchéité à l’air RE2020',
            'excerpt' => 'Test d’infiltrométrie, contrôle de ventilation et cohérence entre le chantier et le fichier réglementaire.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/controle-fin-chantier-etancheite-air-re2020/',
            'wp_id' => 1810,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'vmc-hygro-b-vs-double-flux-re2020',
            'title' => 'VMC Hygro-B vs Double Flux : le match réglementaire RE2020',
            'excerpt' => 'Bbio, Cep, auxiliaires et confort : ce que le moteur réglementaire valorise réellement.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/vmc-hygro-b-vs-double-flux-re2020/',
            'wp_id' => 1385,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'acv-carbone-re2020-permis-construire',
            'title' => 'ACV carbone RE2020 et permis de construire',
            'excerpt' => 'Le rôle de l’analyse de cycle de vie dans la RE2020 et son articulation avec les étapes du projet.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/acv-carbone-re2020-permis-construire/',
            'wp_id' => 1345,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'extension-re2020-seuils-surface',
            'title' => 'Extension et RE2020 : seuils de surface et obligations selon votre projet',
            'excerpt' => 'Les différents seuils de surface et les obligations thermiques applicables aux extensions de maison.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/extension-re2020-seuils-surface/',
            'wp_id' => 1336,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'compacite-bati-re2020',
            'title' => 'Compacité du bâti et performance RE2020',
            'excerpt' => 'Pourquoi la forme du bâtiment influence les déperditions, le Bbio et les choix constructifs.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/compacite-bati-re2020/',
            'wp_id' => 1416,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'attestation-bbio-re2020-contenu-lien-bureau-etudes',
            'title' => 'Attestation Bbio RE2020 : contenu et rôle du bureau d’études',
            'excerpt' => 'Ce que contient l’attestation pour le permis et comment les données de l’étude permettent son édition.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/attestation-bbio-re2020-contenu-lien-bureau-etudes/',
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'difference-cep-cepnr-calcul-re2020',
            'title' => 'Cep et Cep,nr en RE2020 : comprendre la différence',
            'excerpt' => 'Énergie primaire, part non renouvelable et impact des systèmes : comprendre les deux indicateurs de consommation.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/difference-cep-cepnr-calcul-re2020/',
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'evolution-seuils-acv-re2020',
            'title' => 'Évolution des seuils ACV en RE2020',
            'excerpt' => 'Comprendre le durcissement progressif des seuils carbone et ses conséquences sur les choix de construction.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/evolution-seuils-acv-re2020/',
            'wp_id' => 1818,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'exemple-etude-thermique-re2020',
            'title' => 'Exemple d’étude thermique RE2020',
            'excerpt' => 'Comprendre les principaux résultats, livrables et indicateurs que contient une étude thermique RE2020.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/exemple-etude-thermique-re2020/',
            'wp_id' => 1793,
        ],
        [
            'category' => 'reglementaire',
            'slug' => 'calcul-surface-reference-thermique-srt',
            'title' => 'De la SHONrt à la Srt RE2020 : comprendre la surface de référence',
            'excerpt' => 'Comprendre la Srt / Su et la surface réglementaire qui sert notamment à moduler les plafonds de consommation.',
            'source_url' => 'https://r-e-2020.fr/reglementaire/calcul-surface-reference-thermique-srt/',
            'wp_id' => 1683,
        ],
        [
            'category' => 'equipements-solutions-techniques',
            'slug' => 'interdiction-effet-joule-re2020',
            'title' => 'Effet Joule en RE2020 : pourquoi le radiateur électrique classique pénalise le Cep',
            'excerpt' => 'Le coefficient de conversion électrique et les raisons pour lesquelles l’effet Joule devient difficile à valider.',
            'source_url' => 'https://r-e-2020.fr/equipements-solutions-techniques/interdiction-effet-joule-re2020/',
            'wp_id' => 1411,
        ],
        [
            'category' => 'equipements-solutions-techniques',
            'slug' => 'pompe-a-chaleur-re2020-interdiction-effet-joule',
            'title' => 'Pompe à chaleur et RE2020 : la solution après l’effet Joule',
            'excerpt' => 'COP, Cep, Cep,nr, PAC air-eau ou air-air : comprendre l’intérêt réglementaire d’un système thermodynamique.',
            'source_url' => 'https://r-e-2020.fr/equipements-solutions-techniques/pompe-a-chaleur-re2020-interdiction-effet-joule/',
        ],
        [
            'category' => 'equipements-solutions-techniques',
            'slug' => 'regle-un-sixieme-surface-vitree-re2020',
            'title' => 'Surface vitrée RE2020 : règle des 1/6 et facteur solaire',
            'excerpt' => 'Surface minimale de baies, facteur solaire, orientation et protections pour équilibrer Bbio et confort d’été.',
            'source_url' => 'https://r-e-2020.fr/equipements-solutions-techniques/regle-un-sixieme-surface-vitree-re2020/',
            'wp_id' => 1405,
        ],
        [
            'category' => 'couts-optimisation-budgetaire',
            'slug' => 'prix-maison-re2020',
            'title' => 'Prix d’une maison RE2020 : optimiser le budget sans perdre la conformité',
            'excerpt' => 'Identifier les leviers les plus économiques pour corriger un projet et éviter les surdimensionnements inutiles.',
            'source_url' => 'https://r-e-2020.fr/couts-optimisation-budgetaire/prix-maison-re2020/',
            'wp_id' => 1785,
        ],
    ],
];
