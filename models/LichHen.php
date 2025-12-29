<?php
require_once __DIR__ . '/../commons/db.php';

class LichHen {

  public static function bookedSlots(int $doctorId, string $ngay): array {
    $conn = DB::conn();
    $sql = "SELECT slot FROM lich_hen
            WHERE doctor_id=? AND ngay=? AND trang_thai IN ('cho_xac_nhan','da_xac_nhan')
            ORDER BY slot";
    $st = $conn->prepare($sql);
    $st->bind_param("is", $doctorId, $ngay);
    $st->execute();
    $res = $st->get_result()->fetch_all(MYSQLI_ASSOC);
    return array_map(fn($r)=>$r['slot'], $res);
  }

  public static function create(array $p): bool {
    $conn = DB::conn();
    $sql = "INSERT INTO lich_hen
            (patient_id, doctor_id, ngay, slot, ho_ten, sdt, email, dia_chi, ly_do_kham, ngay_sinh, gioi_tinh, trang_thai)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,'cho_xac_nhan')";
    $st = $conn->prepare($sql);
    $st->bind_param(
      "iisssssssss",
      $p['patient_id'], $p['doctor_id'], $p['ngay'], $p['slot'],
      $p['ho_ten'], $p['sdt'], $p['email'], $p['dia_chi'], $p['ly_do_kham'], $p['ngay_sinh'], $p['gioi_tinh']
    );
    return $st->execute();
  }
  public static function my(int $patientId): array {
    $conn = DB::conn();
    $sql = "SELECT lh.id, lh.ngay, lh.slot, lh.ho_ten, lh.sdt, lh.email, lh.trang_thai, lh.created_at,
                   d.full_name AS ten_bac_si,
                   p.chuyen_khoa, p.gia_kham, p.benh_vien, p.tinh_thanh
            FROM lich_hen lh
            JOIN users d ON lh.doctor_id = d.id
            LEFT JOIN bac_si_profile p ON p.user_id = d.id
            WHERE lh.patient_id = ?
            ORDER BY lh.created_at DESC";
    $st = $conn->prepare($sql);
    $st->bind_param("i", $patientId);
    $st->execute();
    $res = $st->get_result();
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}
public static function findById(int $id): ?array {
    $conn = DB::conn();
    $sql = "SELECT * FROM lich_hen WHERE id=? LIMIT 1";
    $st = $conn->prepare($sql);
    $st->bind_param("i", $id);
    $st->execute();
    $row = $st->get_result()->fetch_assoc();
    return $row ?: null;
}

public static function cancelByPatient(int $id, int $patientId): bool {
  $conn = DB::conn();

  $sql = "DELETE FROM lich_hen
          WHERE id=? AND patient_id=?
            AND trang_thai IN ('cho_xac_nhan','da_xac_nhan')";

  $st = $conn->prepare($sql);
  $st->bind_param("ii", $id, $patientId);

  return $st->execute() && $st->affected_rows > 0;
}


public static function listForDoctor(int $doctorId): array {
    $conn = DB::conn();
    $sql = "SELECT lh.*, u.full_name AS ten_benh_nhan
            FROM lich_hen lh
            JOIN users u ON lh.patient_id = u.id
            WHERE lh.doctor_id=?
            ORDER BY lh.created_at DESC";
    $st = $conn->prepare($sql);
    $st->bind_param("i", $doctorId);
    $st->execute();
    $res = $st->get_result();
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}

public static function listAll(): array {
    $conn = DB::conn();
    $sql = "SELECT lh.*,
                   p.full_name AS ten_benh_nhan,
                   d.full_name AS ten_bac_si
            FROM lich_hen lh
            JOIN users p ON lh.patient_id = p.id
            JOIN users d ON lh.doctor_id = d.id
            ORDER BY lh.created_at DESC";
    $res = $conn->query($sql);
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}

public static function updateStatus(int $id, string $status): bool {
    $allow = ['cho_xac_nhan','da_xac_nhan','da_huy','da_kham'];
    if (!in_array($status, $allow, true)) return false;

    $conn = DB::conn();
    $sql = "UPDATE lich_hen SET trang_thai=? WHERE id=?";
    $st = $conn->prepare($sql);
    $st->bind_param("si", $status, $id);
    return $st->execute();
}

}