<?php

class GuideController
{
    public function viewSchedule()
    {
        $title = "Lịch làm việc";
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
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

    public function viewReport()
    {
        $title = "Báo cáo sự cố";
        $view = 'guide/report/report';
        require_once PATH_VIEW_MAIN;
    }
}
