<?php

namespace App\Models;

class UserGamesModel extends Model
{
    protected string $table = 'user_games';

    public function findByUserIDWithDetails(int $userID): array
    {
        $stmt = $this->db->prepare("
        SELECT user_games.*,
               games.title        AS game_title,
               games.cover_image  AS game_cover_imgae,
               games.release_date AS game_release_date,
               platforms.name     AS platform_name,
               genres.name        AS genre_name
        FROM user_games
        JOIN games      ON user_games.game_id   = games.id
        JOIN platforms  ON games.platform_id    = platforms.id
        JOIN genres     ON games.genre_id       = genres.id
        WHERE user_games.user_id = :user_id
        ");
        $stmt->execute([':user_id' => $userID]);
        return $stmt->fetchAll();
    }

    public function add(int $userID, int $gameID): bool 
    {
        $stmt = $this->db->prepare("
        INSERT INTO user_games (user_id, game_id)
        VALUES (:user_id, :game_id)
        ");
        return $stmt->execute([
            ':user_id' => $userID,
            ':game_id' => $gameID
        ]);
    }

    public function isInCollection(int $userID, int $gameID): bool
    {
        $stmt = $this->db->prepare("
        SELECT id FROM user_games
        WHERE user_id = :user_id AND game_id = :game_id
        ");
        $stmt->execute([':user_id' => $userID, ':game_id' => $gameID]);
        return $stmt->fetch() !== false;    
    }

    public function remove(int $userID, int $gameID): bool
    {
        $stmt = $this->db->prepare("
        DELETE FROM user_games
        WHERE user_id = :user_id AND game_id = :game_id
        ");
        return $stmt->execute([':user_id' => $userID, ':game_id' => $gameID]);
    }

    public function updateStatus(int $userID, int $gameID, string $status): bool
    {
        $stmt = $this->db->prepare("
        UPDATE user_games
        SET status = :status
        WHERE user_id = :user_id AND game_id = :game_id
        ");
        return $stmt->execute([
            ':status' => $status,
            ':user_id' => $userID,
            ':game_id' => $gameID
        ]);
    }

    public function updatePlaytime(int $userID, int $gameID, int $playtime): bool
    {
        $stmt = $this->db->prepare("
        UPDATE user_games
        SET playtime = :playtime
        WHERE user_id = :user_id AND game_id = :game_id
        ");
        return $stmt->execute([
            ':playtime' => $playtime,
            ':user_id' => $userID,
            ':game_id' => $gameID
        ]);
    }

    public function getStats(int $userID): array
    {
        $stmt = $this->db->prepare("
            SELECT
                COUNT(*)                          AS total,
                COALESCE(SUM(status = 'playing'),   0) AS playing,
                COALESCE(SUM(status = 'completed'), 0) AS completed,
                COALESCE(SUM(status = 'abandoned'), 0) AS abandoned,
                COALESCE(SUM(status = 'wish_list'), 0) AS wish_list
            FROM user_games
            WHERE user_id = :user_id
        ");
        $stmt->execute([':user_id' => $userID]);
        return $stmt->fetch();
    }
}