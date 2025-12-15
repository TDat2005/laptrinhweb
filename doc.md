# QUY ĐỊNH CHUẨN PHỐI HỢP NHÓM  
## Dự án: Website quản lý hồ sơ bệnh nhân nội trú

Tài liệu này quy định các chuẩn chung về **cấu trúc project, cơ sở dữ liệu, phân quyền, quy trình phối hợp** nhằm đảm bảo các thành viên trong nhóm làm việc **đồng bộ, không xung đột và dễ tích hợp**.

---

## 1. Cấu trúc thư mục project (CHỐT CỨNG)

Nhóm thống nhất sử dụng cấu trúc MVC đơn giản như sau:
/
├── index.php # Front Controller (router)
├── commons/ # Thành phần dùng chung
│ ├── db.php # Kết nối cơ sở dữ liệu
│ ├── auth.php # Session, kiểm tra đăng nhập & phân quyền
│ └── helpers.php # Các hàm dùng chung
├── controllers/ # Xử lý request, gọi model
├── models/ # Xử lý dữ liệu, truy vấn CSDL
├── views/ # Giao diện (HTML/CSS/JS)
├── uploads/ # Lưu file upload (nếu có)
└── README.md # Tài liệu quy định & hướng dẫn

❗ **Không thành viên nào được tự ý tạo thêm thư mục ngoài danh sách trên.**

---

## 2. Quy ước routing (đường dẫn truy cập)

Hệ thống sử dụng query string để định tuyến theo dạng:

index.php?c=<controller>&a=<action>

Ví dụ:
- `index.php?c=auth&a=login`
- `index.php?c=khoa&a=list`
- `index.php?c=benhnhan&a=add`

### Quy ước action chuẩn cho mọi module:
- `list`   : hiển thị danh sách
- `add`    : thêm mới
- `edit`   : chỉnh sửa
- `delete` : xóa hoặc khóa
- `detail` : xem chi tiết (nếu có)

---

## 3. Quy ước đặt tên file (BẮT BUỘC)

### Controllers
controllers/<Name>Controller.php
Ví dụ:
- `AuthController.php`
- `KhoaController.php`
- `PhongController.php`
- `GiuongController.php`
- `BenhNhanController.php`
- `NhapVienController.php`
- `DieuTriController.php`
- `XuatVienController.php`
- `ThongKeController.php`

### Models
models/<Name>.php
Ví dụ:
- `User.php`
- `Khoa.php`
- `Phong.php`
- `Giuong.php`
- `BenhNhan.php`
- `NhapVien.php`

### Views
views/<module>/<action>.php
Ví dụ:
- `views/khoa/list.php`
- `views/khoa/add.php`
- `views/benhnhan/edit.php`

❗ Mỗi module chỉ được chỉnh sửa file trong **controller, model và views của module đó**.

---

## 4. Quy ước session & phân quyền

### Session lưu thông tin đăng nhập:
```php
$_SESSION['user'] = [
  'id',
  'username',
  'full_name',
  'role'
];

## Roles trong hệ thống
- **admin** : quản trị hệ thống  
- **doctor** : bác sĩ  
- **nurse** : y tá  
- **reception** : lễ tân / tiếp nhận  

### Quy tắc phân quyền
- **Admin**: toàn quyền  
- **Reception**: quản lý bệnh nhân, nhập viện  
- **Doctor / Nurse**: xem hồ sơ, diễn biến điều trị, xuất viện  

---

## 5. Cơ sở dữ liệu – Schema chung

### Danh sách bảng (không đổi tên):
- users  
- khoa  
- phong  
- giuong  
- benh_nhan  
- ho_so_nhap_vien  
- dien_bien_dieu_tri  
- ho_so_xuat_vien  

### Quan hệ chính:
- phong.id_khoa → khoa.id  
- giuong.id_phong → phong.id  
- ho_so_nhap_vien.id_benh_nhan → benh_nhan.id  
- ho_so_nhap_vien.id_khoa → khoa.id  
- ho_so_nhap_vien.id_phong → phong.id  
- ho_so_nhap_vien.id_giuong → giuong.id  
- ho_so_nhap_vien.bac_si_phu_trach → users.id  
- dien_bien_dieu_tri.id_ho_so → ho_so_nhap_vien.id  
- ho_so_xuat_vien.id_ho_so → ho_so_nhap_vien.id (1–1)  

---

## 6. Quy ước trạng thái (ENUM – KHÔNG DÙNG 0/1)

- **Trạng thái giường**:  
  `giuong.trang_thai ∈ ('trong', 'dang_su_dung')`

- **Trạng thái hồ sơ nhập viện**:  
  `ho_so_nhap_vien.trang_thai ∈ ('dang_dieu_tri', 'da_xuat_vien')`

❗ Tất cả thành viên bắt buộc dùng đúng các giá trị trên, không tự đặt giá trị khác.

---

## 7. Luồng nghiệp vụ

### Nhập viện
- Thêm bản ghi vào `ho_so_nhap_vien`  
- Cập nhật `giuong.trang_thai = 'dang_su_dung'`

### Xuất viện
- Thêm bản ghi vào `ho_so_xuat_vien`  
- Cập nhật `ho_so_nhap_vien.trang_thai = 'da_xuat_vien'`  
- Cập nhật `giuong.trang_thai = 'trong'`

❗ Không được thiếu bước nào trong các luồng trên.

---

## 8. Quy định validate dữ liệu
- Mọi dữ liệu từ form phải `trim()`  
- Không cho phép rỗng các trường quan trọng:  
  - Tên khoa, tên phòng, mã giường  
  - Mã bệnh nhân, họ tên bệnh nhân  
  - Ngày nhập viện, giường khi nhập viện  

---

#cmd# 9. Phân công và phạm vi chỉnh sửa
- Mỗi thành viên chỉ chỉnh sửa module được phân công  
- Không chỉnh sửa:  
  - `index.php`  
  - `commons/db.php`  
  - `commons/auth.php`  
  (trừ người phụ trách core)  

---

## 10. Quy trình tích hợp (merge)
- Mỗi thành viên nộp:  
  - Folder `views/<module>/`  
  - 01 controller + 01 model tương ứng  
- Trưởng nhóm chịu trách nhiệm tích hợp vào project chính.  
- Kiểm thử theo đúng luồng nghiệp vụ:  
  `tạo khoa → phòng → giường → bệnh nhân → nhập viện → điều trị → xuất viện`  

---

## 11. Hiệu lực tài liệu
- Tài liệu này có hiệu lực xuyên suốt quá trình thực hiện dự án.  
- Mọi thay đổi (nếu có) phải được thống nhất trong nhóm trước khi áp dụng.  
