<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Xuất viện</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    .info-box {
        background: #f9fafb;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .info-box table {
        border-collapse: collapse;
        width: 100%;
    }

    .info-box th,
    .info-box td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .info-box th {
        background: #f6f7f9;
        width: 200px;
    }

    .box {
        max-width: 700px;
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
        box-sizing: border-box;
    }

    label {
        display: block;
        margin: 10px 0 6px;
        font-weight: bold;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    button {
        padding: 10px 20px;
        border: 0;
        border-radius: 10px;
        background: #22c55e;
        color: #052e12;
        font-weight: 700;
        cursor: pointer;
        margin-right: 10px;
    }

    button.cancel {
        background: #ef4444;
        color: white;
    }

    a.btn {
        display: inline-block;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
        margin-right: 5px;
    }
    </style>
</head>

<body>

    <h2>Làm thủ tục xuất viện</h2>

    <div class="info-box">
        <h3>Thông tin hồ sơ</h3>
        <table>
            <tr>
                <th>Mã hồ sơ</th>
                <td><?= e($hoSo['ma_ho_so']) ?></td>
            </tr>
            <tr>
                <th>Tên bệnh nhân</th>
                <td><?= e($hoSo['ho_ten']) ?></td>
            </tr>
            <tr>
                <th>Khoa</th>
                <td><?= e($hoSo['ten_khoa']) ?></td>
            </tr>
            <tr>
                <th>Phòng</th>
                <td><?= e($hoSo['ten_phong']) ?></td>
            </tr>
            <tr>
                <th>Giường</th>
                <td><?= e($hoSo['ma_giuong']) ?></td>
            </tr>
            <tr>
                <th>Ngày nhập viện</th>
                <td><?= e($hoSo['ngay_nhap']) ?></td>
            </tr>
            <tr>
                <th>Chẩn đoán ban đầu</th>
                <td><?= e($hoSo['chan_doan_ban_dau'] ?? '') ?></td>
            </tr>
        </table>
    </div>

    <div class="box">
        <form method="POST" action="<?= e(base_url('index.php?c=xuatvien&a=handle_add')) ?>">
            <input type="hidden" name="id_ho_so" value="<?= (int)$hoSo['id'] ?>">

            <label for="ngay_xuat">Ngày xuất viện *</label>
            <input type="datetime-local" id="ngay_xuat" name="ngay_xuat" required>

            <label for="chan_doan_cuoi">Chẩn đoán cuối</label>
            <textarea id="chan_doan_cuoi" name="chan_doan_cuoi" placeholder="Nhập chẩn đoán cuối cùng..."></textarea>

            <label for="ket_luan">Kết luận</label>
            <textarea id="ket_luan" name="ket_luan" placeholder="Nhập kết luận điều trị..."></textarea>

            <label for="ghi_chu">Ghi chú</label>
            <textarea id="ghi_chu" name="ghi_chu" placeholder="Ghi chú (nếu có)..."></textarea>

            <br><br>
            <button type="submit">Xác nhận xuất viện</button>
            <a class="btn" href="<?= e(base_url('index.php?c=xuatvien&a=list')) ?>">Hủy</a>
        </form>
    </div>

</body>

</html>