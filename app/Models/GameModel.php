<?php

namespace App\Models;

class GameModel extends Model
{
    protected string $table = 'games';

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
        INSERT INTO games (title, description, cover_image, release_date, platform_id, genre_id)
        VALUES (:title, :description, :cover_image, :release_date, :platform_id, :genre_id)
        ");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data[':id'] = $id;
        $stmt = $this->db->prepare("
        UPDATE games
        SET title       = :title,
        description     = :description,
        cover_image     = :cover_image,
        release_date    = :release_date,
        platform_id     = :platform_id,
        genre_id        = :genre_id
        WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    public function findAllWithDetails(): array
    {
        $stmt = $this->db->query("
        SELECT games.*, platforms.name AS platform_name, genres.name AS genre_name
        FROM games
        JOIN platforms ON games.platform_id = platforms.id
        JOIN genres    ON games.genre_id    = genres.id
        ");
        return $stmt->fetchAll();
    }

    public function findByIDWithDetails(int $id): array|false
    {
        $stmt = $this->db->prepare("
        SELECT games.*,
               platforms.name AS platform_name,
               genres.name    AS genre_name
        FROM games
        JOIN platforms ON games.platform_id = platforms.id
        JOIN genres    ON games.genre_id    = genres.id
        WHERE games.id = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}