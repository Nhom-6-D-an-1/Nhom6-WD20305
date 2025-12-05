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
        $departure = new DepartureModel();
        $data_departure = $departure->getOneDeparture($id);

        $title = "Chi tiết chuyến đi";
        $view = "admin/departure/departureDetail";
        require_once PATH_VIEW_MAIN;
    }
}
