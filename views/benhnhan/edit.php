<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>
<div class="page">

    <!-- HEADER -->
    <div class="page-head">
        <div>
            <div class="page-title">Sửa thông tin bệnh nhân</div>
            <div class="page-sub">Cập nhật thông tin hồ sơ cá nhân bệnh nhân</div>
        </div>
    </div>

    <div class="panel">

        <form method="post">

            <div class="form-grid">

                <div class="field">
                    <label>Mã bệnh nhân</label>
                    <input class="input" name="ma_bn" value="<?= e($bn['ma_bn']) ?>" required>
                </div>

                <div class="field">
                    <label>Họ tên</label>
                    <input class="input" name="ho_ten" value="<?= e($bn['ho_ten']) ?>" required>
                </div>

                <div class="field">
                    <label>Ngày sinh</label>
                    <input class="input" type="date" name="ngay_sinh" value="<?= e($bn['ngay_sinh']) ?>">
                </div>

                <div class="field">
                    <label>Giới tính</label>
                    <select class="select" name="gioi_tinh">
                        <option value="nam" <?= $bn['gioi_tinh']=='nam'?'selected':'' ?>>Nam</option>
                        <option value="nu" <?= $bn['gioi_tinh']=='nu'?'selected':'' ?>>Nữ</option>
                        <option value="khac" <?= $bn['gioi_tinh']=='khac'?'selected':'' ?>>Khác</option>
                    </select>
                </div>

                <div class="field">
                    <label>CMND / CCCD</label>
                    <input class="input" name="so_cmnd" value="<?= e($bn['so_cmnd']) ?>">
                </div>

                <div class="field">
                    <label>Số BHYT</label>
                    <input class="input" name="so_bhyt" value="<?= e($bn['so_bhyt']) ?>">
                </div>

                <div class="field full">
                    <label>Địa chỉ</label>
                    <input class="input" name="dia_chi" value="<?= e($bn['dia_chi']) ?>">
                </div>

                <div class="field full">
                    <label>SĐT người thân</label>
                    <input class="input" name="sdt_nguoi_than" value="<?= e($bn['sdt_nguoi_than']) ?>">
                </div>

            </div>

            <!-- ACTIONS -->
            <div class="actions" style="margin-top:18px;">
                <button class="btn">💾 Lưu thay đổi</button>
                <a href="index.php?c=benhnhan&a=list" class="btn-outline">
                    Quay lại
                </a>
            </div>

        </form>

    </div>