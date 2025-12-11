<?php

define('BASE_URL',         'http://localhost/duan1/'); // Thêm đường dẫn tới thư mục dự án

define('PATH_ROOT',         __DIR__ . '/../');

define('PATH_VIEW',         PATH_ROOT . 'views/');

define('PATH_VIEW_MAIN',    PATH_ROOT . 'views/main.php');

define('BASE_ASSETS_UPLOADS',   BASE_URL . 'assets/uploads/');

define('PATH_ASSETS_UPLOADS',   PATH_ROOT . 'assets/uploads/');

define('PATH_CONTROLLER',       PATH_ROOT . 'controllers/');

define('PATH_MODEL',            PATH_ROOT . 'models/');
// // Đổi múi giờ thành UTC+7
date_default_timezone_set('Asia/Ho_Chi_Minh');

define('DB_HOST',     'localhost');
define('DB_PORT',     '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME',     'duan1');
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

define('FAKE_TIME_ENABLE', false);

// Giá trị fake time (YYYY-MM-DD)
define('FAKE_TIME_VALUE', '2025-11-20');

/**
 * Hàm lấy ngày hiện tại, nhưng hỗ trợ FAKE TIME
 */
function today()
{
    if (FAKE_TIME_ENABLE) {
        return FAKE_TIME_VALUE; // luôn trả về ngày giả
    }
    return date("Y/m/d");
}
