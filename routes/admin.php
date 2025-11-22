<?php
<<<<<<< HEAD

// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['flash_error'] = "Bạn không có quyền truy cập trang này!";
    header("Location: " . BASE_URL . "?mode=auth");
    exit();
}

$action = $_GET['action'] ?? '/';

$controller = new AdminController();

// Router cho admin
match ($action) {
    '/'        => $controller->Home(),
    default    => $controller->Home()
};
=======
$action = $_GET['action'] ?? '/';
if ($_SESSION['user'] && $_SERVER['user']['role'] == 'admin') {
    match ($action) {
        '/' => (new AdminController)->Home(),
    };
} else {
    $_SESSION['flash_error'] = "Bạn không có quyền truy cập trang này!";
    header("Location: " . BASE_URL);
    exit();
}
>>>>>>> 6620108b0a9a890054b25d2656816a704ab032bb
