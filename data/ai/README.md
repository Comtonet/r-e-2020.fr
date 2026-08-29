# KeePote — architecture de la base IA

## Accès salariés

Les salariés contribuent uniquement depuis le dossier Google Drive **Collaboratif** :

- Dossier Collaboratif : `1o6z71kCVRcqYe87NtZ7pmtKU2L42bEVk`
- Sous-dossier d'entraînement : **03 — Entraînement IA KeePote**
- ID du sous-dossier : `1auyaQ7jTjBQNL6mCrb-B0NKZVAERXRon`

Le dossier Collaboratif est le seul dossier qui doit être partagé aux salariés.

## Base privée validée

La base IA Google Drive reste privée. Les salariés n'ont pas besoin d'y accéder.

Les contributions du dossier collaboratif ne sont jamais consommées directement par KeePote. Elles doivent être relues et validées avant d'être intégrées dans la base privée **Validé**, puis synchronisées vers les fichiers runtime de ce répertoire `/data/ai/`.

## Runtime

KeePote utilise uniquement les contenus validés présents dans :

- `faq.json`
- `reglementation.json`
- `process.json`
- `commercial.json`
- `technique.json`
- `sources.json`

Le chatbot ne lit pas Google Drive en temps réel.

## Workflow

1. Le salarié dépose ou modifie une contribution dans `Collaboratif / 03 — Entraînement IA KeePote`.
2. La contribution est relue et contrôlée.
3. Une contribution validée est intégrée à la base IA privée.
4. La base privée est synchronisée vers `/data/ai/`.
5. KeePote ne répond qu'à partir des contenus validés.
