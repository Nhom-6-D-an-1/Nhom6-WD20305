<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold mb-0">Booking khách đoàn</h3>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture"
            class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeGit" onsubmit="return validateBookingForm()">

                <!-- ẨN departure -->
                <input type="hidden" name="departure_id"
                    value="<?= htmlspecialchars($_GET['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                <!-- THÔNG TIN NGƯỜI ĐẠI DIỆN -->
                <h5 class="fw-semibold text-primary mb-3">Thông tin người đại diện đoàn</h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Họ tên</label>
                    <input name="full_name" class="form-control">
                    <span class="text-danger small" id="nameError"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Giới tính</label>
                    <select name="gender" class="form-select">
                        <option>Nam</option>
                        <option>Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input name="phone" class="form-control">
                    <span class="text-danger small" id="phoneError"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Ngày sinh</label>
                    <input type="date" name="birth_year" class="form-control">
                    <span class="text-danger small" id="birthError"></span>
                </div>
                <div class="col-md-6 mb-3"><label>CCCD</label>
                    <input name="cccd" class="form-control">
                    <span class="text-danger small" id="cccdError"></span>
                </div>
                <div class="mb-3">
                    <label>Yêu cầu đặc biệt</label>
                    <textarea name="special_request" class="form-control"></textarea>
                    <span class="text-danger small" id="requestError"></span>
                </div>

                <div class="mb-3">
                    <label>Tình trạng y tế</label>
                    <input name="medical_condition" class="form-control">
                    <span class="text-danger small" id="medicalError"></span>
                </div>
                <h5 class="fw-semibold text-primary mt-4 mb-3">Thanh toán</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tổng tiền</label>
                        <input type="number" class="form-control"
                            name="total_amount"
                            placeholder="Bỏ trống = lấy giá tour tự động">
                        <span class="text-danger small" id="amountError"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="pending">Chưa thanh toán</option>
                            <!-- <option value="deposit">Đã đặt cọc</option> -->
                            <option value="completed">Đã thanh toán</option>
                            <!-- <option value="cancelled">Đã hủy</option> -->
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-4">
                    <button class="btn btn-success px-4">Tiếp tục</button>
                </div>

            </form>

        </div>
    </div>
</div>
<script>
function validateBookingForm() {
    const name = document.querySelector('[name="full_name"]');
    const phone = document.querySelector('[name="phone"]');
    const birth = document.querySelector('[name="birth_year"]');
    const cccd = document.querySelector('[name="cccd"]');
    const amount = document.querySelector('[name="total_amount"]');
    const request = document.querySelector('[name="special_request"]');
    const medical = document.querySelector('[name="medical_condition"]');

    const nameErr = document.getElementById('nameError');
    const phoneErr = document.getElementById('phoneError');
    const birthErr = document.getElementById('birthError');
    const cccdErr = document.getElementById('cccdError');
    const amountErr = document.getElementById('amountError');
    const requestErr = document.getElementById('requestError');
    const medicalErr = document.getElementById('medicalError');

    // Reset lỗi
    nameErr.innerHTML =
    phoneErr.innerHTML =
    birthErr.innerHTML =
    cccdErr.innerHTML =
    amountErr.innerHTML =
    requestErr.innerHTML =
    medicalErr.innerHTML = "";

    /* 1. Họ tên */
    const nameVal = name.value.trim();
    if (nameVal === "") {
        nameErr.innerHTML = "Vui lòng nhập họ tên";
        name.focus();
        return false;
    }
    if (/^\d+$/.test(nameVal)) {
        nameErr.innerHTML = "Họ tên không được chỉ chứa số";
        name.focus();
        return false;
    }

    /* 2. Số điện thoại */
    const phoneVal = phone.value.trim();
    if (phoneVal === "") {
        phoneErr.innerHTML = "Vui lòng nhập số điện thoại";
        phone.focus();
        return false;
    }
    if (!/^0\d{9}$/.test(phoneVal)) {
        phoneErr.innerHTML = "Số điện thoại không hợp lệ (10 số, bắt đầu bằng 0)";
        phone.focus();
        return false;
    }

    /* 3. Ngày sinh */
    if (birth.value === "") {
        birthErr.innerHTML = "Vui lòng chọn ngày sinh";
        birth.focus();
        return false;
    }
    if (birth.value >= new Date().toISOString().split('T')[0]) {
        birthErr.innerHTML = "Ngày sinh không hợp lệ";
        birth.focus();
        return false;
    }

    /* 4. CCCD */
    const cccdVal = cccd.value.trim();
    if (cccdVal === "") {
        cccdErr.innerHTML = "Vui lòng nhập CCCD";
        cccd.focus();
        return false;
    }
    if (!/^\d{12}$/.test(cccdVal)) {
        cccdErr.innerHTML = "CCCD phải gồm đúng 12 số";
        cccd.focus();
        return false;
    }

    /* 5. Tổng tiền (không bắt buộc) */
    if (amount.value !== "" && amount.value <= 0) {
        amountErr.innerHTML = "Tổng tiền phải lớn hơn 0";
        amount.focus();
        return false;
    }

    /* 5. Yêu cầu đặc biệt (không bắt buộc) */
    const requestVal = request.value.trim();
    if (requestVal !== "") {

        // Không cho chỉ toàn số
        if (/^\d+$/.test(requestVal)) {
            requestErr.innerHTML = "Yêu cầu đặc biệt phải có chữ, không được chỉ nhập số";
            request.focus();
            return false;
        }

        // Phải có chữ
        if (!/[a-zA-ZÀ-Ỹà-ỹ]/.test(requestVal)) {
            requestErr.innerHTML = "Yêu cầu đặc biệt không được chỉ chứa ký tự đặc biệt";
            request.focus();
            return false;
        }
    }

    /* 6. Tình trạng y tế (không bắt buộc) */
    const medicalVal = medical.value.trim();
    if (medicalVal !== "") {

        if (/^\d+$/.test(medicalVal)) {
            medicalErr.innerHTML = "Tình trạng y tế phải có chữ, không được chỉ nhập số";
            medical.focus();
            return false;
        }

        if (!/[a-zA-ZÀ-Ỹà-ỹ]/.test(medicalVal)) {
            medicalErr.innerHTML = "Tình trạng y tế không được chỉ chứa ký tự đặc biệt";
            medical.focus();
            return false;
        }
    }

    return true;
}
</script>