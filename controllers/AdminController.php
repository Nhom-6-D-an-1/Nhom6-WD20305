<?php
class AdminController
{
    public function Home()
    {
        $title = "trang quản trị";
        $view = "admin/home";
        require_once PATH_VIEW;
    }
}
