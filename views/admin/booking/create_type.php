<div class="container mt-4">

    <h3 class="fw-bold mb-4">Chọn loại Booking</h3>

    <?php
    // Lấy departure_id an toàn
    $departure_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($departure_id <= 0):
    ?>
        <div class="alert alert-danger">
            Không tìm thấy lịch trình phù hợp!
            <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-sm btn-secondary ms-2">Quay lại</a>
        </div>

    <?php else: ?>

        <p class="mb-4 text-muted">
            Vui lòng chọn loại hình booking cho lịch trình có ID: <strong><?= $departure_id ?></strong>
        </p>

        <div class="d-flex gap-3">

            <!-- Booking khách lẻ -->
            <a href="<?= BASE_URL ?>?mode=admin&action=createFit&id=<?= $departure_id ?>"
                class="btn btn-primary btn-lg px-4 py-2">
                Khách lẻ (FIT)
            </a>

            <!-- Booking khách đoàn -->
            <a href="<?= BASE_URL ?>?mode=admin&action=createGit&id=<?= $departure_id ?>"
                class="btn btn-success btn-lg px-4 py-2">
                Khách đoàn (GIT)
            </a>

        </div>

        <div class="mt-4">
            <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-secondary">
                Quay lại chọn lịch trình
            </a>
        </div>

    <?php endif; ?>

</div>