<?php

namespace App\Models;

class UserGamesModel extends Model
{
    protected $table = 'user_games';

    public function findByUserIDWithDetails(int $userID): array
    {
        $stmt = $this->db->prepare("
        SELECT user_games.*,
        JOIN games      ON games.title       AS        game_title,
                           games.cover_image AS games_cover_image,
                           game.release_date AS game_release_date,  
        JOIN platforms ON  platforms.name    AS    platforms_name,
        JOIN genres    ON  genres.name       AS       genres_name,
        WHERE user_games.user_id = :user_id
        ");
        $stmt->execute([':user_id' => $userID]);
        return $stmt->fetchAll();
    }

    public function add(int $userID, int $gameID): bool 
    {
        $stmt = $this->db->prepare("
        INSERT INTO user_games (user_id, game_id
        VALUES (:user_id, :game_id)
        ");
        return $stmt->execute([

        ]);
    }
}