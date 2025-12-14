<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold">Sửa Chuyến Đi</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" onsubmit="return validateDepartureForm()">

                <!-- DATE FIELDS -->
                <div class="md-4">
                    <label class="form-label fw-semibold">Tên chuyến đi</label>
                    <input type="text" name="departure_name" class="form-control" value="<?= $data_departure['departure_name'] ?>">
                    <span class="text-danger small" id="departureNameError"></span>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ngày khởi hành</label>
                        <input type="date" name="start_date" class="form-control"
                            value="<?= $data_departure['start_date'] ?>">
                        <span class="text-danger small" id="startDateError"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ngày kết thúc</label>
                        <input type="date" name="end_date" class="form-control"
                            value="<?= $data_departure['end_date'] ?>">
                        <span class="text-danger small" id="endDateError"></span>
                    </div>
                </div>

                <!-- GUESTS + PRICE + TIME -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Số khách tối đa</label>
                        <input type="number" name="max_guests" class="form-control"
                            value="<?= $data_departure['max_guests'] ?>">
                        <span class="text-danger small" id="maxGuestsError"></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Giá bán</label>
                        <input type="number" name="actual_price" class="form-control"
                            value="<?= $data_departure['actual_price'] ?>">
                        <span class="text-danger small" id="priceError"></span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Giờ đón</label>
                        <input type="time" name="pickup_time" class="form-control"
                            value="<?= $data_departure['pickup_time'] ?>">
                        <span class="text-danger small" id="pickupTimeError"></span>
                    </div>
                </div>

                <!-- PICKUP LOCATION -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Địa điểm đón</label>
                    <input type="text" name="pickup_location" class="form-control"
                        value="<?= $data_departure['pickup_location'] ?>">
                    <span class="text-danger small" id="pickupError"></span>
                </div>

                <!-- NOTE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ghi chú</label>
                    <textarea name="note" rows="3" class="form-control"><?= $data_departure['note'] ?></textarea>
                </div>

                <!-- STATUS -->
                <!-- <div class="mb-3">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="open" <?= $data_departure['status'] == 'open' ? 'selected' : '' ?>>Mở bán</option>
                        <option value="full" <?= $data_departure['status'] == 'full' ? 'selected' : '' ?>>Full</option>
                        <option value="closed" <?= $data_departure['status'] == 'closed' ? 'selected' : '' ?>>Đóng</option>
                        <option value="completed" <?= $data_departure['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                    </select>
                </div> -->

                <!-- BUTTONS -->
                <div class="mt-3">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-secondary">
                        Hủy
                    </a>
                    <button class="btn btn-primary ms-2">
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

    // Error elements
    const nameErr = document.getElementById('departureNameError');
    const startErr = document.getElementById('startDateError');
    const endErr = document.getElementById('endDateError');
    const guestErr = document.getElementById('maxGuestsError');
    const priceErr = document.getElementById('priceError');
    const pickupErr = document.getElementById('pickupError');
    const pickupTimeErr = document.getElementById('pickupTimeError');


    // Reset lỗi
    nameErr.innerHTML = startErr.innerHTML = endErr.innerHTML = guestErr.innerHTML = priceErr.innerHTML = "";

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

    return true;
}
</script>