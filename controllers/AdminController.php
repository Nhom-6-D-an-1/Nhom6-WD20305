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
            header('Location: ?mode=admin&action=viewsbooking');
            exit;
        }

        $bookingModel = new BookingModel();
        $guestModel   = new GuestModel();

        // Lấy đầy đủ thông tin booking
        $booking = $bookingModel->getBookingWithDetails($id);

        if (!$booking) {
            $_SESSION['flash_error'] = 'Booking không tồn tại!';
            header('Location: ?mode=admin&action=viewsbooking');
            exit;
        }

        // 🔥 Quan trọng: Lấy khách theo booking_id thật của booking
        $booking_id = $booking['booking_id'];
        $guests = $guestModel->getGuestsByBooking($booking_id);

        // Lấy yêu cầu đặc biệt
        foreach ($guests as &$g) {
            $sr = $guestModel->getSpecialRequestByGuest($g['guest_id']);
            $g['special_request'] = $sr['description'] ?? "Không có";
        }
        unset($g);

        // Đính vào booking
        $booking['guests'] = $guests;

        // Gửi sang view
        $title = "Chi tiết booking";
        $view = 'admin/booking/showBooking';
        require_once PATH_VIEW_MAIN;
    }


    // Xử lý thêm booking
    public function addBooking()
    {
        // CHỈ DÙNG CHO FIT – KHÁCH LẺ
        if ($_POST['customer_type'] !== 'le') {
            $_SESSION['flash_error'] = "Sai luồng xử lý! Booking đoàn không dùng addBooking().";
            header("Location: " . BASE_URL . "?mode=admin&action=viewsbooking");
            exit;
        }

        $bookingModel = new BookingModel();
        $guestModel   = new GuestModel();

        // 1. Tạo booking FIT
        $booking_id = $bookingModel->addBooking([
            'departure_id'     => $_POST['departure_id'],
            'customer_name'    => $_POST['customer_name'],
            'customer_contact' => $_POST['customer_contact'],
            'customer_type'    => 'le',
        ]);

        // 2. Thêm khách
        $guest_id = $guestModel->addGuest([
            'booking_id' => $booking_id,
            'full_name'  => $_POST['guest_name'],
            'gender'     => $_POST['gender'],
            'birth_year' => $_POST['birth_year'],
            'phone'      => $_POST['phone'],
        ]);

        // 3. Nếu có yêu cầu đặc biệt
        if (!empty($_POST['special_request'])) {
            $guestModel->addSpecialRequest([
                'guest_id'    => $guest_id,
                'description' => $_POST['special_request'],
            ]);
        }

        $_SESSION['flash_success'] = "Thêm booking FIT thành công!";
        header("Location: " . BASE_URL . "?mode=admin&action=showbooking&id=" . $booking_id);
        exit;
    }


    public function createType()
    {
        $departure_id = $_GET['id'] ?? null;
        if (!$departure_id) {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $title = "Chọn loại booking";
        $view = 'admin/booking/create_type';
        require_once PATH_VIEW_MAIN;
    }

    public function createFit()
    {
        $departure_id = $_GET['id'] ?? null;
        if (!$departure_id) {
            header("Location: ?mode=admin&action=viewsbooking");
            exit;
        }

        $title = "Booking khách lẻ";
        $view = "admin/booking/create_fit";
        require_once PATH_VIEW_MAIN;
    }


    public function createGit()
    {
        $departure_id = $_GET['id'] ?? null;
        if (!$departure_id) {
            header("Location: ?mode=admin&action=viewsbooking");
            exit;
        }

        $title = "Booking khách đoàn";
        $view = "admin/booking/create_git";
        require_once PATH_VIEW_MAIN;
    }

    public function storeFit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $departure_id = $_POST['departure_id'];

        $departure = new DepartureModel();
        $info = $departure->getOneDeparture($departure_id);

        // if ($info['current_guests'] >= $info['max_guests']) {
        //     $_SESSION['flash_error'] = "Chuyến đi đã đủ số lượng khách, không thể đặt thêm.";
        //     header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
        //     exit;
        // }

        // if ($info['status'] == 'completed') {
        //     $_SESSION['flash_error'] = "Chuyến đi đã hoàn thành, không thể đặt thêm khách.";
        //     header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
        //     exit;
        // }


        $bookingModel = new BookingModel();
        $guestModel   = new GuestModel();

        // Lấy dữ liệu gửi từ form

        $full_name    = $_POST['full_name'];
        $gender       = $_POST['gender'];
        $birth_year   = $_POST['birth_year'];
        $phone        = $_POST['phone'];
        $cccd        = $_POST['cccd'];
        $special      = $_POST['special_request'] ?? null;
        $total_amount = $_POST['total_amount'] ?? null;
        $status       = $_POST['status'] ?? 'pending';

        // Nếu total_amount rỗng → tự lấy giá tour
        if (empty($total_amount)) {
            $price = $bookingModel->getDeparturePrice($departure_id);
            $total_amount = $price ?? 0;
        }

        // 1. Thêm booking
        $booking_id = $bookingModel->addBooking([
            'departure_id'     => $departure_id,
            'customer_name'    => $full_name,
            'customer_contact' => $phone,
            'customer_type'    => 'le',
            'total_amount'     => $total_amount,
            'status'           => $status,
        ]);

        // 2. Thêm khách lẻ (guest)
        $guest_id = $guestModel->addGuest([
            'booking_id' => $booking_id,
            'full_name'  => $full_name,
            'gender'     => $gender,
            'birth_year' => $birth_year,
            'phone'      => $phone,
            'cccd'      => $cccd,
        ]);

        // 3. Nếu có yêu cầu đặc biệt thì thêm
        if (!empty($special)) {
            $guestModel->addSpecialRequest([
                'guest_id'    => $guest_id,
                'description' => $special,
            ]);
        }

        $bookingModel->updateBooking($booking_id, [
            'departure_id'     => $departure_id,
            'customer_name'    => $full_name,
            'customer_contact' => $phone,
            'customer_type'    => 'le',
            'total_amount'     => $total_amount,
            'status'           => $status,
            'total_guests'     => 1
        ]);

        $departure = new DepartureModel();
        $departure->updateCurrentGuests($departure_id);

        // Kiểm tra lại số khách sau khi cập nhật
        $info = $departure->getOneDeparture($departure_id);

        if ($info['current_guests'] >= $info['max_guests']) {
            $departure->updateStatus($departure_id, 'full');
        }

        // Chuyển hướng sang trang chi tiết booking
        header("Location: " . BASE_URL . "?mode=admin&action=showbooking&id=" . $booking_id);
        exit;
    }


    public function storeGit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $bookingModel = new BookingModel();

        // Lấy dữ liệu từ form
        $departure_id = $_POST['departure_id'];
        $full_name    = $_POST['full_name'];
        $gender       = $_POST['gender'];
        $birth_year   = $_POST['birth_year'];
        $phone        = $_POST['phone'];
        $cccd        = $_POST['cccd'];
        $special      = $_POST['special_request'] ?? null;
        $total_amount = $_POST['total_amount'] ?? null;
        $status       = $_POST['status'] ?? 'pending';

        // Nếu người dùng không nhập giá → tự lấy giá phiên bản tour
        if (empty($total_amount)) {
            $price = $bookingModel->getDeparturePrice($departure_id);
            $total_amount = $price ?? 0;
        }

        // Tạo booking GIT
        $booking_id = $bookingModel->addBooking([
            'departure_id'     => $departure_id,
            'customer_name'    => $full_name,
            'customer_contact' => $phone,
            'customer_type'    => 'doan',
            'total_amount'     => $total_amount,
            'status'           => $status,
        ]);

        // Lưu thông tin khách trưởng đoàn vào session lưu tạm
        $_SESSION['git_booking_id'] = $booking_id;
        $_SESSION['git_guests'] = [];

        // Lưu trưởng đoàn vào danh sách khách luôn
        $_SESSION['git_guests'][] = [
            'full_name' => $full_name,
            'gender' => $gender,
            'birth_year' => $birth_year,
            'phone' => $phone,
            'cccd' => $cccd,
            'special_request' => $special,
            'medical_condition' => null
        ];

        // Chuyển sang trang thêm khách đoàn
        header("Location: " . BASE_URL . "?mode=admin&action=addGitGuests");
        exit;
    }

    public function addGitGuests()
    {
        if (!isset($_SESSION['git_booking_id'])) {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $guest_list = $_SESSION['git_guests'] ?? [];

        $title = "Thêm khách đoàn";
        $view = "admin/booking/create_git_guests";

        require_once PATH_VIEW_MAIN;
    }

    public function storeGitGuest()
    {

        // Lưu khách mới vào session
        $_SESSION['git_guests'][] = [
            'full_name' => $_POST['full_name'],
            'gender' => $_POST['gender'],
            'birth_year' => $_POST['birth_year'],
            'phone' => $_POST['phone'],
            'cccd' => $_POST['cccd'],
            'special_request' => $_POST['special_request'] ?? '',
            'medical_condition' => $_POST['medical_condition'] ?? ''
        ];

        // Quay lại trang thêm khách
        header("Location: " . BASE_URL . "?mode=admin&action=addGitGuests");
        exit;
    }

    public function finishGit()
    {

        $booking_id = $_SESSION['git_booking_id'];
        $guests = $_SESSION['git_guests'];

        $guestModel = new GuestModel();
        $bookingModel = new BookingModel();
        $data_departure  = $bookingModel->getBookingById($booking_id);
        foreach ($guests as $g) {
            $guest_id = $guestModel->addGuest([
                'booking_id' => $booking_id,
                'full_name' => $g['full_name'],
                'gender' => $g['gender'],
                'birth_year' => $g['birth_year'],
                'phone' => $g['phone'],
                'cccd' => $g['cccd'],
            ]);

            // Nếu có yêu cầu đặc biệt
            if (!empty($g['special_request']) || !empty($g['medical_condition'])) {
                $guestModel->addSpecialRequest([
                    'guest_id' => $guest_id,
                    'description' => $g['special_request'] ?? '',
                    'medical_condition' => $g['medical_condition'] ?? ''
                ]);
            }
        }

        $total_guests = count($guests);
        $price = $bookingModel->getDeparturePrice($data_departure['departure_id']);
        $total_amount = $price * $total_guests;

        $bookingModel->updateBooking($booking_id, [
            'departure_id' => $data_departure['departure_id'],
            'customer_name' => $data_departure['customer_name'],
            'customer_contact' => $data_departure['customer_contact'],
            'customer_type' => 'doan',
            'total_amount' => $total_amount,
            'status' => 'completed',
            'total_guests' => $total_guests
        ]);

        $departure = new DepartureModel();
        $departure->updateCurrentGuests($data_departure['departure_id']);

        // kiểm tra xem full chưa
        $info = $departure->getOneDeparture($data_departure['departure_id']);
        if ($info['current_guests'] >= $info['max_guests']) {
            $departure->updateStatus($data_departure['departure_id'], 'full');
        }

        // Dọn session
        unset($_SESSION['git_booking_id']);
        unset($_SESSION['git_guests']);

        header("Location: " . BASE_URL . "?mode=admin&action=showbooking&id=" . $booking_id);
        exit;
    }


    public function storeGuest()
    {
        $guestModel   = new GuestModel();
        $bookingModel = new BookingModel();

        if (empty($_POST['booking_id'])) {
            $info = $_SESSION['git_info'];

            $booking_id = $bookingModel->addBooking([
                'departure_id'     => $info['departure_id'],
                'customer_name'    => $info['contact_name'],
                'customer_contact' => $info['contact_phone'],
                'customer_type'    => 'doan',
                'group_request'    => $info['group_request'],
            ]);

            $_SESSION['git_booking_id'] = $booking_id;
            unset($_SESSION['git_info']);
        } else {
            $booking_id = $_POST['booking_id'];
        }

        // Thêm khách
        $guest_id = $guestModel->addGuest([
            'booking_id' => $booking_id,
            'full_name'  => $_POST['full_name'],
            'gender'     => $_POST['gender'],
            'birth_year' => $_POST['birth_year'],
            'phone'      => $_POST['phone'],
        ]);

        if (!empty($_POST['special_request'])) {
            $guestModel->addSpecialRequest([
                'guest_id' => $guest_id,
                'description' => $_POST['special_request']
            ]);
        }

        header("Location: ?mode=admin&action=guestList&booking_id=" . $booking_id);
        exit;
    }


    public function guestList()
    {
        $booking_id = $_GET['booking_id'] ?? null;
        $guestModel = new GuestModel();

        $guest_list = [];

        if ($booking_id) {
            $guest_list = $guestModel->getGuestsByBooking($booking_id);
        }

        $title = "Danh sách khách đoàn";
        $view = "admin/booking/guest_list";
        require_once PATH_VIEW_MAIN;
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
                ':customer_type' => $_POST['customer_type'] ?? 'le',
                ':total_amount' => (float)($_POST['total_amount'] ?? 0),
                ':status' => $_POST['status'] ?? 'pending',
                'total_guests' => $_POST['total_guests'] ?? 1
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


    //DANH MỤC TOUR
    public function viewDanhmuc()
    {
        $categoryModel = new TourCategoryModel();
        $categories = $categoryModel->getAllCategories();

        $title = "Danh mục tour";
        $view = "admin/danhmuc/danhmuc";

        require_once PATH_VIEW_MAIN;
    }

    public function storeDanhmuc()
    {
        $model = new TourCategoryModel();

        $data = [
            "category_name" => $_POST['category_name'],
            "description"   => $_POST['description'],
            "status"        => $_POST['status']
        ];

        $model->addCategory($data);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    public function editDanhmuc()
    {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $category = $model->getById($id);

        $title = "Sửa danh mục tour";
        $view = "admin/danhmuc/edit";

        require_once PATH_VIEW_MAIN;
    }

    public function addDanhmuc()
    {
        $title = "Thêm danh mục tour";
        $view = "admin/danhmuc/create";

        require_once PATH_VIEW_MAIN;
    }

    public function updateDanhmuc()
    {
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


    public function showDanhmuc()
    {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $category = $model->getById($id);

        $title = "Chi tiết danh mục tour";
        $view = "admin/danhmuc/show";

        require_once PATH_VIEW_MAIN;
    }


    public function deleteDanhmuc()
    {
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
        $tourGuide = new TourGuideModel();
        $data_tourGuide = $tourGuide->getAllGuide();
        $title = "Quản lý nhân sự";
        $view = 'admin/resources/resources';
        require_once PATH_VIEW_MAIN;
    }

    public function viewGuideDetail()
    {
        $tourGuide = new TourGuideModel();
        $id = $_GET['id'] ?? '';
        $data_Guide = $tourGuide->getOneGuide($id);
        $title = "Chi tiết nhân sự";
        $view = 'admin/resources/guideDetail';
        require_once PATH_VIEW_MAIN;
    }

    public function viewEditGuide()
    {
        $tourGuide = new TourGuideModel();
        $userModel = new AccountModel(); // dùng để update bảng users

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_GET['id'] ?? '';
            $data_Guide = $tourGuide->getOneGuide($id);

            // ===== XỬ LÝ AVATAR =====
            $avatar = $data_Guide['avatar'];
            if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
                $avatar = uploadFile($_FILES['avatar'], "guide/");
            }

            // ===== XỬ LÝ ẢNH CHỨNG CHỈ =====
            $certificate_image = $data_Guide['certificate_image'] ?? null;
            if (!empty($_FILES['certificate_image']['name']) && $_FILES['certificate_image']['error'] == UPLOAD_ERR_OK) {
                $certificate_image = uploadFile($_FILES['certificate_image'], "guide/certificates/");
            }

            // ===== LẤY DỮ LIỆU FORM =====
            $full_name        = $_POST['full_name'];  // thuộc bảng users
            $birthday         = $_POST['birthday'];
            $phone            = $_POST['phone'];
            $email            = $_POST['email'];
            $gender           = $_POST['gender'];
            $languages        = $_POST['languages'];
            $rating           = $_POST['rating'];
            $experience_years = $_POST['experience_years'];
            $certificates     = $_POST['certificates'];
            $health           = $_POST['health'];
            $notes            = $_POST['notes'] ?? $data_Guide['notes'];

            // ===== 1) UPDATE TÊN USER TRONG BẢNG users =====
            $userModel->updateUserName($id, $full_name);

            // ===== 2) UPDATE THÔNG TIN HƯỚNG DẪN VIÊN TRONG BẢNG tour_guide =====
            $tourGuide->updateGuideFull([
                "birthday"          => $birthday,
                "phone"             => $phone,
                "email"             => $email,
                "avatar"            => $avatar,
                "gender"            => $gender,
                "languages"         => $languages,
                "rating"            => $rating,
                "experience_years"  => $experience_years,
                "certificates"      => $certificates,
                "certificate_image" => $certificate_image,
                "health"            => $health,
                "notes"             => $notes,
                "user_id"           => $id
            ]);

            header("Location: " . BASE_URL . "?mode=admin&action=viewGuideDetail&id=" . $id);
            exit();
        }

        // ===== HIỂN THỊ FORM =====
        $id = $_GET['id'] ?? '';
        $data_Guide = $tourGuide->getOneGuide($id);

        $title = "Chỉnh sửa thông tin nhân sự";
        $view = 'admin/resources/editGuide';
        require_once PATH_VIEW_MAIN;
    }



    public function viewDashboard()
    {
        $report = new ReportModel();

        $tourSummary = $report->summaryByTour();

        // Tính tổng doanh thu
        $totalRevenue = array_sum(array_column($tourSummary, 'revenue'));

        // Tính tổng chi phí
        $totalCost = array_sum(array_column($tourSummary, 'cost'));

        $data = [
            "title"       => "Dashboard Báo Cáo",
            "revenue"     => $totalRevenue,
            "expense"     => $totalCost,
            "profit"      => $totalRevenue - $totalCost,
            "tours"       => count($tourSummary),
            "tourProfit"  => $tourSummary
        ];

        extract($data);
        $view = "admin/dashboard/dashboard";
        require_once PATH_VIEW_MAIN;
    }
}
