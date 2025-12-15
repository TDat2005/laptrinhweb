<?php
require_once __DIR__ . '/../commons/db.php';

class Khoa {

    public static function all(): array {
        $conn = DB::conn();
        $sql = "SELECT id, ten_khoa, mo_ta
                FROM khoa
                ORDER BY id DESC";
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function findById(int $id): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, ten_khoa, mo_ta FROM khoa WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row ?: null;
    }

    public static function existsName(string $tenKhoa, ?int $ignoreId = null): bool {
        $conn = DB::conn();
        if ($ignoreId) {
            $sql = "SELECT 1 FROM khoa WHERE ten_khoa = ? AND id <> ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $tenKhoa, $ignoreId);
        } else {
            $sql = "SELECT 1 FROM khoa WHERE ten_khoa = ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $tenKhoa);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return (bool)$res->fetch_row();
    }

    public static function create(string $tenKhoa, string $moTa): bool {
        $conn = DB::conn();
        $sql = "INSERT INTO khoa (ten_khoa, mo_ta) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $tenKhoa, $moTa);
        return $stmt->execute();
    }

    public static function update(int $id, string $tenKhoa, string $moTa): bool {
        $conn = DB::conn();
        $sql = "UPDATE khoa SET ten_khoa = ?, mo_ta = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $tenKhoa, $moTa, $id);
        return $stmt->execute();
    }

    /**
     * Xóa khoa chỉ khi không có phòng thuộc khoa đó.
     * Nếu có phòng -> trả về false.
     */
    public static function delete(int $id): bool {
        $conn = DB::conn();

        // Check ràng buộc nghiệp vụ (phòng thuộc khoa)
        $check = $conn->prepare("SELECT COUNT(*) AS cnt FROM phong WHERE id_khoa = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $cnt = $check->get_result()->fetch_assoc()['cnt'] ?? 0;

        if ((int)$cnt > 0) {
            return false;
        }

        $sql = "DELETE FROM khoa WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}