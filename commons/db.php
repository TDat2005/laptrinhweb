<?php
// commons/db.php

define('DB_HOST', 'localhost');
define('DB_NAME', 'ql_benh_nhan_noi_tru');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

class DB {
    private static ?mysqli $conn = null;

    public static function conn(): mysqli {
        if (self::$conn === null) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$conn->connect_error) {
                die("DB connect failed: " . self::$conn->connect_error);
            }
            self::$conn->set_charset(DB_CHARSET);
        }
        return self::$conn;
    }
}