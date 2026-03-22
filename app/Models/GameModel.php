<?php

namespace App\Models;

class GameModel extends Model
{
    protected string $table = 'games';

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO games (title, description, cover_image, release_date)
            VALUES (:title, :description, :cover_image, :release_date)
        ");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data[':id'] = $id;
        $stmt = $this->db->prepare("
            UPDATE games
            SET title        = :title,
                description  = :description,
                cover_image  = :cover_image,
                release_date = :release_date
            WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    public function getLastInsertId(): int
    {
        return (int)$this->db->lastInsertId();
    }

    public function addPlatform(int $gameId, int $platformId): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO game_platforms (game_id, platform_id)
            VALUES (:game_id, :platform_id)
        ");
        return $stmt->execute([
            ':game_id'     => $gameId,
            ':platform_id' => $platformId
        ]);
    }

    public function deletePlatforms(int $gameId): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM game_platforms WHERE game_id = :game_id
        ");
        return $stmt->execute([':game_id' => $gameId]);
    }

    public function addGenre(int $gameId, int $genreId): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO game_genres (game_id, genre_id)
            VALUES (:game_id, :genre_id)
        ");
        return $stmt->execute([
            ':game_id'  => $gameId,
            ':genre_id' => $genreId
        ]);
    }

    public function deleteGenres(int $gameId): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM game_genres WHERE game_id = :game_id
        ");
        return $stmt->execute([':game_id' => $gameId]);
    }

    public function findAllWithDetails(): array
    {
        $stmt = $this->db->query("
            SELECT games.*,
                GROUP_CONCAT(DISTINCT platforms.name ORDER BY platforms.name SEPARATOR ', ')
                    AS platform_names,
                GROUP_CONCAT(DISTINCT genres.name ORDER BY genres.name SEPARATOR ', ')
                    AS genre_names
            FROM games
            LEFT JOIN game_platforms ON games.id = game_platforms.game_id
            LEFT JOIN platforms      ON game_platforms.platform_id = platforms.id
            LEFT JOIN game_genres    ON games.id = game_genres.game_id
            LEFT JOIN genres         ON game_genres.genre_id = genres.id
            GROUP BY games.id
        ");
        return $stmt->fetchAll();
    }

    public function findByIDWithDetails(int $id): array|false
    {
        $stmt = $this->db->prepare("
            SELECT games.*,
                GROUP_CONCAT(DISTINCT platforms.name ORDER BY platforms.name SEPARATOR ', ')
                    AS platform_names,
                GROUP_CONCAT(DISTINCT platforms.id ORDER BY platforms.id SEPARATOR ',')
                    AS platform_ids,
                GROUP_CONCAT(DISTINCT genres.name ORDER BY genres.name SEPARATOR ', ')
                    AS genre_names,
                GROUP_CONCAT(DISTINCT genres.id ORDER BY genres.id SEPARATOR ',')
                    AS genre_ids
            FROM games
            LEFT JOIN game_platforms ON games.id = game_platforms.game_id
            LEFT JOIN platforms      ON game_platforms.platform_id = platforms.id
            LEFT JOIN game_genres    ON games.id = game_genres.game_id
            LEFT JOIN genres         ON game_genres.genre_id = genres.id
            WHERE games.id = :id
            GROUP BY games.id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function deleteFromCollection(int $gameId): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM user_games WHERE game_id = :game_id
        ");
        return $stmt->execute([':game_id' => $gameId]);
    }
}