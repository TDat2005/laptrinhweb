<?php
class BenhNhanController {

    // Danh sách + tìm kiếm
    public function list() {
        $keyword = $_GET['q'] ?? '';
        $data = BenhNhan::all($keyword);
        require 'views/benhnhan/list.php';
    }

    // Thêm
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            BenhNhan::create($_POST);
            header("Location: index.php?c=benhnhan&a=list");
            exit;
        }
        require 'views/benhnhan/add.php';
    }

    // Sửa
    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $bn = BenhNhan::find($id);

        if (!$bn) {
            echo "Bệnh nhân không tồn tại";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            BenhNhan::update($id, $_POST);
            header("Location: index.php?c=benhnhan&a=list");
            exit;
        }

        require 'views/benhnhan/edit.php';
    }

    // Xóa
    public function delete() {
        $id = (int)($_GET['id'] ?? 0);

        if (!BenhNhan::delete($id)) {
            echo "❌ Không thể xóa: bệnh nhân đã có hồ sơ nhập viện";
            return;
        }

        header("Location: index.php?c=benhnhan&a=list");
    }
}
