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
        margin-bottom: 6px;
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
        transition: 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        outline: none;
    }

    /* Large input */
    .form-control-lg {
        padding: 14px 16px !important;
        font-size: 16px !important;
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
    }

    /* ===========================
    GRID FIX
    =========================== */
    .g-4 > [class*="col-"] {
        margin-bottom: 12px;
    }

    /* Row of two inputs (date/time fields) */
    .d-flex.gap-3 .form-control {
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
        transition: 0.2s;
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

    /* Success button (nếu cần) */
    .btn-success {
        background: #e6f9e8;
        color: #059669;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-success:hover {
        background: #d1f2d4;
    }

    /* ===========================
    HR
    =========================== */
    hr {
        border: none;
        border-top: 1px solid #eceef2;
        margin: 32px 0;
    }

</style>
<div class="container-fluid px-4">

    <!-- PAGE TITLE -->
    <h3 class="page-title mt-4">Thêm Ngày Lịch Trình</h3>
    <p class="page-subtitle">
        Phiên bản tour: <strong><?= $data_version['version_name'] ?></strong>
    </p>

    <div class="card mb-4">
        <div class="card-body">

            <!-- SECTION TITLE -->
            <h5 class="section-title">Thông tin ngày lịch trình</h5>

            <form method="POST">

                <div class="row g-4">

                    <!-- Left Column -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Ngày thứ</label>
                            <input type="number" name="day_number" 
                                   class="form-control form-control-lg"
                                   placeholder="VD: 1, 2, 3..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa điểm</label>
                            <input type="text" name="place" 
                                   class="form-control"
                                   placeholder="Nhập địa điểm..." required>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Giờ bắt đầu</label>
                            <input type="time" name="start_time" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giờ kết thúc</label>
                            <input type="time" name="end_time" 
                                   class="form-control" required>
                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <!-- Activities -->
                <h5 class="section-title">Hoạt động trong ngày</h5>

                <div class="mb-3">
                    <textarea name="activity" 
                              class="form-control" 
                              rows="5"
                              placeholder="Nhập nội dung hoạt động..." required></textarea>
                </div>

                <!-- Buttons -->
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

