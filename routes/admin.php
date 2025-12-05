<?php

// ============================
// KIỂM TRA QUYỀN ADMIN
// ============================
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['flash_error'] = "Bạn không có quyền truy cập trang này!";
    header("Location: " . BASE_URL . "?mode=auth");
    exit();
}

// LẤY ACTION
$action = $_GET['action'] ?? '/';

// ROUTER ADMIN

match ($action) {

    // ========== DASHBOARD ==========
    '/'               => (new AdminController())->viewDashboard(),
    'viewsdashboard'  => (new AdminController())->viewDashboard(),

    // ========== BOOKING ==========
    'viewsbooking'    => (new AdminController())->viewBooking(),
    'views_add_booking'         => (new AdminController())->viewAddBooking(),
    'showbooking'               => (new AdminController())->showBooking(),
    'suabooking'                => (new AdminController())->editBooking(),
    'updatebooking'             => (new AdminController())->updateBooking(),
    'addbooking'                => (new AdminController())->addBooking(),
    'deletebooking'             => (new AdminController())->deleteBooking(),


    // ========== DANH MỤC TOUR ==========
    'viewsdanhmuc'       => (new AdminController())->viewDanhmuc(),
    'adddanhmuc'         => (new AdminController())->addDanhmuc(),
    'storedanhmuc'       => (new AdminController())->storeDanhmuc(),
    'suadanhmuc'         => (new AdminController())->editDanhmuc(),
    'updatedanhmuc'      => (new AdminController())->updateDanhmuc(),
    'xemchitietdanhmuc'  => (new AdminController())->showDanhmuc(),
    'xoadanhmuc'         => (new AdminController())->deleteDanhmuc(),

    // ========== ACCOUNT ==========

    'viewsaccount'         => (new AdminController())->viewAccount(),
    'addaccount'        => (new AdminController())->addAccount(),
    'storeaccount'      => (new AdminController())->storeAccount(),
    'deleteaccount'    => (new AdminController())->xoaAccount(),
    'editaccount'      => (new AdminController())->editAccount(),
    'updateaccount'    => (new AdminController())->updateAccount(),

    'viewsresources'         => (new AdminController())->viewResources(),
    'viewGuideDetail'         => (new AdminController())->viewGuideDetail(),
    'viewEditGuide'         => (new AdminController())->viewEditGuide(),


    // ===============   TOUR CONTROLLER   ===============
    'viewstour'   => (new TourController())->viewTour(),
    'createTour'    => (new TourController())->createTour(),
    'tourDetail'     => (new TourController())->tourDetail(),
    'editTour'   => (new TourController())->editTour(),
    'deleteTour'   => (new TourController())->deleteTour(),
    'createVersion'  => (new TourController())->createVersion(),
    'versionDetail'  => (new TourController())->versionDetail(),
    'editVersion'  => (new TourController())->editVersion(),
    'itineraryAdd' => (new TourController())->itineraryAdd(),
    'itineraryEdit'      => (new TourController())->itineraryEdit(),
    'deleteItinerary'      => (new TourController())->deleteItinerary(),
    'addImage'      => (new TourController())->addImage(),
    'deleteImage'      => (new TourController())->deleteImage(),

    // Departure
    'viewDeparture'      => (new DepartureController())->viewDeparture(),



    // Logout 
    'logout' => (new AuthController())->logout(),
    default            => (new AdminController())->viewDashboard(),
};
