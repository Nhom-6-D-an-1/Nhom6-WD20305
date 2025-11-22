<?php

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
