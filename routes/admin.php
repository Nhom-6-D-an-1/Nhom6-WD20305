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
    'views_add_booking'         => (new AdminController())->viewAddBooking(),

    'addbooking'                => (new AdminController())->addBooking(),
    'deletebooking'             => (new AdminController())->deleteBooking(),

    'viewstour'         => (new AdminController())->viewTour(),
    'addtour'           => (new AdminController())->addTour(),
    'deletetour'        => (new AdminController())->deleteTour(),
    'viewsdanhmuc'         => (new AdminController())->viewDanhmuc(),
    'addcategory'       => (new AdminController())->addCategory(),
    'deletecategory'    => (new AdminController())->deleteCategory(),
    'viewsaccount'         => (new AdminController())->viewAccount(),
    'viewsresources'         => (new AdminController())->viewResources(),
    default    => (new AdminController())->viewDashboard()
};
