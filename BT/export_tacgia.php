<?php
require_once "connect.php";

// Gọi thư viện PHPExcel
require_once "Classes/PHPExcel.php";
require_once "Classes/PHPExcel/IOFactory.php";

// Tạo file Excel
$objExcel = new PHPExcel();
$objExcel->setActiveSheetIndex(0);
$sheet = $objExcel->getActiveSheet()->setTitle('Danh sách tác giả');

// Tiêu đề
$rowCount = 1;
$sheet->setCellValue('A'.$rowCount, 'Mã tác giả');
$sheet->setCellValue('B'.$rowCount, 'Tên tác giả');
$sheet->setCellValue('C'.$rowCount, 'Ngày sinh');
$sheet->setCellValue('D'.$rowCount, 'Giới tính');
$sheet->setCellValue('E'.$rowCount, 'Điện thoại');
$sheet->setCellValue('F'.$rowCount, 'Email');
$sheet->setCellValue('G'.$rowCount, 'Địa chỉ');

// Màu + căn giữa
$sheet->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                   ->getStartColor()->setRGB('FFFF00');
$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Lấy dữ liệu từ DB
$sql = "SELECT * FROM tacgia";
$result = mysqli_query($conn, $sql);

// Ghi dữ liệu
while ($row = mysqli_fetch_assoc($result)) {
    $rowCount++;

    $sheet->setCellValue('A'.$rowCount, $row['matacgia']);
    $sheet->setCellValue('B'.$rowCount, $row['tentacgia']);
    $sheet->setCellValue('C'.$rowCount, $row['ngaysinh']);
    $sheet->setCellValue('D'.$rowCount, $row['gioitinh']);
    $sheet->setCellValue('E'.$rowCount, $row['dienthoai']);
    $sheet->setCellValue('F'.$rowCount, $row['email']);
    $sheet->setCellValue('G'.$rowCount, $row['diachi']);
}

// Tự giãn cột
foreach(range('A','G') as $col){
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Kẻ bảng
$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$sheet->getStyle('A1:G'.$rowCount)->applyFromArray($styleArray);

// Xuất file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="tacgia.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
