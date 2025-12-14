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
        --shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* PAGE TITLE */
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    /* SUBTITLE */
    .page-subtitle {
        color: var(--text-light);
        margin-bottom: 24px;
        font-size: 15px;
    }

    /* CARD */
    .card {
        background: #ffffff;
        border-radius: var(--card-radius);
        border: 1px solid #eef0f3;
        box-shadow: var(--shadow);
        padding: 24px;
    }

    /* SECTION TITLE */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 16px;
    }

    /* LABEL */
    .form-label {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    /* INPUT, SELECT, TEXTAREA */
    .form-control,
    .form-select {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 14px;
        font-size: 15px;
        color: var(--text-dark);
        transition: .2s;
    }

    .form-control:focus,
    .form-select:focus {
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
    }

    /* LARGE INPUT */
    .form-control-lg {
        padding: 14px 16px !important;
        font-size: 16px !important;
    }

    /* BUTTONS */
    .btn-primary {
        background: var(--primary-soft);
        color: var(--primary);
        border: none;
        padding: 12px 26px;
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #d6e6ff;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: var(--text-dark);
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    /* HR */
    hr {
        border: none;
        border-top: 1px solid #eceef2;
        margin: 32px 0;
    }

</style>
<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Sửa Phiên Bản Tour</h3>
    <p class="page-subtitle">Thuộc tour: <strong><?= $data_version['tour_name'] ?></strong></p>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Section 1 -->
            <h5 class="section-title">Thông tin phiên bản</h5>

            <form method="POST">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên phiên bản</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="version_name"
                                   value="<?= $data_version['version_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã phiên bản</label>
                            <input type="text" class="form-control"
                                   name="version_code"
                                   value="<?= $data_version['version_code'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mùa</label>
                            <input type="text" class="form-control"
                                   name="season"
                                   value="<?= $data_version['season'] ?>" required>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá (VND)</label>
                            <input type="number" class="form-control"
                                   name="price"
                                   value="<?= $data_version['price'] ?>" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label fw-semibold">Từ ngày</label>
                                <input type="date" class="form-control"
                                       name="valid_from"
                                       value="<?= $data_version['valid_from'] ?>" required>
                            </div>

                            <div class="col">
                                <label class="form-label fw-semibold">Đến ngày</label>
                                <input type="date" class="form-control"
                                       name="valid_to"
                                       value="<?= $data_version['valid_to'] ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="active" <?= $data_version['status'] == "active" ? 'selected' : '' ?>>
                                    Đang chạy
                                </option>
                                <option value="inactive" <?= $data_version['status'] == "inactive" ? 'selected' : '' ?>>
                                    Ngừng
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Section 2 -->
                <h5 class="section-title">Chính sách áp dụng</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="6"
                              name="policies"><?= $data_version['policies'] ?></textarea>
                </div>

                <!-- Nút -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>" 
                       class="btn btn-secondary btn-lg me-2">
                        Hủy
                    </a>

                    <button class="btn btn-primary btn-lg px-4">
                        Lưu thay đổi
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
