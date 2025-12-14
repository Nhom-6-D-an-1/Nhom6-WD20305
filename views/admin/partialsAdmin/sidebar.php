<nav class="sidebar position-fixed top-0 start-0 vh-100 bg-dark text-white">
    <div class="position-sticky">
        <!-- Logo -->
        <div class="text-center mb-2 logo">
            <img class="img-fluid" src="<?php BASE_URL ?>assets/images/logo.png" width="100" alt="">
            <h5 class="text-white mb-5">Premium Tour</h5>
        </div>
        <ul class="nav flex-column px-3">
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/dashboard/dashboard' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewsdashboard">
                    Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/danhmuc/danhmuc' || ($view ?? '') === 'admin/danhmuc/show' || ($view ?? '') === 'admin/danhmuc/create' || ($view ?? '') === 'admin/danhmuc/edit' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewsdanhmuc">
                    Danh mục tour
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/tour/tour' || ($view ?? '') === 'admin/departure/departureAdd' || ($view ?? '') === 'admin/tour/editTour' || ($view ?? '') === 'admin/tour/createTour' || ($view ?? '') === 'admin/tour/createVersion' || ($view ?? '') === 'admin/tour/editVersion' || ($view ?? '') === 'admin/tour/itineraryAdd' || ($view ?? '') === 'admin/tour/itineraryEdit' || ($view ?? '') === 'admin/tour/versionDetail' || ($view ?? '') === 'admin/tour/tourDetail' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewstour">
                    Quản lý tour
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/departure/departure' || ($view ?? '') === 'admin/departure/departureDetail' || ($view ?? '') === 'admin/departure/departureEdit'  ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewDeparture">
                    Quản lý lịch khởi hành
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/booking/booking' || ($view ?? '') === 'admin/booking/showBooking' || ($view ?? '') === 'admin/booking/editBooking' || ($view ?? '') === 'admin/booking/addBooking' || ($view ?? '') === 'admin/booking/create_fit' || ($view ?? '') === 'admin/booking/create_git' || ($view ?? '') === 'admin/booking/create_type' || ($view ?? '') === 'admin/booking/guest_list' || ($view ?? '') === 'admin/booking/create_git_guests' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewsbooking">
                    Quản lý booking
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/account/account' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewsaccount">
                    Quản lý tài khoản
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/resources/resources' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=admin&action=viewsresources">
                    Quản lý nhân sự
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="<?= BASE_URL ?>?mode=admin&action=logout">
                    Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</nav>