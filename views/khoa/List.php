<?php /** @var array $khoas */ /** @var string $msg */ ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý khoa</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="page">
        <div class="page-head">
            <div>
                <div class="page-title">Quản lý khoa</div>
                <div class="page-sub">Danh sách các khoa trong bệnh viện</div>
            </div>

            <div class="actions">
                <a class="btn" href="<?= e(base_url('index.php?c=khoa&a=add')) ?>">+ Thêm khoa</a>
                <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
        <div class="alert">
            <?php
        if ($msg==='created') echo "✅ Thêm khoa thành công.";
        elseif ($msg==='updated') echo "✅ Cập nhật khoa thành công.";
        elseif ($msg==='deleted') echo "✅ Xóa khoa thành công.";
        elseif ($msg==='cannot_delete') echo "⚠️ Không thể xóa khoa vì đang có phòng thuộc khoa này.";
        else echo "✅ Thao tác thành công.";
      ?>
        </div>
        <?php endif; ?>

        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:80px;">ID</th>
                        <th style="width:260px;">Tên khoa</th>
                        <th>Mô tả</th>
                        <th style="width:260px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($khoas as $k): ?>
                    <tr>
                        <td><?= (int)$k['id'] ?></td>
                        <td><?= e($k['ten_khoa']) ?></td>
                        <td><?= e($k['mo_ta'] ?? '') ?></td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-outline"
                                    href="<?= e(base_url('index.php?c=khoa&a=edit&id='.(int)$k['id'])) ?>">Sửa</a>
                                <a class="btn btn-danger"
                                    href="<?= e(base_url('index.php?c=khoa&a=delete&id='.(int)$k['id'])) ?>"
                                    onclick="return confirm('Xóa khoa này? (Chỉ xóa được nếu khoa không có phòng)')">
                                    Xóa
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>