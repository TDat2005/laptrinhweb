<?php
// Kết nối database
$conn = mysqli_connect("localhost", "root", "", "74dctt25_qltv");

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}