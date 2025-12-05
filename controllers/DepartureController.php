<?php
class DepartureController
{
    public function viewDeparture()
    {
        $departure = new DepartureModel();
        $data_departure = $departure->getByTourId();
        $title = "Danh sách Chuyến đi";
        $view = "admin/departure/departure";
        require_once PATH_VIEW_MAIN;
    }
}
