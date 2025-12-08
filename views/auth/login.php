<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            font-family: 'Inter', sans-serif;
        }

        /* ===== LEFT PANEL ===== */
        .left-panel {
            width: 50%;
            overflow: hidden;
        }

        .left-panel img {
            width: 95%;
            height: 100vh;
            object-fit: cover;
            object-position: top center; /* Không bị lẹm đầu/chân */
        }

        /* ===== RIGHT PANEL ===== */
        .right-panel {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* Login box */
        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-title {
            font-weight: 700;
            font-size: 22px;
        }

        .login-subtitle {
            color: gray;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* Input wrapper */
        .input-with-icon {
            position: relative;
        }

        .input-with-icon .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #8a8a8a;
        }

        .input-with-icon input {
            height: 48px;
            padding-left: 42px;
            border-radius: 10px;
            background: #eef3ff;
            border: 1px solid #d6d6d6;
            font-size: 15px;
        }

        .input-with-icon input:focus {
            border-color: #1b245a;
            background: #fff;
        }

        /* Button */
        .btn-login {
            width: 100%;
            height: 50px;
            border-radius: 10px;
            background: #1b245a;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #0f163f;
        }

        /* Error message */
        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }
            .right-panel {
                width: 100%;
            }
        }

        .text-center .login-title {
            font-size: 28px;
        }
    </style>
</head>

<body>

<div class="left-panel">
    <img src="<?= BASE_URL ?>assets/images/anh2.png" alt="Login Background">
</div>

<div class="right-panel">

    <div class="login-box">

        <h4 class="text-center login-title">HỆ THỐNG QUẢN LÝ TOUR</h4>
        <p class="text-center login-subtitle">Đăng nhập để tiếp tục</p>

        <?php if (!empty($_GET['error'])): ?>
            <p class="error-msg text-center"><?= $_GET['error']; ?></p>
        <?php endif; ?>

        <form method="POST" action="?mode=auth&action=login">

            <!-- USERNAME -->
            <div class="mb-3 input-with-icon">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" >
            </div>

            <!-- PASSWORD -->
            <div class="mb-3 input-with-icon">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" >
            </div>

            <div class="text-end mb-3">
                <a href="#" class="text-muted small">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn btn-login">Đăng nhập</button>

        </form>

    </div>

</div>

</body>
</html>