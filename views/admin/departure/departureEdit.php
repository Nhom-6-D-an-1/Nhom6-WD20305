<style>
    /* ======================================================
   ROOT VARIABLES
    ====================================================== */
    :root {
        --primary: #2563eb;
        --primary-soft: #e8f0ff;

        --success: #16a34a;
        --success-soft: #dcfce7;

        --warning: #f59e0b;
        --warning-soft: #fff7e1;

        --danger: #dc2626;
        --danger-soft: #fee2e2;

        --gray-dark: #1f2937;
        --gray: #374151;
        --gray-light: #6b7280;
        --gray-soft: #f3f4f6;

        --border: #e5e7eb;
        --radius: 14px;
        --radius-card: 16px;

        --shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* ======================================================
    TYPOGRAPHY
    ====================================================== */
    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--gray-dark);
    }

    .page-subtitle {
        font-size: 15px;
        color: var(--gray-light);
        margin-top: 2px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 16px;
    }

    /* ======================================================
    CARD
    ====================================================== */
    .card {
        background: #fff;
        border-radius: var(--radius-card);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        padding: 24px;
    }

    /* ======================================================
    FORM INPUTS
    ====================================================== */
    .form-control, .form-select {
        background: var(--gray-soft);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 14px;
        font-size: 15px;
        transition: .2s ease;
        color: var(--gray-dark);
    }

    .form-control:focus,
    .form-select:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
    }

    /* Larger inputs */
    .form-control-lg {
        padding: 14px 16px !important;
        font-size: 16px !important;
    }

    textarea.form-control {
        resize: vertical;
    }

    /* ======================================================
    BUTTONS
    ====================================================== */
    .btn {
        font-weight: 600 !important;
        border-radius: 12px !important;
        padding: 10px 22px !important;
    }

    /* Primary */
    .btn-primary {
        background: var(--primary-soft) !important;
        color: var(--primary) !important;
        border: none !important;
    }
    .btn-primary:hover { background: #d6e6ff !important; }

    /* Secondary */
    .btn-secondary {
        background: #f3f4f6 !important;
        color: var(--gray-dark) !important;
        border: none !important;
    }
    .btn-secondary:hover { background: #e5e7eb !important; }

    /* Success */
    .btn-success {
        background: var(--success-soft) !important;
        color: #166534 !important;
        border: none !important;
    }
    .btn-success:hover { background: #bbf7d0 !important; }

    /* Danger */
    .btn-danger {
        background: var(--danger-soft) !important;
        color: #b91c1c !important;
        border: none !important;
    }
    .btn-danger:hover { background: #fecaca !important; }

    /* Mini Action Buttons */
    .btn-mini {
        padding: 8px 18px !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
    }

    /* Variants */
    .btn-mini-blue {
        background: #e8f0ff;
        color: #2563eb;
    }
    .btn-mini-blue:hover { background: #d6e6ff; }

    .btn-mini-yellow {
        background: #fff4d8;
        color: #b97600;
    }
    .btn-mini-yellow:hover { background: #ffe8b5; }

    .btn-mini-green {
        background: #e7f5ff;
        color: var(--primary);
    }
    .btn-mini-green:hover { background: #d8ecff; }

    /* Group */
    .action-group {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    .action-group a { min-width: 95px; }

    /* ======================================================
    NAV TABS
    ====================================================== */
    .nav-tabs {
        border-bottom: 1px solid var(--border) !important;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        color: var(--gray-light);
        padding: 10px 20px;
        border: none !important;
        border-radius: 10px 10px 0 0 !important;
    }

    .nav-tabs .nav-link:hover {
        background: #f3f4f6;
        color: var(--gray-dark);
    }

    .nav-tabs .nav-link.active {
        background: var(--primary-soft) !important;
        color: var(--primary) !important;
        border-bottom: 2px solid var(--primary) !important;
    }

    /* ======================================================
    TABLE
    ====================================================== */
    .table-card {
        background: #fff;
        border-radius: 16px;
        padding: 26px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .table {
        width: 100%;
        border-collapse: collapse !important;
        table-layout: fixed; /* Cố định spacing không lệch */
    }

    /* Header */
    .table thead th {
        background: #f9fafb !important;
        color: var(--gray-light) !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12.5px;
        padding: 14px 10px;
        border-bottom: 1.6px solid var(--border) !important;
        letter-spacing: .4px;
        text-align: center;
    }

    /* Body */
    .table tbody td {
        padding: 16px 12px !important;
        font-size: 15px;
        color: var(--gray-dark);
        border-bottom: 1px solid #f2f3f5;
        vertical-align: middle !important;
    }

    .table tbody tr:hover { background: #f8fafc !important; }

    /* Cột người đặt */
    .customer-cell {
        text-align: left !important;
        line-height: 1.35;
    }
    .customer-name { font-weight: 600; }
    .customer-phone { font-size: 13px; color: var(--gray-light); }

    /* Căn phải cột tiền */
    .table td.money {
        text-align: right !important;
    }

    /* ======================================================
    BADGES
    ====================================================== */
    .badge {
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
    }

    .badge-open {
        background: #e0f2fe;
        color: #0369a1;
    }

    .badge-run {
        background: #dcfce7;
        color: #166534;
    }

    .badge-end {
        background: #e5e7eb;
        color: #374151;
    }

    .badge-full {
        background: #fee2e2;
        color: #b91c1c;
    }

</style>
<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h3 class="page-title mb-1">Sửa Chuyến Đi</h3>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" 
           class="btn btn-secondary">
            Quay lại
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="section-title">Thông tin cơ bản</h5>

            <form method="POST" onsubmit="return validateDepartureForm()">

                <div class="row g-4">

                    <!-- Tên chuyến đi -->
                    <div class="col-12">
                        <label class="form-label">Tên chuyến đi</label>
                        <input type="text" 
                               name="departure_name" 
                               class="form-control form-control-lg"
                               value="<?= htmlspecialchars($data_departure['departure_name']) ?>">
                        <span class="text-danger small" id="departureNameError"></span>
                    </div>

                    <!-- Ngày đi / Ngày về -->
                    <div class="col-md-6">
                        <label class="form-label">Ngày khởi hành</label>
                        <input type="date" 
                               name="start_date" 
                               class="form-control"
                               value="<?= $data_departure['start_date'] ?>">
                        <span class="text-danger small" id="startDateError"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ngày kết thúc</label>
                        <input type="date" 
                               name="end_date" 
                               class="form-control"
                               value="<?= $data_departure['end_date'] ?>">
                        <span class="text-danger small" id="endDateError"></span>
                    </div>

                    <!-- Số khách / Giá bán / Giờ đón -->
                    <div class="col-md-4">
                        <label class="form-label">Số khách tối đa</label>
                        <input type="number" 
                               name="max_guests" 
                               class="form-control"
                               value="<?= $data_departure['max_guests'] ?>">
                        <span class="text-danger small" id="maxGuestsError"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Giá bán</label>
                        <input type="number" 
                               name="actual_price" 
                               class="form-control"
                               value="<?= $data_departure['actual_price'] ?>">
                        <span class="text-danger small" id="priceError"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Giờ đón</label>
                        <input type="time" 
                               name="pickup_time" 
                               class="form-control"
                               value="<?= $data_departure['pickup_time'] ?>">
                        <span class="text-danger small" id="pickupTimeError"></span>
                    </div>

                    <!-- Địa điểm đón -->
                    <div class="col-12">
                        <label class="form-label">Địa điểm đón</label>
                        <input type="text" 
                               name="pickup_location" 
                               class="form-control"
                               value="<?= $data_departure['pickup_location'] ?>">
                        <span class="text-danger small" id="pickupError"></span>
                    </div>

                    <!-- Ghi chú -->
                    <div class="col-12">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="note" 
                                  rows="4" 
                                  class="form-control"><?= htmlspecialchars($data_departure['note']) ?></textarea>
                        <span class="text-danger small" id="noteError"></span>
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" 
                       class="btn btn-secondary me-2">
                        Hủy
                    </a>

                    <button class="btn btn-primary px-4">
                        Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<script>
function validateDepartureForm() {
    const name = document.querySelector('[name="departure_name"]');
    const startDate = document.querySelector('[name="start_date"]');
    const endDate = document.querySelector('[name="end_date"]');
    const maxGuests = document.querySelector('[name="max_guests"]');
    const price = document.querySelector('[name="actual_price"]');
    const pickup = document.querySelector('[name="pickup_location"]');
    const pickupTime = document.querySelector('[name="pickup_time"]');
    const note = document.querySelector('[name="note"]');

    // Error elements
    const nameErr = document.getElementById('departureNameError');
    const startErr = document.getElementById('startDateError');
    const endErr = document.getElementById('endDateError');
    const guestErr = document.getElementById('maxGuestsError');
    const priceErr = document.getElementById('priceError');
    const pickupErr = document.getElementById('pickupError');
    const pickupTimeErr = document.getElementById('pickupTimeError');
    const noteErr = document.getElementById('noteError');


    // Reset lỗi
    nameErr.innerHTML = startErr.innerHTML = endErr.innerHTML = guestErr.innerHTML = priceErr.innerHTML = noteErr.innerHTML = "";

    /* 1. Tên chuyến đi */
    const nameVal = name.value.trim();
    if (nameVal === "") {
        nameErr.innerHTML = "Vui lòng nhập tên chuyến đi";
        name.focus();
        return false;
    }
    if (/^\d+$/.test(nameVal)) {
        nameErr.innerHTML = "Tên chuyến đi không được chỉ chứa số";
        name.focus();
        return false;
    }

    /* 2. Ngày khởi hành */
    if (startDate.value === "") {
        startErr.innerHTML = "Vui lòng chọn ngày khởi hành";
        startDate.focus();
        return false;
    }

    /* 3. Ngày kết thúc */
    if (endDate.value === "") {
        endErr.innerHTML = "Vui lòng chọn ngày kết thúc";
        endDate.focus();
        return false;
    }
    if (endDate.value < startDate.value) {
        endErr.innerHTML = "Ngày kết thúc phải sau ngày khởi hành";
        endDate.focus();
        return false;
    }

    /* 4. Số khách */
    if (maxGuests.value === "" || maxGuests.value <= 0) {
        guestErr.innerHTML = "Số khách phải lớn hơn 0";
        maxGuests.focus();
        return false;
    }

    /* 5. Giá bán */
    if (price.value === "" || price.value <= 0) {
        priceErr.innerHTML = "Giá bán phải lớn hơn 0";
        price.focus();
        return false;
    }
    
    /* 6. Điểm đón (không bắt buộc nhưng nếu nhập thì phải hợp lệ) */
    const pickupVal = pickup.value.trim();
    if (pickupVal !== "") {

        // Không cho chỉ toàn số
        if (/^\d+$/.test(pickupVal)) {
            pickupErr.innerHTML = "Điểm đón không được chỉ chứa số";
            pickup.focus();
            return false;
        }

        // Phải có chữ
        if (!/[a-zA-ZÀ-Ỹà-ỹ]/.test(pickupVal)) {
            pickupErr.innerHTML = "Điểm đón phải có chữ, không được toàn ký tự đặc biệt";
            pickup.focus();
            return false;
        }

        // Độ dài tối thiểu
        if (pickupVal.length < 5) {
            pickupErr.innerHTML = "Điểm đón quá ngắn, vui lòng nhập rõ hơn";
            pickup.focus();
            return false;
        }
    }

    /* 7. Giờ đón <=> Điểm đón */
    if (pickupVal !== "" && pickupTime.value === "") {
        pickupTimeErr.innerHTML = "Vui lòng chọn giờ đón";
        pickupTime.focus();
        return false;
    }

    if (pickupTime.value !== "" && pickupVal === "") {
        pickupErr.innerHTML = "Vui lòng nhập điểm đón khi có giờ đón";
        pickup.focus();
        return false;
    }
    
    /* 8. Ghi chú (không bắt buộc, nhưng nếu nhập thì phải hợp lệ) */
    const noteVal = note.value.trim();
    if (noteVal !== "") {

        // Không cho chỉ toàn số
        if (/^\d+$/.test(noteVal)) {
            noteErr.innerHTML = "Ghi chú không được chỉ chứa số";
            note.focus();
            return false;
        }

        // Phải có chữ
        if (!/[a-zA-ZÀ-Ỹà-ỹ]/.test(noteVal)) {
            noteErr.innerHTML = "Ghi chú phải có chữ, không được toàn ký tự đặc biệt";
            note.focus();
            return false;
        }

        // Giới hạn độ dài (tránh nhập linh tinh)
        if (noteVal.length < 5) {
            noteErr.innerHTML = "Ghi chú quá ngắn, vui lòng nhập rõ hơn";
            note.focus();
            return false;
        }

        if (noteVal.length > 500) {
            noteErr.innerHTML = "Ghi chú không được vượt quá 500 ký tự";
            note.focus();
            return false;
        }
    }

    return true;
}
</script>
