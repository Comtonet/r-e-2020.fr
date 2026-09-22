<?php
return [
    // Chiffres globaux affichés sur le site.
    'projects_count' => 89000,
    'experience_years' => 16,
    'google_rating' => 4.6,
    'google_reviews' => 319,

    // Qualifications / preuves publiques.
    'opqibi_1331' => true,
    'opqibi_1332' => true,
    'opqibi_1905' => true,
    'opqibi_1911' => true,
    'opqibi_profile_url' => 'https://www.opqibi.com/fiche/3545',

    // Délais : toutes les valeurs sont modifiables ici.
    'delay_standard_days' => 1,
    'delay_eco_days' => 2,
    'delay_collective_min_days' => 5,
    'delay_collective_max_days' => 10,
    'delay_quote_hours' => 24,
    'delay_small_extension_hours' => 2,

    // Tarifs publics TTC : ne jamais saisir un prix directement dans une page.
    'price_eco_permis_ttc' => 124,
    'price_pack_permis_ttc' => 199,
    'price_fin_travaux_ttc' => 274,
    'price_fin_travaux_acv_ttc' => 423,
    'price_small_extension_attestation_ttc' => 19,

    // Packs maison : le slug public est converti côté serveur vers le type_demande historique.
    // Ne jamais accepter un type_demande envoyé librement par le navigateur.
    'house_signup_packs' => [
        'eco' => [
            'label' => "Pack Eco'Permis",
            'type_demande' => 're2020_bbio_eco',
            'price_key' => 'price_eco_permis_ttc',
            'description' => 'Bbio + DH pour la phase permis, formule économique.',
        ],
        'permis' => [
            'label' => 'Pack Permis',
            'type_demande' => 're2020_bbio',
            'price_key' => 'price_pack_permis_ttc',
            'description' => 'Bbio + DH et attestation permis générée par KeePlanet.',
        ],
        'fdc' => [
            'label' => 'Pack Fin de travaux',
            'type_demande' => 're2020_bbio_fdc_dim50',
            'price_key' => 'price_fin_travaux_ttc',
            'description' => 'Étude thermique complète avec fin de travaux et dimensionnement inclus.',
        ],
        'fdc-acv' => [
            'label' => 'Pack Fin de travaux + ACV',
            'type_demande' => 're2020_bbio_fdc_dim50_acv',
            'price_key' => 'price_fin_travaux_acv_ttc',
            'description' => 'Étude complète avec fin de travaux, dimensionnement et ACV.',
        ],
        'inf50' => [
            'label' => 'Extension / petite construction < 50 m²',
            'type_demande' => 'inf50',
            'price_key' => 'price_small_extension_attestation_ttc',
            'description' => 'Prise en charge de l’attestation simplifiée par notre équipe.',
        ],
    ],

    // Offre commerciale affichée à l'intention de sortie sur la page des packs maison.
    // Le Pack Eco'Permis est toujours exclu de cette remise.
    'house_exit_offer_enabled' => true,
    'house_exit_offer_percent' => 10,

    // Moteur du calculateur de devis RE2020.
    // Valeurs reprises du moteur transmis et regroupées ici pour faciliter les mises à jour.
    'quote_mi_forfait' => 50,
    'quote_mi_logement' => 75,
    'quote_mi_modele' => 74,
    'quote_mi_complete_forfait' => 125,
    'quote_mi_complete_unite' => 149,
    'quote_ext_permis' => 199,
    'quote_ext_fdc' => 274,
    'quote_ext_complete' => 423,
    'quote_article_metre' => 100,
    'quote_social_m2' => 1.25,
    'quote_vestiaire_forfait' => 130,
    'quote_tertiaire_fdc_complement' => 130,
    'quote_tertiaire_complete_complement' => 429,
    'quote_power_a' => 39.18,
    'quote_power_k' => 0.43,

    // Logement collectif : grille actuelle jusqu'à 25 logements, puis courbe sans plafond.
    // Le niveau FDC reprend le forfait BBIO avec le complément de 180 € avant l'ACV.
    // Au-delà de 25 : article de métré = a × nombre de logements + b.
    'quote_collective_fdc_forfait_delta' => 180,
    'quote_collective_bbio_forfait' => 210,
    'quote_collective_complete_forfait' => 390,
    'quote_collective_identique' => 50,
    'quote_plancher_tertiaire' => 262.50,
    'quote_social_forfait' => 200,
    'quote_collective_curve_threshold' => 25,
    'quote_collective_curve_a' => 36.492,
    'quote_collective_curve_b' => 11.067,

    // Valeurs commerciales affichées lorsqu'elles sont mentionnées.
    'value_keephome_ttc' => 50,
    'value_heating_sizing_ttc' => 50,

    // KeePote : la clé API reste hors Git (OPENAI_API_KEY ou inc/secrets.php).
    'ai_model' => 'gpt-5.6-luna',
    'ai_max_output_tokens' => 700,
];
