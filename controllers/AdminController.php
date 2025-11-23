<?php

class AdminController
{
    public function viewBooking()
    {
        $title = "Quản lý booking";
        $view = 'admin/booking/booking';
        require_once PATH_VIEW_MAIN;
    }
    public function viewTour()
    {
        $title = "Quản lý tour";
        $view = 'admin/tour/tour';
        require_once PATH_VIEW_MAIN;
    }

    public function viewDanhmuc() {
        $model = new TourCategoryModel();
        $list = $model->getAll();

        $title = "Danh mục tour";
        $view = "admin/danhmuc/danhmuc";

        require_once PATH_VIEW_MAIN;
    }


    public function addDanhmuc() {
        $title = "Thêm danh mục tour";
        $view = "admin/danhmuc/create";

        require_once PATH_VIEW_MAIN;
    }


    public function storeDanhmuc() {
        $model = new TourCategoryModel();

        $data = [
            "category_name" => $_POST['category_name'],
            "description"   => $_POST['description'],
            "status"        => $_POST['status']
        ];

        $model->addDanhmuc($data);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    public function editDanhmuc() {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $category = $model->getById($id);

        $title = "Sửa danh mục tour";
        $view = "admin/danhmuc/edit";

        require_once PATH_VIEW_MAIN;
    }


    public function updateDanhmuc() {
        $id = $_GET['id'];
        $model = new TourCategoryModel();

        $data = [
            "category_name" => $_POST['category_name'],
            "description"   => $_POST['description'],
            "status"        => $_POST['status']
        ];

        $model->updateDanhmuc($id, $data);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    public function showDanhmuc() {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $category = $model->getById($id);

        $title = "Chi tiết danh mục tour";
        $view = "admin/danhmuc/show";

        require_once PATH_VIEW_MAIN;
    }


    public function deleteDanhmuc() {
        $id = $_GET['id'];

        $model = new TourCategoryModel();
        $model->deleteDanhmuc($id);

        header("Location: ?mode=admin&action=viewsdanhmuc");
        exit();
    }


    public function viewAccount()
    {
        $title = "Quản lý tài khoản";
        $view = 'admin/account/account';
        require_once PATH_VIEW_MAIN;
    }
    public function viewResources()
    {
        $title = "Quản lý nhân sự";
        $view = 'admin/resources/resources';
        require_once PATH_VIEW_MAIN;
    }
    public function viewDashboard()
    {
        $title = "Dashboard";
        $view = 'admin/dashboard/dashboard';
        require_once PATH_VIEW_MAIN;
    }
}
