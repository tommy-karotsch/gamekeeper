<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Inscription

    public function register(): void
    {
        $errors = [];
        $succes = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email']    ?? '');
            $password =      $_POST['password'] ?? '' ;
            $confirm  =      $_POST['confirm_password'] ?? '';

            if (empty($username)){
                $errors[] = "Le nom d'utilisateur est requis.";
            }
            if (empty($email)){
                $errors[] = "L'adreese email est invalide.";
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
                    $succes = "Inscription réussie.";
            }
        }

        require_once __DIR__ . '/../Views/user/register.php';
    }


    // Connexion

    public function login(): void
    {
        if(isset($_SESSION['user_id'])){
            header('Location: /gamekeepe/public/?url=user/profile');
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
                    header('Location:/gamekeeper/public/?url=user/profile');
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
        $succes = '';
        $user   = $this->userModel->findByID($_SESSION['user_id']);
        require_once __DIR__ . '/../Views/user/profile.php';
    }

    // Modification

    public function edit():void
    {
        $this->requireAuth();
        $errors = [];
        $succes = '';
        $user   = $this->userModel->findByID($_SESSION['user_id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $type = $_POST['type'] ?? '';

            if($type === 'info'){
                $username = trim($_POST['username'] ?? '');
                $email    = trim($_POST['email']    ?? '');

                if (empty($username)){
                    $errors[] = "Le nom d'utilisateur est requis."; 
                }
                if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors[] = "L'email est invalide.";
                }

                if(empty($errors)){
                    $existing = $this->userModel->findByUsername($username);
                    if($existing && (int)$existing['id'] !== (int)$_SESSION['user_id']){
                        $errors[] = "Ce nom d'utilisateur est déjà pris.";

                    $existingEmail = $this->userModel->findByEmail($email);
                    if($existingEmail && (int)$existingEmail['id'] !== (int)$_SESSION['user_id']){
                        $errors[] = "Cette adresse email est déjà utilisé.";
                    }

                    }
                }
            }
        }
    }
}