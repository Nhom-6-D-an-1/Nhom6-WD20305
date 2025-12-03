<?php

class TourController
{ // Xem tour
    public function viewTour()
    {
        $tour = new TourModel();
        $data = $tour->getAllTour();
        $title = "Danh sách tour";
        $view = "admin/tour/tour";
        require_once PATH_VIEW_MAIN;
    }

    // Tạo tour
    public function createTour()
    {
        $title = "Tạo tour mới";
        $view = "admin/tour/createTour";
        require_once PATH_VIEW_MAIN;
    }

    // Chi tiết tour
    public function tourDetail()
    {
        $tour = new TourModel();
        $id = $_GET['id'];
        $data = $tour->getOneTour($id);
        $tour_version = new TourVersionModel();
        $data_version = $tour_version->getAllVersionByTourId($id);
        $title = "Chi tiết tour";
        $view = "admin/tour/tourDetail";
        require_once PATH_VIEW_MAIN;
    }

    // Phiên bản tour
    public function versionCopy()
    {
        $title = "Phiên bản tour";
        $view = "admin/tour/versionCopy";
        require_once PATH_VIEW_MAIN;
    }

    // Thêm phiên bản
    public function createVersion()
    {
        $tour = new TourModel();
        $id = $_GET['id'];
        $data = $tour->getOneTour($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_version = new TourVersionModel();
            $version_name = $_POST['version_name'];
            $version_code = $_POST['version_code'];
            $season = $_POST['season'];
            $price = $_POST['price'];
            $policies = $_POST['policies'];
            $valid_from = $_POST['valid_from'];
            $valid_to = $_POST['valid_to'];

            $tour_version->createVersion($id, $version_name, $version_code, $season, $price, $policies, $valid_from, $valid_to);
            header("Location: " . BASE_URL . "?mode=admin&action=tourDetail&tab=versions&id=" . $id);
            exit;
        } else {
            $title = "Thêm phiên bản tour";
            $view = "admin/tour/createVersion";
            require_once PATH_VIEW_MAIN;
        }
    }

    // Chi tiết phiên bản
    public function versionDetail()
    {
        $id = $_GET['id'];
        $tour_version = new TourVersionModel();
        $data_version = $tour_version->getOneVersion($id);
        $title = "Chi tiết phiên bản tour";
        $view = "admin/tour/versionDetail";
        require_once PATH_VIEW_MAIN;
    }

    // Sửa phiên bản
    public function editVersion()
    {
        $tour_version = new TourVersionModel();
        $title = "Sửa phiên bản tour";
        $view  = "admin/tour/editVersion";
        require_once PATH_VIEW_MAIN;
    }

    // Thêm lịch trình tour
    public function itineraryAdd()
    {
        $title = "Thêm lịch trình";
        $view = "admin/tour/itineraryAdd";
        require_once PATH_VIEW_MAIN;
    }

    // Sửa lịch trình tour
    public function itineraryEdit()
    {
        $title = "Sửa lịch trình";
        $view = "admin/tour/itineraryEdit";
        require_once PATH_VIEW_MAIN;
    }
}
