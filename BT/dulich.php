<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Đăng Ký Du Lịch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        .form-container {
            display: inline-block;
            background-color: #f7f7f7;
            border: 3px solid #ccc; /* Viền bao ngoài */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: left;
            margin-top: 30px;
            width: 550px;
        }
        h2 {
            text-align: center;
            color: #1b0ed1ff; /* Màu xanh cho tiêu đề */
            margin-bottom: 20px;
        }
        .form-table {
            width: 100%;
            border-collapse: collapse;
        }
        .form-table td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .label-cell {
            width: 35%;
            font-weight: bold;
            padding-left: 10px;
        }
        .input-cell input[type="text"], 
        .input-cell input[type="tel"], 
        .input-cell input[type="number"], 
        .input-cell select,
        .input-cell textarea {
            width: 90%;
            padding: 3px;
            border: 1px solid #666;
            box-sizing: border-box;
        }
        /* Style cho fieldset Số lượng đoàn khách */
        .guest-count fieldset {
            border: 1px solid #7c0a02; 
            padding: 10px;
            margin-top: 5px;
            width: 95%;
        }
        .guest-count legend {
            color: #7c0a02;
            font-weight: bold;
        }
        
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Đăng ký du lịch</h2>
        
        <form action="#" method="POST">
            <table class="form-table">
                <tr>
                    <td class="label-cell">Họ và tên</td>
                    <td class="input-cell"><input type="text" name="ho_ten" value=""></td>
                </tr>

                <tr>
                    <td class="label-cell">Địa chỉ</td>
                    <td class="input-cell"><input type="text" name="dia_chi" value=""></td>
                </tr>

                <tr>
                    <td class="label-cell">Điện thoại</td>
                    <td class="input-cell"><input type="tel" name="dien_thoai" value=""></td>
                </tr>

                <tr>
                    <td class="label-cell">Khách Việt Nam</td>
                    <td class="input-cell">
                        <input type="checkbox" name="khachviet" checked>
                    </td>
                </tr>

                <tr>
                    <td class="label-cell">Chọn tour</td>
                    <td class="input-cell">
                        <select name="tour" style="width: 90%;">
                            
                            
                            <optgroup label="Miền Bắc">
                                <option value="HN-HL-SP">Hà Nội - Hạ Long - Sapa</option>
                                <option value="HN-CH-NB">Hà Nội - Chùa Hương - Ninh Bình</option>
                                <option value="HN-CB-TQ">Hà Nội - Cát Bà - Tuần Châu</option>
                            </optgroup>
                            
                            <optgroup label="Miền Trung">
                                <option value="Hue-BM-DN">Huế - Bạch Mã - Đà Nẵng</option>
                                <option value="NT-DL">Nha Trang - Đà Lạt</option>
                                <option value="BMT-GL-KT" selected>Buôn Ma Thuột - Gia Lai - Kontum</option> 
                            </optgroup>
                            
                            <optgroup label="Miền Nam">
                                <option value="TPHCM-CT-CM">TP HCM - Cần Thơ - Cà Mau</option>
                                <option value="TPHCM-MT">TP HCM - Mỹ Tho</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="label-cell">Phương tiện</td>
                    <td class="input-cell">
                        <input type="radio" id="maybay" name="phuongtien" value="MayBay" checked>
                        <label for="maybay">Máy bay</label>
                        <input type="radio" id="xeto" name="phuongtien" value="XeOto">
                        <label for="xeto">Xe ô tô</label>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" class="guest-count-cell"> 
                        <fieldset>
                            <legend>Số lượng đoàn khách</legend>
                            <label for="nguoilon">Người lớn</label>
                            <input type="number" id="nguoilon" name="nguoilon" value="6" style="width: 100px;">
                            
                            <label for="treem">Trẻ em</label>
                            <input type="number" id="treem" name="treem" value="4" style="width: 100px;">
                        </fieldset>
                    </td>
                </tr>

                <tr>
                    <td class="label-cell">Ghi chú thêm</td>
                    <td class="input-cell">
                        <textarea name="ghichuthem" rows="3" style="min-height: 50px;">có 2 trẻ em dưới 6 tuổi
có 2 người Ăn chay</textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center; padding: 15px;">
                        <button type="submit" class="submit-button">Đồng ý</button>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center; padding: 10px;">
                        <p style="color: green; font-weight: bold; margin: 0;">Bạn đã đăng ký thành công!!!</p>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>