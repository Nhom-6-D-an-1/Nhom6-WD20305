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

      
    public function viewDanhmuc()
    {
        $categoryModel = new TourCategoryModel();
        $categories = $categoryModel->getAllCategories();

        $title = "Danh mục tour";
        $view = 'admin/danhmuc/danhmuc';
        require_once PATH_VIEW_MAIN;
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
            $ok = $categoryModel->deleteCategory((int)$id);
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
        $title = "Quản lý tài khoản";
        $view = 'admin/account/account';
        require_once PATH_VIEW_MAIN;
    }
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
