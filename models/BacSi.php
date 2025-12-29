<?php
require_once __DIR__ . '/../commons/db.php';

class BacSi {

  public static function all(): array {
  $conn = DB::conn();
  $sql = "SELECT u.id, u.full_name, u.username,
                 p.chuyen_khoa, p.gia_kham, p.benh_vien, p.phong_kham, p.tinh_thanh,
                 p.phuong_thuc_tt, p.gioi_thieu_ngan, p.mo_ta_chi_tiet, p.anh_dai_dien
          FROM users u
          LEFT JOIN bac_si_profile p ON p.user_id = u.id
          WHERE u.role='doctor' AND u.status=1
          ORDER BY u.full_name";
  $res = $conn->query($sql);
  return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}


  public static function find(int $id): ?array {
    $conn = DB::conn();
    $sql = "SELECT u.id, u.full_name,
                   p.chuyen_khoa, p.gia_kham, p.benh_vien, p.phong_kham, p.tinh_thanh,
                   p.gioi_thieu_ngan, p.mo_ta_chi_tiet, p.anh_dai_dien
            FROM users u
            LEFT JOIN bac_si_profile p ON p.user_id = u.id
            WHERE u.id=? AND u.role='doctor' LIMIT 1";
    $st = $conn->prepare($sql);
    $st->bind_param("i", $id);
    $st->execute();
    $row = $st->get_result()->fetch_assoc();
    return $row ?: null;
  }
  public static function updateProfile(int $userId, array $p): bool {
    $conn = DB::conn();

    // kiểm tra đã có profile chưa
    $check = $conn->prepare("SELECT id FROM bac_si_profile WHERE user_id=?");
    $check->bind_param("i", $userId);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();

    if ($exists) {
        // UPDATE
        $sql = "UPDATE bac_si_profile SET
            chuyen_khoa=?,
            gia_kham=?,
            benh_vien=?,
            phong_kham=?,
            tinh_thanh=?,
            phuong_thuc_tt=?,
            gioi_thieu_ngan=?,
            mo_ta_chi_tiet=?,
            anh_dai_dien=?
            WHERE user_id=?";
        $st = $conn->prepare($sql);
        $st->bind_param(
            "sisssssssi",
            $p['chuyen_khoa'],
            $p['gia_kham'],
            $p['benh_vien'],
            $p['phong_kham'],
            $p['tinh_thanh'],
            $p['phuong_thuc_tt'],
            $p['gioi_thieu_ngan'],
            $p['mo_ta_chi_tiet'],
            $p['anh_dai_dien'],
            $userId
        );
    } else {
        // INSERT
        $sql = "INSERT INTO bac_si_profile
            (user_id, chuyen_khoa, gia_kham, benh_vien, phong_kham, tinh_thanh,
             phuong_thuc_tt, gioi_thieu_ngan, mo_ta_chi_tiet, anh_dai_dien)
            VALUES (?,?,?,?,?,?,?,?,?,?)";
        $st = $conn->prepare($sql);
        $st->bind_param(
            "isisssssss",
            $userId,
            $p['chuyen_khoa'],
            $p['gia_kham'],
            $p['benh_vien'],
            $p['phong_kham'],
            $p['tinh_thanh'],
            $p['phuong_thuc_tt'],
            $p['gioi_thieu_ngan'],
            $p['mo_ta_chi_tiet'],
            $p['anh_dai_dien']
        );
    }

    return $st->execute();
}

}