<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Sửa giường</title>
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

    <h2>Sửa giường #<?= (int)$giuong['id'] ?></h2>

    <div class="box">
        <?php if (!empty($errors)): ?>
        <div class="err">
            <b>Lỗi:</b>
            <ul>
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= e(base_url('index.php?c=giuong&a=edit&id='.(int)$giuong['id'])) ?>">
            <label>Mã giường</label>
            <input name="ma_giuong" value="<?= e($old['ma_giuong']) ?>" required>

            <label>Phòng</label>
            <select name="id_phong" required>
                <option value="0">-- Chọn phòng --</option>
                <?php foreach ($phongs as $p): ?>
                <option value="<?= (int)$p['id'] ?>" <?= ((int)$old['id_phong']===(int)$p['id'])?'selected':'' ?>>
                    <?= e($p['ten_khoa']) ?> — <?= e($p['ten_phong']) ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label>Trạng thái</label>
            <select name="trang_thai">
                <option value="trong" <?= ($old['trang_thai']==='trong')?'selected':'' ?>>Trống</option>
                <option value="dang_su_dung" <?= ($old['trang_thai']==='dang_su_dung')?'selected':'' ?>>Đang sử dụng
                </option>
            </select>

            <label>Ghi chú (tuỳ chọn)</label>
            <textarea name="ghi_chu"><?= e($old['ghi_chu']) ?></textarea>

            <br><br>
            <button type="submit">Lưu thay đổi</button>
            &nbsp; <a href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">Quay lại</a>
        </form>
    </div>

</body>

</html>