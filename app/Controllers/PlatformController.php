<?php 

namespace App\Controllers;

use App\Models\PlatformModel;

class PlatformController
{
    private PlatformModel $platformModel;

    public function __construct()
    {
        $this->platformModel = new PlatformModel();
    }

    public function index(): void
    {
        $this->requireAdmin();
        $platforms = $this->platformModel->findAll();
        require_once __DIR__ . '/../Views/platform/index.php';
    }

    public function create(): void
    {
        $this->requireAdmin();
        require_once __DIR__ . '/../Views/platform/create.php';
    }

    public function store(): void
    {
        $this->requireAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $name = trim($_POST['name'] ?? '');

                if(!empty($name)){
                    $this->platformModel->create([':name' => $name]);
                }
            }
            header('Location: /gamekeeper/public/?url=platform/index');
            exit;
    }
    
    public function delete(): void
    {
        $this->requireAdmin();
        $id        = $_GET['id'] ?? null;
        $errors    = [];
        $platforms = $this->platformModel->findAll();

        if ($id) {
            // Vérifie si des jeux utilisent cette plateforme
            $games = $this->platformModel->findGamesCount((int)$id);

            if ($games > 0) {
                $errors[] = "Impossible de supprimer cette plateforme car elle est utilisée par $games jeu(x).";
                require_once __DIR__ . '/../Views/platform/index.php';
                return;
            }

            $this->platformModel->delete((int)$id);
        }

        header('Location: /gamekeeper/public/?url=platform/index');
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