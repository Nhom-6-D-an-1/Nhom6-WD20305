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

    // Tạo tour
    public function createTour()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_id = $_POST['category_id'];
            $tour_code = $_POST['tour_code'];
            $tour_name = $_POST['tour_name'];
            $description = $_POST['description'];
            $duration_days = $_POST['duration_days'];
            $short_description = $_POST['short_description'];
            $tour = new TourModel();
            $tour->createTour($category_id, $tour_code, $tour_name, $description, $duration_days, $short_description);
            header("Location: " . BASE_URL . "?mode=admin&action=viewstour");
            exit;
        }
        $tour_category = new TourCategoryModel();
        $data_category = $tour_category->getAllCategories();
        $title = "Tạo tour mới";
        $view = "admin/tour/createTour";
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category_id = $_POST['category_id'];
            $tour_code = $_POST['tour_code'];
            $tour_name = $_POST['tour_name'];
            $description = $_POST['description'];
            $duration_days = $_POST['duration_days'];
            $short_description = $_POST['short_description'];
            $tour->editTour($category_id, $tour_code, $tour_name, $description, $duration_days, $short_description, $id);
            header("Location: " . BASE_URL . "?mode=admin&action=viewstour");
            exit;
        }
        $data_tour = $tour->getOneTour($id);
        $data_category = $tour_category->getAllCategories();
        $title = "Chỉnh sửa tour";
        $view = "admin/tour/editTour";
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_version = new TourVersionModel();
            $version_name = $_POST['version_name'];
            $version_code = $_POST['version_code'];
            $season = $_POST['season'];
            $price = $_POST['price'];
            $policies = $_POST['policies'];
            $valid_from = $_POST['valid_from'];
            $valid_to = $_POST['valid_to'];

            $tour_version->createVersion($id, $version_name, $version_code, $season, $price, $policies, $valid_from, $valid_to);
            header("Location: " . BASE_URL . "?mode=admin&action=tourDetail&tab=versions&id=" . $id);
            exit;
        } else {
            $title = "Thêm phiên bản tour";
            $view = "admin/tour/createVersion";
            require_once PATH_VIEW_MAIN;
        }
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $version_name = trim($_POST['version_name']);
            $version_code = trim($_POST['version_code']);
            $season = trim($_POST['season']);
            $price = trim($_POST['price']);
            $policies = trim($_POST['policies']);
            $valid_from = trim($_POST['valid_from']);
            $valid_to = trim($_POST['valid_to']);
            $status = trim($_POST['status']);
            $tour_version->editVersion($version_name, $version_code, $season, $price, $policies, $valid_from, $valid_to, $status, $id);
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_itinerary = new TourItineraryModel();
            $data = [
                'version_id' => $id,
                'day_number' => $_POST['day_number'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'place' => $_POST['place'],
                'activity' => $_POST['activity']
            ];
            $tour_itinerary->insert($data);
            header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=itinerary&id=" . $id);
            exit;
        }
        $title = "Thêm lịch trình";
        $view = "admin/tour/itineraryAdd";
        require_once PATH_VIEW_MAIN;
    }

    // Sửa lịch trình tour
    public function itineraryEdit()
    {
        $id = $_GET['id'];
        $tour_itinerary = new TourItineraryModel();
        $data_itinerary = $tour_itinerary->getOneItinerary($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_itinerary = new TourItineraryModel();
            $data = [
                'day_number' => $_POST['day_number'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'place' => $_POST['place'],
                'activity' => $_POST['activity']
            ];
            $tour_itinerary->update($id, $data);
            $version_id = $data_itinerary['version_id'];
            header("Location: " . BASE_URL . "?mode=admin&action=versionDetail&tab=itinerary&id=" . $version_id);
            exit;
        }
        $title = "Sửa lịch trình";
        $view = "admin/tour/itineraryEdit";
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
