<?php
class AdminController
{
    // BOOKING
    public function viewBooking()
    {
        $bookingModel = new BookingModel();
        $bookings = $bookingModel->getAllBooking();
        
        $title = "Quản lý booking";
        $view = 'admin/booking/booking';
        require_once PATH_VIEW_MAIN;
    }
    public function viewAddBooking()
    {
        // Load departures for selection
        $bookingModel = new BookingModel();
        $departures = $bookingModel->getDepartures();

        $title = "Thêm booking";
        $view = 'admin/booking/addBooking';
        require_once PATH_VIEW_MAIN;
    }

    // Xem chi tiết booking
    public function showBooking()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
            exit;
        }

        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingWithDetails($id);

        if (!$booking) {
            $_SESSION['flash_error'] = 'Booking không tồn tại!';
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
            exit;
        }

        $title = "Chi tiết booking";
        $view = 'admin/booking/showBooking';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý thêm booking
    public function addBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':departure_id' => !empty($_POST['departure_id']) ? (int)$_POST['departure_id'] : null,
                ':customer_name' => trim($_POST['customer_name'] ?? ''),
                ':customer_contact' => trim($_POST['customer_contact'] ?? ''),
                ':total_amount' => (float)($_POST['total_amount'] ?? 0),
                ':status' => $_POST['status'] ?? 'pending',
                ':created_at' => date('Y-m-d H:i:s')
            ];

            $bookingModel = new BookingModel();
            $ok = $bookingModel->addBooking($data);

            header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
            exit;
        }

        header('Location: ' . BASE_URL . '?mode=admin&action=views_add_booking');
        exit;
    }  
    
    // Xem form sửa booking
    public function editBooking()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
            exit;
        }

        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingById($id);

        if (!$booking) {
            $_SESSION['flash_error'] = 'Booking không tồn tại!';
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
            exit;
        }

        $departures = $bookingModel->getDepartures();

        $title = "Sửa booking";
        $view = 'admin/booking/editBooking';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý cập nhật booking
    public function updateBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['booking_id'] ?? null;
            if (!$id) {
                $_SESSION['flash_error'] = 'Booking ID không hợp lệ.';
                header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
                exit;
            }

            $data = [
                ':departure_id' => !empty($_POST['departure_id']) ? (int)$_POST['departure_id'] : null,
                ':customer_name' => trim($_POST['customer_name'] ?? ''),
                ':customer_contact' => trim($_POST['customer_contact'] ?? ''),
                ':total_amount' => (float)($_POST['total_amount'] ?? 0),
                ':status' => $_POST['status'] ?? 'pending',
                ':id' => (int)$id
            ];

            $bookingModel = new BookingModel();
            $ok = $bookingModel->updateBooking($id, $data);

            if ($ok) {
                $_SESSION['flash_success'] = "Cập nhật booking thành công.";
            } else {
                $_SESSION['flash_error'] = "Cập nhật booking thất bại.";
            }

            header('Location: ' . BASE_URL . '?mode=admin&action=showbooking&id=' . (int)$id);
            exit;
        }

        header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
        exit;
    }

    // Xử lý xóa booking
        public function deleteBooking()
        {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $bookingModel = new BookingModel();
                $ok = $bookingModel->deleteBooking((int)$id);
                if ($ok) {
                    $_SESSION['flash_success'] = "Xóa booking thành công.";
                } else {
                    $_SESSION['flash_error'] = "Xóa booking thất bại. Vui lòng kiểm tra ràng buộc dữ liệu.";
                }
            } else {
                $_SESSION['flash_error'] = "ID booking không hợp lệ.";
            }
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsbooking');
            exit;
        }

    // TOUR
    public function viewTour()
    {
        // Load tours
        $tourModel = new TourModel();
        $tours = $tourModel->getAllTours();

        $title = "Quản lý tour";
        $view = 'admin/tour/tour';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý thêm tour
    public function addTour()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'category_id' => $_POST['category_id'] ?? null,
                'tour_name' => trim($_POST['tour_name'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];

            $tourModel = new TourModel();
            $ok = $tourModel->addTour($data);

            header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
            exit;
        }
        header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
        exit;
    }

    // Xem form sửa tour
    public function editTour()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
            exit;
        }

        $tourModel = new TourModel();
        $tour = $tourModel->getTourById($id);

        if (!$tour) {
            $_SESSION['flash_error'] = 'Tour không tồn tại!';
            header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
            exit;
        }

        $title = "Sửa tour";
        $view = 'admin/tour/edit';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý cập nhật tour
    public function updateTour()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['tour_id'] ?? null;
            if (!$id) {
                $_SESSION['flash_error'] = 'Tour ID không hợp lệ.';
                header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
                exit;
            }

            $data = [
                'category_id' => $_POST['category_id'] ?? null,
                'tour_name' => trim($_POST['tour_name'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];

            $tourModel = new TourModel();
            $ok = $tourModel->updateTour($id, $data);

            if ($ok) {
                $_SESSION['flash_success'] = "Cập nhật tour thành công.";
            } else {
                $_SESSION['flash_error'] = "Cập nhật tour thất bại.";
            }

            header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
            exit;
        }

        header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
        exit;
    }

        // Xử lý xóa tour
        public function deleteTour()
        {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $tourModel = new TourModel();
                $tourModel->deleteTour((int)$id);
            }
            header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
            exit;
        }
        public function showTour()
        {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
                exit;
            }

            $tourModel = new TourModel();
            $tour = $tourModel->showTour($id);

            if (!$tour) {
                $_SESSION['flash_error'] = 'Tour không tồn tại!';
                header('Location: ' . BASE_URL . '?mode=admin&action=viewstour');
                exit;
            }

            $title = "Chi tiết tour";
            $view = 'admin/tour/show';
            require_once PATH_VIEW_MAIN;
        }

      //DANH MỤC TOUR
    public function viewDanhmuc()
    {
        $categoryModel = new TourCategoryModel();
        $categories = $categoryModel->getAllCategories();

        $title = "Danh mục tour";
        $view = "admin/danhmuc/danhmuc";

        require_once PATH_VIEW_MAIN;
    }

    public function addDanhmuc() {
        $title = "Thêm danh mục tour";
        $view = "admin/danhmuc/create";

        require_once PATH_VIEW_MAIN;
    }


    public function storeDanhmuc() {
        $model = new TourCategoryModel();

        $data = [
            "category_name" => $_POST['category_name'],
            "description"   => $_POST['description'],
            "status"        => $_POST['status']
        ];

        $model->addDanhmuc($data);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    public function editDanhmuc() {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $category = $model->getById($id);

        $title = "Sửa danh mục tour";
        $view = "admin/danhmuc/edit";

        require_once PATH_VIEW_MAIN;
    }


    public function updateDanhmuc() {
        $id = $_GET['id'];
        $model = new TourCategoryModel();

        $data = [
            "category_name" => $_POST['category_name'],
            "description"   => $_POST['description'],
            "status"        => $_POST['status']
        ];

        $model->updateDanhmuc($id, $data);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    public function showDanhmuc() {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $category = $model->getById($id);

        $title = "Chi tiết danh mục tour";
        $view = "admin/danhmuc/show";

        require_once PATH_VIEW_MAIN;
    }


    public function deleteDanhmuc() {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $model->deleteDanhmuc($id);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    // Xử lý thêm danh mục tour
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'category_name' => trim($_POST['category_name'] ?? '')
            ];

            if (!empty($data['category_name'])) {
                $categoryModel = new TourCategoryModel();
                $ok = $categoryModel->addCategory($data);
                if ($ok) {
                    $_SESSION['flash_success'] = "Thêm danh mục tour thành công.";
                } else {
                    $_SESSION['flash_error'] = "Thêm danh mục tour thất bại.";
                }
            } else {
                $_SESSION['flash_error'] = "Tên danh mục không được để trống.";
            }

            header('Location: ' . BASE_URL . '?mode=admin&action=viewsdanhmuc');
            exit;
        }

        header('Location: ' . BASE_URL . '?mode=admin&action=viewsdanhmuc');
        exit;
    }

    // Xử lý xóa danh mục tour
    public function deleteCategory()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $categoryModel = new TourCategoryModel();
            $ok = $categoryModel->deleteDanhmuc((int)$id);
            if ($ok) {
                $_SESSION['flash_success'] = "Xóa danh mục tour thành công.";
            } else {
                $_SESSION['flash_error'] = "Xóa danh mục tour thất bại. Vui lòng kiểm tra ràng buộc dữ liệu.";
            }
        } else {
            $_SESSION['flash_error'] = "ID danh mục không hợp lệ.";
        }
        header('Location: ' . BASE_URL . '?mode=admin&action=viewsdanhmuc');
        exit;
    }
    public function viewAccount()
    {
        $accountModel = new AccountModel();
        $accounts = $accountModel->getAllAccounts();
        $title = "Quản lý tài khoản";
        $view = 'admin/account/account';
        require_once PATH_VIEW_MAIN;
    }
    public function addAccount()
    {
    $title = "Thêm tài khoản";
    $view = 'admin/account/add';
    require_once PATH_VIEW_MAIN;
    }
    public function storeAccount()
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = [
            'full_name' => $_POST['full_name'],
            'user_name' => $_POST['user_name'],
            'password_hash'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role'      => $_POST['role'],
            // 'status'    => $_POST['status']
        ];

        $accountModel = new AccountModel();
        $accountModel->insertAccount($data);

        header("Location: " . BASE_URL . "?mode=admin&action=viewsaccount");
        exit;
    }
    }
    public function xoaAccount()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $accountModel = new AccountModel();
            $accountModel->deleteAccount($id);
        }
        header('Location: ' . BASE_URL . '?mode=admin&action=viewsaccount');
        exit;
    }

    // Hiển thị form sửa tài khoản
    public function editAccount()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsaccount');
            exit;
        }

        $accountModel = new AccountModel();
        $account = $accountModel->getAccountById((int)$id);

        if (!$account) {
            $_SESSION['flash_error'] = 'Tài khoản không tồn tại.';
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsaccount');
            exit;
        }

        $title = 'Sửa tài khoản';
        $view = 'admin/account/edit';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý cập nhật tài khoản
    public function updateAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsaccount');
            exit;
        }

        $id = $_POST['user_id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'ID tài khoản không hợp lệ.';
            header('Location: ' . BASE_URL . '?mode=admin&action=viewsaccount');
            exit;
        }

        $data = [
            'full_name' => trim($_POST['full_name'] ?? ''),
            'username' => trim($_POST['username'] ?? ''),
            'role' => $_POST['role'] ?? 'guide',
            'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1,
        ];

        // Nếu nhập mật khẩu mới, băm
        if (!empty($_POST['password'])) {
            $data['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $data['password_hash'] = '';
        }

        $accountModel = new AccountModel();
        $ok = $accountModel->updateAccount((int)$id, $data);

        if ($ok) {
            $_SESSION['flash_success'] = 'Cập nhật tài khoản thành công.';
        } else {
            $_SESSION['flash_error'] = 'Cập nhật tài khoản thất bại.';
        }

        header('Location: ' . BASE_URL . '?mode=admin&action=viewsaccount');
        exit;
    }
    

// Nhân Sự
    public function viewResources()
    {
        $title = "Quản lý nhân sự";
        $view = 'admin/resources/resources';
        require_once PATH_VIEW_MAIN;
    }
    public function viewDashboard()
    {
        $title = "Dashboard";
        $view = 'admin/dashboard/dashboard';
        require_once PATH_VIEW_MAIN;
    }
}
