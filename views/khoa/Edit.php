<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Sửa khoa</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    .box {
        max-width: 560px;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 16px;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    label {
        display: block;
        margin: 10px 0 6px;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .err {
        padding: 10px;
        border: 1px solid #fecaca;
        background: #fff1f2;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    button {
        padding: 10px 12px;
        border: 0;
        border-radius: 10px;
        background: #3b82f6;
        color: #06122b;
        font-weight: 700;
        cursor: pointer;
    }

    a {
        color: #2563eb;
        text-decoration: none;
    }
    </style>
</head>

<body>

    <h2>Sửa khoa #<?= (int)$khoa['id'] ?></h2>

    <div class="box">
        <?php if (!empty($errors)): ?>
        <div class="err">
            <b>Lỗi:</b>
            <ul>
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= e(base_url('index.php?c=khoa&a=edit&id='.(int)$khoa['id'])) ?>">
            <label>Tên khoa</label>
            <input name="ten_khoa" value="<?= e($old['ten_khoa']) ?>" required>

            <label>Mô tả</label>
            <textarea name="mo_ta"><?= e($old['mo_ta']) ?></textarea>

            <br><br>
            <button type="submit">Lưu thay đổi</button>
            &nbsp; <a href="<?= e(base_url('index.php?c=khoa&a=list')) ?>">Quay lại</a>
        </form>
    </div>

</body>

</html>