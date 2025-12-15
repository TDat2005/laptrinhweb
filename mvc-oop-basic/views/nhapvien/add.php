<h2>TIẾP NHẬN BỆNH NHÂN NỘI TRÚ</h2>

<form method="post">

Bệnh nhân:
<select name="id_benh_nhan" required>
    <?php foreach ($benhnhan as $bn): ?>
    <option value="<?= $bn['id'] ?>">
        <?= e($bn['ho_ten']) ?> (<?= e($bn['ma_bn']) ?>)
    </option>
    <?php endforeach; ?>
</select><br><br>

Khoa:
<select id="khoa" name="id_khoa" required></select><br><br>

Phòng:
<select id="phong" name="id_phong" required></select><br><br>

Giường trống:
<select id="giuong" name="id_giuong" required></select><br><br>

Ngày giờ nhập viện:
<input type="datetime-local" name="ngay_nhap" required><br><br>

Bác sĩ phụ trách:
<select name="bac_si_phu_trach">
    <?php foreach ($bacsi as $bs): ?>
    <option value="<?= $bs['id'] ?>">
        <?= e($bs['full_name']) ?>
    </option>
    <?php endforeach; ?>
</select><br><br>

Chẩn đoán ban đầu:
<textarea name="chan_doan_ban_dau"></textarea><br><br>

<button>Lưu hồ sơ nhập viện</button>

</form>

<script>
const khoaData = <?= json_encode($khoa) ?>;
const khoa = document.getElementById('khoa');
const phong = document.getElementById('phong');
const giuong = document.getElementById('giuong');

khoa.innerHTML = khoaData.map(k =>
    `<option value="${k.id}">${k.ten_khoa}</option>`
).join('');

khoa.onchange = () => {
    fetch(`index.php?c=nhapvien&a=phong&id_khoa=${khoa.value}`)
        .then(r => r.json())
        .then(data => {
            phong.innerHTML = data.map(p =>
                `<option value="${p.id}">${p.ten_phong}</option>`
            ).join('');
            phong.onchange();
        });
};

phong.onchange = () => {
    fetch(`index.php?c=nhapvien&a=giuong&id_phong=${phong.value}`)
        .then(r => r.json())
        .then(data => {
            giuong.innerHTML = data.map(g =>
                `<option value="${g.id}">${g.ma_giuong}</option>`
            ).join('');
        });
};

khoa.onchange();
</script>
