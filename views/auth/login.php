<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ===== BODY ===== */
body {
    height: 100vh;
    display: flex;
    font-family: "Inter", sans-serif;

    /* Nền vũ trụ gradient động */
    background: linear-gradient(135deg, #dfe9f3, #ffffff);
    background-size: 300% 300%;
    animation: galaxyMove 12s ease infinite;
}

/* ===== LEFT PANEL ===== */
.left-panel {
    width: 50%;
    overflow: hidden;
    position: relative;
}

.left-panel img {
    width: 100%;
    height: 100%;
    object-fit: cover;

    /* Hiệu ứng ánh sáng sang trọng */
    filter: brightness(1.05) saturate(1.1);
}

.left-panel::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.6), rgba(255,255,255,0) 70%);
    pointer-events: none;
}

/* ===== RIGHT PANEL ===== */
.right-panel {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px;
}

/* ===== LOGIN BOX ===== */
.login-box {
    width: 100%;
    max-width: 430px;
    padding: 45px 38px;
    border-radius: 20px;

    /* Glass cao cấp */
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px) saturate(1.7);
    border: 1px solid rgba(255, 255, 255, 0.45);

    /* Shadow đa lớp sang trọng */
    box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.08),
        0 15px 45px rgba(0, 0, 0, 0.1),
        0 0 60px rgba(150, 180, 255, 0.35);
    
    animation: floatUp 1s ease forwards;
}

/* ===== TITLE ===== */
.login-title {
    font-size: 26px;
    font-weight: 800;
    text-align: center;

    color: #1a2b6f !important;   /* CHỮ XANH NAVY – GIỐNG SIDEBAR */
    text-transform: uppercase;
    letter-spacing: 0.5px;
}


.login-subtitle {
    color: #6d6d73 !important;   /* XÁM XANH NHẸ – DỄ ĐỌC */
    text-align: center;
    margin-bottom: 25px;
}

/* ===== INPUT FIELD ===== */
.input-with-icon {
    position: relative;
    margin-bottom: 20px;
}

.input-with-icon .input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #4f5d75;
    font-size: 20px;
}

.input-with-icon input {
    width: 100%;
    height: 54px;
    padding-left: 50px;

    border-radius: 14px;
    background: #f0f3ff;
    border: 1px solid #d7dcf6;

    font-size: 16px;
    color: #1c1f34;

    transition: 0.28s ease;
}

.input-with-icon input:focus {
    border-color: #4a6bff;
    background: #ffffff;

    /* Glow lam nhẹ sang cực đẹp */
    box-shadow:
        0 0 0 4px rgba(100, 130, 255, 0.2),
        0 0 25px rgba(100, 130, 255, 0.3);
}


.btn-login {
    width: 100%;
    height: 50px;
    border-radius: 14px;
    border: none;

    background: #2f03f3ff !important;    
    color: #f4f4f4ff !important;        
    font-size: 16px;
    font-weight: 700;

    box-shadow:
        0 4px 16px rgba(75, 105, 255, 0.35),
        0 2px 8px rgba(140, 165, 255, 0.35);

    transition: 0.25s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow:
        0 8px 22px rgba(75, 105, 255, 0.45),
        0 4px 12px rgba(140, 165, 255, 0.45);
}

/* ===== ERROR ===== */
.error-msg {
    color: #e60033;
    font-weight: 600;
    text-align: center;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .left-panel {
        display: none;
    }
    .right-panel {
        width: 100%;
        padding: 25px;
    }
}

/* ===== ANIMATIONS ===== */
@keyframes galaxyMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes floatUp {
    from { opacity: 0; transform: translateY(35px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes btnMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
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