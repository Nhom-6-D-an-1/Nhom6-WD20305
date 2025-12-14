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

    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        background: var(--bg-input);
        border-radius: var(--radius);
        padding: 12px 14px;
    }

    .form-control:focus,
    .form-select:focus {
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

    <h3 class="page-title mt-4">Sửa Phiên Bản Tour</h3>
    <p class="page-subtitle">
        Thuộc tour: <strong><?= htmlspecialchars($data_version['tour_name']) ?></strong>
    </p>

    <div class="card mb-4">
        <div class="card-body">

            <form method="post">

                <div class="row g-4">

                    <!-- CỘT TRÁI -->
                    <div class="col-md-6">

                        <!-- Tên phiên bản -->
                        <div class="mb-3">
                            <label class="form-label">Tên phiên bản</label>
                            <input type="text"
                                name="version_name"
                                class="form-control form-control-lg <?= isset($errors['version_name']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['version_name'] ?? $data_version['version_name']) ?>">

                            <?php if (isset($errors['version_name'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['version_name'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Mã phiên bản -->
                        <div class="mb-3">
                            <label class="form-label">Mã phiên bản</label>
                            <input type="text"
                                name="version_code"
                                class="form-control <?= isset($errors['version_code']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['version_code'] ?? $data_version['version_code']) ?>">

                            <?php if (isset($errors['version_code'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['version_code'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Mùa -->
                        <div class="mb-3">
                            <label class="form-label">Mùa</label>
                            <input type="text"
                                name="season"
                                class="form-control <?= isset($errors['season']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['season'] ?? $data_version['season']) ?>">

                            <?php if (isset($errors['season'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['season'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- CỘT PHẢI -->
                    <div class="col-md-6">

                        <!-- Giá -->
                        <div class="mb-3">
                            <label class="form-label">Giá (VND)</label>
                            <input type="number"
                                name="price"
                                class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['price'] ?? $data_version['price']) ?>">

                            <?php if (isset($errors['price'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['price'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Ngày -->
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Từ ngày</label>
                                <input type="date"
                                    name="valid_from"
                                    class="form-control <?= isset($errors['valid_from']) ? 'is-invalid' : '' ?>"
                                    value="<?= htmlspecialchars($old['valid_from'] ?? $data_version['valid_from']) ?>">
                            </div>

                            <div class="col">
                                <label class="form-label">Đến ngày</label>
                                <input type="date"
                                    name="valid_to"
                                    class="form-control <?= isset($errors['valid_to']) ? 'is-invalid' : '' ?>"
                                    value="<?= htmlspecialchars($old['valid_to'] ?? $data_version['valid_to']) ?>">
                            </div>

                            <?php if (isset($errors['valid_from'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['valid_from'] ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($errors['valid_to'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['valid_to'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status"
                                class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>">
                                <option value="active"
                                    <?= (($old['status'] ?? $data_version['status']) === 'active') ? 'selected' : '' ?>>
                                    Đang chạy
                                </option>
                                <option value="inactive"
                                    <?= (($old['status'] ?? $data_version['status']) === 'inactive') ? 'selected' : '' ?>>
                                    Ngừng
                                </option>
                            </select>

                            <?php if (isset($errors['status'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['status'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Chính sách -->
                <div class="mb-3">
                    <label class="form-label">Chính sách áp dụng</label>
                    <textarea name="policies"
                        class="form-control"
                        rows="6"><?= htmlspecialchars($old['policies'] ?? $data_version['policies']) ?></textarea>
                </div>

                <!-- NÚT -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>"
                        class="btn btn-secondary me-2">
                        Hủy
                    </a>
                    <button class="btn btn-primary px-4">
                        Lưu thay đổi
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php unset($_SESSION['errors'], $_SESSION['old']); ?>