<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\PlatformModel;
use App\Models\GenreModel;

class HomeController
{
    private GameModel     $gameModel;
    private PlatformModel $platformModel;
    private GenreModel    $genreModel;

    public function __construct()
    {
        $this->gameModel     = new GameModel();
        $this->platformModel = new PlatformModel();
        $this->genreModel    = new GenreModel();
    }

    public function index(): void
    {
        // 6 derniers jeux ajoutés
        $recentGames = array_slice($this->gameModel->findAllWithDetails(), 0, 6);
        $platforms   = $this->platformModel->findAll();
        $genres      = $this->genreModel->findAll();

        require_once __DIR__ . '/../Views/home/index.php';
    }
}