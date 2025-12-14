<?php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
?>

<style>
    :root {
        --primary: #2563eb;
        --primary-soft: #e5efff;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --border: #e5e7eb;
        --bg-input: #f9fafb;
        --radius: 14px;
        --card-radius: 16px;
        --shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
    }

    .page-subtitle {
        color: var(--text-light);
        margin-bottom: 24px;
    }

    .card {
        background: #fff;
        border-radius: var(--card-radius);
        box-shadow: var(--shadow);
        padding: 24px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 16px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .form-control,
    textarea.form-control {
        background: var(--bg-input);
        border-radius: var(--radius);
        padding: 12px 14px;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .15);
    }

    .btn-primary {
        background: var(--primary-soft);
        color: var(--primary);
        border-radius: 12px;
        font-weight: 600;
    }
</style>

<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Thêm Ngày Lịch Trình</h3>
    <p class="page-subtitle">
        Phiên bản tour: <strong><?= htmlspecialchars($data_version['version_name']) ?></strong>
    </p>

    <div class="card mb-4">
        <div class="card-body">

            <form method="post">

                <div class="row g-4">

                    <!-- CỘT TRÁI -->
                    <div class="col-md-6">

                        <!-- Ngày thứ -->
                        <div class="mb-3">
                            <label class="form-label">Ngày thứ</label>
                            <input type="number"
                                name="day_number"
                                class="form-control form-control-lg <?= isset($errors['day_number']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['day_number'] ?? '') ?>">

                            <?php if (isset($errors['day_number'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['day_number'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Địa điểm -->
                        <div class="mb-3">
                            <label class="form-label">Địa điểm</label>
                            <input type="text"
                                name="place"
                                class="form-control <?= isset($errors['place']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['place'] ?? '') ?>">

                            <?php if (isset($errors['place'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['place'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- CỘT PHẢI -->
                    <div class="col-md-6">

                        <!-- Giờ bắt đầu -->
                        <div class="mb-3">
                            <label class="form-label">Giờ bắt đầu</label>
                            <input type="time"
                                name="start_time"
                                class="form-control <?= isset($errors['start_time']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['start_time'] ?? '') ?>">

                            <?php if (isset($errors['start_time'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['start_time'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Giờ kết thúc -->
                        <div class="mb-3">
                            <label class="form-label">Giờ kết thúc</label>
                            <input type="time"
                                name="end_time"
                                class="form-control <?= isset($errors['end_time']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['end_time'] ?? '') ?>">

                            <?php if (isset($errors['end_time'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['end_time'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Hoạt động -->
                <div class="mb-3">
                    <label class="form-label">Hoạt động trong ngày</label>
                    <textarea name="activity"
                        class="form-control <?= isset($errors['activity']) ? 'is-invalid' : '' ?>"
                        rows="5"><?= htmlspecialchars($old['activity'] ?? '') ?></textarea>

                    <?php if (isset($errors['activity'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errors['activity'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- NÚT -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&tab=itinerary&id=<?= $data_version['version_id'] ?>"
                        class="btn btn-secondary me-2">
                        Hủy
                    </a>
                    <button class="btn btn-primary px-4">
                        Thêm ngày
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php unset($_SESSION['errors'], $_SESSION['old']); ?>