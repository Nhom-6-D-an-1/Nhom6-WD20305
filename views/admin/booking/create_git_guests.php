<div class="container mt-4">

    <h3>Booking khách đoàn - Thêm khách</h3>
    <p class="text-muted">Booking ID: <?= $_SESSION['git_booking_id'] ?></p>

    <!-- FORM THÊM KHÁCH -->
    <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeGitGuest" onsubmit="return validateBookingForm()"
        class="card p-3 mb-4">

        <h5>Thêm khách</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Họ tên</label>
                <input name="full_name" class="form-control">
                <span class="text-danger small" id="nameError"></span>
            </div>

            <div class="col-md-3 mb-3">
                <label>Giới tính</label>
                <select name="gender" class="form-select">
                    <option>Nam</option>
                    <option>Nữ</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Năm sinh</label>
                <input type="date" name="birth_year" class="form-control">
                <span class="text-danger small" id="birthError"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>SĐT</label>
                <input name="phone" class="form-control">
                <span class="text-danger small" id="phoneError"></span>

            </div>
            <div class="col-md-6 mb-3"><label>CCCD</label>
                <input name="cccd" class="form-control">
                <span class="text-danger small" id="cccdError"></span>
            </div>
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

        <button class="btn btn-primary">Thêm khách</button>
    </form>


    <!-- DANH SÁCH KHÁCH ĐÃ NHẬP -->
    <h5>Danh sách khách đã nhập</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Năm sinh</th>
                <th>SĐT</th>
                <th>CCCD</th>
                <th>Yêu cầu đặc biệt</th>
                <th>Tình trạng y tế</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($guest_list as $index => $g): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($g['full_name']) ?></td>
                    <td><?= $g['gender'] ?></td>
                    <td><?= $g['birth_year'] ?></td>
                    <td><?= $g['phone'] ?></td>
                    <td><?= $g['cccd'] ?></td>
                    <td><?= $g['special_request'] ?: '—' ?></td>
                    <td><?= $g['medical_condition'] ?: '—' ?></td>
                    <td><a href="<?= BASE_URL ?>?mode=admin&action=deleteGitGuest&index=<?= $index ?>"
                            onclick="return confirm('Xóa khách này?')"
                            class="btn btn-sm btn-danger">
                            Xóa
                        </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- NÚT HOÀN TẤT BOOKING ĐOÀN -->
    <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=finishGit">
        <button class="btn btn-success btn-lg mt-3"
            onclick="return confirm('Xác nhận lưu toàn bộ khách vào hệ thống?')">
            Hoàn tất & Lưu toàn bộ khách
        </button>
    </form>

</div>
<script>
function validateBookingForm() {
    const name = document.querySelector('[name="full_name"]');
    const phone = document.querySelector('[name="phone"]');
    const birth = document.querySelector('[name="birth_year"]');
    const cccd = document.querySelector('[name="cccd"]');
    const request = document.querySelector('[name="special_request"]');
    const medical = document.querySelector('[name="medical_condition"]');

    const nameErr = document.getElementById('nameError');
    const phoneErr = document.getElementById('phoneError');
    const birthErr = document.getElementById('birthError');
    const cccdErr = document.getElementById('cccdError');
    const requestErr = document.getElementById('requestError');
    const medicalErr = document.getElementById('medicalError');

    // Reset lỗi
    nameErr.innerHTML =
    phoneErr.innerHTML =
    birthErr.innerHTML =
    cccdErr.innerHTML =
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