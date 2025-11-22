<nav class="sidebar position-fixed top-0 start-0 vh-100 bg-dark text-white">
    <div class="position-sticky">
        
        <!-- Logo -->
        <div class="text-center mb-2 logo">
            <img class="img-fluid" src="<?= BASE_URL ?>assets/images/logo.png" width="100" alt="">
            <h5 class="text-white mb-5">Premium Tour</h5>
        </div>

        <ul class="nav flex-column px-3">

            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/home' ? 'active' : '' ?>"
                   href="<?= BASE_URL ?>?mode=admin">
                    Dashboard
                </a>
            </li>

            <!-- Danh mục tour -->
            <li class="nav-item mb-2">
                <a class="nav-link <?= ($view ?? '') === 'admin/tour_category/list' ? 'active' : '' ?>"
                   href="<?= BASE_URL ?>?mode=admin&action=tourcategory">
                    Danh mục tour
                </a>
            </li>

            <!-- Quản lý tour -->
            <li class="nav-item mb-2">
                <a class="nav-link"
                   href="<?= BASE_URL ?>?mode=admin&action=tour">
                    Quản lý tour
                </a>
            </li>

            <!-- Quản lý booking -->
            <li class="nav-item mb-2">
                <a class="nav-link"
                   href="<?= BASE_URL ?>?mode=admin&action=booking">
                    Quản lý booking
                </a>
            </li>

            <!-- Quản lý khách hàng -->
            <li class="nav-item mb-2">
                <a class="nav-link"
                   href="<?= BASE_URL ?>?mode=admin&action=guest">
                    Quản lý khách hàng
                </a>
            </li>

            <!-- Quản lý hướng dẫn viên -->
            <li class="nav-item mb-2">
                <a class="nav-link"
                   href="<?= BASE_URL ?>?mode=admin&action=guide_manager">
                    Quản lý HDV
                </a>
            </li>

            <!-- Quản lý nhân sự -->
            <li class="nav-item mb-2">
                <a class="nav-link"
                   href="<?= BASE_URL ?>?mode=admin&action=staff">
                    Quản lý nhân sự
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item mb-2">
                <a class="nav-link text-danger"
                   href="<?= BASE_URL ?>?mode=auth&action=logout">
                    Đăng xuất
                </a>
            </li>

        </ul>
    </div>
</nav>
