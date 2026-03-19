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

## Arborescence
gamekeeper/
├── app/
│   ├── Controllers/
│   │   ├── HomeController.php      ← ✅ 
│   │   ├── UserController.php      ← ✅ 
│   │   ├── PlatformController.php  ← ✅  (protégé admin)
│   │   └── GenreController.php     ← ✅  (protégé admin)
│   ├── Models/
│   │   ├── Model.php               ← ✅ 
│   │   ├── UserModel.php           ← ✅ 
│   │   ├── PlatformModel.php       ← ✅ 
│   │   └── GenreModel.php          ← ✅ 
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── header.php          ← ✅ stylisé (Figma)
│   │   │   └── footer.php          ← ✅ stylisé (Figma)
│   │   ├── home/
│   │   │   └── index.php           ← ✅  (template Accueil)
│   │   ├── user/
│   │   │   ├── login.php           ← ⬜ à styliser
│   │   │   ├── register.php        ← ⬜ à styliser
│   │   │   └── profile.php         ← ⬜ à styliser (template Profil)
│   │   ├── platform/
│   │   │   ├── index.php           ← ⬜ à styliser (admin)
│   │   │   └── create.php          ← ⬜ à styliser (admin)
│   │   ├── genre/
│   │   │   ├── index.php           ← ⬜ à styliser (admin)
│   │   │   └── create.php          ← ⬜ à styliser (admin)
│   │   ├── game/                   ← ⬜ à créer
│   │   │   ├── index.php
│   │   │   ├── show.php
│   │   │   ├── create.php          ← admin
│   │   │   └── edit.php            ← admin
│   │   └── collection/             ← ⬜ à créer
│   │       └── index.php           ← template Collection
│   └── Router.php                  ← ✅ 
├── config/
│   └── Database.php                ← ✅ 
├── public/
│   └── index.php                   ← ✅ 
├── assets/
│   ├── css/
│   │   └── style.css               ← ✅ stylisé (variables Figma)
│   └── img/
│       └── logo-manette.png        ← ⬜ à télécharger depuis Figma
├── vendor/                         ← ✅ généré par Composer
└── composer.json                   ← ✅ 

## Namespaces (composer.json)
- App\    → app/
- Config\ → config/

## Routing
URL pattern : /gamekeeper/public/?url=controller/method
- ?url=                   → HomeController::index()   (défaut)
- ?url=user/login         → UserController::login()
- ?url=user/register      → UserController::register()
- ?url=user/profile       → UserController::profile()
- ?url=user/edit          → UserController::edit()
- ?url=user/logout        → UserController::logout()
- ?url=user/delete        → UserController::delete()
- ?url=platform/index     → PlatformController::index()
- ?url=platform/create    → PlatformController::create()
- ?url=platform/store     → PlatformController::store()
- ?url=platform/delete    → PlatformController::delete()
- ?url=genre/index        → GenreController::index()
- ?url=genre/create       → GenreController::create()
- ?url=genre/store        → GenreController::store()
- ?url=genre/delete       → GenreController::delete()

## Base de données
Tables :
- users (id, username, email, password, role ENUM('user','admin'), created_at)
- games (id, title, description, cover_image, release_date, platform_id, genre_id, created_at)
- genres (id, name)
- platforms (id, name)
- user_games (id, user_id, game_id, status ENUM('wish_list','playing','completed','abandoned'), playtime, added_at)

Relations :
- user_games est la table pivot entre users et games
- games dépend de platforms et genres (FK)

## Patterns utilisés
- Classe abstraite Model (findAll, findByID, delete communs)
- UserModel / PlatformModel / GenreModel extends Model
- Config\Database avec getConnection() (singleton PDO)
- requireAuth() dans UserController (pages connectées)
- requireAdmin() dans PlatformController + GenreController
- password_hash / password_verify pour les mots de passe
- htmlspecialchars() dans toutes les vues (XSS)
- Requêtes préparées PDO (injection SQL)
- Champ caché name="type" pour distinguer les formulaires dans edit()
- header.php / footer.php inclus dans chaque vue via require_once

## Design (Figma)
Lien : https://www.figma.com/design/UBlKscbthjtT5a8tB3uDS3/GameKeeper

Couleurs :
- --vert-accent      : #39D979
- --blanc            : #FFFFFF
- --header-gradient  : linear-gradient(90deg, rgb(61,30,102) → rgb(122,60,204))
- --footer-gradient  : linear-gradient(90deg, rgb(122,60,204) → rgb(61,30,102))

Polices :
- Kanit    → logo "GameKeeper"
- Poppins  → textes, navigation

Templates Figma → Pages :
- Index/Accueil  → home/index.php ✅, login.php, register.php
- Collection     → game/index.php, collection/index.php
- Profil         → user/profile.php

## Ordre de développement
1. ✅ User (register, login, profile, edit, logout, delete)
2. ✅ Platform + Genre (CRUD admin, protégé requireAdmin)
3. ✅ Intégration Figma — layout (header, footer, style.css)
4. ✅ Page d'accueil (home/index.php)
5. 🔧 Styliser login.php et register.php
6. ⬜ Games (Model, Controller, Views)
7. ⬜ User_games / Collection
8. ⬜ Styliser profile.php (template Profil Figma)
9. ⬜ Styliser collection/index.php (template Collection Figma)
10. ⬜ Styliser pages admin (platform, genre, game/create, game/edit)

## Avancement
- ✅ BDD créée et importée
- ✅ Composer configuré (PSR-4, autoload)
- ✅ config/Database.php
- ✅ app/Models/ (Model, UserModel, PlatformModel, GenreModel)
- ✅ app/Controllers/ (HomeController, UserController, PlatformController, GenreController)
- ✅ app/Router.php
- ✅ public/index.php
- ✅ assets/css/style.css (variables Figma)
- ✅ layout/header.php + footer.php (stylisés)
- ✅ home/index.php
- ✅ user/ (login, register, profile) — fonctionnels, pas encore stylisés
- ✅ platform/ + genre/ (index, create) — fonctionnels, pas encore stylisés
- ⬜ Télécharger logo-manette.png depuis Figma
- ⬜ game/ (index, show, create, edit)
- ⬜ collection/index.php