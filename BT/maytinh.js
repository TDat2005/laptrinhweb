function press(value) {
    document.getElementById("screen").value += value;
}

function calculate() {
    let text = document.getElementById("screen").value;
    try {
        document.getElementById("screen").value = eval(text);
    } catch {
        document.getElementById("screen").value = "Lỗi!";
    }
}

function clearScreen() {
    document.getElementById("screen").value = "";
}
