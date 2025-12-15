function tinh() {
    let a = Number(document.getElementById("a").value);
    let b = Number(document.getElementById("b").value);
    let pt = document.querySelector("input[name='pt']:checked");

    if (!pt) {
        alert("Bạn chưa chọn phép toán!");
        return;
    }

    let kq = 0;

    switch (pt.value) {
        case '+': kq = a + b; break;
        case '-': kq = a - b; break;
        case '*': kq = a * b; break;
        case '/': 
            if (b === 0) { kq = "Không thể chia cho 0"; break; }
            kq = a / b; 
        break;
    }

    document.getElementById("kq").textContent = kq;
}
