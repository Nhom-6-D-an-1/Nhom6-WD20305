<?php

class GuideController
{
    // SCHEDULE
    public function viewSchedule()
    {
        $schedule = new ScheduleModel();
        $guide_id = $_SESSION['user']['user_id'];
        $scheduleData = $schedule->getAllScheduleByGuide($guide_id);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
public function viewScheduleInfo()
    {
        if(!isset($_GET['id'])) {
            // Nếu không có id, quay lại trang danh sách
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
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
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
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
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
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
            header("Location: " . BASE_URL . "?mode=guide&action=viewSchedule");
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
        $title = "Danh sách khách";
        $view = 'guide/customers/customers';
        require_once PATH_VIEW_MAIN;
    }
    public function viewDiary()
    {
        $title = "Nhật ký tour";
        $view = 'guide/diary/diary';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCheckin()
    {
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
