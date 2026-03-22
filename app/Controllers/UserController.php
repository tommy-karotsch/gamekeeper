<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserGamesModel;

class UserController
{
    private UserModel $userModel;
    private UserGamesModel $userGamesModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userGamesModel = new UserGamesModel();
    }

    // Inscription
    public function register(): void
    {
        $errors = [];
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email']    ?? '');
            $password =      $_POST['password'] ?? '' ;
            $confirm  =      $_POST['confirm_password'] ?? '';

            if (empty($username)){
                $errors[] = "Le nom d'utilisateur est requis.";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "L'adresse email est invalide.";
            }
            if (strlen($password) < 8){
                $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
            }
            if ($password !== $confirm){
                $errors[] = "Les mots de passe ne correspondent pas.";
            }

            if(empty($errors)){
                    if($this->userModel->findByEmail($email)){
                        $errors[] = "Cet email est déjà utilisé.";
                    }
                    if($this->userModel->findByUsername($username)){
                        $errors[] = "Ce nom d'utilisateur est déjà utilisé.";
                    }
            }

            if(empty($errors)){
                    $this->userModel->create([
                        ':username' => $username,
                        ':email'    => $email,
                        ':password' => $password,
                    ]);
                    $success = "Inscription réussie.";
                    header('Location: /gamekeeper/public/?url=user/login');
            }
        }

        require_once __DIR__ . '/../Views/user/register.php';
    }

    // Connexion
    public function login(): void
    {
        if(isset($_SESSION['user_id'])){
            header('Location: /gamekeeper/public/?url=user/profile');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email      = trim($_POST['email']  ?? '');
            $password   =      $_POST['password'] ?? '';

            if (empty($email) || empty($password)){
                $errors[] = "Tous les champs sont requis.";
            } else{
                $user = $this->userModel->findByEmail($email);

                if(!$user || !password_verify($password, $user['password'])){
                    $errors[] = "Email ou mot de passe incorrect.";
                } else{
                    $_SESSION['user_id']  = $user ['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];
                    header('Location: /gamekeeper/public/?url=user/profile');
                    exit;
                }
            }
        }
        
        require_once __DIR__ . '/../Views/user/login.php';
    }

    // Déconnexion 
    public function logout(): void
    {
        session_destroy();
        header('Location: /gamekeeper/public/?url=user/login');
        exit;
    }


    // Profil
    public function profile(): void
    {
        $this->requireAuth();
        $errors = [];
        $success = '';
        $user   = $this->userModel->findByID($_SESSION['user_id']);
        $stats   = $this->userGamesModel->getStats($_SESSION['user_id']);
        require_once __DIR__ . '/../Views/user/profile.php';
    }

    // Modification
    public function edit(): void
    {
        $this->requireAuth();
        $errors = [];
        $success = '';
        $user = $this->userModel->findByID($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? '';

            if ($type === 'info') {
                $username = trim($_POST['username'] ?? '');
                $email    = trim($_POST['email']    ?? '');

                if (empty($username)) {
                    $errors[] = "Le nom d'utilisateur est requis.";
                }
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "L'email est invalide.";
                }

                if (empty($errors)) {
                    $existing = $this->userModel->findByUsername($username);
                    if ($existing && (int)$existing['id'] !== (int)$_SESSION['user_id']) {
                        $errors[] = "Ce nom d'utilisateur est déjà pris.";
                    }

                    $existingEmail = $this->userModel->findByEmail($email);
                    if ($existingEmail && (int)$existingEmail['id'] !== (int)$_SESSION['user_id']) {
                        $errors[] = "Cette adresse email est déjà utilisée.";
                    }

                    if (empty($errors)) {
                        $this->userModel->updateInfo($_SESSION['user_id'], [
                            ':username' => $username,
                            ':email'    => $email,
                        ]);
                        $_SESSION['username'] = $username;
                        $success = "Informations mises à jour.";
                        $user = $this->userModel->findByID($_SESSION['user_id']);
                        $stats = $this->userGamesModel->getStats($_SESSION['user_id']);
                    }
                }

            } elseif ($type === 'password') {
                $current = $_POST['current_password'] ?? '';
                $new     = $_POST['new_password']     ?? '';
                $confirm = $_POST['confirm_password'] ?? '';

                if (!password_verify($current, $user['password'])) {
                    $errors[] = "Mot de passe actuel incorrect.";
                }
                if (strlen($new) < 8) {
                    $errors[] = "Le nouveau mot de passe doit faire au moins 8 caractères.";
                }
                if ($new !== $confirm) {
                    $errors[] = "Les mots de passe ne correspondent pas.";
                }

                if (empty($errors)) {
                    $this->userModel->updatePassword($_SESSION['user_id'], $new);
                    $success = "Mot de passe mis à jour.";
                }
            }
        }

        require_once __DIR__ . '/../Views/user/profile.php';
    }

    // Suppression du compte
    public function delete(): void
    {
        $this->requireAuth();
        $errors = [];
        $success = '';
        $user = $this->userModel->findByID($_SESSION['user_id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = $_POST['password'] ?? '';

            if(!password_verify($password, $user['password'])){
                $errors[] = "Mot de passe incorrect. Suppression annulée.";
                require_once __DIR__ . '/../Views/user/profile.php';
                return;
            }

            $this->userModel->delete($_SESSION['user_id']);
            session_destroy();
            header('Location: /gamekeeper/public/?url=user/login');
            exit;
        }
    }

    // Si l'utilisateur est connecté
    private function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /gamekeeper/public/?url=user/login');
            exit;
        }
    }
}
