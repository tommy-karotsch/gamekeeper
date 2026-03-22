# Projet : Gamekeeper

## Description
Site web permettant à un utilisateur de créer et gérer
sa collection de jeux vidéo personnalisée.

## Stack technique
- Frontend : HTML, CSS
- Backend : PHP 8.2.12 (MVC, PSR-4, Composer)
- Base de données : MySQL/MariaDB 10.4 via phpMyAdmin
- Environnement : XAMPP (Windows)
- Autoloading : Composer PSR-4

## Modélisation (draw.io — gamekeeper_merise.drawio)

### MCD (Modèle Conceptuel de Données)
Entités :
- UTILISATEUR (id, username, email, password, role, created_at)
- JEU (id, titre, description, cover_image, date_sortie, created_at)
- GENRE (id, nom)
- PLATEFORME (id, nom)

Associations :
- APPARTENIR_À  : GENRE (0,n) ——— (1,1) JEU
- DISPONIBLE_SUR : JEU (1,1) ——— (0,n) PLATEFORME
- POSSÉDER : UTILISATEUR (0,n) ——— (0,n) JEU
  → attributs portés : statut, temps_jeu, date_ajout

### MLD (Modèle Logique de Données)
- UTILISATEUR (id, username, email, password, role, created_at)
- JEU (id, titre, description, cover_image, date_sortie, #genre_id, #platform_id, created_at)
- GENRE (id, nom)
- PLATEFORME (id, nom)
- POSSÉDER (id, #user_id, #game_id, statut, temps_jeu, date_ajout)

### MPD (Modèle Physique de Données)
- users (PK id INT, username VARCHAR, email VARCHAR,
         password VARCHAR, role ENUM, created_at TIMESTAMP)
- games (PK id INT, title VARCHAR, description TEXT,
         cover_image VARCHAR, release_date DATE,
         FK platform_id INT, FK genre_id INT, created_at TIMESTAMP)
- genres (PK id INT, name VARCHAR)
- platforms (PK id INT, name VARCHAR)
- user_games (PK id INT, FK user_id INT, FK game_id INT,
              status ENUM('wish_list','playing','completed','abandoned'),
              playtime INT, added_at TIMESTAMP)

## Arborescence
gamekeeper/
├── app/
│   ├── Controllers/
│   │   ├── HomeController.php          ← ✅
│   │   ├── UserController.php          ← ✅
│   │   ├── PlatformController.php      ← ✅ (protégé admin)
│   │   ├── GenreController.php         ← ✅ (protégé admin)
│   │   ├── GameController.php          ← ✅ (protégé admin pour create/store/edit/update/delete)
│   │   └── CollectionController.php    ← ✅
│   ├── Models/
│   │   ├── Model.php                   ← ✅
│   │   ├── UserModel.php               ← ✅
│   │   ├── PlatformModel.php           ← ✅
│   │   ├── GenreModel.php              ← ✅
│   │   ├── GameModel.php               ← ✅ (findAllWithDetails + findByIDWithDetails)
│   │   └── UserGamesModel.php          ← ✅
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── header.php              ← ✅ stylisé (Figma)
│   │   │   └── footer.php              ← ✅ stylisé (Figma)
│   │   ├── home/
│   │   │   └── index.php               ← ✅ stylisé (template Accueil Figma)
│   │   ├── user/
│   │   │   ├── login.php               ← ✅ stylisé
│   │   │   ├── register.php            ← ✅ stylisé
│   │   │   └── profile.php             ← ✅ stylisé (template Profil Figma)
│   │   ├── platform/
│   │   │   ├── index.php               ← ⬜ à styliser (admin)
│   │   │   └── create.php              ← ⬜ à styliser (admin)
│   │   ├── genre/
│   │   │   ├── index.php               ← ⬜ à styliser (admin)
│   │   │   └── create.php              ← ⬜ à styliser (admin)
│   │   ├── game/
│   │   │   ├── index.php               ← ✅ stylisé (template Collection Figma)
│   │   │   ├── show.php                ← ✅
│   │   │   ├── create.php              ← ⬜ à styliser (admin)
│   │   │   └── edit.php                ← ⬜ à styliser (admin)
│   │   └── collection/
│   │       └── index.php               ← ✅ stylisé (template Collection Figma)
│   └── Router.php                      ← ✅
├── config/
│   └── Database.php                    ← ✅
├── public/
│   └── index.php                       ← ✅
├── assets/
│   ├── css/
│   │   └── style.css                   ← ✅ stylisé (variables Figma)
│   └── img/
│       └── logo-manette.png            ← ✅
├── vendor/                             ← ✅ généré par Composer
└── composer.json                       ← ✅

## Namespaces (composer.json)
- App\    → app/
- Config\ → config/

## Routing
URL pattern : /gamekeeper/public/?url=controller/method
- ?url=                            → HomeController::index()
- ?url=user/login                  → UserController::login()
- ?url=user/register               → UserController::register()
- ?url=user/profile                → UserController::profile()
- ?url=user/edit                   → UserController::edit()
- ?url=user/logout                 → UserController::logout()
- ?url=user/delete                 → UserController::delete()
- ?url=platform/index              → PlatformController::index()
- ?url=platform/create             → PlatformController::create()
- ?url=platform/store              → PlatformController::store()
- ?url=platform/delete             → PlatformController::delete()
- ?url=genre/index                 → GenreController::index()
- ?url=genre/create                → GenreController::create()
- ?url=genre/store                 → GenreController::store()
- ?url=genre/delete                → GenreController::delete()
- ?url=game/index                  → GameController::index()
- ?url=game/show&id=X              → GameController::show()
- ?url=game/create                 → GameController::create()
- ?url=game/store                  → GameController::store()
- ?url=game/edit&id=X              → GameController::edit()
- ?url=game/update&id=X            → GameController::update()
- ?url=game/delete&id=X            → GameController::delete()
- ?url=collection/index            → CollectionController::index()
- ?url=collection/add&game_id=X    → CollectionController::add()
- ?url=collection/remove&game_id=X → CollectionController::remove()
- ?url=collection/updateStatus     → CollectionController::updateStatus()
- ?url=collection/updatePlaytime   → CollectionController::updatePlaytime()

## Base de données
Tables :
- users (id, username, email, password, role ENUM('user','admin'), created_at)
- games (id, title, description, cover_image, release_date,
         platform_id FK, genre_id FK, created_at)
- genres (id, name)
- platforms (id, name)
- user_games (id, user_id FK, game_id FK,
              status ENUM('wish_list','playing','completed','abandoned'),
              playtime INT, added_at)

Relations :
- user_games est la table pivot entre users et games (relation POSSÉDER)
- games dépend de platforms et genres (FK — DISPONIBLE_SUR / APPARTENIR_À)

## Patterns utilisés
- Classe abstraite Model (findAll, findByID, delete communs)
- Tous les modèles extends Model
- Config\Database avec getConnection() (singleton PDO)
- requireAuth() dans UserController + CollectionController
- requireAdmin() dans PlatformController, GenreController, GameController
- password_hash / password_verify pour les mots de passe
- htmlspecialchars() dans toutes les vues (XSS)
- Requêtes préparées PDO (injection SQL)
- Champ caché name="type" pour distinguer les formulaires dans edit()
- header.php / footer.php inclus dans chaque vue via require_once
- Accordéon JS pour la page profil
- JOIN SQL dans GameModel + UserGamesModel
- COALESCE() dans getStats() pour éviter les valeurs NULL

## Design (Figma)
Lien : https://www.figma.com/design/UBlKscbthjtT5a8tB3uDS3/GameKeeper

Couleurs :
- --vert-accent     : #39D979
- --blanc           : #FFFFFF
- --header-gradient : linear-gradient(90deg, rgb(61,30,102) → rgb(122,60,204))
- --footer-gradient : linear-gradient(90deg, rgb(122,60,204) → rgb(61,30,102))

Polices :
- Kanit   → logo "GameKeeper"
- Poppins → textes, navigation

Templates Figma → Pages :
- Index/Accueil → home/index.php ✅, login.php ✅, register.php ✅
- Collection    → game/index.php ✅, collection/index.php ✅
- Profil        → user/profile.php ✅

## Améliorations prévues pour profile.php
- ⬜ Badge rôle (admin/user) dans la carte infos — faisable immédiatement
- ⬜ Lien "Voir ma collection" dans l'accordéon — faisable immédiatement
- ⬜ Stats de collection (total, en cours, terminés...) — UserGamesModel prêt ✅

## Sécurité (non prioritaire — à faire plus tard)
- ⬜ CSRF — protection des formulaires
- ⬜ Validation des données dans GameController::store() et update()
- ⬜ Limite de tentatives de connexion
- ⬜ Headers de sécurité HTTP dans public/index.php

## Ordre de développement
1.  ✅ User (register, login, profile, edit, logout, delete)
2.  ✅ Platform + Genre (CRUD admin)
3.  ✅ Intégration Figma (header, footer, style.css)
4.  ✅ Page d'accueil
5.  ✅ Styliser login.php + register.php
6.  ✅ Styliser profile.php
7.  ✅ Games (Model, Controller, Views)
8.  ✅ User_games / Collection
9.  🔧 Améliorations profile.php (badge rôle, lien collection, stats)
10. 🔧 Styliser pages admin (platform, genre, game/create, game/edit)
11. ⬜ Sécurité (non prioritaire)

## Avancement
- ✅ BDD créée et importée
- ✅ MCD + MLD + MPD modélisés (gamekeeper_merise.drawio)
- ✅ Composer configuré (PSR-4, autoload)
- ✅ config/Database.php
- ✅ app/Models/ (Model, UserModel, PlatformModel, GenreModel, GameModel, UserGamesModel)
- ✅ app/Controllers/ (Home, User, Platform, Genre, Game, Collection)
- ✅ app/Router.php
- ✅ public/index.php
- ✅ assets/css/style.css
- ✅ layout/ (header + footer stylisés)
- ✅ home/index.php
- ✅ user/ (login, register, profile) stylisés
- ✅ platform/ + genre/ fonctionnels (style à faire)
- ✅ game/ (index, show, create, edit) fonctionnels
- ✅ collection/index.php fonctionnel et stylisé