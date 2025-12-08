<?php
class AuthController
{
    public function index()
    {
        include './views/auth/login.php';
    }

    // public function login()
    // {
    //     require_once './models/UserModel.php';

    //     $username = trim($_POST['username'] ?? "");
    //     $password = trim($_POST['password'] ?? "");

    //     $model = new UserModel();
    //     $user = $model->checkLogin($username);

    //     if (!$user || !password_verify($password, $user['password_hash'])) {
    //         header("Location: ?mode=auth&error=Tài khoản hoặc mật khẩu sai");
    //         exit;
    //     }

    //     $_SESSION['user'] = $user;
    //     if ($user['role'] == 'guide') {
    //         require_once './models/TourGuideModel.php';
    //         $guideModel = new TourGuideModel();
    //         $guideInfo = $guideModel->getByUserId($user['user_id']);

    //         if ($guideInfo) {
    //             $_SESSION['user']['guide_id'] = $guideInfo['guide_id'];
    //         }
    //     }


    //     if ($user['role'] == 'admin') {
    //         header("Location: " . BASE_URL . "?mode=admin");
    //     } else {
    //         header("Location: " . BASE_URL . "?mode=guide");
    //     }
    // }
    public function login()
    {
        require_once './models/UserModel.php';

        $username = trim($_POST['username'] ?? "");
        $password = trim($_POST['password'] ?? "");

        // Validate cơ bản
        if ($username === "") {
            header("Location: ?mode=auth&error=Username không được để trống");
            exit;
        }
        if ($password === "") {
            header("Location: ?mode=auth&error=Password không được để trống");
            exit;
        }

        // Validate độ dài
        if (strlen($username) < 3 || strlen($username) > 30) {
            header("Location: ?mode=auth&error=Username phải từ 3-30 ký tự");
            exit;
        }
        if (strlen($password) < 6 || strlen($password) > 10) {
            header("Location: ?mode=auth&error=Password phải từ 6-10 ký tự");
            exit;
        }

        // Kiểm tra DB
        $model = new UserModel();
        $user = $model->checkLogin($username);

        if (!$user) {
            // Không tìm thấy username trong DB
            header("Location: ?mode=auth&error=Username không tồn tại");
            exit;
        }

        if (!password_verify($password, $user['password_hash'])) {
            // Username đúng nhưng password sai
            header("Location: ?mode=auth&error=Password không đúng");
            exit;
        }

        // Lưu session
        $_SESSION['user'] = $user;
        if ($user['role'] == 'guide') {
            require_once './models/TourGuideModel.php';
            $guideModel = new TourGuideModel();
            $guideInfo = $guideModel->getByUserId($user['user_id']);
            if ($guideInfo) {
                $_SESSION['user']['guide_id'] = $guideInfo['guide_id'];
            }
        }

        // Redirect theo role
        if ($user['role'] == 'admin') {
            header("Location: " . BASE_URL . "?mode=admin");
        } else {
            header("Location: " . BASE_URL . "?mode=guide");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . BASE_URL . "?mode=auth");
    }
}
