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
        margin-bottom: 8px;
    }

    /* Subtitle */
    .page-subtitle {
        color: var(--text-light);
        margin-bottom: 24px;
        font-size: 15px;
    }

    /* ===========================
    CARD
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
        font-size: 15px;
        font-weight: 600;
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
        transition: .2s;
    }

    .form-control:focus,
    .form-select:focus {
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
    }

    /* Input lớn */
    .form-control-lg {
        padding: 14px 16px !important;
        font-size: 16px !important;
    }

    /* Ngày */
    .gap-3 > .form-control {
        flex: 1;
    }

    /* ===========================
    BUTTONS
    =========================== */
    .btn-primary {
        background: var(--primary-soft);
        color: var(--primary);
        border: none;
        padding: 12px 26px;
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
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    /* ===========================
    HR
    =========================== */
    hr {
        border: none;
        border-top: 1px solid #eceef2;
        margin: 32px 0;
    }

    /* ===========================
    GRID FIX
    =========================== */
    .g-4 > [class*="col-"] {
        margin-bottom: 12px;
    }

</style>

<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Tạo Phiên Bản Tour</h3>
    <p class="page-subtitle">Thuộc tour: <strong><?= $data['tour_name'] ?></strong></p>


    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Tiêu đề nhỏ -->
            <h5 class="fw-semibold text-primary mb-3">Thông tin phiên bản</h5>

            <form method="post">

                <input type="hidden" name="tour_id" value="<?= $data['tour_id'] ?>">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên phiên bản</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="version_name" placeholder="VD: V1.2 - Hè 2025">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã phiên bản</label>
                            <input type="text" class="form-control"
                                   name="version_code" placeholder="VD: HG-001-V12">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mùa</label>
                            <input type="text" class="form-control" name="season" placeholder="Xuân / Hè / Thu / Đông">
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá (VND)</label>
                            <input type="number" class="form-control" name="price" placeholder="Nhập giá...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày áp dụng</label>
                            <div class="d-flex gap-3">
                                <input type="date" class="form-control" name="valid_from">
                                <input type="date" class="form-control" name="valid_to">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Phần chính sách -->
                <h5 class="fw-semibold text-primary mb-3">Chính sách áp dụng</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="5" name="policies"
                              placeholder="Nhập chính sách cho phiên bản tour..."></textarea>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&tab=versions&id=<?= $data['tour_id'] ?>" 
                       class="btn btn-secondary btn-lg me-2">
                        Quay lại
                    </a>

                    <button class="btn btn-primary btn-lg px-4">
                        Tạo phiên bản
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
