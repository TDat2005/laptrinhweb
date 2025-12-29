<?php /** @var array $list */ /** @var string $title */ ?>
<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <div class="page-title"><?= e($title ?? 'Lịch hẹn của tôi') ?></div>
            <div class="page-sub">Theo dõi trạng thái lịch hẹn và thao tác hủy khi cần</div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=bacsi&a=list')) ?>">+ Đặt lịch mới</a>
            <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
        </div>
    </div>

    <?php if (empty($list)): ?>
    <div class="panel">
        <div style="font-weight:700;">Chưa có lịch hẹn nào.</div>
        <div class="page-sub" style="margin-top:6px;">
            Bấm “Đặt lịch mới” để chọn bác sĩ và giờ khám.
        </div>
    </div>
    <?php else: ?>

    <div class="panel">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ngày / Giờ</th>
                        <th>Bác sĩ</th>
                        <th>Chuyên khoa</th>
                        <th>Giá khám</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach (($list ?? []) as $i => $r): ?>
                    <?php
                                $st = $r['trang_thai'] ?? 'cho_xac_nhan';
                                $stText = [
                                    'cho_xac_nhan' => 'Chờ xác nhận',
                                    'da_xac_nhan'  => 'Đã xác nhận',
                                    'da_huy'       => 'Đã hủy',
                                    'da_kham'      => 'Đã khám'
                                ][$st] ?? $st;

                                // dùng tag có sẵn trong admin.css
                                $tagClass = in_array($st, ['da_xac_nhan','da_kham'], true) ? 'tag-on' : 'tag-off';
                                if ($st === 'cho_xac_nhan') $tagClass = ''; // mặc định
                            ?>
                    <tr>
                        <td><?= $i + 1 ?></td>

                        <td>
                            <div style="font-weight:700;"><?= e($r['ngay'] ?? '-') ?></div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">
                                <?= e($r['slot'] ?? '-') ?>
                            </div>
                        </td>

                        <td>
                            <div style="font-weight:700;"><?= e($r['ten_bac_si'] ?? '-') ?></div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">
                                <?= e($r['benh_vien'] ?? '') ?>
                                <?= !empty($r['tinh_thanh']) ? ' - '.e($r['tinh_thanh']) : '' ?>
                            </div>
                        </td>

                        <td><?= e($r['chuyen_khoa'] ?? '-') ?></td>

                        <td style="font-weight:700;">
                            <?= number_format((int)($r['gia_kham'] ?? 0)) ?>đ
                        </td>

                        <td>
                            <?php if ($tagClass !== ''): ?>
                            <span class="tag <?= $tagClass ?>"><?= e($stText) ?></span>
                            <?php else: ?>
                            <span class="tag"><?= e($stText) ?></span>
                            <?php endif; ?>
                        </td>

                        <td style="color:var(--muted);">
                            <?= e($r['created_at'] ?? '') ?>
                        </td>

                        <td style="min-width:130px;">
                            <?php if (in_array(($r['trang_thai'] ?? ''), ['cho_xac_nhan','da_xac_nhan'], true)): ?>
                            <form method="post" action="<?= e(base_url('index.php?c=lichhen&a=cancel')) ?>"
                                onsubmit="return confirm('Hủy lịch hẹn này?');">
                                <input type="hidden" name="id" value="<?= (int)($r['id'] ?? 0) ?>">
                                <button type="submit" class="btn btn-outline">Hủy</button>
                            </form>
                            <?php else: ?>
                            <span style="color:var(--muted);">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

    <?php endif; ?>

</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>