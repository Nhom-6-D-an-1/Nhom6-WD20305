<?php
class DepartureController
{
    public function viewDeparture()
    {
        $departure = new DepartureModel();
        $data_departure = $departure->getAllDepartures();
        $title = "Danh sách Chuyến đi";
        $view = "admin/departure/departure";
        require_once PATH_VIEW_MAIN;
    }

    public function departureAdd()
    {
        $id = $_GET['id'];
        $tour_version = new TourVersionModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departure = new DepartureModel();
            $data = [
                'version_id' => $id,
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'max_guests' => trim($_POST['max_guests']),
                'actual_price' => trim($_POST['actual_price']),
                'pickup_time' => $_POST['pickup_time'],
                'pickup_location' => trim($_POST['pickup_location']),
                'note' => trim($_POST['note']),
                'current_guests'  => 0,
                'status'          => 'open'
            ];
            $departure->createDeparture($data);
            header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
            exit();
        }
        $data_version = $tour_version->getOneVersion($id);

        $title = "Tạo chuyến đi";
        $view = "admin/departure/departureAdd";
        require_once PATH_VIEW_MAIN;
    }

    public function departureEdit()
    {
        $id = $_GET['id'];
        $departure = new DepartureModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'start_date'      => $_POST['start_date'],
                'end_date'        => $_POST['end_date'],
                'max_guests'      => trim($_POST['max_guests']),
                'actual_price'    => trim($_POST['actual_price']),
                'pickup_location' => trim($_POST['pickup_location']),
                'pickup_time'     => $_POST['pickup_time'],
                'note'            => trim($_POST['note']),
                'status'          => $_POST['status']
            ];

            $departure->updateDeparture($id, $data);
            header("Location: " . BASE_URL . "?mode=admin&action=viewDeparture");
            exit;
        }

        $data_departure = $departure->getOneDeparture($id);
        $title = "Sửa chuyến đi";
        $view = "admin/departure/departureEdit";
        require_once PATH_VIEW_MAIN;
    }

    public function departureDetail()
    {
        $id = $_GET['id'];
        $assignment = new AssignedStaffModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departure_id = $_POST['departure_id'];
            $guide_id = $_POST['guide_id'];
            $role = $_POST['role_in_tour'];
            $notes = $_POST['notes'];
            $res = $assignment->addGuideByDeparture($departure_id, $guide_id, $role, $notes);
            if (!$res['ok']) $_SESSION['flash_error'] = $res['error'];
            else $_SESSION['flash_success'] = "Phân công thành công.";
            header("Location: " . BASE_URL . "?mode=admin&action=departureDetail&id=" . $departure_id . "&tab=staff");
            exit;
        }
        $departure = new DepartureModel();
        $data_departure = $departure->getOneDeparture($id);
        $revenue = $departure->getRevenue($id);
        $booking = new BookingModel();
        $data_booking = $booking->getAllBookingInDeparture($id);
        $guest = new Guest();
        $data_guest = $guest->getGuestsByDeparture($id);
        $data_assignment = $assignment->getByDeparture($id);
        $data_guide = $assignment->getAllGuides();
        $service_assignment = new ServiceAssignmentModel();
        $data_service_assignment = $service_assignment->listByDeparture($id);
        $service = new ServiceModel();
        $data_service = $service->getAll();
        $title = "Chi tiết chuyến đi";
        $view = "admin/departure/departureDetail";
        require_once PATH_VIEW_MAIN;
    }

    public function deleteStaff()
    {
        $id = $_GET['id'];
        $assignment = new AssignedStaffModel();
        $data_assignment = $assignment->getOne($id);
        $departure_id = $data_assignment['departure_id'];
        $assignment->delete($id);
        $_SESSION['flash_success'] = "Xóa phân công thành công.";
        header("Location: " . BASE_URL . "?mode=admin&action=departureDetail&id=" . $departure_id . "&tab=staff");
        exit;
    }

    public function addService()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL);
            exit;
        }
        $departure_id = $_POST['departure_id'];
        $service_id = $_POST['service_id'];
        $supplier = $_POST['supplier'] ?? '';
        $price = $_POST['price'] ?? 0;
        $quantity = $_POST['quantity'] ?? 1;
        $notes = $_POST['notes'] ?? '';

        $sa = new ServiceAssignmentModel();
        $ok = $sa->addService($departure_id, $service_id, $supplier, $price, $quantity, $notes);
        $_SESSION[$ok ? 'flash_success' : 'flash_error'] = $ok ? "Gán dịch vụ thành công." : "Lỗi khi gán dịch vụ.";
        header("Location: " . BASE_URL . "?mode=admin&action=departureDetail&id=" . $departure_id . "&tab=services");
        exit;
    }

    public function deleteService()
    {
        $id = $_GET['id'];
        $service_assignment = new ServiceAssignmentModel();
        $data_service_assignment = $service_assignment->getOne($id);
        $departure_id = $data_service_assignment['departure_id'];
        $service_assignment->delete($id);
        $_SESSION['flash_success'] = "Xóa phân công thành công.";
        header("Location: " . BASE_URL . "?mode=admin&action=departureDetail&id=" . $departure_id . "&tab=services");
        exit;
    }
}
