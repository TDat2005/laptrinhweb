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
        <!-- SIDEBAR giữ như mày đang làm -->
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


                <li><a class="quick" href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Bệnh nhân</a></li>
                <li><a class="quick" href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">Nhập viện</a></li>
                <li><a class="quick" href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">Giường trống</a></li>
                <li><a class="quick" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">Điều trị</a></li>
                <?php if ($user['role'] === 'admin'): ?>
                <li class="nav-sep"></li>
                <li><a href="<?= e(base_url('index.php?c=thongke&a=index')) ?>">Thống kê & Báo cáo</a></li>
                <?php endif; ?>

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
                <section class="banner">
                    <div class="banner-bg"></div>

                    <div class="banner-content">
                        <h1>Nền tảng quản lý nội trú</h1>
                        <p>
                            Hệ thống quản lý bệnh nhân nội trú toàn diện:
                            nhập viện – điều trị – xuất viện – giường – khoa – phòng.
                        </p>

                        <div class="banner-actions">
                            <a href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Bệnh nhân</a>
                            <a class="alt" href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">Nhập viện</a>
                            <a class="alt" href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">Giường trống</a>
                        </div>
                    </div>
                </section>

                <!-- HERO như vibe Booking Clinic -->
                <section class="hero">
                    <div class="hero-top">
                        <div>
                            <h1>Nền tảng nội trú — quản lý điều trị toàn diện</h1>
                            <p>
                                Tìm nhanh chức năng theo nghiệp vụ: bệnh nhân, nhập viện, giường trống, điều trị và xuất
                                viện.
                                Giao diện gọn – rõ – đúng quy trình.
                            </p>
                        </div>

                        <div class="search">
                            <input placeholder="Tìm chức năng… (ví dụ: bệnh nhân, giường, khoa)">
                            <span class="chip">Search</span>
                        </div>
                    </div>

                    <!-- quick actions dạng icon -->
                    <div class="quickbar">
                        <a class="qitem" href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">
                            <div class="qicon">BN</div>
                            <div class="t">Bệnh nhân</div>
                        </a>
                        <a class="qitem" href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">
                            <div class="qicon">NV</div>
                            <div class="t">Nhập viện</div>
                        </a>
                        <a class="qitem" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">
                            <div class="qicon">DT</div>
                            <div class="t">Điều trị</div>
                        </a>
                        <a class="qitem" href="<?= e(base_url('index.php?c=xuatvien&a=list')) ?>">
                            <div class="qicon">XV</div>
                            <div class="t">Xuất viện</div>
                        </a>
                        <a class="qitem" href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">
                            <div class="qicon">G</div>
                            <div class="t">Giường</div>
                        </a>
                        <a class="qitem" href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">
                            <div class="qicon">Ø</div>
                            <div class="t">Giường trống</div>
                        </a>
                    </div>
                </section>

                <!-- SECTION giống vibe ảnh (cards) -->
                <section class="section">
                    <div class="section-head">
                        <div class="section-title">Nghiệp vụ phổ biến</div>
                        <a class="section-more" href="<?= e(base_url('index.php')) ?>">Xem thêm</a>
                    </div>

                    <div class="cards">
                        <a class="cardx" href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">
                            <div class="thumb"></div>
                            <div class="body">
                                <p class="name">Danh sách bệnh nhân</p>
                                <p class="meta">Quản lý hồ sơ, thông tin và trạng thái.</p>
                            </div>
                        </a>

                        <a class="cardx" href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">
                            <div class="thumb"></div>
                            <div class="body">
                                <p class="name">Tiếp nhận / Nhập viện</p>
                                <p class="meta">Tạo hồ sơ nhập viện nhanh theo khoa/phòng.</p>
                            </div>
                        </a>

                        <a class="cardx" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">
                            <div class="thumb"></div>
                            <div class="body">
                                <p class="name">Bệnh nhân điều trị</p>
                                <p class="meta">Theo dõi diễn biến và xử lý điều trị.</p>
                            </div>
                        </a>

                        <a class="cardx" href="<?= e(base_url('index.php?c=xuatvien&a=list')) ?>">
                            <div class="thumb"></div>
                            <div class="body">
                                <p class="name">Xuất viện</p>
                                <p class="meta">Hoàn tất hồ sơ và cập nhật giường trống.</p>
                            </div>
                        </a>
                        <a class="cardx" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">
                            <div class="thumb"></div>
                            <div class="body">
                                <p class="name">Danh sách bệnh nhân đang điều trị</p>
                                <p class="meta">TEST</p>
                            </div>
                        </a>
                    </div>
                </section>

            </main>
        </div>
    </div>

</body>

</html>