<?php
include "connect.php";

// Lấy mã tác giả từ URL
$matg = $_GET['matg'] ?? '';

if (empty($matg)) {
    die("Không tìm thấy mã tác giả!");
}

// Lấy dữ liệu cũ
$sql = "SELECT * FROM tacgia WHERE matacgia='$matg'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Tác giả không tồn tại!");
}

// Khi nhấn cập nhật
if (isset($_POST["update"])) {

    $tentg = $_POST["tentacgia"];
    $ngaysinh = $_POST["ngaysinh"];
    $gioitinh = $_POST["gioitinh"];
    $dienthoai = $_POST["dienthoai"];
    $email = $_POST["email"];
    $diachi = $_POST["diachi"];

    $sqlUpdate = "UPDATE tacgia 
                  SET tentacgia='$tentg',
                      ngaysinh='$ngaysinh',
                      gioitinh='$gioitinh',
                      dienthoai='$dienthoai',
                      email='$email',
                      diachi='$diachi'
                  WHERE matacgia='$matg'";

    if (mysqli_query($conn, $sqlUpdate)) {
        header("Location: find_tacgia.php?msg=updated");
        exit();
    } else {
        echo "<script>alert('Lỗi cập nhật dữ liệu!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sửa thông tin tác giả</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: white;
        padding: 40px;
    }
    .form-box {
        width: 800px;
        background: #fff1d2e7;
        margin: auto;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px #bbb;
    }
    h2 {
        text-align: center;
        color: #333;
    }
    .row {
        display: flex;
        gap: 50px;
        margin-top: 20px;
    }
    .col {
        flex: 1;
    }
    
    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }
    input, select {
        width: 95%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #aaa;
        border-radius: 5px;
    }
    button {
        width: 100%;
        margin-top: 25px;
        padding: 12px;
        background: #28a745;
        color: white;
        border: none;
        font-size: 17px;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: #218838;
    }
</style>

</head>
<body>

<div class="form-box">
    <h2>Sửa thông tin tác giả</h2>

    <form method="POST">

    <div class="row">
        <div class="col">
            <label>Mã tác giả</label>
            <input type="text" name="matacgia" value="<?= $data['matacgia'] ?>" readonly>

            <label>Tên tác giả</label>
            <input type="text" name="tentacgia" value="<?= $data['tentacgia'] ?>" required>

            <label>Ngày sinh</label>
            <input type="date" name="ngaysinh" value="<?= $data['ngaysinh'] ?>" required>
        </div>

        <div class="col">
            <label>Giới tính</label>
            <select name="gioitinh">
                <option value="Nam"  <?= $data['gioitinh']=='Nam'?'selected':'' ?>>Nam</option>
                <option value="Nữ"   <?= $data['gioitinh']=='Nữ'?'selected':'' ?>>Nữ</option>
            </select>

            <label>Điện thoại</label>
            <input type="text" name="dienthoai" value="<?= $data['dienthoai'] ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?= $data['email'] ?>">
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <label><b>Địa chỉ</b></label>
        <input type="text" name="diachi"
               value="<?= $data['diachi'] ?>"
               style="width: 97%; padding: 12px; border: 1px solid #aaa; border-radius: 5px; margin-top: 5px;">
    </div>

    <button type="submit" name="update">Cập nhật</button>

</form>

</div>

</body>
</html>
