<?php
/** @var array $bs */
/** @var string $title */
require __DIR__ . "/../layout/AdminHeader.php";
?>

<div class="page">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px;">
        <div>
            <div class="page-title">
                Hồ sơ bác sĩ: <?= e($bs['full_name'] ?? '') ?>
            </div>
            <div class="page-sub">
                Thông tin chuyên khoa, giá khám và lịch làm việc
            </div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=bacsi&a=edit_my')) ?>">
                ✏️ Chỉnh sửa hồ sơ
            </a>
        </div>
    </div>

    <div class="panel" style="max-width:880px;">

        <div style="display:flex; gap:24px; align-items:flex-start;">

            <!-- ẢNH ĐẠI DIỆN -->
            <div style="width:160px; flex-shrink:0;">
                <?php if (!empty($bs['anh_dai_dien'])): ?>
                <img src="<?= e($bs['anh_dai_dien']) ?>" alt="Avatar"
                    style="width:160px;height:160px;object-fit:cover;border-radius:14px;">
                <?php else: ?>
                <div style="width:160px;height:160px;border-radius:14px;
                                background:#f1f5f9;display:flex;align-items:center;
                                justify-content:center;color:#94a3b8;">
                    No Image
                </div>
                <?php endif; ?>
            </div>

            <!-- THÔNG TIN CHÍNH -->
            <div style="flex:1;">

                <div style="font-size:18px;font-weight:800;margin-bottom:8px;">
                    <?= e($bs['full_name'] ?? '') ?>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px 24px;">

                    <div><b>Chuyên khoa:</b> <?= e($bs['chuyen_khoa'] ?? '-') ?></div>
                    <div><b>Giá khám:</b> <?= number_format((int)($bs['gia_kham'] ?? 0)) ?> đ</div>

                    <div><b>Bệnh viện:</b> <?= e($bs['benh_vien'] ?? '-') ?></div>
                    <div><b>Phòng khám:</b> <?= e($bs['phong_kham'] ?? '-') ?></div>

                    <div><b>Tỉnh thành:</b> <?= e($bs['tinh_thanh'] ?? '-') ?></div>
                    <div><b>Phương thức TT:</b> <?= e($bs['phuong_thuc_tt'] ?? '-') ?></div>

                </div>

                <?php if (!empty($bs['gioi_thieu_ngan'])): ?>
                <div style="margin-top:16px;">
                    <b>Giới thiệu:</b>
                    <div style="margin-top:6px;line-height:1.6;">
                        <?= nl2br(e($bs['gioi_thieu_ngan'])) ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($bs['mo_ta_chi_tiet'])): ?>
                <div style="margin-top:16px;">
                    <b>Mô tả chi tiết:</b>
                    <div style="margin-top:6px;line-height:1.6;">
                        <?= nl2br(e($bs['mo_ta_chi_tiet'])) ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>

    </div>

</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>