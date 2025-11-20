<?php

class HomeController
{
    public function index() {
        $view = 'schedule/index';
        require_once PATH_VIEW_MAIN;
    }
    public function viewSchedule()  {
        $view = 'schedule/index';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCustomers()  {
        $view = 'customers/index';
        require_once PATH_VIEW_MAIN;
    }
    public function viewDiary()  {
        $view = 'diary/index';
        require_once PATH_VIEW_MAIN;
    }
    public function viewCheckin()  {
        $view = 'check-in/index';
        require_once PATH_VIEW_MAIN;
    }
    public function viewRequest()  {
        $view = 'request/index';
        require_once PATH_VIEW_MAIN;
    }
    public function viewReport()  {
        $view = 'report/index';
        require_once PATH_VIEW_MAIN;
    }
}