<?php

class TourController
{ // Xem tour
    public function viewTour()
    {
        $tour = new TourModel();
        $data = $tour->getAllTour();
        $title = "Danh sách tour";
        $view = "admin/tour/tour";
        require_once PATH_VIEW_MAIN;
    }

    // Tạo <tour></tour>
    public function createTour()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Lấy dữ liệu
            $category_id = $_POST['category_id'] ?? '';
            $tour_code = trim($_POST['tour_code'] ?? '');
            $tour_name = trim($_POST['tour_name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $duration_days = $_POST['duration_days'] ?? '';
            $short_description = trim($_POST['short_description'] ?? '');

            $errors = [];

            if ($tour_name === '') {
                $errors['tour_name'] = 'Tên tour không được để trống';
            }

            if ($tour_code === '') {
                $errors['tour_code'] = 'Mã tour không được để trống';
            }

            if ($category_id === '') {
                $errors['category_id'] = 'Vui lòng chọn danh mục tour';
            }

            if (!is_numeric($duration_days) || $duration_days <= 0) {
                $errors['duration_days'] = 'Thời lượng phải là số lớn hơn 0';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=createTour");
                exit;
            }

            $tour = new TourModel();
            $tour->createTour(
                $category_id,
                $tour_code,
                $tour_name,
                $description,
                $duration_days,
                $short_description
            );
            header("Location: " . BASE_URL . "?mode=admin&action=viewstour");
            exit;
        }

        $tour_category = new TourCategoryModel();
        $data_category = $tour_category->getAllCategories();

        $title = "Tạo tour mới";
        $view  = "admin/tour/createTour";

        require_once PATH_VIEW_MAIN;
    }



    // Chi tiết tour
    public function tourDetail()
    {
        $tour = new TourModel();
        $id = $_GET['id'];
        $data = $tour->getOneTour($id);
        $tour_version = new TourVersionModel();
        $data_version = $tour_version->getAllVersionByTourId($id);
        $title = "Chi tiết tour";
        $view = "admin/tour/tourDetail";
        require_once PATH_VIEW_MAIN;
    }

    // Sửa tour
    public function editTour()
    {
        $tour = new TourModel();
        $tour_category = new TourCategoryModel();
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $category_id       = $_POST['category_id'] ?? '';
            $tour_code         = trim($_POST['tour_code'] ?? '');
            $tour_name         = trim($_POST['tour_name'] ?? '');
            $description       = trim($_POST['description'] ?? '');
            $duration_days     = $_POST['duration_days'] ?? '';
            $short_description = trim($_POST['short_description'] ?? '');

            $errors = [];

            if ($tour_name === '') {
                $errors['tour_name'] = 'Tên tour không được để trống';
            }

            if ($tour_code === '') {
                $errors['tour_code'] = 'Mã tour không được để trống';
            }

            if ($category_id === '') {
                $errors['category_id'] = 'Danh mục không hợp lệ';
            }

            if (!is_numeric($duration_days) || $duration_days <= 0) {
                $errors['duration_days'] = 'Thời lượng phải lớn hơn 0';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=editTour&id=" . $id);
                exit;
            }

            $tour->editTour(
                $category_id,
                $tour_code,
                $tour_name,
                $description,
                $duration_days,
                $short_description,
                $id
            );

            header("Location: " . BASE_URL . "?mode=admin&action=viewstour");
            exit;
        }

        $data_tour     = $tour->getOneTour($id);
        $data_category = $tour_category->getAllCategories();

        $title = "Chỉnh sửa tour";
        $view  = "admin/tour/editTour";
        require_once PATH_VIEW_MAIN;
    }


    // Xóa Tour
    public function deleteTour()
    {
        $id = $_GET['id'];
        $tour_version = new TourVersionModel();
        $tour = new TourModel();
        $count = $tour_version->countVersionByTourId($id);
        if ($count > 0) {
            $_SESSION['flash_error'] = "Không thể xóa tour vì đang có phiên bản!";
            header("Location: " . BASE_URL . "?mode=admin&action=viewstour");
            exit;
        }
        $tour->deleteTour($id);
        $_SESSION['flash_success'] = "Xóa tour thành công!";
        header("Location: " . BASE_URL . "?mode=admin&action=viewstour");
        exit;
    }

    // Thêm phiên bản
    public function createVersion()
    {
        $id = $_GET['id'];

        $tour = new TourModel();
        $data = $tour->getOneTour($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $version_name = trim($_POST['version_name'] ?? '');
            $version_code = trim($_POST['version_code'] ?? '');
            $season       = trim($_POST['season'] ?? '');
            $price        = $_POST['price'] ?? '';
            $policies     = trim($_POST['policies'] ?? '');
            $valid_from   = $_POST['valid_from'] ?? '';
            $valid_to     = $_POST['valid_to'] ?? '';

            $errors = [];

            if ($version_name === '') {
                $errors['version_name'] = 'Tên phiên bản không được để trống';
            }

            if ($version_code === '') {
                $errors['version_code'] = 'Mã phiên bản không được để trống';
            }

            if ($season === '') {
                $errors['season'] = 'Mùa không được để trống';
            }

            if (!is_numeric($price) || $price <= 0) {
                $errors['price'] = 'Giá phải là số lớn hơn 0';
            }

            if ($valid_from === '') {
                $errors['valid_from'] = 'Vui lòng chọn ngày bắt đầu';
            }

            if ($valid_to === '') {
                $errors['valid_to'] = 'Vui lòng chọn ngày kết thúc';
            }

            if ($valid_from && $valid_to && $valid_from > $valid_to) {
                $errors['valid_to'] = 'Ngày kết thúc phải sau ngày bắt đầu';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=createVersion&id=" . $id);
                exit;
            }

            $tour_version = new TourVersionModel();
            $tour_version->createVersion(
                $id,
                $version_name,
                $version_code,
                $season,
                $price,
                $policies,
                $valid_from,
                $valid_to
            );

            header("Location: " . BASE_URL . "?mode=admin&action=tourDetail&tab=versions&id=" . $id);
            exit;
        }

        $title = "Thêm phiên bản tour";
        $view  = "admin/tour/createVersion";
        require_once PATH_VIEW_MAIN;
    }


    // Chi tiết phiên bản
    public function versionDetail()
    {
        $id = $_GET['id'];
        $tour_version = new TourVersionModel();
        $tour_itinerary = new TourItineraryModel();
        $tour_image = new TourImageModel();
        $data_version = $tour_version->getOneVersion($id);
        $data_itinerary = $tour_itinerary->getByVersionId($id);
        $data_image = $tour_image->getImagesByVersion($id);
        $title = "Chi tiết phiên bản tour";
        $view = "admin/tour/versionDetail";
        require_once PATH_VIEW_MAIN;
    }

    // Sửa phiên bản
    public function editVersion()
    {
        $id = $_GET['id'];
        $tour_version = new TourVersionModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $version_name = trim($_POST['version_name'] ?? '');
            $version_code = trim($_POST['version_code'] ?? '');
            $season       = trim($_POST['season'] ?? '');
            $price        = $_POST['price'] ?? '';
            $policies     = trim($_POST['policies'] ?? '');
            $valid_from   = $_POST['valid_from'] ?? '';
            $valid_to     = $_POST['valid_to'] ?? '';
            $status       = $_POST['status'] ?? '';

            $errors = [];


            if ($version_name === '') {
                $errors['version_name'] = 'Tên phiên bản không được để trống';
            }

            if ($version_code === '') {
                $errors['version_code'] = 'Mã phiên bản không được để trống';
            }

            if ($season === '') {
                $errors['season'] = 'Mùa không được để trống';
            }

            if (!is_numeric($price) || $price <= 0) {
                $errors['price'] = 'Giá phải là số lớn hơn 0';
            }

            if ($valid_from === '') {
                $errors['valid_from'] = 'Vui lòng chọn ngày bắt đầu';
            }

            if ($valid_to === '') {
                $errors['valid_to'] = 'Vui lòng chọn ngày kết thúc';
            }

            if ($valid_from && $valid_to && $valid_from > $valid_to) {
                $errors['valid_to'] = 'Ngày kết thúc phải sau ngày bắt đầu';
            }

            if (!in_array($status, ['active', 'inactive'])) {
                $errors['status'] = 'Trạng thái không hợp lệ';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=editVersion&id=" . $id);
                exit;
            }

            $tour_version->editVersion(
                $version_name,
                $version_code,
                $season,
                $price,
                $policies,
                $valid_from,
                $valid_to,
                $status,
                $id
            );

            header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&id=" . $id);
            exit;
        }

        $data_version = $tour_version->getOneVersion($id);
        $title = "Sửa phiên bản tour";
        $view  = "admin/tour/editVersion";
        require_once PATH_VIEW_MAIN;
    }


    // Thêm lịch trình tour
    public function itineraryAdd()
    {
        $id = $_GET['id'];

        $tour_version = new TourVersionModel();
        $data_version = $tour_version->getOneVersion($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $day_number = $_POST['day_number'] ?? '';
            $place      = trim($_POST['place'] ?? '');
            $start_time = $_POST['start_time'] ?? '';
            $end_time   = $_POST['end_time'] ?? '';
            $activity   = trim($_POST['activity'] ?? '');

            $errors = [];

            if (!is_numeric($day_number) || $day_number <= 0) {
                $errors['day_number'] = 'Ngày thứ phải là số lớn hơn 0';
            }

            if ($place === '') {
                $errors['place'] = 'Địa điểm không được để trống';
            }

            if ($start_time === '') {
                $errors['start_time'] = 'Vui lòng chọn giờ bắt đầu';
            }

            if ($end_time === '') {
                $errors['end_time'] = 'Vui lòng chọn giờ kết thúc';
            }

            if ($start_time && $end_time && $start_time >= $end_time) {
                $errors['end_time'] = 'Giờ kết thúc phải sau giờ bắt đầu';
            }

            if ($activity === '') {
                $errors['activity'] = 'Hoạt động không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=itineraryAdd&id=" . $id);
                exit;
            }

            $tour_itinerary = new TourItineraryModel();
            $data = [
                'version_id' => $id,
                'day_number' => $day_number,
                'start_time' => $start_time,
                'end_time'   => $end_time,
                'place'      => $place,
                'activity'   => $activity
            ];

            $tour_itinerary->insert($data);

            header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=itinerary&id=" . $id);
            exit;
        }

        $title = "Thêm lịch trình";
        $view  = "admin/tour/itineraryAdd";
        require_once PATH_VIEW_MAIN;
    }


    // Sửa lịch trình tour
    public function itineraryEdit()
    {
        $id = $_GET['id'];
        $tour_itinerary = new TourItineraryModel();
        $data_itinerary = $tour_itinerary->getOneItinerary($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $day_number = $_POST['day_number'] ?? '';
            $place      = trim($_POST['place'] ?? '');
            $start_time = $_POST['start_time'] ?? '';
            $end_time   = $_POST['end_time'] ?? '';
            $activity   = trim($_POST['activity'] ?? '');

            $errors = [];

            if (!is_numeric($day_number) || $day_number <= 0) {
                $errors['day_number'] = 'Ngày thứ phải là số lớn hơn 0';
            }

            if ($place === '') {
                $errors['place'] = 'Địa điểm không được để trống';
            }

            if ($start_time === '') {
                $errors['start_time'] = 'Vui lòng chọn giờ bắt đầu';
            }

            if ($end_time === '') {
                $errors['end_time'] = 'Vui lòng chọn giờ kết thúc';
            }

            if ($start_time && $end_time && $start_time >= $end_time) {
                $errors['end_time'] = 'Giờ kết thúc phải sau giờ bắt đầu';
            }

            if ($activity === '') {
                $errors['activity'] = 'Hoạt động không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old']    = $_POST;

                header("Location: " . BASE_URL . "?mode=admin&action=itineraryEdit&id=" . $id);
                exit;
            }

            $data = [
                'day_number' => $day_number,
                'start_time' => $start_time,
                'end_time'   => $end_time,
                'place'      => $place,
                'activity'   => $activity
            ];

            $tour_itinerary->update($id, $data);

            $version_id = $data_itinerary['version_id'];
            header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=itinerary&id=" . $version_id);
            exit;
        }

        $title = "Sửa lịch trình";
        $view  = "admin/tour/itineraryEdit";
        require_once PATH_VIEW_MAIN;
    }


    // Xóa lịch trình 
    public function deleteItinerary()
    {
        $id = $_GET['id'];
        $tour_itinerary = new TourItineraryModel();
        $data_itinerary = $tour_itinerary->getOneItinerary($id);
        $tour_itinerary->delete($id);
        $version_id = $data_itinerary['version_id'];
        header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=itinerary&id=" . $version_id);
        exit;
    }

    public function addImage()
    {
        $tour_image = new TourImageModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'] ?? '';
            $data_image = $tour_image->getImagesByVersion($id);
            if ($_FILES['image_url'] && $_FILES['image_url']['error'] == UPLOAD_ERR_OK) {
                $image_url = uploadFile($_FILES['image_url'], "tour/");

                if ($image_url) {
                    if ($data_image) {
                        deleteFile($data_image['image_url']);
                        $tour_image->updateImage($id, $image_url);
                    } else {
                        $tour_image->insertImage($id, $image_url);
                    }
                }
            }
            header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=images&id=" . $id);
            exit;
        }
    }
    public function deleteImage()
    {
        $id = $_GET['id'];
        $tour_image = new TourImageModel();
        $tour_version = new TourVersionModel();
        $data_image = $tour_image->getImagesByVersion($id);
        $image_id = $data_image['image_id'];
        $tour_image->deleteImage($image_id);
        $data_version = $tour_version->getOneVersion($id);
        $version_id = $data_version['version_id'];
        header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=images&id=" . $version_id);
        exit;
    }
}
