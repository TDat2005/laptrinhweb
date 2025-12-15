<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu đăng ký</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="slide-container">
        <header class="slide-header">
            <h1>Phiếu đăng ký tham gia chương trình khuyến mãi</h1>
        </header>

        <main class="registration-form">
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
                        <td class="label-cell">Phái</td>
                        <td class="input-cell gender-group">
                            <input type="radio" id="nam" name="phai" value="nam" >
                            <label for="nam">Nam</label>
                            <input type="radio" id="nu" name="phai" value="nu">
                            <label for="nu">Nữ</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-cell">Nghề nghiệp</td>
                        <td class="input-cell">
                            <select name="nghe_nghiep" class="dropdown">
                                <option value="bac_si">Bác sĩ</option>
                                <option value="ky_su">Kỹ sư</option>
                                <option value="giao_vien" >Giáo viên</option>
                                <option value="khac">Khác</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-cell">Chọn sản phẩm tham gia</td>
                        <td class="input-cell">
                            <select name="san_pham" size="4" multiple class="product-select">
                                <option value="kem_danh_rang">Kem đánh răng</option>
                                <option value="bot_giat">Bột giặt</option>
                                <option value="dau_goi_dau" >Dầu gội đầu</option>
                                <option value="sua_tam">Sữa tắm</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-cell">Số người dự đoán tham gia</td>
                        <td class="input-cell"><input type="number" name="so_nguoi_du_doan" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="submit-cell">
                            <button type="submit" class="submit-button">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </form>
        </main>
        
        <footer class="success-message">
            Bạn đã đăng ký thành công!!!
        </footer>
        
        
    </div>
</body>
</html>

