<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <div class="page-title">Quản lý bác sĩ</div>
            <div class="page-sub">Danh sách bác sĩ, chuyên khoa và giá khám</div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
        </div>
    </div>

    <div class="panel">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Họ tên</th>
                        <th>Chuyên khoa</th>
                        <th>Giá khám</th>
                        <th style="width:160px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($list)): ?>
                    <tr>
                        <td colspan="5" style="padding:18px;color:var(--muted);">Chưa có bác sĩ nào.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($list as $i => $r): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td style="font-weight:800;"><?= e($r['full_name'] ?? '') ?></td>
                        <td><?= e($r['chuyen_khoa'] ?? '-') ?></td>
                        <td style="font-weight:800;"><?= number_format((int)($r['gia_kham'] ?? 0)) ?> đ</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-outline"
                                    href="<?= e(base_url('index.php?c=bacsi&a=edit&id='.(int)($r['id'] ?? 0))) ?>">
                                    Sửa
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>