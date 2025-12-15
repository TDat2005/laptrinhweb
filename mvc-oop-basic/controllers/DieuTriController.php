<?php
class DieuTriController {

    public function list() {

        $filter = [
            'id_khoa' => $_GET['id_khoa'] ?? null,
            'id_phong' => $_GET['id_phong'] ?? null,
        ];

        $data = DieuTri::list($filter);
        $khoa = DieuTri::khoa();

        require 'views/dieutri/list.php';
    }

    // AJAX load phòng
    public function phong() {
        $id_khoa = (int)$_GET['id_khoa'];
        echo json_encode(DieuTri::phongByKhoa($id_khoa));
    }
}
