<?php 

namespace App\Models;

class PlatformModel extends Model
{
    protected string $table = 'platforms';


    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
        INSERT INTO platforms (name)
        VALUES (:name)
        ");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data[':id'] = $id;
        $stmt = $this->db->prepare("
        UPDATE platforms
        SET name = :name
        WHERE id = :id
        ");
        return $stmt->execute($data);
    }
}