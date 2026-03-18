<?php

namespace App\Controllers;

use App\Models\GenreModel;

class GenreController
{
    private GenreModel $genreModel;

    public function __construct()
    {
        $this->genreModel = new GenreModel();
    }

    public function index(): void
    {
        $this->requireAdmin();
        $genres = $this->genreModel->findAll();
        require_once __DIR__ . '/../Views/genre/index.php';
    }

    public function create(): void
    {
        $this->requireAdmin();
        require_once __DIR__ . '/../Views/genre/create.php';
    }

    public function store(): void
    {
        $this->requireAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $name = trim($_POST['name'] ?? '');

                if(!empty($name)){
                    $this->genreModel->create([':name' => $name]);
                }
            }
           header('Location: /gamekeeper/public/?url=genre/index');
            exit;
    }

    public function delete(): void
    {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;

        $this->genreModel->delete((int)$id);
        header('Location: /gamekeeper/public/?url=genre/index');
        exit;
    }

    private function requireAdmin(): void
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: /gamekeeper/public/?url=user/login');
            exit;
        }
    }
}