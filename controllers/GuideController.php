<?php

class GuideController
{
    // SCHEDULE
    public function viewSchedule()
    {
        $schedule = new ScheduleModel();
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['user_id'];
        $assignedTours = $customers->getAssignedTours($guide_id);
        $scheduleData = $schedule->getAllScheduleByGuide($guide_id);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
    public function viewScheduleInfo()
    {
        if (!isset($_GET['id'])) {
            // Nếu không có id, quay lại trang danh sách
            header("Location: " . BASE_URL . "?mode=guide&action=viewschedule");
            exit();
        }

        $departure_id = $_GET['id']; // Lấy id tour từ URL
        $schedule = new ScheduleModel();
        $infoData = $schedule->getScheduleInfo($departure_id); // truyền đúng id tour
        $title = "Lịch làm việc - Chi tiết tour";
        $view = 'guide/schedule/detail/info';
        require_once PATH_VIEW_MAIN;
    }

    public function viewScheduleItinerary()
    {
        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
            exit();
        }

        $departure_id = $_GET['id'];
        $schedule = new ScheduleModel();
        $itineraryData = $schedule->getScheduleItinerary($departure_id);
        // Lấy tên tour
        $schedule = new ScheduleModel();
        $infoData = $schedule->getScheduleInfo($departure_id);
        $title = "Lịch làm việc - Lịch trình tour";
        $view = 'guide/schedule/detail/itinerary';
        require_once PATH_VIEW_MAIN;
    }

    public function viewScheduleCustomers()
    {
        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
            exit();
        }

        $departure_id = $_GET['id'];
        $schedule = new ScheduleModel();
        $customersData = $schedule->getScheduleCustomers($departure_id);
        // Lấy tên tour
        $schedule = new ScheduleModel();
        $infoData = $schedule->getScheduleInfo($departure_id);
        $title = "Lịch làm việc - Danh sách khách";
        $view = 'guide/schedule/detail/customers';
        require_once PATH_VIEW_MAIN;
    }

    public function viewScheduleCheckin()
    {
        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
            exit();
        }

        $departure_id = $_GET['id'];
        $schedule = new ScheduleModel();
        $checkinData = $schedule->getScheduleCheckin($departure_id);
        // Lấy tên tour
        $schedule = new ScheduleModel();
        $infoData = $schedule->getScheduleInfo($departure_id);
        $title = "Lịch làm việc - Check-in tour";
        $view = 'guide/schedule/detail/checkin';
        require_once PATH_VIEW_MAIN;
    }

    // CUSTOMERS
    public function viewCustomers()
    {
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['user_id'];
        $allCustomersData = $customers->getAllCustomers($guide_id);
        $assignedTours = $customers->getAssignedTours($guide_id);
        $title = "Danh sách khách";
        $view = 'guide/customers/customers';
        require_once PATH_VIEW_MAIN;
    }

public function viewDiary()
{
    $diary = new DiaryModel();
    $customers = new CustomersModel();
    $guide_id = $_SESSION['user']['user_id'];
    $assignedTours = $customers->getAssignedTours($guide_id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $departure_id = $_POST['departure_id'] ?? null;
        $note = trim($_POST['note']);
        $date = $_POST['date'] ?? date('Y-m-d H:i:s');
        $imagePath = null;

        // Upload file
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = uploadFile($_FILES['image'], 'diary/'); // helper trả về path relative
        }

        if ($departure_id && $note) {
            $diary->addDiary($departure_id, $guide_id, $note, $imagePath, $date);
            // Reload để tránh resubmit
            header("Location: " . BASE_URL . "?mode=guide&action=viewdiary&departure_id=$departure_id");
            exit();
        }
    }

    // Lấy nhật ký theo tour đã chọn
    $selectedTour = $_GET['departure_id'] ?? 0;
    $diaryData = $diary->getAllDiaryByGuide($guide_id, $selectedTour);

    $title = "Nhật ký tour";
    $view = 'guide/diary/diary';
    require_once PATH_VIEW_MAIN;
}


    // DIARY - Thêm diary mới
    public function addDiary()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departure_id = $_POST['departure_id'];
            $guide_id = $_SESSION['user']['user_id'];
            $date = $_POST['date'];
            $note = trim($_POST['note']);
            $imagePath = null;

            // Upload ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = uploadFile($_FILES['image'], 'diary/');
            }

            $diary = new DiaryModel();
            $diary->addDiary($departure_id, $guide_id, $note, $imagePath);

            header("Location: " . BASE_URL . "?mode=guide&action=viewdiary");
            exit();
        }

        $customers = new CustomersModel();
        $assignedTours = $customers->getAssignedTours($_SESSION['user']['user_id']);
    }


    // DIARY - Xóa diary
    public function deleteDiary()
    {
        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewdiary");
            exit();
        }

        $diary_id = $_GET['id'];
        $diary = new DiaryModel();
        $diary->deleteDiary($diary_id);

        header("Location: " . BASE_URL . "?mode=guide&action=viewdiary");
        exit();
    }
    // public function viewCheckin()
    // {
    //     $checkinModel = new CheckinModel();
    //     $checkinData = $checkinModel->getAllCheckin();
    //     $customers = new CustomersModel();
    //     $guide_id = $_SESSION['user']['user_id'];
    //     $assignedTours = $customers->getAssignedTours($guide_id);
    //     $title = "Check-in, điểm danh";
    //     $view = 'guide/checkin/checkin';
    //     require_once PATH_VIEW_MAIN;
    // }
    public function viewCheckin()
    {
        // 1. Tái sử dụng CustomersModel để lấy danh sách tour được phân công (Phương án B)
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['user_id'];
        $assignedTours = $customers->getAssignedTours($guide_id);
        
        // 2. Khởi tạo CheckinModel
        $checkinModel = new CheckinModel(); 
        
        $selectedDepartureId = $_GET['departure_id'] ?? null;
        $selectedStage = $_GET['stage'] ?? null;
        $statusDisplay = []; 
        $stages = []; 

        // Xử lý CẬP NHẬT trạng thái check-in (Hành động POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_checkin') {
            $guest_id = $_POST['guest_id'] ?? null;
            $departure_id = $_POST['departure_id'] ?? null;
            $stage_description = $_POST['stage_description'] ?? null;
            $status = $_POST['status'] ?? null; // present, absent, late

            if ($guest_id && $departure_id && $stage_description && $status) {
                $checkinModel->updateCheckinStatus(
                    $guest_id, 
                    $departure_id, 
                    $guide_id, // recorded_by_user_id
                    $stage_description, 
                    $status
                );
                // Sau khi cập nhật, reload lại trang
                header("Location: " . BASE_URL . "?mode=guide&action=viewcheckin&departure_id=$departure_id&stage=" . urlencode($stage_description));
                exit();
            }
        }

        // Lấy dữ liệu hiển thị (GET)
        if ($selectedDepartureId) {
            // Lấy danh sách chặng/điểm check-in của tour đã chọn
            $stages = $checkinModel->getCheckinStages($selectedDepartureId);

            // Nếu chưa có chặng nào được chọn, mặc định chọn chặng đầu tiên
            if (!$selectedStage && !empty($stages)) {
                $selectedStage = $stages[0];
            }

            // Lấy danh sách khách và trạng thái điểm danh
            if ($selectedStage) {
                $checkinData = $checkinModel->getGuestsAndCheckinStatus($selectedDepartureId, $selectedStage);
                $statusDisplay = array_map(function($item) use ($checkinModel) {
                    $item['display_status'] = $checkinModel->getStatusDisplay($item['status']);
                    return $item;
                }, $checkinData);
            }
        }
        
        $title = "Check in, điểm danh";
        $view = 'guide/checkin/checkin'; 
        require_once PATH_VIEW_MAIN;
    }
    public function viewRequest()
    {
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['user_id'];
        $assignedTours = $customers->getAssignedTours($guide_id);
        $request = new GuestSpecialRequest();
        $guest = new Guest();
        $tour = new Tour();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $guest_id = $_POST['guest_id'];
            $description = trim($_POST['description']);
            $medical_condition = trim($_POST['medical_condition'] ?? "");
            $current_tour_id = $_POST['current_tour_id'] ?? '';
            if ($description == '') {
                $_SESSION['flash_error'] = "Yêu cầu không được để trống!";
            } else {
                $request->insertRequest($guest_id, $description, $medical_condition);
            }
            $redirectUrl = BASE_URL . "?mode=guide&action=viewrequest";
            if ($current_tour_id) $redirectUrl .= "&tour_id=" . $current_tour_id;

            header("Location: " . $redirectUrl);
            exit();
        } else {
            $list_tour = $tour->getAllTour();
            $filter_tour_id = isset($_GET['departure_id']) && $_GET['departure_id'] != '' 
                                ? $_GET['departure_id'] 
                                : null; // CMT: đổi từ tour_id sang departure_id để đồng bộ với View
            if ($filter_tour_id) {
                $data_guest = $guest->getGuideByTour($filter_tour_id);
                $data = $request->getAllRequest($filter_tour_id);
            } else {
                $data_guest = [];
                $data = [];
            }


            $title = "Yêu cầu đặc biệt";
            $view = 'guide/request/request';
            require_once PATH_VIEW_MAIN;
        }
    }

    public function deleteRequest()
    {
        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewrequest");
            exit();
        }
        $request = new GuestSpecialRequest();
        $id = $_GET['id'];
        $request->deleteRequest($id);
        header("Location: " . BASE_URL . "?mode=guide&action=viewrequest");
        exit();
    }
}
