<?php
// class AdminController
// {
// public function Home()
// {
// $title = "trang quản trị";
// $view = "admin/home";
// require_once PATH_VIEW;
// }
// }
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
    public function viewDanhmuc()
    {
        $title = "Danh mục tour";
        $view = 'admin/danhmuc/danhmuc';
        require_once PATH_VIEW_MAIN;
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
