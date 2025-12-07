<?php

$action = $_GET['action'] ?? '/';
match ($action) {

    '/'             => (new GuideController)->viewSchedule(),
    'viewschedule'  => (new GuideController)->viewSchedule(),
    'viewcustomers' => (new GuideController)->viewCustomers(),
    'viewdiary'     => (new GuideController)->viewDiary(),
    'deleteDiary'   => (new GuideController)->deleteDiary(),
    'viewcheckin'   => (new GuideController)->viewCheckin(),
    'viewrequest'   => (new GuideController)->viewRequest(),
    'deleteRequest'   => (new GuideController)->deleteRequest(),
    'detail-schedule-info'         => (new GuideController)->viewScheduleInfo(),
    'detail-schedule-itinerary'         => (new GuideController)->viewScheduleItinerary(),
    'detail-schedule-customers'         => (new GuideController)->viewScheduleCustomers(),
    'detail-schedule-checkin'         => (new GuideController)->viewScheduleCheckin(),
    'logout' => (new AuthController())->logout(),
    default         => (new GuideController)->viewSchedule(),
};
