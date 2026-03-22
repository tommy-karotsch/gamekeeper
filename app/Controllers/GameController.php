<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\PlatformModel;
use App\Models\GenreModel;

class GameController
{
    private GameModel       $gameModel;
    private PlatformModel   $platformModel;
    private GenreModel      $genreModel;

    public function __construct()
    {
        $this->gameModel     = new GameModel();
        $this->platformModel = new PlatformModel();
        $this->genreModel    = new GenreModel();
    }

    public function index(): void
    {
        $games = $this->gameModel->findAllWithDetails();
        require_once __DIR__ . '/../Views/game/index.php';
    }

    public function show(): void
    {
        $id   = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /gamekeeper/public/?url=game/index');
            exit;
        }

        $game = $this->gameModel->findByIDWithDetails((int)$id);

        if (!$game) {
            header('Location: /gamekeeper/public/?url=game/index');
            exit;
        }

        require_once __DIR__ . '/../Views/game/show.php';
    }
    public function create(): void 
    {
        $this->requireAdmin();
        $platforms = $this->platformModel->findAll();
        $genres = $this->genreModel->findAll();
        require_once __DIR__ . '/../Views/game/create.php';
    }

    public function store(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $platformIds = $_POST['platform_ids'] ?? [];
            $genreIds    = $_POST['genre_ids']    ?? [];

            $this->gameModel->create([
                ':title'        => trim($_POST['title']        ?? ''),
                ':description'  => trim($_POST['description']  ?? ''),
                ':cover_image'  => trim($_POST['cover_image']  ?? ''),
                ':release_date' => trim($_POST['release_date'] ?? ''),
            ]);

            $gameId = $this->gameModel->getLastInsertId();

            foreach ($platformIds as $platformId) {
                $this->gameModel->addPlatform($gameId, (int)$platformId);
            }
            foreach ($genreIds as $genreId) {
                $this->gameModel->addGenre($gameId, (int)$genreId);
            }
        }

        header('Location: /gamekeeper/public/?url=game/index');
        exit;
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $id         = $_GET['id'] ?? null;
        $game       = $this->gameModel->findByID((int)$id);
        $platforms  = $this->platformModel->findAll();
        $genres     = $this->genreModel->findAll();
        require_once __DIR__ . '/../Views/game/edit.php';
    }

    public function update(): void
    {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $platformIds = $_POST['platform_ids'] ?? [];
            $genreIds    = $_POST['genre_ids']    ?? [];

            $this->gameModel->update((int)$id, [
                ':title'        => trim($_POST['title']        ?? ''),
                ':description'  => trim($_POST['description']  ?? ''),
                ':cover_image'  => trim($_POST['cover_image']  ?? ''),
                ':release_date' => trim($_POST['release_date'] ?? ''),
            ]);

            $this->gameModel->deletePlatforms((int)$id);
            foreach ($platformIds as $platformId) {
                $this->gameModel->addPlatform((int)$id, (int)$platformId);
            }

            $this->gameModel->deleteGenres((int)$id);
            foreach ($genreIds as $genreId) {
                $this->gameModel->addGenre((int)$id, (int)$genreId);
            }
        }

        header('Location: /gamekeeper/public/?url=game/index');
        exit;
    }
    
    public function delete(): void
    {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->gameModel->deleteFromCollection((int)$id);
            $this->gameModel->deletePlatforms((int)$id);
            $this->gameModel->deleteGenres((int)$id);
            $this->gameModel->delete((int)$id);
        }

        header('Location: /gamekeeper/public/?url=game/index');
        exit;
    }
    private function requireAdmin(): void
    {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
            header('Location: /gamekeeper/public/?url=user/login');
            exit;
        }
    }
}