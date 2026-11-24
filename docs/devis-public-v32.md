# Devis public RE2020 – intégration V32

## Parcours conservé

- Le site conserve /devis-en-ligne/, /devis-en-ligne/envoi/ et le POST vers https://espace-client.keeplanet.fr/pages/ajout-projet/traitement-devis-re2020-public.php. Coordonnées obligatoires, autocomplétion, conversion et page /devis-compte-existant/ inchangées.
- Le traitement public réellement fourni recherche le compte par e-mail/login dans clients.donnees, clients.compte_vide et comptabilite.devis. Il réutilise les accès du compte connu et ne connecte pas automatiquement le visiteur. Pour un nouveau prospect, il réserve un num_gerant, crée le devis et ses accès dans comptabilite.devis ; il ne crée pas directement de ligne dans clients.donnees ou clients.compte_vide. Génération PDF, notification, file d'envoi et redirection historiques préservées.
- Le traitement public adapté V32 est livré séparément pour /var/www/espaceclv2/pages/ajout-projet/traitement-devis-re2020-public.php. Le moteur recalcule depuis les champs métier, sans utiliser les montants fournis ni un num_gerant du navigateur. Version site-public-v1 encore acceptée pour une installation en deux temps, versions inconnues refusées.
- Le payload site-public-v32-denis-20260918 utilise projet.nature (neuf, ext, mixte-ne, reno-ext, reno-neuf, sur), famille, famille_extension, famille_neuve, donnees.parts (main/ext/neuf/sur), extMode et surfaces. Deux packs, tarifs masqués, supplément Express visible. Usage hors calcul automatique ou RT2012 : devis manuel par contact.
- Express : délai standard > 1 jour, ligne optionnelle quantité 0 si non sélectionnée, ligne incluse quantité 1 sinon ; aucun Express si délai standard de 1 jour. Prix calculés à partir des lignes HT arrondies. Passage à l'étude complète conservé en option si BBIO. Origine_creation espace_client_calculateur conservée pour permettre au traitement de commande du ZIP de persister les options.
- Pas de facturation tiers via le formulaire public. Si le login trouvé correspond à une adresse différente du mail de compte, le traitement demande une connexion au compte au lieu de réexpédier ses accès à une autre adresse.

## Déploiement

1. Sauvegarder le fichier PHP public actuel et installer la version adaptée sur le serveur espace client (compatible avec le site V1). Vérifier également que les fichiers d'options et de validation finale du ZIP sont installés ; ne pas modifier total.php.
2. Tester en environnement de test : PDF et mail, prospect nouveau, compte existant, montant et acompte, Express non coché puis sélectionné à la validation finale, Express choisi initialement, RT2012 et codes de type de devis.
3. Fusionner la PR GitHub seulement après installation du traitement public et validation du parcours de bout en bout. Déployer via Plesk.

Contrôles réalisés hors production : syntaxe PHP et JavaScript, calculs maison, extension, collectif avec bâtiment identique, mixte, surélévation, bureaux, Express, refus RT2012, compatibilité V1. Pas de test sur les tables MySQL ni sur le générateur PDF/SFTP/mailer réel.
