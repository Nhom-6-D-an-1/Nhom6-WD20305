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

            <form method="POST" onsubmit="return validateDepartureForm()">

                <div class="row g-4">

                    <div class="col-12">
                        <label class="form-label">Tên chuyến đi</label>
                        <input type="text" name="departure_name" class="form-control form-control-lg">
                        <span class="text-danger small" id="departureNameError"></span>
                    </div>

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Ngày khởi hành</label>
                            <input type="date" name="start_date" class="form-control">
                            <span class="text-danger small" id="startDateError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số khách tối đa</label>
                            <input type="number" name="max_guests" class="form-control">
                            <span class="text-danger small" id="maxGuestsError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Điểm đón</label>
                            <input type="text" name="pickup_location" class="form-control"
                                   placeholder="VD: 123 Trần Duy Hưng, Hà Nội">
                            <span class="text-danger small" id="pickupError"></span>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control">
                            <span class="text-danger small" id="endDateError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giá bán</label>
                            <input type="number" name="actual_price" class="form-control">
                            <span class="text-danger small" id="priceError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giờ đón</label>
                            <input type="time" name="pickup_time" class="form-control">
                            <span class="text-danger small" id="pickupTimeError"></span>
                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <h5 class="section-title">Ghi chú</h5>

                <div class="mb-3">
                    <textarea name="note" rows="4" class="form-control"
                              placeholder="Thông tin bổ sung..."></textarea>
                    <span class="text-danger small" id="noteError"></span>
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

    /* 8. Ghi chú – không bắt buộc, nhưng nếu nhập thì phải hợp lệ */
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
            noteErr.innerHTML = "Ghi chú phải có chữ, không được nhập linh tinh";
            note.focus();
            return false;
        }
    }

    return true;
}
</script>
