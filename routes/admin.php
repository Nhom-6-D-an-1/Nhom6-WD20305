<?php
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
