<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <!-- HEADER -->
    <div class="page-head">
        <div>
            <div class="page-title">Tiếp nhận bệnh nhân nội trú</div>
            <div class="page-sub">
                Lập hồ sơ nhập viện – phân khoa, phòng, giường
            </div>
        </div>
    </div>

    <div class="panel">

        <form method="post">

            <div class="form-grid">

                <!-- BỆNH NHÂN -->
                <div class="field full">
                    <label>Bệnh nhân</label>
                    <select class="select" name="id_benh_nhan" required>
                        <?php foreach ($benhnhans as $bn): ?>
                        <option value="<?= $bn['id'] ?>">
                            <?= e($bn['ma_bn'].' - '.$bn['ho_ten']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- KHOA -->
                <div class="field">
                    <label>Khoa</label>
                    <select class="select" name="id_khoa" id="khoa" required>
                        <option value="">-- Chọn khoa --</option>
                    </select>
                </div>

                <!-- PHÒNG -->
                <div class="field">
                    <label>Phòng</label>
                    <select class="select" name="id_phong" id="phong" required>
                        <option value="">-- Chọn phòng --</option>
                    </select>
                </div>

                <!-- GIƯỜNG -->
                <div class="field">
                    <label>Giường trống</label>
                    <select class="select" name="id_giuong" id="giuong" required>
                        <option value="">-- Chọn giường --</option>
                    </select>
                </div>

                <!-- NGÀY NHẬP -->
                <div class="field">
                    <label>Ngày giờ nhập viện</label>
                    <input class="input" type="datetime-local" name="ngay_nhap" required>
                </div>

                <!-- BÁC SĨ -->
                <div class="field full">
                    <label>Bác sĩ phụ trách</label>
                    <select class="select" name="bac_si_phu_trach">
                        <option value="">-- Chưa phân công --</option>
                    </select>
                </div>

                <!-- CHẨN ĐOÁN -->
                <div class="field full">
                    <label>Chẩn đoán ban đầu</label>
                    <textarea class="input" name="chan_doan_ban_dau" rows="3"
                        placeholder="Nhập chẩn đoán ban đầu..."></textarea>
                </div>

            </div>

            <!-- ACTIONS -->
            <div class="actions" style="margin-top:18px;">
                <button class="btn">💾 Tiếp nhận</button>
                <a href="index.php?c=dieutri&a=list" class="btn-outline">
                    Quay lại
                </a>
            </div>

        </form>

    </div>