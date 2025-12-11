<?php

class GuideController
{
    // SCHEDULE
    public function viewSchedule()
    {
        $departure = new DepartureModel();
        $departure->autoUpdateStatus();
        $schedule = new ScheduleModel();
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['guide_id'];
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

        // Lấy thông tin tour
        $infoData = $schedule->getScheduleInfo($departure_id);

        // Lấy version_id (đây mới là khóa dùng trong tour_itinerary)
        $version_id = $infoData['version_id'];

        // Lấy lịch trình theo version_id
        $itineraryData = $schedule->getScheduleItinerary($version_id);

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
        $guide_id = $_SESSION['user']['guide_id'];
        $selectedDepartureId = $_GET['departure_id'] ?? 0;

        $allCustomersData = $customers->getAllCustomers($guide_id, $selectedDepartureId);
        $assignedTours = $customers->getAssignedTours($guide_id);

        $title = "Danh sách khách";
        $view = 'guide/customers/customers';
        require_once PATH_VIEW_MAIN;
    }
    private function getCurrentRunningTour($guide_id)
    {
        $customers = new CustomersModel();
        $assigned = $customers->getAssignedTours($guide_id);
        $today = date('Y-m-d');

        foreach ($assigned as $tour) {
            if ($tour['start_date'] <= $today && $tour['end_date'] >= $today) {
                return $tour; // trả về tour đang diễn ra
            }
        }
        return null; // không có tour đang diễn ra
    }

        public function viewDiary()
        {

            $diary = new DiaryModel();
            $customers = new CustomersModel();
            $guide_id = $_SESSION['user']['guide_id'];
            // Nếu chưa chọn tour → tự động chọn tour đang diễn ra
            if (!isset($_GET['departure_id'])) {
                $running = $this->getCurrentRunningTour($guide_id);
                if ($running) {
                    header("Location: " . BASE_URL . "?mode=guide&action=viewdiary&departure_id=" . $running['departure_id']);
                    exit();
                }
            }
            $assignedTours = $customers->getAssignedTours($guide_id);

            // Tự động tìm tour đang diễn ra
            $currentTour = $this->getCurrentRunningTour($guide_id);

            // Nếu không có tour đang diễn ra -> truyền biến báo lên view (không die)
            if (!$currentTour) {
                $selectedDepartureId = 0;
                $itineraryDays = [];
                $diaryData = [];
                $todayDay = null;
                $noRunningTour = true;
            } else {
                $selectedDepartureId = (int)$currentTour['departure_id'];
                $today = date('Y-m-d');
                // tính ngày thứ bao nhiêu (ngày 1 là ngày start_date)
                $startDate = date('Y-m-d', strtotime($currentTour['start_date']));
                $todayDay = (int)(floor((strtotime($today) - strtotime($startDate)) / 86400) + 1);

                // Lấy tất cả ngày của lịch trình rồi lọc chỉ giữ ngày hôm nay
                $allDays = $diary->getItineraryDays($selectedDepartureId); // trả về day_number, itinerary_id, place...
                $itineraryDays = array_values(array_filter($allDays, function($d) use ($todayDay) {
                    return isset($d['day_number']) && ((int)$d['day_number'] === (int)$todayDay);
                }));

                // Lấy nhật ký (theo tour) rồi lọc chỉ lấy ngày hôm nay (nếu model trả về day_number)
                $allDiary = $diary->getAllDiaryByGuide($guide_id, $selectedDepartureId);
                $diaryData = $allDiary;

                $noRunningTour = false;
            }

            // Nếu POST (thêm nhật ký) — giữ nguyên luồng xử lý nhưng override departure_id bằng selectedDepartureId (bảo vệ)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $departure_id = $selectedDepartureId; // bắt buộc phải là tour đang diễn ra
                $note = trim($_POST['note'] ?? '');
                $itinerary_id = !empty($_POST['itinerary_id']) ? (int)$_POST['itinerary_id'] : null;
                $handling_method = trim($_POST['handling_method'] ?? '');
                $customer_feedback = trim($_POST['customer_feedback'] ?? '');
                $imagePath = null;

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imagePath = uploadFile($_FILES['image'], 'diary/');
                }

                if ($departure_id && $note) {
                    $diary->addDiary(
                        $departure_id,
                        $guide_id,
                        $note,
                        $itinerary_id,
                        $handling_method,
                        $customer_feedback,
                        $imagePath
                    );
                    header("Location: " . BASE_URL . "?mode=guide&action=viewdiary");
                    exit();
                }
            }

            $title = "Nhật ký tour";
            $view = 'guide/diary/diary';
            require_once PATH_VIEW_MAIN;
        }


    // DIARY - Thêm diary mới
    // public function addDiary()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $departure_id = $_POST['departure_id'];
    //         $guide_id = $_SESSION['user']['guide_id'];
    //         $date = $_POST['date'];
    //         $note = trim($_POST['note']);
    //         $imagePath = null;

    //         // Upload ảnh nếu có
    //         if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //             $imagePath = uploadFile($_FILES['image'], 'diary/');
    //         }

    //         $diary = new DiaryModel();
    //         $diary->addDiary($departure_id, $guide_id, $note, $imagePath);

    //         header("Location: " . BASE_URL . "?mode=guide&action=viewdiary");
    //         exit();
    //     }

    //     $customers = new CustomersModel();
    //     $assignedTours = $customers->getAssignedTours($_SESSION['user']['guide_id']);
    // }


    // DIARY - Xóa diary
    public function deleteDiary()
    {
        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewdiary");
            exit();
        }

        // $diary_id = $_GET['id'];
        $diary_id = (int)$_GET['id'];
        $departure_id = isset($_GET['departure_id']) ? (int)$_GET['departure_id'] : 0;

        $diary = new DiaryModel();
        $diary->deleteDiary($diary_id);

        header("Location: " . BASE_URL . "?mode=guide&action=viewdiary&departure_id=" . $departure_id);
        exit();
    }
public function viewCheckin()
{
    $customers = new CustomersModel();
    $guide_id = $_SESSION['user']['guide_id'];
    $assignedTours = $customers->getAssignedTours($guide_id);

    if (!isset($_GET['departure_id'])) {
        $running = $this->getCurrentRunningTour($guide_id);
        if ($running) {
            header("Location: " . BASE_URL . "?mode=guide&action=viewcheckin&departure_id=" . $running['departure_id']);
            exit();
        }
    }
    
    // Khởi tạo model
    $checkinModel = new CheckinModel();

    // Tự động lấy tour đang diễn ra
    $currentTour = $this->getCurrentRunningTour($guide_id);

    if (!$currentTour) {
        $selectedDepartureId = 0;
        $selectedStage = null;
        $statusDisplay = [];
        $stages = [];
        $noRunningTour = true;
    } else {
        $selectedDepartureId = (int)$currentTour['departure_id'];
        $today = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime($currentTour['start_date']));
        $todayDay = (int)(floor((strtotime($today) - strtotime($startDate)) / 86400) + 1);

        // Lấy tất cả chặng từ model
        $allStages = $checkinModel->getCheckinStages($selectedDepartureId) ?? [];

        if (!empty($allStages)) {
            $filteredStages = array_filter($allStages, function($s) use ($todayDay) {
                return isset($s['day_number']) && ((int)$s['day_number'] === (int)$todayDay);
            });

            $stagesToUse = !empty($filteredStages) ? $filteredStages : $allStages;

            $stages = array_map(function($s) {
                $time = '';
                if (!empty($s['start_time'])) {
                    $time = date('H:i', strtotime($s['start_time']));
                    if (!empty($s['end_time'])) {
                        $time .= ' - ' . date('H:i', strtotime($s['end_time']));
                    }
                }
                return [
                    'stage_description' => $s['stage_description'],
                    'label' => $s['stage_description'] . ($time ? " ($time)" : "")
                ];
            }, $stagesToUse);

            // Sau khi redirect, hoặc nếu đã có stage trong URL thì gán
            $selectedStage = $_GET['stage'] ?? null;
        } else {
            $stages = [];
            $selectedStage = null;
        }

        // Lấy danh sách khách + trạng thái
        $statusDisplay = [];
        if ($selectedStage) {
            $checkinData = $checkinModel->getGuestsAndCheckinStatus($selectedDepartureId, $selectedStage);
            $statusDisplay = array_map(function ($item) use ($checkinModel) {
                $item['display_status'] = $checkinModel->getStatusDisplay($item['status']);
                return $item;
            }, $checkinData);
        }
        $noRunningTour = false;
    }

    // Xử lý POST update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_checkin') {
        $guest_id = $_POST['guest_id'] ?? null;
        $departure_id = $_POST['departure_id'] ?? null;
        $stage_description = $_POST['stage_description'] ?? null;
        $status = $_POST['status'] ?? null;

        if ($guest_id && $departure_id && $stage_description && $status) {
            $checkinModel->updateCheckinStatus(
                $guest_id,
                $departure_id,
                $guide_id,
                $stage_description,
                $status
            );
            header("Location: " . BASE_URL . "?mode=guide&action=viewcheckin&departure_id=" . $departure_id . "&stage=" . urlencode($stage_description));
            exit();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' 
        && isset($_POST['action']) 
        && $_POST['action'] === 'update_checkin_multi') {

        $departure_id = $_POST['departure_id'];
        $stage = $_POST['stage_description'];

        foreach ($_POST['guest_id'] as $index => $gid) {
            $status = $_POST['status'][$index];
            if ($status !== "") {
                $checkinModel->updateCheckinStatus(
                    $gid,
                    $departure_id,
                    $guide_id,
                    $stage,
                    $status
                );
            }
        }

        header("Location: " . BASE_URL . "?mode=guide&action=viewcheckin&departure_id=" . $departure_id . "&stage=" . urlencode($stage));
        exit();
    }

    $title = "Check in, điểm danh";
    $view = 'guide/checkin/checkin';
    require_once PATH_VIEW_MAIN;
}
    public function viewRequest()
    {
        $customers = new CustomersModel();
        $guide_id = $_SESSION['user']['guide_id'];
        $assignedTours = $customers->getAssignedTours($guide_id);
        $request = new GuestSpecialRequest();
        $guest = new Guest();
        $tour = new TourModel();
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
