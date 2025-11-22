<?php

$action = $_GET['action'] ?? '/';
match ($action) {

    '/'             => (new GuideController)->viewSchedule(),
    'viewschedule'  => (new GuideController)->viewSchedule(),
    'viewcustomers' => (new GuideController)->viewCustomers(),
    'viewdiary'     => (new GuideController)->viewDiary(),
    'viewcheckin'   => (new GuideController)->viewCheckin(),
    'viewrequest'   => (new GuideController)->viewRequest(),
    'deleteRequest'   => (new GuideController)->deleteRequest(),
    'viewreport'    => (new GuideController)->viewReport(),
    default         => (new GuideController)->viewSchedule(),
};
