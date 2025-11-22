<?php

$action = $_GET['action'] ?? '/';
match ($action) {

    '/'             => (new GuideController)->viewSchedule(),
    'viewschedule'  => (new GuideController)->viewSchedule(),
    'viewcustomers' => (new GuideController)->viewCustomers(),
    'viewdiary'     => (new GuideController)->viewDiary(),
    // ❗ Sửa lại: không dùng viewcheck-in
    'viewcheckin'   => (new GuideController)->viewCheckin(),
    'viewrequest'   => (new GuideController)->viewRequest(),
    'viewreport'    => (new GuideController)->viewReport(),
    // bắt buộc phải có default
    default         => (new GuideController)->viewSchedule(),
};

