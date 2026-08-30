<?php
// Copier ce fichier en inc/secrets.php directement sur le serveur Plesk.
// inc/secrets.php est ignoré par Git et ne doit jamais être envoyé au dépôt.
return [
    'openai_api_key' => 'sk-REMPLACE-MOI-SUR-LE-SERVEUR',

    // Historique KeePote vers Keeplanet Gestion.
    // Exemple : https://gestion.votre-domaine.fr
    'keepote_log_url' => 'https://URL-DE-LA-GESTION',
    // Même secret que integrations.keepote_log_token dans config/config.local.php de kp-gestion.
    'keepote_log_token' => 'REMPLACE-MOI-PAR-UN-SECRET-LONG-ALEATOIRE',
];
