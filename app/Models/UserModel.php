<?php

namespace App\Models;

class User extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function findByUsername(string $username): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = :username"
        );
        $stmt->execute([':username' => $username]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $data[':password'] = password_hash($data[':password'], PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("
        INSERT INTO users (username, email, password)
        VALUES (:username, :email, :password
        ");
        return $stmt->execute($data);
    }

    public function updateInfo(int $id, array $data): bool
    {
        $data[':id'] = $id;
        $stmt = $this->db->prepare("
        UPDATE users
        SET username = :username,
            email = :email
        WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        $stmt = $this->db->prepare("
        UPDATE users SET password = :password WHERE id = :id 
        ");
        return $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_BCRYPT),
            ':id'       => $id,
        ]);
    }
}