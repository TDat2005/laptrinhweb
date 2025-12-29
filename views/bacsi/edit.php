<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px;">
        <div>
            <div class="page-title">
                Cập nhật bác sĩ: <?= e($bs['full_name']) ?>
            </div>
            <div class="page-sub">
                Cập nhật chuyên khoa, giá khám, thông tin phòng khám và mô tả
            </div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=bacsi&a=manage')) ?>">
                ⬅ Quay lại
            </a>
        </div>
    </div>

    <div class="panel">

        <form method="post" action="<?= e(base_url('index.php?c=bacsi&a=update')) ?>">
            <input type="hidden" name="user_id" value="<?= (int)$bs['id'] ?>">

            <div class="form-grid">

                <div class="field">
                    <label>Chuyên khoa</label>
                    <input class="input" name="chuyen_khoa" value="<?= e($bs['chuyen_khoa'] ?? '') ?>" required>
                </div>

                <div class="field">
                    <label>Giá khám (VNĐ)</label>
                    <input class="input" type="number" name="gia_kham" value="<?= e($bs['gia_kham'] ?? 0) ?>">
                </div>

                <div class="field">
                    <label>Bệnh viện</label>
                    <input class="input" name="benh_vien" value="<?= e($bs['benh_vien'] ?? '') ?>">
                </div>

                <div class="field">
                    <label>Phòng khám</label>
                    <input class="input" name="phong_kham" value="<?= e($bs['phong_kham'] ?? '') ?>">
                </div>

                <div class="field">
                    <label>Tỉnh thành</label>
                    <input class="input" name="tinh_thanh" value="<?= e($bs['tinh_thanh'] ?? '') ?>">
                </div>

                <div class="field">
                    <label>Phương thức thanh toán</label>
                    <input class="input" name="phuong_thuc_tt" value="<?= e($bs['phuong_thuc_tt'] ?? '') ?>">
                </div>

                <div class="field full">
                    <label>Giới thiệu ngắn</label>
                    <textarea class="input" name="gioi_thieu_ngan"
                        style="min-height:100px;resize:vertical;"><?= e($bs['gioi_thieu_ngan'] ?? '') ?></textarea>
                </div>

                <div class="field full">
                    <label>Mô tả chi tiết</label>
                    <textarea class="input" name="mo_ta_chi_tiet"
                        style="min-height:140px;resize:vertical;"><?= e($bs['mo_ta_chi_tiet'] ?? '') ?></textarea>
                </div>

                <div class="field full">
                    <label>Ảnh đại diện (URL)</label>
                    <input class="input" name="anh_dai_dien" value="<?= e($bs['anh_dai_dien'] ?? '') ?>">
                </div>

            </div>

            <div class="actions" style="margin-top:16px;">
                <button type="submit" class="btn">💾 Lưu thay đổi</button>
                <a class="btn btn-outline" href="<?= e(base_url('index.php?c=bacsi&a=manage')) ?>">
                    Hủy
                </a>
            </div>
        </form>

    </div>
</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>