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
- APPARTENIR_À  : GENRE (0,n) ——— (0,n) JEU  ← table pivot game_genres
- DISPONIBLE_SUR : JEU (0,n) ——— (0,n) PLATEFORME ← table pivot game_platforms
- POSSÉDER : UTILISATEUR (0,n) ——— (0,n) JEU
  → attributs portés : statut, temps_jeu, date_ajout

### MLD (Modèle Logique de Données)
- UTILISATEUR (id, username, email, password, role, created_at)
- JEU (id, titre, description, cover_image, date_sortie, created_at)
- GENRE (id, nom)
- PLATEFORME (id, nom)
- GAME_PLATFORMS (id, #game_id, #platform_id)
- GAME_GENRES (id, #game_id, #genre_id)
- POSSÉDER (id, #user_id, #game_id, statut, temps_jeu, date_ajout)

### MPD (Modèle Physique de Données)
- users (PK id INT, username VARCHAR, email VARCHAR,
         password VARCHAR, role ENUM, created_at TIMESTAMP)
- games (PK id INT, title VARCHAR, description TEXT,
         cover_image VARCHAR, release_date DATE, created_at TIMESTAMP)
- genres (PK id INT, name VARCHAR)
- platforms (PK id INT, name VARCHAR)
- game_platforms (PK id INT, FK game_id INT, FK platform_id INT)
- game_genres (PK id INT, FK game_id INT, FK genre_id INT)
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
│   │   ├── PlatformModel.php           ← ✅ (findGamesCount pour protection suppression)
│   │   ├── GenreModel.php              ← ✅ (findGamesCount pour protection suppression)
│   │   ├── GameModel.php               ← ✅ (game_platforms + game_genres + GROUP_CONCAT)
│   │   └── UserGamesModel.php          ← ✅ (JOIN via game_platforms + game_genres)
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── header.php              ← ✅ stylisé (Figma + nav complète)
│   │   │   └── footer.php              ← ✅ stylisé (Figma)
│   │   ├── home/
│   │   │   └── index.php               ← ✅ stylisé (template Accueil Figma)
│   │   ├── user/
│   │   │   ├── login.php               ← ✅ stylisé
│   │   │   ├── register.php            ← ✅ stylisé
│   │   │   └── profile.php             ← ✅ stylisé (badge rôle + stats + lien collection)
│   │   ├── platform/
│   │   │   ├── index.php               ← ✅ stylisé (admin)
│   │   │   └── create.php              ← ✅ stylisé (admin)
│   │   ├── genre/
│   │   │   ├── index.php               ← ✅ stylisé (admin)
│   │   │   └── create.php              ← ✅ stylisé (admin)
│   │   ├── game/
│   │   │   ├── index.php               ← ✅ stylisé (tags plateforme/genre)
│   │   │   ├── show.php                ← ✅ (cover_image + platform_names + genre_names)
│   │   │   ├── create.php              ← ✅ redesign 2 colonnes + checkboxes
│   │   │   └── edit.php                ← ✅ redesign 2 colonnes + checkboxes pré-sélectionnés
│   │   └── collection/
│   │       └── index.php               ← ✅ stylisé (tags plateforme/genre + cover_image)
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
- games (id, title, description, cover_image, release_date, created_at)
- genres (id, name)
- platforms (id, name)
- game_platforms (id, game_id FK, platform_id FK)  ← table pivot
- game_genres (id, game_id FK, genre_id FK)         ← table pivot
- user_games (id, user_id FK, game_id FK,
              status ENUM('wish_list','playing','completed','abandoned'),
              playtime INT, added_at)

Relations :
- game_platforms : relation N-N entre games et platforms
- game_genres    : relation N-N entre games et genres
- user_games     : table pivot entre users et games (relation POSSÉDER)

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
- GROUP_CONCAT + DISTINCT dans GameModel + UserGamesModel
- COALESCE() dans getStats() pour éviter les valeurs NULL
- confirm() JS sur les suppressions
- Tags CSS distincts pour plateformes (violet) et genres (vert)
- Checkboxes scrollables pour sélection multiple plateformes/genres

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
6.  ✅ Styliser profile.php (badge rôle, stats, lien collection)
7.  ✅ Games (Model, Controller, Views)
8.  ✅ User_games / Collection
9.  ✅ Styliser pages admin (platform, genre, game/create, game/edit)
10. ✅ Migration N-N plateformes + genres (game_platforms, game_genres)
11. ✅ Cover image sur les cards et show
12. ⬜ Sécurité (non prioritaire)

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
- ✅ platform/ + genre/ stylisés
- ✅ game/ (index, show, create, edit) stylisés et fonctionnels
- ✅ collection/index.php stylisé et fonctionnel