<style>
    /* ===========================
    GLOBAL VARIABLES
    =========================== */
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

    /* ===========================
    PAGE TITLE
    =========================== */
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 24px;
    }

    /* ===========================
    CARD WRAPPER
    =========================== */
    .card {
        background: #ffffff;
        border-radius: var(--card-radius);
        border: 1px solid #eef0f3;
        box-shadow: var(--shadow);
        padding: 24px;
    }

    /* ===========================
    SECTION TITLE
    =========================== */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 16px;
    }

    /* ===========================
    FORM LABEL
    =========================== */
    .form-label {
        font-weight: 600;
        font-size: 15px;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    /* ===========================
    INPUT / SELECT / TEXTAREA
    =========================== */
    .form-control,
    .form-select {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 14px;
        font-size: 15px;
        color: var(--text-dark);
        transition: .2s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
    }

    /* ===========================
    BUTTONS
    =========================== */
    .btn-primary {
        background: var(--primary-soft);
        color: var(--primary);
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        transition: .2s ease;
    }

    .btn-primary:hover {
        background: #d6e6ff;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: var(--text-dark);
        padding: 12px 22px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    /* ===========================
    HR LINE
    =========================== */
    hr {
        border: none;
        border-top: 1px solid #eceef2;
        margin: 32px 0;
    }

    /* ===========================
    GRID SPACING FIX
    =========================== */
    .g-4 > [class*="col-"] {
        margin-bottom: 16px;
    }

</style>
<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Tạo Tour Mới</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Tiêu đề nhỏ -->
            <h5 class="fw-semibold mb-3 text-primary">Thông tin cơ bản</h5>

            <form method="post" class="mt-2">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên Tour</label>
                            <input type="text" class="form-control form-control-lg" 
                                   name="tour_name" placeholder="Nhập tên tour...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã Tour</label>
                            <input type="text" class="form-control" 
                                   name="tour_code" placeholder="Ví dụ: HG-001">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục Tour</label>
                            <select class="form-select" name="category_id">
                                <?php foreach ($data_category as $value): ?>
                                    <option value="<?= $value['category_id'] ?>">
                                        <?= htmlspecialchars($value['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thời lượng (ngày)</label>
                            <input type="number" class="form-control" 
                                   name="duration_days" placeholder="Ví dụ: 3">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả ngắn</label>
                            <textarea class="form-control" rows="3"
                                      name="short_description"
                                      placeholder="Nhập mô tả ngắn..."></textarea>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Mô tả chi tiết -->
                <h5 class="fw-semibold mb-3 text-primary">Chi tiết Tour</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="6" 
                              name="description" placeholder="Nhập nội dung chi tiết tour..."></textarea>
                </div>


                <!-- Nút hành động -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" 
                       class="btn btn-secondary btn-lg me-2">
                        Quay lại
                    </a>

                    <button class="btn btn-primary btn-lg px-4">
                        Lưu Tour
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
