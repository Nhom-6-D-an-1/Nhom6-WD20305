<?php
// Lấy lỗi & dữ liệu cũ từ session
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
?>

<style>
    :root {
        --primary: #2563eb;
        --primary-soft: #e5efff;
        --text-dark: #1f2937;
        --border: #e5e7eb;
        --bg-input: #f9fafb;
        --radius: 14px;
        --card-radius: 16px;
        --shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 24px;
    }

    .card {
        background: #fff;
        border-radius: var(--card-radius);
        border: 1px solid #eef0f3;
        box-shadow: var(--shadow);
        padding: 24px;
    }

    .form-label {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        background: var(--bg-input);
        border-radius: var(--radius);
        padding: 12px 14px;
        font-size: 15px;
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

    .btn-primary:hover {
        background: #d6e6ff;
    }
</style>

<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Tạo Tour Mới</h3>

    <div class="card mb-4">
        <div class="card-body">

            <form method="post">

                <div class="row g-4">

                    <!-- CỘT TRÁI -->
                    <div class="col-md-6">

                        <!-- Tên tour -->
                        <div class="mb-3">
                            <label class="form-label">Tên Tour</label>
                            <input type="text"
                                name="tour_name"
                                class="form-control <?= isset($errors['tour_name']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['tour_name'] ?? '') ?>">

                            <?php if (isset($errors['tour_name'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['tour_name'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Mã tour -->
                        <div class="mb-3">
                            <label class="form-label">Mã Tour</label>
                            <input type="text"
                                name="tour_code"
                                class="form-control <?= isset($errors['tour_code']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['tour_code'] ?? '') ?>">

                            <?php if (isset($errors['tour_code'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['tour_code'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label class="form-label">Danh mục Tour</label>
                            <select name="category_id"
                                class="form-select <?= isset($errors['category_id']) ? 'is-invalid' : '' ?>">
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($data_category as $value): ?>
                                    <option value="<?= $value['category_id'] ?>"
                                        <?= (($old['category_id'] ?? '') == $value['category_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($value['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <?php if (isset($errors['category_id'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['category_id'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- CỘT PHẢI -->
                    <div class="col-md-6">

                        <!-- Thời lượng -->
                        <div class="mb-3">
                            <label class="form-label">Thời lượng (ngày)</label>
                            <input type="number"
                                name="duration_days"
                                class="form-control <?= isset($errors['duration_days']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['duration_days'] ?? '') ?>">

                            <?php if (isset($errors['duration_days'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['duration_days'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Mô tả ngắn -->
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea name="short_description"
                                class="form-control"
                                rows="3"><?= htmlspecialchars($old['short_description'] ?? '') ?></textarea>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Mô tả chi tiết -->
                <div class="mb-3">
                    <label class="form-label">Chi tiết Tour</label>
                    <textarea name="description"
                        class="form-control"
                        rows="6"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                </div>

                <!-- NÚT -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewstour"
                        class="btn btn-secondary me-2">
                        Quay lại
                    </a>
                    <button class="btn btn-primary px-4">
                        Lưu Tour
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php
// Xóa session sau khi render
unset($_SESSION['errors'], $_SESSION['old']);
?>