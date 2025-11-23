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
        if(!isset($_GET['id'])) {
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
        if(!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewschedule");
            exit();
        }

        $departure_id = $_GET['id'];
        $schedule = new ScheduleModel();
        $itineraryData = $schedule->getScheduleItinerary($departure_id);
        $title = "Lịch làm việc - Lịch trình tour";
        $view = 'guide/schedule/detail/itinerary';
        require_once PATH_VIEW_MAIN;
    }

public function viewScheduleCustomers()
    {
        if(!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewschedule");
            exit();
        }

        $departure_id = $_GET['id'];
        $schedule = new ScheduleModel();
        $customersData = $schedule->getScheduleCustomers($departure_id);
        $title = "Lịch làm việc - Danh sách khách";
        $view = 'guide/schedule/detail/customers';
        require_once PATH_VIEW_MAIN;
    }

public function viewScheduleCheckin()
    {
        if(!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewschedule");
            exit();
        }

        $departure_id = $_GET['id'];
        $schedule = new ScheduleModel();
        $checkinData = $schedule->getScheduleCheckin($departure_id);
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
    public function viewCheckin()
    {
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['user_id'];
        $assignedTours = $customers->getAssignedTours($guide_id);
        $title = "Check-in, điểm danh";
        $view = 'guide/checkin/checkin';
        require_once PATH_VIEW_MAIN;
    }
    public function viewRequest()
    {
        $request = new GuestSpecialRequest();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $guest_id = $_POST['guest_id'];
            $description = trim($_POST['description']);
            $medical_condition = trim($_POST['medical_condition'] ?? "");
            if ($description == '') {
                $_SESSION['flash_error'] = "Yêu cầu không được để trống!";
                header("Location: " . BASE_URL . "?mode=guide&action=viewrequest");
                exit();
            }
            $request->insertRequest($guest_id, $description, $medical_condition);
            header("Location: " . BASE_URL . "?mode=guide&action=viewrequest");
            exit();
        } else {
            $guest = new Guest();
            $data_guest = $guest->getAllGuest();
            $data = $request->getAllRequest();
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
