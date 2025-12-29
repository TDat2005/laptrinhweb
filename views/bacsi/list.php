<?php /** @var array $list */ /** @var string $title */ ?>
<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <div class="page-title"><?= e($title ?? 'Bác sĩ') ?></div>
            <div class="page-sub">Danh sách bác sĩ, chuyên khoa và giá khám</div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
        </div>
    </div>

    <?php if (empty($list)): ?>
    <div class="panel">
        <div style="font-weight:800;">Chưa có bác sĩ nào.</div>
        <div class="page-sub" style="margin-top:6px;">Vui lòng thêm dữ liệu bác sĩ để hiển thị danh sách.</div>
    </div>
    <?php else: ?>

    <div class="grid" style="grid-template-columns:repeat(4, minmax(0,1fr));">
        <?php foreach(($list ?? []) as $bs): ?>
        <div class="card" style="display:flex; flex-direction:column; gap:8px; min-height:170px;">
            <div style="font-weight:800; font-size:15px;">
                <?= e($bs['full_name'] ?? '-') ?>
            </div>

            <div style="font-size:13px; color:var(--muted);">
                <?= e($bs['chuyen_khoa'] ?? 'Chưa cập nhật chuyên khoa') ?>
            </div>

            <div style="font-size:13px;">
                Giá khám: <span style="font-weight:800;"><?= number_format((int)($bs['gia_kham'] ?? 0)) ?>đ</span>
            </div>

            <div style="font-size:12px; color:var(--muted);">
                <?= e($bs['benh_vien'] ?? '') ?>
                <?= !empty($bs['tinh_thanh']) ? ' - '.e($bs['tinh_thanh']) : '' ?>
            </div>

            <a class="btn"
                style="margin-top:auto; width:100%; display:flex; align-items:center; justify-content:center; color:#fff;"
                href="<?= e(base_url('index.php?c=bacsi&a=detail&id='.(int)($bs['id'] ?? 0))) ?>">
                Xem chi tiết
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <style>
    @media (max-width: 1100px) {
        .grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }

    @media (max-width: 650px) {
        .grid {
            grid-template-columns: 1fr !important;
        }
    }
    </style>

    <?php endif; ?>

</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>