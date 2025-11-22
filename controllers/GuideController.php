<?php

class GuideController
{
    // SCHEDULE
    public function viewSchedule()
    {
        $schedule = new ScheduleModel();
        $schedulaData = $schedule->getAllByGuide($_SESSION['user_id']);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/schedule';
        require_once PATH_VIEW_MAIN;
    }
    public function viewScheduleInfo()
    {
        $schedule = new ScheduleModel();
        $infoData = $schedule->getInfo($_SESSION['departure_id']);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/detail/info';
        require_once PATH_VIEW_MAIN;
    }
    public function viewScheduleItinerary()
    {
        $schedule = new ScheduleModel();
        $itineraryData = $schedule->getItinerary($_SESSION['departure_id']);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/detail/itinerary';
        require_once PATH_VIEW_MAIN;
    }
    public function viewScheduleCustomers()
    {
        $schedule = new ScheduleModel();
        $customersData = $schedule->getCustomers($_SESSION['departure_id']);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/detail/customers';
        require_once PATH_VIEW_MAIN;
    }
    public function viewScheduleCheckin()
    {
        $schedule = new ScheduleModel();
        $checkinData = $schedule->getCheckin($_SESSION['departure_id']);
        $title = "Lịch làm việc";
        $view = 'guide/schedule/detail/checkin';
        require_once PATH_VIEW_MAIN;
    }
    // CUSTOMERS
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
