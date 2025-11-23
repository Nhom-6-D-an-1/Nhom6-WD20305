<?php

// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['flash_error'] = "Bạn không có quyền truy cập trang này!";
    header("Location: " . BASE_URL . "?mode=auth");
    exit();
}

$action = $_GET['action'] ?? '/';

// $controller = new AdminController();

// Router cho admin
match ($action) {
    '/'        => (new AdminController())->viewDashboard(),
    'viewsdashboard'         => (new AdminController())->viewDashboard(),

    'viewsbooking'         => (new AdminController())->viewBooking(),

    'viewstour'         => (new AdminController())->viewTour(),

    'viewsdanhmuc'       => (new AdminController())->viewDanhmuc(),

    'adddanhmuc'         => (new AdminController())->addDanhmuc(),

    'storedanhmuc'       => (new AdminController())->storeDanhmuc(),

    'suadanhmuc'         => (new AdminController())->editDanhmuc(),

    'updatedanhmuc'      => (new AdminController())->updateDanhmuc(),

    'xemchitietdanhmuc'  => (new AdminController())->showDanhmuc(),

    'xoadanhmuc'         => (new AdminController())->deleteDanhmuc(),

    'viewsaccount'         => (new AdminController())->viewAccount(),
    
    'viewsresources'         => (new AdminController())->viewResources(),
    default    => (new AdminController())->viewDashboard()
};
