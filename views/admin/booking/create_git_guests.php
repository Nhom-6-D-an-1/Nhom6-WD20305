<div class="container mt-4">

    <h3>Booking khách đoàn - Thêm khách</h3>
    <p class="text-muted">Booking ID: <?= $_SESSION['git_booking_id'] ?></p>

    <!-- FORM THÊM KHÁCH -->
    <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeGitGuest"
        class="card p-3 mb-4">

        <h5>Thêm khách</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Họ tên</label>
                <input name="full_name" class="form-control" required>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>SĐT</label>
                <input name="phone" class="form-control">

            </div>
            <div class="col-md-6 mb-3"><label>CCCD</label>
                <input name="cccd" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Yêu cầu đặc biệt</label>
            <textarea name="special_request" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Tình trạng y tế</label>
            <input name="medical_condition" class="form-control">
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