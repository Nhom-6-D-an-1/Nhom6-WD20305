<?php

$action = $_GET['action'] ?? '/';
match ($action) {

    '/'             => (new GuideController)->viewSchedule(),
    'viewschedule'  => (new GuideController)->viewSchedule(),
    'viewcustomers' => (new GuideController)->viewCustomers(),
    'viewdiary'     => (new GuideController)->viewDiary(),
    'viewcheckin'   => (new GuideController)->viewCheckin(),
    'viewrequest'   => (new GuideController)->viewRequest(),
    'viewreport'    => (new GuideController)->viewReport(),
    default         => (new GuideController)->viewSchedule(),
};
