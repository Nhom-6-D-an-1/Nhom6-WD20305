<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .left-panel {
            background: linear-gradient(180deg, #1b245a 0%, #382a7d 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
        }

        .left-panel img {
            max-width: 80%;
        }

        .login-box {
            max-width: 400px;
            margin: auto;
            padding: 40px;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
        }

        .btn-login {
            height: 50px;
            border-radius: 8px;
            background-color: #1b245a;
            color: white;
            font-weight: 500;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #0f163f;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.6;
        }

        .input-with-icon input {
            padding-left: 40px;
        }

        .error-msg {
            color: red;
            margin-bottom: 10px;
        }

        .img-fluid {
            height: 100%;
        }
    </style>
</head>

<body>

<div class="row h-100 g-0">

    <!-- LEFT SIDE -->
    <div class="col-12 col-md-6 left-panel">
        <img class="img-fluid" src="<?php BASE_URL ?>assets/images/anh.png" alt="Handshake Image">
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-12 col-md-6 d-flex align-items-center">

        <div class="login-box">

            <h4 class="fw-bold text-center mb-1">HỆ THỐNG QUẢN LÝ TOUR</h4>
            <p class="text-center text-muted mb-4">Đăng nhập để tiếp tục</p>

            <?php if (!empty($_GET['error'])): ?>
                <p class="error-msg"><?= $_GET['error']; ?></p>
            <?php endif; ?>

            <form method="POST" action="?mode=auth&action=login">

                <div class="mb-3 position-relative input-with-icon">
                    <i class="input-icon bi bi-envelope"></i>
                    <input type="text" name="username" class="form-control" placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3 position-relative input-with-icon">
                    <i class="input-icon bi bi-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="text-end mb-3">
                    <a href="#" class="text-muted small">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn btn-login">Đăng nhập</button>

            </form>

        </div>

    </div>

</div>

<!-- icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
