<?php
require_once __DIR__ . '/../commons/db.php';

class User {
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
}