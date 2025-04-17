# 🚀 Coding Tool Box – Guide d'installation

Bienvenue dans **Coding Tool Box**, un outil complet de gestion pédagogique conçu pour la Coding Factory.  
Ce projet Laravel inclut la gestion des groupes, promotions, étudiants, rétro (Kanban), QCM  dynamiques, et bien plus.

---

## 📦 Prérequis

Assurez-vous d’avoir les éléments suivants installés sur votre machine :

- PHP ≥ 8.1
- Composer
- MySQL ou MariaDB
- Node.js + npm (pour les assets frontend si nécessaire)
- Laravel CLI (`composer global require laravel/installer`)

---

## ⚙️ Installation du projet

Exécutez les étapes ci-dessous pour lancer le projet en local :

### 1. Cloner le dépôt

```bash
git clone https://m_thibaud@bitbucket.org/m_thibaud/projet-web-2025.git
cd coding-tool-box
cp .env.example .env
```

### 2. Configuration de l'environnement

```bash
✍️ Ouvrez le fichier .env et configurez les paramètres liés à votre base de données :

DB_DATABASE=nom_de_votre_bdd
DB_USERNAME=utilisateur
DB_PASSWORD=motdepasse
```

### 3. Installation des dépendances PHP

```bash
composer install
```

### 4. Nettoyage et optimisation du cache

```bash
php artisan optimize:clear
```

### 5. Génération de la clé d'application

```bash
php artisan key:generate
```

### 6. Migration de la base de données

```bash
php artisan migrate
```

### 7. Population de la base (Données de test)

```bash
php artisan db:seed
```

---

## 💻 Compilation des assets (si nécessaire)

```bash
npm install
npm run dev
```

---

## 👤 Comptes de test disponibles

| Rôle       | Email                         | Mot de passe |
|------------|-------------------------------|--------------|
| **Admin**  | admin@codingfactory.com       | 123456       |
| Enseignant | teacher@codingfactory.com     | 123456       |
| Étudiant   | student@codingfactory.com     | 123456       |

---

## 🚧 Fonctionnalités principales

- 🔧 Gestion des groupes, promotions, étudiants
- 📅 Vie commune avec système de pointage
- 📊 Bilans semestriels étudiants via QCM générés par IA
- 🧠 Génération automatique de QCM par langage sélectionné
- ✅ Système de Kanban pour les rétrospectives
- 📈 Statistiques d’usage et suivi pédagogique



---

# 💻  Projet Backlog 1

Ici je résumerais les taches que j'ai éffectué et comment les réalisé sur le site.

---

## 1ère Story

EN TANT QU’admin
JE VEUX avoir un tableau de bord avec une vue d'ensemble des promotions, étudiants,
enseignants et groupes
AFIN DE pouvoir accéder rapidement à la gestion des entités principales.
Critères d’acceptation
• Le Dashboard affiche le nombre total de promotions, étudiants, enseignants et groupes.
• Le nombre des groupes sera un nombre statique en front. Vous ne gérer pas les groupes dans
ce backlog.
• Il s’agit de la page Overview pour les admin.


### Réalisation :

En vous connectant sur le site en tant qu’administrateur, vous accéderez à la page principale contenant un tableau affichant le nombre de promotions, d’étudiants, d’enseignants et de groupes.

En cliquant sur "Promotion" par exemple, vous serez redirigé vers une page où toutes les promotions créées apparaîtront.

---

## 2ème Story

EN TANT QU’enseignant
JE VEUX voir mes promotions avec lesquelles je travaille
AFIN DE pouvoir gérer et suivre les performances de mes étudiants.
Critères d’acceptation
• L’enseignant peut accéder à une liste de ses promotions depuis la page promotions
• L’enseignant peut accéder à un récap des promotions en cours (année en cours) sur son
dashboard (overview)
• Une table est créée afin de lier un enseignant avec une promotion. Attention plusieurs
enseignants peuvent être affecté à plusieurs promotions

### Réalisation : 


## 3ème Story

EN TANT QU’admin
JE VEUX pouvoir créer, modifier et supprimer des étudiants
AFIN DE gérer les membres de chaque promotion.
Critères d’acceptation
• L’admin peut ajouter des étudiants avec des informations. Libre à vous d’ajouter les
informations essentielles. A minima, nous aurons le nom, le prénom, la date de naissance et
l’adresse email.
• Le mot de passe est généré en backend et transmis par mail à l’utilisateur
• L’admin peut modifier ou supprimer un étudiant existant.
• L’admin peut associer un étudiant à une promotion.
• Ces actions se font via une modal et une requête AJAX. Aucun rechargement de page pour
voir afficher les résultats


### Réalisation :

En vous connectant en tant qu'administrateur, vous pouvez accéder à la page dédiée aux étudiants.
Dans cette page, un tableau affiche la liste de tous les étudiants créés. À côté de ce tableau, un formulaire permet d'ajouter un nouvel étudiant.

Les informations à renseigner sont : le nom, le prénom, la date de naissance et l’adresse email de l’étudiant.
Une fois le formulaire rempli, cliquez sur Valider pour ajouter l'étudiant à la liste.

Chaque étudiant affiché dans le tableau possède une colonne contenant deux boutons :

Modifier : pour éditer les informations de l’étudiant.

Supprimer : pour supprimer l’étudiant de la liste.

Lorsque vous cliquez sur le bouton Modifier, le même formulaire que celui de création s'affiche, mais avec les informations de l'étudiant préremplies. Il ne vous reste qu'à modifier les champs souhaités, puis valider.

Lorsqu’un étudiant est créé, un email est automatiquement envoyé en backend pour lui transmettre son mot de passe.

Le mot de passe par défaut est toujours "123456".

Enfin, en accédant à la page d’une promotion, vous verrez un tableau représentant cette promotion ainsi qu’un formulaire à côté.
Ce formulaire contient une liste déroulante avec tous les étudiants créés. En sélectionnant un étudiant et en cliquant sur Valider, celui-ci est ajouté à la promotion.


## 4ème Story

EN TANT QU’admin
JE VEUX pouvoir créer, modifier et supprimer des promotions
AFIN D’organiser et gérer les groupes d’étudiants.
Critères d’acceptation
• L’admin peut créer une promotion en saisissant un nom et des informations de base.
• L’admin peut modifier ou supprimer une promotion existante.
• Ces actions se font via une modal et une requête AJAX. Aucun rechargement de page pour
voir afficher les résultats


### Réalisation :

En vous connectant en tant qu’administrateur, vous pouvez vous diriger vers la page listant toutes les promotions.
Vous y trouverez un tableau affichant l’ensemble des promotions créées.

À côté du tableau se trouve un formulaire permettant de créer une nouvelle promotion.
Les informations à renseigner sont :

Le nom de la promotion

Le lieu

L’année de début

L’année de fin

Une fois le formulaire rempli, cliquez sur Valider. La promotion créée apparaîtra alors automatiquement dans le tableau.

Dans ce tableau, chaque promotion dispose de deux boutons :

Modifier : pour mettre à jour les informations

Supprimer : pour la retirer définitivement

❌ Lorsque vous cliquez sur Modifier, vous êtes redirigé vers un formulaire identique à celui de création.
Les champs sont préremplis avec les informations de la promotion, que vous pouvez alors modifier avant de valider.


## 5ème Story

EN TANT QU’admin
JE VEUX pouvoir créer, modifier et supprimer des enseignants
AFIN DE gérer les responsables des promotions.
Critères d’acceptation
• L’admin peut ajouter des enseignants avec des informations. Libre à vous d’ajouter les
informations essentielles. A minima, nous aurons le nom, le prénom et l’adresse email.
• L’admin peut modifier ou supprimer un enseignant.
• Ces actions se font via une modal et une requête AJAX. Aucun rechargement de page pour
voir afficher les résultats


### Réalisation :

En vous connectant en tant qu’administrateur, vous pouvez accéder à la page dédiée aux enseignants.
Dans cette page, un tableau affiche la liste de tous les enseignants créés. À côté du tableau, un formulaire permet d’ajouter un nouvel enseignant.

Les informations à renseigner sont :

Le nom

Le prénom

La date de naissance

L’adresse email

Une fois le formulaire rempli, cliquez sur Valider : l’enseignant sera alors ajouté à la liste.

Chaque enseignant affiché dans le tableau dispose d’une colonne contenant deux boutons :

Modifier : pour modifier ses informations

Supprimer : pour le retirer de la liste

Lorsque vous cliquez sur le bouton Modifier, un formulaire identique à celui de création s’affiche, avec les informations de l’enseignant préremplies. Il vous suffit de modifier les champs souhaités, puis de valider.

Lorsqu’un enseignant est créé, un email est automatiquement envoyé côté backend pour lui communiquer son mot de passe.

Le mot de passe par défaut est toujours "123456".


## 6ème Story

EN TANT QU’utilisateur
JE VEUX pouvoir modifier mon email, mot de passe et photo de profil. Supprimer mon compte.
AFIN DE personnaliser et sécuriser mon compte.
Critères d’acceptation
• L’utilisateur peut modifier son email et mot de passe.
• L’utilisateur peut télécharger une nouvelle photo de profil.
• L’utilisateur peut supprimer son compte


### Réalisation :
Une fois connecté en tant qu’utilisateur, vous pouvez accéder à votre profil.

Le profil est divisé en quatre catégories :

Informations personnelles
Cette section permet de modifier votre nom, prénom, numéro de téléphone (optionnel, car il n’est pas lié à la base de données) ainsi que votre photo de profil.
Une fois les modifications effectuées, cliquez sur Save Changes pour enregistrer les nouvelles informations.

Adresse email
Dans cette partie, vous pouvez mettre à jour votre email.
L’adresse actuelle est affichée par défaut : il vous suffit de la modifier puis de cliquer sur Save pour valider le changement.

Mot de passe
Ici, vous pouvez modifier votre mot de passe.
Pour cela, entrez d’abord votre ancien mot de passe, puis le nouveau mot de passe, et enfin confirmez-le.

Le nouveau mot de passe doit contenir au moins 6 caractères.
Cliquez sur Save pour enregistrer le nouveau mot de passe.

Suppression du compte
Cette dernière section permet de supprimer votre compte.
Vous devez d’abord cocher une case de confirmation, puis cliquer sur Delete Account pour finaliser la suppression.

⚠️ Cette action est irréversible.
