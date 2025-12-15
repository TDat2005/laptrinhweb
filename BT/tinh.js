function tinh() {
    let a = Number(document.getElementById("a").value);
    let b = Number(document.getElementById("b").value);

    let pt = document.querySelector("input[name='pt']:checked");

    // Nếu chưa chọn phép toán -> không tính
    if (!pt) {
        document.getElementById("kq").textContent = "";
        return;
    }

    let kq;

    switch (pt.value) {
        case "+":
            kq = a + b;
            break;
        case "-":
            kq = a - b;
            break;
        case "*":
            kq = a * b;
            break;
        case "/":
            if (b === 0) {
                kq = "Không thể chia cho 0";
            } else {
                kq = a / b;
            }
            break;
    }

    document.getElementById("kq").textContent = kq;
}

// Gọi hàm khi nhập số
document.getElementById("a").oninput = tinh;
document.getElementById("b").oninput = tinh;

// Gọi hàm khi chọn phép toán
document.querySelectorAll("input[name='pt']").forEach(pt => {
    pt.onchange = tinh;
});
