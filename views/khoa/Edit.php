<?php /** @var array $errors */ /** @var array $old */ /** @var array $khoa */ ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa khoa</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="page">
        <div class="page-head">
            <div>
                <div class="page-title">Sửa khoa #<?= (int)$khoa['id'] ?></div>
                <div class="page-sub">Cập nhật thông tin khoa</div>
            </div>
            <div class="actions">
                <a class="btn btn-outline" href="<?= e(base_url('index.php?c=khoa&a=list')) ?>">Quay lại</a>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <b>Lỗi:</b>
            <ul style="margin:8px 0 0 18px;">
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="panel">
            <form method="post" action="<?= e(base_url('index.php?c=khoa&a=edit&id='.(int)$khoa['id'])) ?>">
                <div class="form-grid">
                    <div class="field full">
                        <label>Tên khoa</label>
                        <input class="input" name="ten_khoa" value="<?= e($old['ten_khoa'] ?? '') ?>" required>
                    </div>

                    <div class="field full">
                        <label>Mô tả</label>
                        <textarea class="input" name="mo_ta"
                            style="min-height:120px;"><?= e($old['mo_ta'] ?? '') ?></textarea>
                    </div>

                    <div class="full actions" style="justify-content:flex-end;">
                        <button class="btn" type="submit">Lưu thay đổi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>