<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <title><?= $title ?? 'Base MVC PHP 1' ?></title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/views.css">
</head>

<body>

    <?php
    $mode = $_SESSION['user']['role'] ?? 'auth';
    if ($mode == 'admin') {
        require_once PATH_VIEW . "admin/partialsAdmin/header.php";
        require_once PATH_VIEW . "admin/partialsAdmin/sidebar.php";
    } elseif ($mode == 'guide') {
        require_once PATH_VIEW . "guide/partials/header.php";
        require_once PATH_VIEW . "guide/partials/sidebar.php";
    }
    ?>

    <div class="d-flex">
        <main class="min-vh-100 flex-grow-1" style="margin-left: 260px;">
            <div class="container-fluid py-4 px-4">
                <?php
                // Flash messages (success / error)
                if (!empty($_SESSION['flash_success'])) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['flash_success']) . '</div>';
                    unset($_SESSION['flash_success']);
                }
                if (!empty($_SESSION['flash_error'])) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
                    unset($_SESSION['flash_error']);
                }

                if (isset($view)) {
                    require_once PATH_VIEW . $view . '.php';
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>