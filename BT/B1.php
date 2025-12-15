<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Công ty hoa hồng</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            background-color: #ffffff; /* Nền ngoài trắng */
            margin: 40px;
        }

        .container {
            border: 5px solid #dca3a3;
            padding: 20px;
            width: 700px;
            background-color: #fff8b3; /* Nền trong khung vàng nhạt */
            display: flex; /* Chia 2 phần: ảnh và nội dung */
        }

        .left {
            flex: 1;
        }

        .left img {
            width: 100%;
            height: 100%; /* Ảnh cao bằng toàn bộ nội dung */
            object-fit: cover; /* Giữ tỉ lệ ảnh khi co giãn */
        }

        .right {
            flex: 2;
            padding-left: 20px;
        }

        h1 {
            color: #a52a2a;
            text-align: center;
            margin-top: 0;
        }

        .info {
            text-indent: 3px; /* Thụt đầu dòng */
        }

        ul {
            list-style-type: square;
        }

        /* 🔴 Giới thiệu & Liên hệ: nền đỏ, chữ đen */
        strong {
            background-color: red;
            color: black;
            padding: 3px 8px;
            border-radius: 5px; /* Bo tròn nhẹ */
        }

        .copyright {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
            text-align: center;
        }

        .copyright a {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="rose.jpg" alt="Hoa hồng">
        </div>

        <div class="right">
            <h1><?php echo "Công ty hoa hồng"; ?></h1>

            <div class="info">
                <ol>
                    <li>
                        <strong>Giới thiệu</strong>
                        <ul>
                            <li>Thành lập ngày <?php echo "25/05/2007"; ?></li>
                            <li>Chuyên cung cấp các loại hoa quả tươi</li>
                            <li>Có trên <?php echo 20; ?> cửa hàng bán lẻ tại TP.HCM</li>
                            <li>Nhận kết giỏ hoa theo yêu cầu của khách hàng</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Liên hệ</strong>
                        <ul>
                            <li>Điện thoại: <?php echo "84-08-8351056"; ?></li>
                            <li>Địa chỉ: <?php echo "227 Nguyễn Văn Cừ, Quận 5, TP.HCM"; ?></li>
                        </ul>
                    </li>
                </ol>
            </div>

            <div class="copyright">
                &copy; <a href="#">Trung tâm tin học - Đại học Công Nghệ GTVT</a>
            </div>
        </div>
    </div>
</body>
</html>
