<?php
require_once __DIR__ . '/../commons/db.php';

class Phong {

    public static function allWithKhoa(): array {
        $conn = DB::conn();
        $sql = "SELECT p.id, p.ten_phong, p.loai_phong, p.id_khoa, p.ghi_chu,
                       k.ten_khoa
                FROM phong p
                JOIN khoa k ON p.id_khoa = k.id
                ORDER BY p.id DESC";
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function findById(int $id): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, ten_phong, loai_phong, id_khoa, ghi_chu
                FROM phong
                WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row ?: null;
    }

    public static function create(string $tenPhong, string $loaiPhong, int $idKhoa, string $ghiChu): bool {
        $conn = DB::conn();
        $sql = "INSERT INTO phong (ten_phong, loai_phong, id_khoa, ghi_chu)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $tenPhong, $loaiPhong, $idKhoa, $ghiChu);
        return $stmt->execute();
    }

    public static function update(int $id, string $tenPhong, string $loaiPhong, int $idKhoa, string $ghiChu): bool {
        $conn = DB::conn();
        $sql = "UPDATE phong
                SET ten_phong = ?, loai_phong = ?, id_khoa = ?, ghi_chu = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $tenPhong, $loaiPhong, $idKhoa, $ghiChu, $id);
        return $stmt->execute();
    }

    /**
     * Xóa phòng chỉ khi phòng không có giường.
     */
    public static function delete(int $id): bool {
        $conn = DB::conn();

        $check = $conn->prepare("SELECT COUNT(*) AS cnt FROM giuong WHERE id_phong = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $cnt = $check->get_result()->fetch_assoc()['cnt'] ?? 0;

        if ((int)$cnt > 0) return false;

        $sql = "DELETE FROM phong WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public static function allForSelect(): array {
    $conn = DB::conn();
    $sql = "SELECT p.id, p.ten_phong, p.id_khoa, k.ten_khoa
            FROM phong p
            JOIN khoa k ON p.id_khoa = k.id
            ORDER BY k.ten_khoa ASC, p.ten_phong ASC";
    $res = $conn->query($sql);
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}
public static function byKhoa(int $idKhoa): array {
    $conn = DB::conn();
    $sql = "SELECT id, ten_phong
            FROM phong
            WHERE id_khoa = ?
            ORDER BY ten_phong ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idKhoa);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}

}