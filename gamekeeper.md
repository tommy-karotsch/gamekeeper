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
│   │   └── UserController.php      ← ✅
│   ├── Models/
│   │   ├── Model.php               ← ✅
│   │   └── UserModel.php           ← ✅
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── header.php          ← ✅
│   │   │   └── footer.php          ← ✅
│   │   └── user/
│   │       ├── login.php           ← ✅
│   │       ├── register.php        ← ✅
│   │       └── profile.php         ← ✅
│   └── Router.php                  ← ✅
├── config/
│   └── Database.php                ← ✅
├── public/
│   └── index.php                   ← ✅
├── assets/
│   └── css/style.css               ← ⬜ 
├── vendor/                         ← ✅ 
└── composer.json                   ← ✅

## Namespaces (composer.json)
- App\    → app/
- Config\ → config/

## Routing
URL pattern : /gamekeeper/public/?url=controller/method
- ?url=user/login     → UserController::login()
- ?url=user/register  → UserController::register()
- ?url=user/profile   → UserController::profile()
- ?url=user/edit      → UserController::edit()
- ?url=user/logout    → UserController::logout()
- ?url=user/delete    → UserController::delete()

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
- Classe abstraite Model (findAll, findByID, delete communs à tous les modèles)
- UserModel extends Model
- Config\Database avec getConnection() (singleton PDO)
- requireAuth() pour protéger les pages privées
- password_hash / password_verify pour les mots de passe
- htmlspecialchars() dans les vues (protection XSS)
- Requêtes préparées PDO (protection injection SQL)
- Champ caché name="type" pour distinguer les formulaires dans edit()

## Ordre de développement
1. ✅ composer.json
2. ✅ app/Router.php
3. ✅ public/index.php
4. ✅ Vues user/ (login, register, profile)
5. ⬜ Platforms + Genres
6. ⬜ Games
7. ⬜ User_games (collection personnelle)
8. ⬜ CSS / intégration du template Figma

## Design
- Template Figma existant (non prioritaire)

## Avancement
- ✅ BDD créée
- ✅ Structure de dossiers en place
- ✅ Composer configuré (PSR-4, autoload)
- ✅ config/Database.php
- ✅ app/Models/Model.php
- ✅ app/Models/UserModel.php
- ✅ app/Router.php
- ✅ app/Controllers/UserController.php
- ✅ public/index.php
- ✅ app/Views/user/login.php
- ✅ app/Views/user/register.php
- ✅ app/Views/user/profile.php

## À faire
- ✅ Tester toutes les fonctionnalités User en navigateur
- ⬜ assets/css/style.css
- ⬜ Intégration template Figma
- ⬜ Platforms + Genres
- ⬜ Games
- ⬜ User_games