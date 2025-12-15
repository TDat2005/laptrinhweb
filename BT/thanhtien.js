function tinhTien() {
    let soLuong = Number(document.getElementById("a").value);
    let donGia = Number(document.getElementById("b").value);

    let thanhTien = soLuong * donGia;

    document.getElementById("kq").textContent = thanhTien;
}

document.getElementById("a").oninput = tinhTien;
document.getElementById("b").oninput = tinhTien;
