<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new GuideController)->index(),
    'viewschedule'         => (new GuideController)->viewSchedule(),
    'viewcustomers'         => (new GuideController)->viewCustomers(),
    'viewdiary'         => (new GuideController)->viewDiary(),
    'viewcheck-in'         => (new GuideController)->viewCheckin(),
    'viewrequest'         => (new GuideController)->viewRequest(),
    'viewreport'         => (new GuideController)->viewReport(),
};