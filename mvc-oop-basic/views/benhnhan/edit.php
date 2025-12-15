<h2>SỬA BỆNH NHÂN</h2>

<form method="post">
    Họ tên: <input name="ho_ten" value="<?= e($bn['ho_ten']) ?>"><br>
    Ngày sinh: <input type="date" name="ngay_sinh" value="<?= $bn['ngay_sinh'] ?>"><br>

    Giới tính:
    <select name="gioi_tinh">
        <option value="nam" <?= $bn['gioi_tinh']=='nam'?'selected':'' ?>>Nam</option>
        <option value="nu" <?= $bn['gioi_tinh']=='nu'?'selected':'' ?>>Nữ</option>
        <option value="khac" <?= $bn['gioi_tinh']=='khac'?'selected':'' ?>>Khác</option>
    </select><br>

    CMND: <input name="so_cmnd" value="<?= e($bn['so_cmnd']) ?>"><br>
    BHYT: <input name="so_bhyt" value="<?= e($bn['so_bhyt']) ?>"><br>
    Địa chỉ: <input name="dia_chi" value="<?= e($bn['dia_chi']) ?>"><br>
    SĐT người thân: <input name="sdt_nguoi_than" value="<?= e($bn['sdt_nguoi_than']) ?>"><br><br>

    <button>Cập nhật</button>
</form>
