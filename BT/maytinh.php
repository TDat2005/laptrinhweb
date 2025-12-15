<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Máy tính đơn giản</title>
  <link rel="stylesheet" href="maytinh.css" />
</head>
<body>
  <div class="calculator">
    <input type="text" id="screen" disabled />
    <div class="buttons">
      <button class="num" onclick="press('1')">1</button>
      <button class="num" onclick="press('2')">2</button>
      <button class="num" onclick="press('3')">3</button>
      <button class="op"  onclick="press('+')">+</button>

      <button class="num" onclick="press('4')">4</button>
      <button class="num" onclick="press('5')">5</button>
      <button class="num" onclick="press('6')">6</button>
      <button class="op"  onclick="press('-')">-</button>

      <button class="num" onclick="press('7')">7</button>
      <button class="num" onclick="press('8')">8</button>
      <button class="num" onclick="press('9')">9</button>
      <button class="op"  onclick="press('*')">*</button>

      <button class="clear special" onclick="clearScreen()">C</button>
      <button class="num zero" onclick="press('0')">0</button>
      <button class="equal special" onclick="calculate()">=</button>
      <button class="op"  onclick="press('/')">/</button>
    </div>
  </div>

  <script src="maytinh.js"></script>
</body>
</html>
