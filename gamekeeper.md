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
│   │   └── UserController.php      ← ✅ propre
│   ├── Models/
│   │   ├── Model.php               ← ✅ propre
│   │   └── UserModel.php           ← ✅ propre
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── header.php          ← ✅ propre 
│   │   │   └── footer.php          ← ✅ propre 
│   │   └── user/
│   │       ├── login.php           ← ⬜ vide
│   │       ├── register.php        ← ⬜ vide
│   │       └── profile.php         ← ⬜ vide
│   └── Router.php                  ← ⬜ vide
├── config/
│   └── Database.php                ← ✅ propre
├── public/
│   └── index.php                   ← ⬜ vide
├── assets/
│   └── css/style.css               ← ⬜ vide
├── vendor/                         ← ✅ généré par Composer
└── composer.json                   ← ⬜ vide

## Namespaces (composer.json)
- App\    → app/
- Config\ → config/

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

## ⚠️ Bugs connus à corriger

### public/index.php
5. Fichier vide → point d'entrée de toute l'application, doit être rempli

## Ordre de développement
1. 🔧 Remplir public/index.php
2. 🔧 Coder les vues user/ (login, register, profile)
3. ⬜ Platforms + Genres
4. ⬜ Games
5. ⬜ User_games (collection personnelle)
6. ⬜ CSS / intégration du template Figma

## Design
- Template Figma existant (non prioritaire)

## Avancement
- ✅ BDD créée et importée
- ✅ Structure de dossiers en place
- ✅ config/Database.php — connexion PDO
- ✅ app/Models/Model.php
- ✅ app/Models/UserModel.php 
- ✅ app/Controllers/UserController.php
- ✅ Composer pas configuré (PSR-4, autoload)
- ✅ app/Router.php
- ✅ public/index.php 

## À faire
- ⬜ user/login — vides
- ⬜ user/register — vides
- ⬜ user/profile — vides