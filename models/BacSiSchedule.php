<?php
require_once __DIR__ . '/../commons/db.php';

class BacSiSchedule {

  public static function slots(): array {
    return ["08:00-09:00","09:00-10:00","10:00-11:00","11:00-12:00","13:00-14:00","14:00-15:00","15:00-16:00","16:00-17:00"];
  }

  // lấy slot active theo ngày
  public static function activeSlots(int $doctorId, string $ngay): array {
    $conn = DB::conn();
    $sql = "SELECT slot FROM bac_si_schedule
            WHERE doctor_id=? AND ngay=? AND is_active=1
            ORDER BY slot";
    $st = $conn->prepare($sql);
    $st->bind_param("is", $doctorId, $ngay);
    $st->execute();
    $res = $st->get_result()->fetch_all(MYSQLI_ASSOC);
    return array_map(fn($r)=>$r['slot'], $res);
  }

  // lưu danh sách slot active (xóa cũ -> insert mới)
  public static function save(int $doctorId, string $ngay, array $slots): void {
    $conn = DB::conn();
    $conn->begin_transaction();

    $del = $conn->prepare("DELETE FROM bac_si_schedule WHERE doctor_id=? AND ngay=?");
    $del->bind_param("is", $doctorId, $ngay);
    $del->execute();

    $ins = $conn->prepare("INSERT INTO bac_si_schedule(doctor_id, ngay, slot, is_active) VALUES(?,?,?,1)");
    foreach ($slots as $s) {
      $slot = trim($s);
      if ($slot === "") continue;
      $ins->bind_param("iss", $doctorId, $ngay, $slot);
      $ins->execute();
    }

    $conn->commit();
  }
}