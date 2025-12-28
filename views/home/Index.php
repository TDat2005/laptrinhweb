<?php /** @var array $user */ ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">

</head>

<body>
    <div class="shell">

        <aside class="sidebar">
            <div class="brand">
                <div class="title">CLINIC ADMIN</div>
                <div class="sub">Quản lý nội trú</div>
            </div>

            <ul class="nav">
                <li><a href="<?= e(base_url('index.php?c=user&a=list')) ?>">Quản lý tài khoản</a></li>
                <li><a href="<?= e(base_url('index.php?c=khoa&a=list')) ?>">Quản lý khoa</a></li>
                <li><a href="<?= e(base_url('index.php?c=phong&a=list')) ?>">Quản lý phòng</a></li>
                <li><a href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">Quản lý giường</a></li>


                <li><a href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Bệnh nhân</a></li>
                <li><a href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">Nhập viện</a></li>
                <li><a href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">Giường trống</a></li>

                <li class="nav-sep"></li>
                <li><a href="<?= e(base_url('index.php?c=auth&a=logout')) ?>">Đăng xuất</a></li>
            </ul>
        </aside>

        <div class="content">
            <header class="topbar">
                <div>
                    <div class="title">Xin chào, <?= e($user['full_name']) ?></div>
                    <div class="sub">Hệ thống quản lý bệnh nhân nội trú</div>
                </div>
                <div class="user-box"><?= e($user['role']) ?></div>
            </header>

            <main class="main">
                <div class="card">
                    <div class="label">Dashboard</div>
                    <div class="value">Chọn chức năng ở menu bên trái để thao tác.</div>
                </div>
            </main>
        </div>

    </div>

    </main>
    </div>

    </div>

</body>

</html>