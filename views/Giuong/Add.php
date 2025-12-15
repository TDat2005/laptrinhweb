<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Thêm giường</title>
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
        background: #22c55e;
        color: #052e12;
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

    <h2>Thêm giường</h2>

    <div class="box">
        <?php if (!empty($errors)): ?>
        <div class="err">
            <b>Lỗi:</b>
            <ul>
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (empty($phongs)): ?>
        <div class="err">
            Chưa có phòng nào. Vui lòng tạo khoa → phòng trước.
            <br><br>
            <a href="<?= e(base_url('index.php?c=phong&a=add')) ?>">Đi tới tạo phòng</a>
        </div>
        <?php else: ?>
        <form method="post" action="<?= e(base_url('index.php?c=giuong&a=add')) ?>">
            <label>Mã giường</label>
            <input name="ma_giuong" value="<?= e($old['ma_giuong']) ?>" required placeholder="VD: G01, G02...">

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
            <button type="submit">Thêm giường</button>
            &nbsp; <a href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">Quay lại</a>
        </form>
        <?php endif; ?>
    </div>

</body>

</html>