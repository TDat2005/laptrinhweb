<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Sửa phòng</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    .box {
        max-width: 640px;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 16px;
    }

    input,
    select,
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
        min-height: 110px;
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

    <h2>Sửa phòng #<?= (int)$phong['id'] ?></h2>

    <div class="box">
        <?php if (!empty($errors)): ?>
        <div class="err">
            <b>Lỗi:</b>
            <ul>
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= e(base_url('index.php?c=phong&a=edit&id='.(int)$phong['id'])) ?>">
            <label>Tên phòng</label>
            <input name="ten_phong" value="<?= e($old['ten_phong']) ?>" required>

            <label>Khoa</label>
            <select name="id_khoa" required>
                <option value="0">-- Chọn khoa --</option>
                <?php foreach ($khoas as $k): ?>
                <option value="<?= (int)$k['id'] ?>" <?= ((int)$old['id_khoa']===(int)$k['id'])?'selected':'' ?>>
                    <?= e($k['ten_khoa']) ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label>Loại phòng (tuỳ chọn)</label>
            <input name="loai_phong" value="<?= e($old['loai_phong']) ?>">

            <label>Ghi chú (tuỳ chọn)</label>
            <textarea name="ghi_chu"><?= e($old['ghi_chu']) ?></textarea>

            <br><br>
            <button type="submit">Lưu thay đổi</button>
            &nbsp; <a href="<?= e(base_url('index.php?c=phong&a=list')) ?>">Quay lại</a>
        </form>
    </div>

</body>

</html>