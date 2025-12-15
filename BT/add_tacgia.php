<?php
// Kết nối database
include "connect.php";

// Khi nhấn Lưu
if (isset($_POST["save"])) {

    $matg = $_POST["matacgia"];
    $tentg = $_POST["tentacgia"];
    $ngaysinh = $_POST["ngaysinh"];
    $gioitinh = $_POST["gioitinh"];
    $dienthoai = $_POST["dienthoai"];
    $email = $_POST["email"];
    $diachi = $_POST["diachi"];

    $sql = "INSERT INTO tacgia (matacgia, tentacgia, ngaysinh, gioitinh, dienthoai, email, diachi)
            VALUES ('$matg', '$tentg', '$ngaysinh', '$gioitinh', '$dienthoai', '$email', '$diachi')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Thêm tác giả thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm dữ liệu!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Thông tin tác giả</title>

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
    <h2>Thông tin tác giả</h2>

    <form method="POST">

    <div class="row">
        <div class="col">
            <label>Mã tác giả</label>
            <input type="text" name="matacgia" required>

            <label>Tên tác giả</label>
            <input type="text" name="tentacgia" required>

            <label>Ngày sinh</label>
            <input type="date" name="ngaysinh" required>
        </div>

        <div class="col">
            <label>Giới tính</label>
            <select name="gioitinh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>

            <label>Điện thoại</label>
            <input type="text" name="dienthoai">

            <label>Email</label>
            <input type="email" name="email">
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <label><b>Địa chỉ</b></label>
        <input type="text" name="diachi" style="
            width: 97%;
            padding: 12px;
            border: 1px solid #aaa;
            border-radius: 5px;
            margin-top: 5px;
        ">
    </div>

    <button type="submit" name="save">Lưu tác giả</button>

</form>

</div>

</body>
</html>
