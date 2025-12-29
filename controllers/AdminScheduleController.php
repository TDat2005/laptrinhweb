<?php
require_once __DIR__ . '/../models/BacSi.php';
require_once __DIR__ . '/../models/BacSiSchedule.php';

class AdminScheduleController {

  public function index(): void {
    require_role(['admin','doctor']);
    $title = "Quản lý kế hoạch khám";
    $doctors = BacSi::all();

    $doctorId = (int)($_GET['doctor_id'] ?? ($doctors[0]['id'] ?? 0));
    $ngay = $_GET['ngay'] ?? date('Y-m-d');

    $activeSlots = ($doctorId>0) ? BacSiSchedule::activeSlots($doctorId, $ngay) : [];
    $allSlots = BacSiSchedule::slots();

    render('admin/schedule', [
      'title'=>$title,
      'doctors'=>$doctors,
      'doctorId'=>$doctorId,
      'ngay'=>$ngay,
      'allSlots'=>$allSlots,
      'activeSlots'=>$activeSlots,
    ]);
  }

  public function save(): void {
    require_role(['admin','doctor']);
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo "Method not allowed"; return; }

    $doctorId = (int)($_POST['doctor_id'] ?? 0);
    $ngay = $_POST['ngay'] ?? date('Y-m-d');
    $slots = $_POST['slots'] ?? [];

    if ($doctorId<=0) { echo "Thiếu bác sĩ"; return; }

    BacSiSchedule::save($doctorId, $ngay, $slots);
    $_SESSION['flash_success'] = "Đã lưu lịch khám.";

    header("Location: index.php?c=adminSchedule&a=index&doctor_id={$doctorId}&ngay={$ngay}");
    exit;
  }
  public function slots(): void {
  require_role(['admin','doctor']);

  $doctorId = (int)($_GET['doctor_id'] ?? 0);
  $ngay = $_GET['ngay'] ?? date('Y-m-d');

  $active = ($doctorId>0) ? BacSiSchedule::activeSlots($doctorId, $ngay) : [];

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['active'=>$active], JSON_UNESCAPED_UNICODE);
  exit;
}

}