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
        // $today = date('Y-m-d');
        $today = today(); // Sử $today để dùng được ngày giả

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
            $itineraryDays = array_values(array_filter($allDays, function ($d) use ($todayDay) {
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

        // Nếu không truyền departure_id → tự chọn tour đang diễn ra
        if (!isset($_GET['departure_id'])) {
            $running = $this->getCurrentRunningTour($guide_id);
            if ($running) {
                header("Location: " . BASE_URL . "?mode=guide&action=viewcheckin&departure_id=" . $running['departure_id']);
                exit();
            }
        }


        $checkinModel = new CheckinModel();
        $currentTour = $this->getCurrentRunningTour($guide_id);

        if (!$currentTour) {
            // Không có tour đang diễn ra
            $selectedDepartureId = 0;
            $selectedStage = null;
            $statusDisplay = [];
            $stages = [];
            $noRunningTour = true;
        } else {

            // Lấy departure_id của tour đang chạy
            $selectedDepartureId = (int)$currentTour['departure_id'];

            // Dùng ngày giả hoặc ngày thật
            $today = today();
            $startDate = $currentTour['start_date'];

            // Tính hôm nay là ngày thứ mấy của tour
            $todayDay = (int)(floor((strtotime($today) - strtotime($startDate)) / 86400) + 1);

            // Lấy toàn bộ chặng
            $allStages = $checkinModel->getCheckinStages($selectedDepartureId) ?? [];

            // Chỉ lấy chặng đúng ngày hôm nay
            $stagesToday = array_filter($allStages, function ($s) use ($todayDay) {
                return (int)$s['day_number'] === (int)$todayDay;
            });

            if (empty($stagesToday)) {
                // Không có chặng của ngày hôm nay → không cho điểm danh
                $stages = [];
                $selectedStage = null;
                $statusDisplay = [];
            } else {
                // Tạo dropdown hiển thị chặng
                $stages = array_map(function ($s) {
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
                }, $stagesToday);

                // Stage được chọn từ URL
                $selectedStage = $_GET['stage'] ?? null;

                // Lấy danh sách khách + trạng thái nếu đã chọn stage
                if ($selectedStage) {
                    $checkinData = $checkinModel->getGuestsAndCheckinStatus($selectedDepartureId, $selectedStage);
                    $statusDisplay = array_map(function ($item) use ($checkinModel) {
                        $item['display_status'] = $checkinModel->getStatusDisplay($item['status']);
                        return $item;
                    }, $checkinData);
                } else {
                    $statusDisplay = [];
                }
            }

            $noRunningTour = false;
        }

        // Xử lý cập nhật hàng loạt
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['action'])
            && $_POST['action'] === 'update_checkin_multi'
        ) {

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
}
