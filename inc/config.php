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

    // Moteur du calculateur de devis RE2020 hors logement collectif.
    // Valeurs reprises du moteur transmis et regroupées ici pour faciliter les mises à jour.
    'quote_mi_forfait' => 50,
    'quote_mi_logement' => 75,
    'quote_mi_modele' => 74,
    'quote_mi_complete_forfait' => 125,
    'quote_mi_complete_unite' => 149,
    'quote_ext_permis' => 199,
    'quote_ext_complete' => 423,
    'quote_article_metre' => 100,
    'quote_social_m2' => 1.25,
    'quote_vestiaire_forfait' => 130,
    'quote_tertiaire_complete_complement' => 429,
    'quote_power_a' => 39.18,
    'quote_power_k' => 0.43,

    // Valeurs commerciales affichées lorsqu'elles sont mentionnées.
    'value_keephome_ttc' => 50,
    'value_heating_sizing_ttc' => 50,

    // KeePote : la clé API reste hors Git (OPENAI_API_KEY ou inc/secrets.php).
    'ai_model' => 'gpt-5.6-luna',
    'ai_max_output_tokens' => 700,
];
