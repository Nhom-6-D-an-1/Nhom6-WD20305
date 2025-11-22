<?php

session_start();

spl_autoload_register(function ($class) {
    $fileName = "$class.php";

    $fileModel      = PATH_MODEL . $fileName;
    $fileController = PATH_CONTROLLER . $fileName;

    if (is_readable($fileModel)) {
        require_once $fileModel;
    } else if (is_readable($fileController)) {
        require_once $fileController;
    }
});

require_once './configs/env.php';
require_once './configs/helper.php';

// Lấy mode
$mode = $_GET['mode'] ?? 'auth';

/* Chặn truy cập khi chưa login */
if (($mode == 'admin' || $mode == 'guide') && !isset($_SESSION['user'])) {
    header("Location: ?mode=auth&error=Bạn phải đăng nhập trước");
    exit;
}

/* Routing chính */
switch ($mode) {
    case 'admin':
        require './routes/admin.php';
        break;

    case 'guide':
        require './routes/guide.php';
        break;

    case 'auth':
    default:
        require './routes/auth.php';
        break;
}
