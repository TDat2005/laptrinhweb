
<?php /** @var array $user */ ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>

<body>
    <h2>Xin chào, <?= e($user['full_name']) ?> (<?= e($user['role']) ?>)</h2>

    <ul>
        <li><a href="<?= e(base_url('index.php?c=auth&a=logout')) ?>">Đăng xuất</a></li>
        <li><a href="<?= e(base_url('index.php?c=khoa&a=list')) ?>">Quản lý khoa</a> (chưa làm)</li>
        <li><a href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Quản lý bệnh nhân</a> </li>
        <li><a href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">Tiếp nhận / Nhập viện</a> </li>
        <li><a href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">Bệnh nhân đang điều trị</a> </li>
    </ul>
</body>

</html>