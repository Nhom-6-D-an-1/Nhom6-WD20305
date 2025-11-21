<?php

class GuideController
{
    public function index() {
        $title = 'Lịch làm việc';
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
    public function viewSchedule()  {
        $schedule = new ScheduleModel();
        $data = $schedule->getAll();
        $title = "Lịch làm việc";
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCustomers()  {
        $view = 'guide/customers/customers';
        require_once PATH_VIEW_MAIN;
    }
    public function viewDiary()  {
        $view = 'guide/diary/diary';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCheckin()  {
        $view = 'guide/check-in/check-in';
        require_once PATH_VIEW_MAIN;
    }
    public function viewRequest()  {
        $view = 'guide/request/request';
        require_once PATH_VIEW_MAIN;
    }
    public function viewReport()  {
        $view = 'guide/report/report';
        require_once PATH_VIEW_MAIN;
    }
}