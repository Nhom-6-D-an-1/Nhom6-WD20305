<?php

class TourController
{
    private $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
    }

    /* =====================================
        DANH SÁCH TOUR
    ===================================== */
    public function index()
    {
        $tours = $this->tourModel->getFullInfo();
        $title = "Quản lý tour";
        $view = "admin/tour/tour";
        require_once PATH_VIEW_MAIN;
    }

    public function create()
    {
        $categories = $this->tourModel->getCategories();
        $guides     = $this->tourModel->getGuides();
        $title = "Thêm tour";
        $view = "admin/tour/create";
        require_once PATH_VIEW_MAIN;
    }

    public function store()
    {
        $data = [
            "tour_name"   => $_POST["tour_name"],
            "category_id" => $_POST["category_id"],
            "price"       => $_POST["price"],
            "start_date"  => $_POST["start_date"],
            "user_id"     => $_POST["user_id"],
        ];

        $this->tourModel->insertFull($data);
        header("Location: index.php?mode=admin&action=viewstour");
        exit;
    }

    public function edit()
    {
        $id = $_GET["id"];
        $tour = $this->tourModel->getFullById($id);
        $categories = $this->tourModel->getCategories();
        $guides     = $this->tourModel->getGuides();
        $title = "Sửa tour";
        $view = "admin/tour/edit";
        require_once PATH_VIEW_MAIN;
    }

    public function update()
    {
        $id = $_POST["tour_id"];

        $data = [
            "tour_name"   => $_POST["tour_name"],
            "category_id" => $_POST["category_id"],
            "price"       => $_POST["price"],
            "start_date"  => $_POST["start_date"],
            "user_id"     => $_POST["user_id"],
        ];

        $this->tourModel->updateFull($id, $data);
        header("Location: index.php?mode=admin&action=viewstour");
        exit;
    }

    public function delete()
    {
        $id = $_GET["id"];
        $this->tourModel->delete($id);
        header("Location: index.php?mode=admin&action=viewstour");
        exit;
    }

    public function detail()
    {
        $id = $_GET["id"];

        $tour = $this->tourModel->getTourDetail($id);

        // Lấy đúng departure của tour
        $departures = $this->tourModel->getDeparturesByTour($id);

        // Lấy departure đầu tiên
        $departure_id = !empty($departures) ? $departures[0]["departure_id"] : null;

        $title = "Chi tiết tour";
        $view  = "admin/tour/detail";
        require_once PATH_VIEW_MAIN;
    }


    /* =====================================
        DANH SÁCH KHÁCH THEO BOOKING
    ===================================== */
    public function guestList()
    {
        $departure_id = $_GET["departure_id"];

        // Lấy khách theo booking, không phải bảng guest
        $guests = $this->tourModel->getBookingsByDeparture($departure_id);
        $guests = $this->tourModel->getGuestsFullByDeparture($departure_id);

        $tourName = $this->tourModel->getTourNameByDeparture($departure_id);

        $title = "Danh sách khách: $tourName";
        $view = "admin/tour/guest_list";
        require_once PATH_VIEW_MAIN;
    }

}
