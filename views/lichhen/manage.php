<?php /** @var array $list */ /** @var array $me */ /** @var string $title */ ?>
<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <div class="page-title"><?= e($title ?? 'Quản lý lịch hẹn') ?></div>
            <div class="page-sub">Danh sách lịch hẹn, trạng thái và cập nhật</div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
        </div>
    </div>

    <?php if(!empty($_SESSION['flash_success'])): ?>
    <div class="alert">
        ✅ <?= e($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?>
    </div>
    <?php endif; ?>

    <div class="panel">
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ngày/Giờ</th>
                        <th>Bệnh nhân</th>
                        <?php if(($me['role'] ?? '') === 'admin'): ?>
                        <th>Bác sĩ</th>
                        <?php endif; ?>
                        <th>SĐT</th>
                        <th>Lý do</th>
                        <th>Trạng thái</th>
                        <th>Cập nhật</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach(($list ?? []) as $i => $r): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>

                        <td>
                            <div style="font-weight:700;"><?= e($r['ngay'] ?? '-') ?></div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">
                                <?= e($r['slot'] ?? '-') ?>
                            </div>
                        </td>

                        <td>
                            <div style="font-weight:700;">
                                <?= e($r['ten_benh_nhan'] ?? $r['ho_ten'] ?? '-') ?>
                            </div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">
                                <?= e($r['email'] ?? '') ?>
                            </div>
                        </td>

                        <?php if(($me['role'] ?? '') === 'admin'): ?>
                        <td><?= e($r['ten_bac_si'] ?? '-') ?></td>
                        <?php endif; ?>

                        <td><?= e($r['sdt'] ?? '-') ?></td>

                        <td style="color:var(--muted);">
                            <?= e($r['ly_do_kham'] ?? '-') ?>
                        </td>

                        <td>
                            <?php
                                    $st = $r['trang_thai'] ?? '-';
                                    $map = [
                                        'cho_xac_nhan' => 'Chờ xác nhận',
                                        'da_xac_nhan'  => 'Đã xác nhận',
                                        'da_huy'       => 'Đã hủy',
                                        'da_kham'      => 'Đã khám'
                                    ];
                                    echo e($map[$st] ?? $st);
                                ?>
                        </td>

                        <td style="min-width:280px;">
                            <form method="post" action="<?= e(base_url('index.php?c=lichhen&a=update')) ?>"
                                class="actions" style="gap:8px;flex-wrap:nowrap;">
                                <input type="hidden" name="id" value="<?= (int)($r['id'] ?? 0) ?>">

                                <select class="select" name="status" style="min-width:170px;">
                                    <option value="cho_xac_nhan"
                                        <?= (($r['trang_thai'] ?? '')==='cho_xac_nhan')?'selected':'' ?>>
                                        Chờ xác nhận
                                    </option>
                                    <option value="da_xac_nhan"
                                        <?= (($r['trang_thai'] ?? '')==='da_xac_nhan')?'selected':'' ?>>
                                        Đã xác nhận
                                    </option>
                                    <option value="da_huy" <?= (($r['trang_thai'] ?? '')==='da_huy')?'selected':'' ?>>
                                        Đã hủy
                                    </option>
                                    <option value="da_kham" <?= (($r['trang_thai'] ?? '')==='da_kham')?'selected':'' ?>>
                                        Đã khám
                                    </option>
                                </select>

                                <button type="submit" class="btn">Lưu</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if(empty($list)): ?>
                    <tr>
                        <td colspan="<?= (($me['role'] ?? '') === 'admin') ? 8 : 7 ?>"
                            style="padding:18px;color:var(--muted);">
                            Chưa có lịch hẹn nào.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>