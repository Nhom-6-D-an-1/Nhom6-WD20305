<style>
/* ===============================
   PAGE TITLE – DASHBOARD
=============================== */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 22px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===============================
   CARD – APPLE STYLE
=============================== */
.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

/* ===============================
   SECTION TITLE
=============================== */
.section-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin: 22px 0 14px;
}

/* ===============================
   FORM CONTROL
=============================== */
.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.form-control,
.form-select,
textarea.form-control {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
    font-size: 14px;
}

/* ===============================
   BUTTON
=============================== */
.btn-next {
    background: #d1fae5;
    color: #047857;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    padding: 10px 24px;
}

.btn-next:hover {
    background: #a7f3d0;
}

.btn-back {
    border-radius: 10px;
    font-weight: 600;
}
</style>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div class="page-title mb-0">Booking khách đoàn</div>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture"
           class="btn btn-outline-secondary btn-back">
            ← Quay lại
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="card">

        <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeGit">

            <!-- hidden departure -->
            <input type="hidden" name="departure_id"
                   value="<?= htmlspecialchars($_GET['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <!-- ===============================
                 ĐẠI DIỆN ĐOÀN
            =============================== -->
            <div class="section-title mt-0">Thông tin người đại diện đoàn</div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ tên</label>
                    <input name="full_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gender" class="form-select">
                        <option>Nam</option>
                        <option>Nữ</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input name="phone" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" name="birth_year" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">CCCD</label>
                    <input name="cccd" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Yêu cầu đặc biệt</label>
                <textarea name="special_request"
                          class="form-control"
                          rows="3"></textarea>
            </div>

            <!-- ===============================
                 THANH TOÁN
            =============================== -->
            <div class="section-title">Thanh toán</div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tổng tiền</label>
                    <input type="number"
                           name="total_amount"
                           class="form-control"
                           placeholder="Bỏ trống = lấy giá tour tự động">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="pending">Chưa thanh toán</option>
                        <option value="completed">Đã thanh toán</option>
                    </select>
                </div>
            </div>

            <!-- ACTION -->
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-next">
                    Tiếp tục →
                </button>
            </div>

        </form>

    </div>
</div>
