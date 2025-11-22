<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Base MVC PHP 1' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/views.css">
</head>

<body>

    <!-- HEADER ADMIN -->
    <?php require_once PATH_VIEW . "admin/layout/header.php"; ?>

    <div class="d-flex">

        <!-- SIDEBAR ADMIN -->
        <?php require_once PATH_VIEW . "admin/layout/sidebar.php"; ?>

        <!-- CONTENT -->
        <main class="min-vh-100 flex-grow-1" style="margin-left: 260px;">
            <div class="container-fluid py-4 px-4">
                <?php
                if (isset($view)) {
                    require_once PATH_VIEW . $view . '.php';
                }
                ?>
            </div>
        </main>

    </div>

</body>

</html>
