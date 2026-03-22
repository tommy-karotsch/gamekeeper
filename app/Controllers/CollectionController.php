<?php

namespace App\Controllers;

use App\Models\UserGamesModel;
use App\Models\GameModel;

class CollectionController
{
    private UserGamesModel $userGamesModel;
    private GameModel      $gameModel;

    public function __construct()
    {
        $this->userGamesModel = new UserGamesModel();
        $this->gameModel      = new GameModel();
    }

    public function index(): void
    {
        $this->requireAuth();
        $userID = $_SESSION['user_id'];
        $games  = $this->userGamesModel->findByUserIDWithDetails($userID);
        $stats  = $this->userGamesModel->getStats($userID);
        require_once __DIR__ . '/../Views/collection/index.php';
    }

    public function add(): void
    {
        $this->requireAuth();
        $gameID = $_GET['game_id'] ?? null;
        $userID = $_SESSION['user_id'];

        if($gameID){
            if(!$this->userGamesModel->isInCollection($userID, (int)$gameID)){
                $this->userGamesModel->add($userID, (int)$gameID);
            }
        }
        header('Location: /gamekeeper/public/?url=game/index');
        exit;
    }

    public function remove(): void
    {
        $this->requireAuth();
        $gameID = $_GET['game_id'] ?? null;
        $userID = $_SESSION['user_id'];

        if($gameID){
            $this->userGamesModel->remove($userID, (int)$gameID);
        }
        header('Location: /gamekeeper/public/?url=collection/index');
        exit;
    }

    public function updateStatus(): void
    {
        $this->requireAuth();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $gameID = $_POST['game_id'] ?? null,
            $status = $_POST['status']  ?? null,
            $userID = $_SESSION['user_id'],

            $allowedStatues = ['wish_list', 'playing', 'completed', 'abandoned'];

            if($agemID && $status && in_array($status, $allowedStatues)){
                $this->userGamesModel->updateStatus($userID, (int)$gameID, $status);
            }
        }
        header('Location: /gamekeeper/public/?url=collection/index');
        exit;
    }

    public function updatePlaytime(): void
    {
        $this->requireAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $gameID    = $_POST['game_id'] ?? null,
            $playtime  = $_POST['playtime'] ?? null,
            $userID    = $_SESSION['user_id'];

            if($gameID && is_numeric($playtime) && $playtime >= 0){
                $this->userGameModel->updatePlaytime($userID, (int)$gameID, (int)$playtime);
            }
        }
        header('Location: /gamekeeper/public/?url=collection/index');
        exit;
    }

    private function requireAuth(): void
    {
        if(!isset($_SESSION['user_id'])){
            header('Location: /gamekeeper/public/?url=user/login');
            exit;
        }
    }
}