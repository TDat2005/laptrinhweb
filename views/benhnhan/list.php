<h2>DANH SÁCH BỆNH NHÂN</h2>

<form method="get">
    <input type="hidden" name="c" value="benhnhan">
    <input type="hidden" name="a" value="list">
    <input name="q" placeholder="Tìm mã BN / họ tên"
           value="<?= e($keyword) ?>">
    <button>Tìm</button>
</form>

<br>
<a href="index.php?c=benhnhan&a=add">➕ Thêm bệnh nhân</a>

<table border="1" cellpadding="5">
<tr>
    <th>Mã BN</th>
    <th>Họ tên</th>
    <th>Ngày sinh</th>
    <th>Giới tính</th>
    <th>CMND</th>
    <th>BHYT</th>
    <th>Thao tác</th>
</tr>

<?php foreach ($data as $bn): ?>
<tr>
    <td><?= e($bn['ma_bn']) ?></td>
    <td><?= e($bn['ho_ten']) ?></td>
    <td><?= e($bn['ngay_sinh']) ?></td>
    <td><?= e($bn['gioi_tinh']) ?></td>
    <td><?= e($bn['so_cmnd']) ?></td>
    <td><?= e($bn['so_bhyt']) ?></td>
    <td>
        <a href="index.php?c=benhnhan&a=edit&id=<?= $bn['id'] ?>">✏️ Sửa</a>
        |
        <a href="index.php?c=benhnhan&a=delete&id=<?= $bn['id'] ?>"
           onclick="return confirm('Xóa bệnh nhân?')">🗑 Xóa</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
