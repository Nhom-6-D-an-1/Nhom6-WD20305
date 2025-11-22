<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new AdminController)->viewDashboard(),
    'viewsdashboard'         => (new AdminController)->viewDashboard(),
    'viewsbooking'         => (new AdminController)->viewBooking(),
    'viewstour'         => (new AdminController)->viewTour(),
    'viewsdanhmuc'         => (new AdminController)->viewDanhmuc(),
    'viewsaccount'         => (new AdminController)->viewAccount(),
    'viewsresources'         => (new AdminController)->viewResources(),
};