<?php
class AdminController
{
    // BOOKING
    public function viewBooking()
    {
        $bookingModel = new BookingModel();
        $departureModel = new DepartureModel();

        // Lấy danh sách chuyến đi cho dropdown
        $departures = $departureModel->getAllDepartures();

        // Lấy filter
        $departure_id = $_GET['departure_id'] ?? null;
        $from_date    = $_GET['from_date'] ?? null;
        $to_date      = $_GET['to_date'] ?? null;

        // Nếu có filter thì lọc
        if ($departure_id || $from_date || $to_date) {
            $bookings = $bookingModel->filterBooking($departure_id, $from_date, $to_date);
        } else {
            $bookings = $bookingModel->getAllBooking();
        }

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

        // Lấy số khách hiện tại
        $bookingModel = new BookingModel();
        $current = $bookingModel->countGuestsInDeparture($departure_id);
        $max = $info['max_guests'];

        // Kiểm tra full TRƯỚC khi thêm booking
        if ($current >= $max) {
            $_SESSION['flash_error'] = "Chuyến đi đã đủ số lượng khách, không thể đặt thêm.";
            header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
            exit;
        }

        // Dữ liệu
        $full_name    = $_POST['full_name'];
        $gender       = $_POST['gender'];
        $birth_year   = $_POST['birth_year'];
        $phone        = $_POST['phone'];
        $cccd         = $_POST['cccd'];
        $special      = $_POST['special_request'] ?? null;
        $total_amount = $_POST['total_amount'] ?? null;
        $status       = $_POST['status'] ?? 'pending';

        // Nếu không nhập tiền → lấy giá tour mặc định
        if (empty($total_amount)) {
            $price = $bookingModel->getDeparturePrice($departure_id);
            $total_amount = $price ?? 0;
        }

        // Tạo booking
        $booking_id = $bookingModel->addBooking([
            'departure_id'     => $departure_id,
            'customer_name'    => $full_name,
            'customer_contact' => $phone,
            'customer_type'    => 'le',
            'total_amount'     => $total_amount,
            'status'           => $status,
        ]);

        // Thêm khách
        $guestModel = new GuestModel();
        $guest_id = $guestModel->addGuest([
            'booking_id' => $booking_id,
            'full_name'  => $full_name,
            'gender'     => $gender,
            'birth_year' => $birth_year,
            'phone'      => $phone,
            'cccd'       => $cccd,
        ]);

        // Yêu cầu đặc biệt
        if (!empty($special)) {
            $guestModel->addSpecialRequest([
                'guest_id' => $guest_id,
                'description' => $special
            ]);
        }

        // Cập nhật tổng khách
        $bookingModel->updateBooking($booking_id, [
            'departure_id' => $departure_id,
            'customer_name' => $full_name,
            'customer_contact' => $phone,
            'customer_type' => 'le',
            'total_amount' => $total_amount,
            'status' => $status,
            'total_guests' => 1
        ]);

        $departure->updateCurrentGuests($departure_id);

        // Nếu đủ khách → chuyển trạng thái full
        $current = $bookingModel->countGuestsInDeparture($departure_id);
        if ($current >= $max) {
            $departure->updateStatus($departure_id, 'full');
        }

        header("Location: " . BASE_URL . "?mode=admin&action=showbooking&id=" . $booking_id);
        exit;
    }



    public function storeGit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $departure_id = $_POST['departure_id'];

        $departure = new DepartureModel();
        $info = $departure->getOneDeparture($departure_id);

        if (!$info) {
            $_SESSION['flash_error'] = "Chuyến đi không tồn tại.";
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $max = $info['max_guests'];

        $bookingModel = new BookingModel();
        $current = $bookingModel->countGuestsInDeparture($departure_id);

        // Không còn chỗ
        if ($current >= $max) {
            $_SESSION['flash_error'] = "Chuyến đi đã đủ khách, không thể thêm booking đoàn.";
            header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
            exit;
        }

        // ===============================
        // 1) Tạo booking đoàn
        // ===============================
        $full_name    = $_POST['full_name'];
        $gender       = $_POST['gender'];
        $birth_year   = $_POST['birth_year'];
        $phone        = $_POST['phone'];
        $cccd         = $_POST['cccd'];
        $special      = $_POST['special_request'] ?? null;
        $status       = $_POST['status'] ?? 'pending';

        // Nếu không nhập giá → lấy giá tour
        $price = $bookingModel->getDeparturePrice($departure_id);
        $total_amount = $price ?? 0;

        $booking_id = $bookingModel->addBooking([
            'departure_id'     => $departure_id,
            'customer_name'    => $full_name,
            'customer_contact' => $phone,
            'customer_type'    => 'doan',
            'total_amount'     => $total_amount,
            'status'           => $status,
        ]);

        // ===============================
        // 2) Lưu trưởng đoàn vào session
        // ===============================
        $_SESSION['git_booking_id'] = $booking_id;
        $_SESSION['git_guests'] = [];

        $_SESSION['git_guests'][] = [
            'full_name' => $full_name,
            'gender' => $gender,
            'birth_year' => $birth_year,
            'phone' => $phone,
            'cccd' => $cccd,
            'special_request' => $special,
            'medical_condition' => null
        ];

        header("Location: " . BASE_URL . "?mode=admin&action=addGitGuests");
        exit;
    }


    public function storeGitGuest()
    {
        if (!isset($_SESSION['git_booking_id'])) {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $booking_id = $_SESSION['git_booking_id'];
        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingById($booking_id);

        $departure_id = $booking['departure_id'];

        $departure = new DepartureModel();
        $info = $departure->getOneDeparture($departure_id);

        $max = $info['max_guests'];

        $current = $bookingModel->countGuestsInDeparture($departure_id);
        $currentSession = count($_SESSION['git_guests']);

        // Nếu thêm 1 khách nữa mà vượt → cấm
        if (($current + $currentSession + 1) > $max) {
            $_SESSION['flash_error'] = "Không thể thêm khách vì vượt quá số chỗ còn lại!";
            header("Location: " . BASE_URL . "?mode=admin&action=addGitGuests");
            exit;
        }

        // Lưu khách vào session
        $_SESSION['git_guests'][] = [
            'full_name' => $_POST['full_name'],
            'gender' => $_POST['gender'],
            'birth_year' => $_POST['birth_year'],
            'phone' => $_POST['phone'],
            'cccd' => $_POST['cccd'],
            'special_request' => $_POST['special_request'] ?? '',
            'medical_condition' => $_POST['medical_condition'] ?? ''
        ];

        header("Location: " . BASE_URL . "?mode=admin&action=addGitGuests");
        exit;
    }

    public function deleteGitGuest()
    {
        if (!isset($_SESSION['git_guests'])) {
            header("Location: ?mode=admin&action=addGitGuests");
            exit;
        }

        $index = $_GET['index'] ?? null;

        if ($index !== null && isset($_SESSION['git_guests'][$index])) {

            // Xóa đúng khách
            unset($_SESSION['git_guests'][$index]);

            // Sắp xếp lại key của mảng để không bị nhảy index
            $_SESSION['git_guests'] = array_values($_SESSION['git_guests']);

            $_SESSION['flash_success'] = "Đã xóa khách thành công.";
        }

        header("Location: ?mode=admin&action=addGitGuests");
        exit;
    }


    public function finishGit()
    {
        if (!isset($_SESSION['git_booking_id'])) {
            header("Location: ?mode=admin&action=viewDeparture");
            exit;
        }

        $booking_id = $_SESSION['git_booking_id'];
        $guests = $_SESSION['git_guests'];

        $bookingModel = new BookingModel();
        $guestModel = new GuestModel();

        $booking = $bookingModel->getBookingById($booking_id);
        $departure_id = $booking['departure_id'];

        $departure = new DepartureModel();
        $info = $departure->getOneDeparture($departure_id);

        $max = $info['max_guests'];
        $current = $bookingModel->countGuestsInDeparture($departure_id);

        // Tổng số khách sau khi thêm
        $totalAfterAdd = $current + count($guests);

        //  Nếu vượt → rollback booking
        if ($totalAfterAdd > $max) {

            // Xóa booking rỗng
            $bookingModel->deleteBooking($booking_id);

            $_SESSION['flash_error'] = "Số lượng khách vượt quá số chỗ. Booking đã bị hủy!";
            header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
            exit;
        }

        // ===========================
        // Thêm từng khách vào DB
        // ===========================
        foreach ($guests as $g) {
            $guest_id = $guestModel->addGuest([
                'booking_id' => $booking_id,
                'full_name' => $g['full_name'],
                'gender' => $g['gender'],
                'birth_year' => $g['birth_year'],
                'phone' => $g['phone'],
                'cccd' => $g['cccd'],
            ]);

            if (!empty($g['special_request']) || !empty($g['medical_condition'])) {
                $guestModel->addSpecialRequest([
                    'guest_id' => $guest_id,
                    'description' => $g['special_request'] ?? '',
                    'medical_condition' => $g['medical_condition'] ?? ''
                ]);
            }
        }

        // Cập nhật booking
        $price = $bookingModel->getDeparturePrice($departure_id);
        $total_amount = $price * count($guests);

        $bookingModel->updateBooking($booking_id, [
            'departure_id' => $departure_id,
            'customer_name' => $booking['customer_name'],
            'customer_contact' => $booking['customer_contact'],
            'customer_type' => 'doan',
            'total_amount' => $total_amount,
            'status' => 'completed',
            'total_guests' => count($guests)
        ]);

        // Cập nhật số khách chuyến đi
        $departure->updateCurrentGuests($departure_id);

        // Dọn session
        unset($_SESSION['git_booking_id']);
        unset($_SESSION['git_guests']);

        header("Location: " . BASE_URL . "?mode=admin&action=showbooking&id=" . $booking_id);
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

    public function deleteGuest()
    {
        $guest_id = $_GET['id'] ?? null;

        if (!$guest_id) {
            $_SESSION['flash_error'] = "ID khách không hợp lệ.";
            header("Location: " . BASE_URL . "?mode=admin&action=viewsbooking");
            exit;
        }

        $guestModel = new GuestModel();
        $bookingModel = new BookingModel();
        $departureModel = new DepartureModel();

        // Lấy booking_id của khách
        $guest = $guestModel->getGuestById($guest_id);

        if (!$guest) {
            $_SESSION['flash_error'] = "Khách không tồn tại.";
            header("Location: " . BASE_URL . "?mode=admin&action=viewsbooking");
            exit;
        }

        $booking_id = $guest['booking_id'];

        // Lấy thông tin booking để lấy departure_id
        $booking = $bookingModel->getBookingById($booking_id);
        $departure_id = $booking['departure_id'];

        // Xóa khách
        $guestModel->deleteGuest($guest_id);

        // Cập nhật lại số khách của chuyến
        $departureModel->updateCurrentGuests($departure_id);

        // Lấy lại thông tin chuyến
        $info = $departureModel->getOneDeparture($departure_id);

        // Nếu chuyến đang full mà giờ còn chỗ → mở lại bán
        if ($info['current_guests'] < $info['max_guests'] && $info['status'] == 'full') {
            $departureModel->updateStatus($departure_id, 'open');
        }

        $_SESSION['flash_success'] = "Xóa khách thành công!";

        // Quay lại trang chi tiết booking
        header("Location: " . BASE_URL . "?mode=admin&action=departureDetail&tab=guests&id=" . $departure_id);
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

            // Lấy departure_id trước khi xóa
            $booking = $bookingModel->getBookingById($id);
            $departure_id = $booking['departure_id'] ?? null;

            // Xóa booking
            $ok = $bookingModel->deleteBooking((int)$id);

            if ($ok && $departure_id) {
                // Cập nhật lại số khách thật
                $departureModel = new DepartureModel();
                $departureModel->updateCurrentGuests($departure_id);

                // Reset trạng thái từ full nếu đã có chỗ trống
                $info = $departureModel->getOneDeparture($departure_id);
                if ($info['current_guests'] < $info['max_guests']) {
                    $departureModel->updateStatus($departure_id, 'open');
                }
            }

            $_SESSION['flash_success'] = "Xóa booking thành công.";
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

            $full_name = trim($_POST['full_name'] ?? '');
            $user_name = trim($_POST['user_name'] ?? '');
            $password  = $_POST['password'] ?? '';
            $role      = $_POST['role'] ?? '';

            $errors = [];

            if ($full_name === '') {
                $errors['full_name'] = 'Họ và tên không được để trống';
            }

            if ($user_name === '') {
                $errors['user_name'] = 'Tên đăng nhập không được để trống';
            }

            if (strlen($password) < 6) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            if (!in_array($role, ['admin', 'guide'])) {
                $errors['role'] = 'Vai trò không hợp lệ';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=createaccount");
                exit;
            }

            $data = [
                'full_name'     => $full_name,
                'user_name'     => $user_name,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'role'          => $role
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

        $full_name = trim($_POST['full_name'] ?? '');
        $username  = trim($_POST['username'] ?? '');
        $password  = $_POST['password'] ?? '';
        $role      = $_POST['role'] ?? '';

        $errors = [];

        if ($full_name === '') {
            $errors['full_name'] = 'Họ và tên không được để trống';
        }

        if ($username === '') {
            $errors['username'] = 'Tên đăng nhập không được để trống';
        }

        if ($password !== '' && strlen($password) < 6) {
            $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
        }

        if (!in_array($role, ['admin', 'guide'])) {
            $errors['role'] = 'Vai trò không hợp lệ';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old']    = $_POST;

            header('Location: ' . BASE_URL . '?mode=admin&action=editaccount&id=' . $id);
            exit;
        }

        $data = [
            'full_name' => $full_name,
            'username'  => $username,
            'role'      => $role,
        ];

        // Nếu có nhập mật khẩu mới
        if ($password !== '') {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
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
        $userModel = new AccountModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_GET['id'] ?? '';
            $data_Guide = $tourGuide->getOneGuide($id);

            $full_name  = trim($_POST['full_name'] ?? '');
            $phone      = trim($_POST['phone'] ?? '');
            $email      = trim($_POST['email'] ?? '');
            $languages  = trim($_POST['languages'] ?? '');

            $errors = [];

            if ($full_name === '') {
                $errors['full_name'] = 'Họ và tên không được để trống';
            }

            if ($phone === '') {
                $errors['phone'] = 'Số điện thoại không được để trống';
            }

            if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            }

            if ($languages === '') {
                $errors['languages'] = 'Ngôn ngữ không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=viewEditGuide&id=" . $id);
                exit;
            }

            $avatar = $data_Guide['avatar'];
            if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $avatar = uploadFile($_FILES['avatar'], "guide/");
            }

            $certificate_image = $data_Guide['certificate_image'];
            if (!empty($_FILES['certificate_image']['name']) && $_FILES['certificate_image']['error'] === UPLOAD_ERR_OK) {
                $certificate_image = uploadFile($_FILES['certificate_image'], "guide/certificates/");
            }

            $userModel->updateUserName($id, $full_name);

            $tourGuide->updateGuideFull([
                "birthday"          => $_POST['birthday'],
                "phone"             => $phone,
                "email"             => $email,
                "avatar"            => $avatar,
                "gender"            => $_POST['gender'],
                "languages"         => $languages,
                "rating"            => $_POST['rating'],
                "experience_years"  => $_POST['experience_years'],
                "certificates"      => $_POST['certificates'],
                "certificate_image" => $certificate_image,
                "health"            => $_POST['health'],
                "notes"             => $_POST['notes'] ?? $data_Guide['notes'],
                "user_id"           => $id
            ]);

            header("Location: " . BASE_URL . "?mode=admin&action=viewGuideDetail&id=" . $id);
            exit;
        }

        $id = $_GET['id'] ?? '';
        $data_Guide = $tourGuide->getOneGuide($id);

        $title = "Chỉnh sửa thông tin nhân sự";
        $view  = "admin/resources/editGuide";
        require_once PATH_VIEW_MAIN;
    }




    public function viewDashboard()
    {
        // --- UPDATE STATUS DEPARTURES ---
        $departure = new DepartureModel();
        $departure->autoUpdateStatus();

        // --- REPORT MODEL ---
        $report = new ReportModel();

        // Lấy năm từ người dùng nếu có, mặc định năm hiện tại
        $year = $_GET["year"] ?? date("Y");

        // --- SUMMARY THEO TỪNG CHUYẾN ĐI ---
        $departureSummary = $report->summaryByDeparture();

        // Tính tổng doanh thu
        $totalRevenue = array_sum(array_column($departureSummary, 'revenue'));

        // Tính tổng chi phí (cost + ex_cost)
        $totalCost = array_sum(array_map(
            fn($d) => ($d["cost"] ?? 0) + ($d["ex_cost"] ?? 0),
            $departureSummary
        ));

        // --- PHÂN TÍCH THÁNG / QUÝ / NĂM ---
        $byMonth   = $report->revenueByMonth($year);
        $byQuarter = $report->revenueByQuarter($year);
        $byYear    = $report->revenueByYear();

        // --- PACK DATA TRUYỀN SANG VIEW ---
        $data = [
            "title"          => "Dashboard Báo Cáo",
            "year"           => $year,

            // Tổng quan
            "revenue"        => $totalRevenue,
            "expense"        => $totalCost,
            "profit"         => $totalRevenue - $totalCost,
            "tours"          => count($departureSummary),

            // Chi tiết tour
            "tourProfit"     => $departureSummary,

            // Phân tích thống kê
            "byMonth"        => $byMonth,
            "byQuarter"      => $byQuarter,
            "byYear"         => $byYear,
        ];

        extract($data);

        $view = "admin/dashboard/dashboard";
        require_once PATH_VIEW_MAIN;
    }
}
