<?php
require_once __DIR__ . '/../commons/db.php';

class User {

    // ====== LOGIN ======
    public static function findActiveByUsername(string $username): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, username, password, full_name, role, status
                FROM users
                WHERE username = ? AND status = 1
                LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row ?: null;
    }

    // ====== ADMIN CRUD ======
    public static function all(): array {
        $conn = DB::conn();
        $sql = "SELECT id, username, full_name, role, status, created_at
                FROM users
                ORDER BY id DESC";
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function findById(int $id): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, username, password, full_name, role, status, created_at
                FROM users
                WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row ?: null;
    }

    public static function existsUsername(string $username, ?int $ignoreId = null): bool {
        $conn = DB::conn();
        if ($ignoreId) {
            $sql = "SELECT 1 FROM users WHERE username = ? AND id <> ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $username, $ignoreId);
        } else {
            $sql = "SELECT 1 FROM users WHERE username = ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return (bool)$res->fetch_row();
    }

    public static function create(string $username, string $passwordHash, string $fullName, string $role, int $status = 1): bool {
        $conn = DB::conn();
        $sql = "INSERT INTO users (username, password, full_name, role, status)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $passwordHash, $fullName, $role, $status);
        return $stmt->execute();
    }

    public static function updateInfo(int $id, string $username, string $fullName, string $role, int $status): bool {
        $conn = DB::conn();
        $sql = "UPDATE users
                SET username = ?, full_name = ?, role = ?, status = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $username, $fullName, $role, $status, $id);
        return $stmt->execute();
    }

    public static function updatePassword(int $id, string $passwordHash): bool {
        $conn = DB::conn();
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $passwordHash, $id);
        return $stmt->execute();
    }

    public static function toggleStatus(int $id): bool {
        $conn = DB::conn();
        $sql = "UPDATE users
                SET status = CASE WHEN status = 1 THEN 0 ELSE 1 END
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}