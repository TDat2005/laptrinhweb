<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý nội trú</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>

<body>

    <div class="admin-wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h2>ADMIN</h2>
            <ul>
                <li><a href="/home">Trang chủ</a></li>
                <li><a href="/user">Quản lý tài khoản</a></li>
                <li><a href="/khoa">Quản lý khoa</a></li>
                <li><a href="/phong">Quản lý phòng</a></li>
                <li><a href="/giuong">Quản lý giường</a></li>
                <li><a href="/benhnhan">Bệnh nhân</a></li>
                <li><a href="/nhapvien">Nhập viện</a></li>
                <li><a href="/dieutri">Điều trị</a></li>
                <li><a href="/xuatvien">Xuất viện</a></li>
                <li><a href="/thongke">Thống kê</a></li>
                <li><a href="/auth/logout">Đăng xuất</a></li>
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <div class="topbar">
                <div>Hệ thống quản lý bệnh nhân nội trú</div>
                <div class="user">
                    Xin chào, <?= $_SESSION['user']['full_name'] ?? 'Admin' ?>
                </div>
            </div>

            <div class="main">