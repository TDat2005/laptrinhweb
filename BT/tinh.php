<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập áp dụng</title>
    <link rel="stylesheet" href="tinh.css">
</head>
<body>

<div class="header">
    <h1>Website lập trình trên nền web</h1>
</div>

<div class="menu-top">
    <a href="#">Trang chủ</a>
    <a href="#">Thủ thuật</a>
    <a href="#">Tin văn phòng</a>
    <a href="#">Đồ hoạ</a>
    <a href="#">Thiết kế web</a>
    <a href="#">Lập trình</a>
</div>

<div class="container">

    <div class="menu-left">
        <ul>
            <li>Bài tập áp dụng 1</li>
            <li>Bài tập áp dụng 2</li>
            <li>Bài tập áp dụng 3</li>
            <li>Bài tập áp dụng 4</li>
        </ul>
    </div>

    <div class="content">
        <label>Nhập số thứ 1: </label>
        <input type="number" id="a"><br><br>

        <label>Nhập số thứ 2: </label>
        <input type="number" id="b"><br><br>

        <label>Phép toán: </label>
        <input type="radio" name="pt" value="+"> +
        <input type="radio" name="pt" value="-"> -
        <input type="radio" name="pt" value="*"> *
        <input type="radio" name="pt" value="/"> / <br><br>

        <p>Kết quả: <span id="kq"></span></p>
        
    </div>
</div>
</body>
<script src="tinh.js"></script>
</html>