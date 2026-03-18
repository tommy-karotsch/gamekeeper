<?php

namespace App\Models;

class GenreModel extends Model
{
    protected string $table = 'genres';

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
        INSERT INTO genres (name)
        VALUE (:name)
        ");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data[':id'] = $id;
        $stmt = $this->db->prepare("
        UPDATE genres
        SET name = :name
        WHERE id = :id
        ");
        return $stmt->execute($data);
    }
}