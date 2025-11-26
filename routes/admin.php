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
    'showbooking'               => (new AdminController())->showBooking(),
    'suabooking'                => (new AdminController())->editBooking(),
    'updatebooking'             => (new AdminController())->updateBooking(),
    'addbooking'                => (new AdminController())->addBooking(),
    'deletebooking'             => (new AdminController())->deleteBooking(),


    'viewstour'         => (new AdminController())->viewTour(),
    'addtour'           => (new AdminController())->addTour(),
    'edittour'          => (new AdminController())->editTour(),
    'updatetour'        => (new AdminController())->updateTour(),
    'deletetour'        => (new AdminController())->deleteTour(),
    'showtour'          => (new AdminController())->showTour(),


    'viewsdanhmuc'         => (new AdminController())->viewDanhmuc(),
    'adddanhmuc'         => (new AdminController())->addDanhmuc(),
    'storedanhmuc'       => (new AdminController())->storeDanhmuc(),
    'suadanhmuc'         => (new AdminController())->editDanhmuc(),
    'updatedanhmuc'      => (new AdminController())->updateDanhmuc(),
    'xemchitietdanhmuc'  => (new AdminController())->showDanhmuc(),
    'xoadanhmuc'         => (new AdminController())->deleteDanhmuc(),


    'viewsaccount'         => (new AdminController())->viewAccount(),

    'viewsresources'         => (new AdminController())->viewResources(),
    'viewGuideDetail'         => (new AdminController())->viewGuideDetail(),
    'viewEditGuide'         => (new AdminController())->viewEditGuide(),
    default    => (new AdminController())->viewDashboard()
};
