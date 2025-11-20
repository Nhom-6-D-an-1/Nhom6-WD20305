<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'viewschedule'         => (new HomeController)->viewSchedule(),
    'viewcustomers'         => (new HomeController)->viewCustomers(),
    'viewdiary'         => (new HomeController)->viewDiary(),
    'viewcheck-in'         => (new HomeController)->viewCheckin(),
    'viewrequest'         => (new HomeController)->viewRequest(),
    'viewreport'         => (new HomeController)->viewReport(),
};