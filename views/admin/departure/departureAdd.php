<style>
    /* ======================================================
   GLOBAL FORM STYLE — Premium Admin
    ====================================================== */

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }

    .page-sub {
        color: #6b7280;
        font-size: 15px;
        margin-bottom: 20px;
    }

    /* Card */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        padding: 24px;
    }

    /* Section title */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 16px;
    }

    /* Form label */
    .form-label {
        font-weight: 600;
        font-size: 15px;
        color: #374151;
    }

    /* Input */
    .form-control, .form-select {
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 12px 14px;
        font-size: 15px;
        color: #1f2937;
        transition: .2s;
    }

    .form-control:focus, .form-select:focus {
        background: #fff;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
    }

    /* Large input */
    .form-control-lg {
        padding: 14px 16px !important;
        font-size: 16px !important;
    }

    /* Buttons */
    .btn-secondary {
        background: #f3f4f6 !important;
        color: #1f2937 !important;
        border-radius: 12px !important;
        padding: 10px 20px !important;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background: #e5e7eb !important;
    }

    .btn-success {
        background: #dcfce7 !important;
        color: #166534 !important;
        border-radius: 12px !important;
        padding: 10px 28px !important;
        font-weight: 600;
    }

    .btn-success:hover {
        background: #bbf7d0 !important;
    }

    /* Fix Bootstrap gap */
    .g-4 > [class*="col"] {
        margin-bottom: 10px;
    }

</style>

<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Thêm Chuyến Đi</h3>
    <p class="page-sub">Phiên bản tour: <strong><?= $data_version['version_name'] ?></strong></p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="section-title">Thông tin chuyến đi</h5>

            <form method="POST">

                <div class="row g-4">

                    <div class="col-12">
                        <label class="form-label">Tên chuyến đi</label>
                        <input type="text" name="departure_name" class="form-control form-control-lg" required>
                    </div>

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Ngày khởi hành</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số khách tối đa</label>
                            <input type="number" name="max_guests" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Điểm đón</label>
                            <input type="text" name="pickup_location" class="form-control"
                                   placeholder="VD: 123 Trần Duy Hưng, Hà Nội">
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giá bán</label>
                            <input type="number" name="actual_price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giờ đón</label>
                            <input type="time" name="pickup_time" class="form-control">
                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <h5 class="section-title">Ghi chú</h5>

                <div class="mb-3">
                    <textarea name="note" rows="4" class="form-control"
                              placeholder="Thông tin bổ sung..."></textarea>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>&tab=info"
                       class="btn btn-secondary me-2">Hủy</a>

                    <button class="btn btn-success">Lưu chuyến đi</button>
                </div>

            </form>

        </div>
    </div>

</div>
