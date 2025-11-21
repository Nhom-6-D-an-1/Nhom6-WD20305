<?php

class GuideController
{
    public function viewSchedule()
    {
        $title = "Lịch làm việc";
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCustomers()
    {
        $title = "Danh sách khách";
        $view = 'guide/customers/customers';
        require_once PATH_VIEW_MAIN;
    }
    public function viewDiary()
    {
        $title = "Nhật ký tour";
        $view = 'guide/diary/diary';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCheckin()
    {
        $title = "Check-in, điểm danh";
        $view = 'guide/checkin/checkin';
        require_once PATH_VIEW_MAIN;
    }
    public function viewRequest()
    {
        $title = "Yêu cầu đặc biệt";
        $view = 'guide/request/request';
        require_once PATH_VIEW_MAIN;
    }
    public function viewReport()
    {
        $title = "Báo cáo sự cố";
        $view = 'guide/report/report';
        require_once PATH_VIEW_MAIN;
    }
}
