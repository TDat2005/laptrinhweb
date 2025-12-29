<?php
// views/home/index.php
require_once __DIR__ . '/../layout/AdminHeader.php';

// $user đã có từ AdminHeader.php (current_user + require_login)
$role = $user['role'] ?? '';

if ($role !== 'admin') {
    // doctor/patient không được vào dashboard admin
    if ($role === 'doctor') {
        redirect(base_url('index.php?c=bacsi&a=profile'));
    }
    if ($role === 'patient') {
        redirect(base_url('index.php?c=patientHome&a=index'));
    }
    redirect(base_url('index.php?c=auth&a=login'));
}
?>

<!-- ========== ADMIN DASHBOARD (ONLY) ========== -->
<div class="page">

    <div class="page-head" style="justify-content:flex-start;align-items:flex-start;gap:12px;flex-wrap:wrap;">
        <div>
            <div class="page-title">Dashboard quản trị nội trú</div>
            <div class="page-sub">
                Xin chào <b><?= e($user['full_name'] ?? '') ?></b> — quản lý khoa/phòng/giường, nhập viện, điều trị và
                xuất viện.
            </div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=auth&a=logout')) ?>">Đăng xuất</a>
        </div>
    </div>

    <!-- Banner ảnh (dùng đúng admin.css: panel) -->
    <section class="panel" style="padding:0;overflow:hidden;">
        <div style="
        height:220px;
        border-radius:18px;

        background:
            linear-gradient(
                to right,
                rgba(0,0,0,.15),
                rgba(0,0,0,.05)
            ),
            url('<?= e(base_url('public/css/banner.jpg')) ?>');

        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
    ">
            <!-- KHÔNG CÓ CHỮ -->
        </div>
    </section>



    <!-- Quick actions -->
    <div class="grid" style="grid-template-columns:repeat(3,1fr);margin-top:14px;">
        <div class="card">
            <div class="label">Nghiệp vụ</div>
            <div class="value">Bệnh nhân</div>
            <div class="label" style="margin-top:6px;">Quản lý hồ sơ, thông tin và trạng thái.</div>
            <a href="<?= e(base_url('index.php?c=benhnhan&a=list')) ?>">Mở danh sách →</a>
        </div>

        <div class="card">
            <div class="label">Nghiệp vụ</div>
            <div class="value">Nhập viện</div>
            <div class="label" style="margin-top:6px;">Tiếp nhận nội trú theo khoa/phòng/giường.</div>
            <a href="<?= e(base_url('index.php?c=nhapvien&a=add')) ?>">Tạo hồ sơ nhập viện →</a>
        </div>

        <div class="card">
            <div class="label">Nghiệp vụ</div>
            <div class="value">Giường trống</div>
            <div class="label" style="margin-top:6px;">Xem nhanh giường còn trống theo phòng.</div>
            <a href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">Xem giường trống →</a>
        </div>

        <div class="card">
            <div class="label">Quản trị</div>
            <div class="value">Khoa / Phòng / Giường</div>
            <div class="label" style="margin-top:6px;">Cấu hình danh mục và cơ sở vật chất.</div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;">
                <a class="btn btn-outline" href="<?= e(base_url('index.php?c=khoa&a=list')) ?>">Khoa</a>
                <a class="btn btn-outline" href="<?= e(base_url('index.php?c=phong&a=list')) ?>">Phòng</a>
                <a class="btn btn-outline" href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">Giường</a>
            </div>
        </div>

        <div class="card">
            <div class="label">Quản lý</div>
            <div class="value">Lịch làm việc</div>
            <div class="label" style="margin-top:6px;">Quản lý slot làm việc của bác sĩ.</div>
            <a href="<?= e(base_url('index.php?c=adminSchedule&a=index')) ?>">Quản lý lịch làm việc →</a>
        </div>

        <div class="card">
            <div class="label">Báo cáo</div>
            <div class="value">Thống kê</div>
            <div class="label" style="margin-top:6px;">Xem báo cáo, thống kê theo thời gian.</div>
            <a href="<?= e(base_url('index.php?c=thongke&a=index')) ?>">Mở thống kê →</a>
        </div>
    </div>

    <!-- Bảng lối tắt (dùng panel + tbl trong admin.css) -->
    <div class="panel" style="margin-top:14px;">
        <div class="page-title" style="font-size:15px;">Lối tắt nghiệp vụ</div>
        <div class="page-sub">Các chức năng hay dùng nhất cho admin.</div>

        <div class="tbl-wrap" style="margin-top:12px;">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:260px;">Nhóm</th>
                        <th>Chức năng</th>
                        <th style="width:220px;">Đi tới</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight:800;">Tài khoản</td>
                        <td>Quản lý user, role (admin/doctor/patient), trạng thái</td>
                        <td>
                            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=user&a=list')) ?>">Mở</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:800;">Bác sĩ</td>
                        <td>Danh sách & chỉnh thông tin bác sĩ (chuyên khoa, giá khám,...)</td>
                        <td>
                            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=bacsi&a=manage')) ?>">Mở</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:800;">Điều trị</td>
                        <td>Danh sách bệnh nhân đang điều trị, cập nhật tiến trình</td>
                        <td>
                            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">Mở</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:800;">Xuất viện</td>
                        <td>Hoàn tất hồ sơ, giải phóng giường, cập nhật trạng thái</td>
                        <td>
                            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=xuatvien&a=list')) ?>">Mở</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="height:10px;"></div>

</div>

<?php require __DIR__ . '/../layout/AdminFooter.php'; ?>