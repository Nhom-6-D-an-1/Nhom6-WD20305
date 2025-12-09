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


    'createType'    => (new AdminController())->createType(),
    'createFit'     => (new AdminController())->createFit(),
    'createGit'     => (new AdminController())->createGit(),

    'storeFit'      => (new AdminController())->storeFit(),
    'storeGit'      => (new AdminController())->storeGit(),
    'addGitGuests'      => (new AdminController())->addGitGuests(),
    'storeGitGuest'      => (new AdminController())->storeGitGuest(),
    'deleteGitGuest'      => (new AdminController())->deleteGitGuest(),
    'finishGit'      => (new AdminController())->finishGit(),
    'deleteGuest'      => (new AdminController())->deleteGuest(),

    'guestList'     => (new AdminController())->guestList(),



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
    'departureAdd'      => (new DepartureController())->departureAdd(),
    'departureEdit'      => (new DepartureController())->departureEdit(),
    'departureDetail'      => (new DepartureController())->departureDetail(),
    'deleteStaff'      => (new DepartureController())->deleteStaff(),
    'addService'      => (new DepartureController())->addService(),
    'deleteService'      => (new DepartureController())->deleteService(),


    // Logout 
    'logout' => (new AuthController())->logout(),
    default            => (new AdminController())->viewDashboard(),
};
