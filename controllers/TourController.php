<?php

class TourController
{
    private $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
    }

    /* ======================
        DANH SÁCH TOUR
       ====================== */
    public function index()
    {
        $tours = $this->tourModel->getFullInfo();

        $title = "Quản lý tour";
        $view = "admin/tour/tour";
        require_once PATH_VIEW_MAIN;
    }

    /* ======================
        FORM THÊM
       ====================== */
    public function create()
    {
        $categories = $this->tourModel->getCategories();
        $guides     = $this->tourModel->getGuides();

        $title = "Thêm tour";
        $view = "admin/tour/create";
        require_once PATH_VIEW_MAIN;
    }

    /* ======================
        LƯU TOUR MỚI
       ====================== */
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

    /* ======================
        FORM SỬA TOUR
       ====================== */
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

    /* ======================
        CẬP NHẬT TOUR
       ====================== */
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

    /* ======================
        XOÁ TOUR
       ====================== */
    public function delete()
    {
        $id = $_GET["id"];
        $this->tourModel->delete($id);

        header("Location: index.php?mode=admin&action=viewstour");
        exit;
    }
}
