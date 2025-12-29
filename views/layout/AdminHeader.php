<?php
/** layout header dùng chung cho mọi trang admin
 *  $user: array (current logged-in user)
 *  $pageTitle: string (tiêu đề trang)
 *  $pageSub: string (mô tả ngắn)
 */
?>
<?php
require_once __DIR__ . '/../../commons/auth.php';

$user = current_user();
require_login();

// patient không được vào admin
if ($user['role'] === 'patient') {
    redirect(base_url('index.php?c=patientHome&a=index'));
}
?>

<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? 'CLINIC ADMIN') ?></title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="shell">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="brand">
                <div class="title">CLINIC ADMIN</div>
                <div class="sub">Quản lý nội trú</div>
            </div>

            <ul class="nav">

                <?php if ($user['role'] === 'admin'): ?>

                <li><a href="<?= e(base_url('index.php?c=user&a=list')) ?>">Quản lý tài khoản</a></li>
                <li><a href="<?= e(base_url('index.php?c=khoa&a=list')) ?>">Quản lý khoa</a></li>
                <li><a href="<?= e(base_url('index.php?c=phong&a=list')) ?>">Quản lý phòng</a></li>
                <li><a href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">Quản lý giường</a></li>

                <li><a href="<?= e(base_url('index.php?c=adminSchedule&a=index')) ?>">Quản lý lịch làm việc</a></li>
                <li><a href="<?= e(base_url('index.php?c=lichhen&a=my')) ?>">Lịch hẹn của tôi</a></li>
                <li><a href="<?= e(base_url('index.php?c=adminSchedule&a=index')) ?>">Set lịch bác sĩ</a></li>




                <li class="nav-sep"></li>

                <li><a href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Bệnh nhân</a></li>
                <li><a href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">Nhập viện</a></li>
                <li><a href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">Giường trống</a></li>
                <li><a href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">Điều trị</a></li>
                <li><a href="<?= e(base_url('index.php?c=xuatvien&a=list')) ?>">Xuất viện</a></li>

                <li><a href="<?= e(base_url('index.php?c=bacsi&a=manage')) ?>">Quản lý bác sĩ</a></li>
                <li><a href="<?= e(base_url('index.php?c=thongke&a=index')) ?>">Thống kê & Báo cáo</a></li>

                <?php elseif ($user['role'] === 'doctor'): ?>

                <li><a href="<?= e(base_url('index.php?c=adminSchedule&a=index')) ?>">Quản lý lịch làm việc</a></li>
                <li><a href="<?= e(base_url('index.php?c=lichhen&a=manage')) ?>">Lịch hẹn của tôi</a></li>


                <li class="nav-sep"></li>

                <li><a href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Bệnh nhân</a></li>
                <li><a href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">Điều trị</a></li>

                <li class="nav-sep"></li>

                <li><a href="<?= e(base_url('index.php?c=bacsi&a=profile')) ?>">Hồ sơ bác sĩ</a></li>

                <?php elseif (($user['role'] ?? '') === 'patient'): ?>

                <li><a href="<?= e(base_url('index.php?c=patientHome&a=index')) ?>">Trang bệnh nhân</a></li>

                <li class="nav-sep"></li>

                <li><a href="<?= e(base_url('index.php?c=bacsi&a=list')) ?>">Lịch làm việc (Bác sĩ)</a></li>
                <li><a href="<?= e(base_url('index.php?c=lichhen&a=my')) ?>">Lịch hẹn của tôi</a></li>

                <?php endif; ?>

                <li class="nav-sep"></li>
                <li><a href="<?= e(base_url('index.php?c=auth&a=logout')) ?>">Đăng xuất</a></li>

            </ul>

        </aside>

        <!-- CONTENT -->
        <div class="content">
            <header class="topbar">
                <div>
                    <div class="title"><?= e($pageTitle ?? 'CLINIC ADMIN') ?></div>
                    <?php if (!empty($pageSub)): ?>
                    <div class="sub"><?= e($pageSub) ?></div>
                    <?php else: ?>
                    <div class="sub">Hệ thống quản lý bệnh nhân nội trú</div>
                    <?php endif; ?>
                </div>

                <div class="user-box">
                    <?= e($user['role'] ?? '') ?>
                </div>
            </header>

            <main class="main">