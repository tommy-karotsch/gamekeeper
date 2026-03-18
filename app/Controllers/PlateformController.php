<?php 

namespace App\Controllers;

use App\Models\PlatformModel;

class PlateformController
{
    private PlatformModel $platformModel;

    public function __construct()
    {
        $this->platformModel = new PlatformModel();
    }

    public function index(): void
    {
        $platforms = $this->platformModel->findAll();
        require_once __DIR__ . '/../Views/platform/index.php';
    }

    public function create(): void
    {
        require_once __DIR__ . '../Views/platform/create.php';
    }

    public function store(): void
    {
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
        $id = $_GET['id'] ?? null;

        $this->platformModel->delete((int)$id);
        header('Location: /gamekeeper/public/?url=platform/index');
        exit;
    }
}