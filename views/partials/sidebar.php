<nav class="sidebar position-fixed top-0 start-0 vh-100 bg-dark text-white">
    <div class="position-sticky">
        <!-- Logo -->
         <div class="text-center mb-2 logo">
            <img class="img-fluid" src="<?php BASE_URL ?>assets/images/logo.png" width="100" alt="">
            <h5 class="text-white mb-5">Premium Tour</h5>
         </div>
         <ul class="nav flex-column px-3">
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'schedule/index' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=viewschedule">
                    Lịch làm việc
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'customers/index' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=viewcustomers">
                    Danh sách khách
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'diary/index' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=viewdiary">
                    Nhật ký tour
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'check-in/index' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=viewcheck-in">
                    Check-in, điểm danh
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'request/index' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=viewrequest">
                    Yêu cầu đặc biệt
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'report/index' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=viewreport">
                    Báo cáo sự cố
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="<?= BASE_URL ?>?logout">
                    Đăng xuất
                </a>
            </li>
         </ul>
    </div>
</nav>