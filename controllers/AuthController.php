<?php
class AuthController
{
    public function index()
    {
        include './views/auth/login.php';
    }

    public function login()
    {
        require_once './models/UserModel.php';

        $username = trim($_POST['username'] ?? "");
        $password = trim($_POST['password'] ?? "");

        $model = new UserModel();
        $user = $model->checkLogin($username);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            header("Location: ?mode=auth&error=Tài khoản hoặc mật khẩu sai");
            exit;
        }

        $_SESSION['user'] = $user;

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
