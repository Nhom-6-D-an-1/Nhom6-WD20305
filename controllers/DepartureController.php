<?php
class DepartureController
{
    public function viewDeparture()
    {
        $departure = new DepartureModel();
        // $data_departure = $departure->getByTourId();
        $title = "Danh sách Chuyến đi";
        $view = "admin/departure/departure";
        require_once PATH_VIEW_MAIN;
    }

    public function departureAdd()
    {
        $id = $_GET['id'];
        $tour_version = new TourVersionModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [];
        }
        $data_version = $tour_version->getOneVersion($id);

        $title = "Tạo chuyến đi";
        $view = "admin/departure/departureAdd";
        require_once PATH_VIEW_MAIN;
    }
}
