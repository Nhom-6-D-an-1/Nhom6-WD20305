<style>
   /* PAGE TITLE */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

   /* CARD – APPLE STYLE */
.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

   /* SECTION TITLE */
.section-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin: 18px 0 14px;
}

   /* FORM */
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

   /* TABLE */
.table thead th {
    background: transparent !important;
    color: #6b7280;
    font-size: 12px;
    text-transform: uppercase;
    border-bottom: 1px solid #e5e7eb !important;
    text-align: center;
}

.table tbody td {
    font-size: 14px;
    vertical-align: middle;
}

.table tbody td:nth-child(1),
.table tbody td:nth-child(3),
.table tbody td:nth-child(4),
.table tbody td:nth-child(5),
.table tbody td:nth-child(6),
.table tbody td:nth-child(9) {
    text-align: center;
}

   /* BUTTON */
.btn-add {
    background: #dbeafe;
    color: #1e40af;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    padding: 10px 20px;
}

.btn-add:hover {
    background: #bfdbfe;
}

.btn-finish {
    background: #d1fae5;
    color: #047857;
    border-radius: 12px;
    font-weight: 700;
    padding: 12px 26px;
}

.btn-danger {
    border-radius: 8px;
    font-weight: 600;
}
</style>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="page-title">Booking khách đoàn – Thêm khách</div>
    <p class="text-muted mb-4">
        Booking ID: <strong><?= $_SESSION['git_booking_id'] ?></strong>
    </p>

         <!-- FORM THÊM KHÁCH -->
    <div class="card mb-4">

        <form method="POST"
              action="<?= BASE_URL ?>?mode=admin&action=storeGitGuest">

            <div class="section-title mt-0">Thêm khách</div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ tên</label>
                    <input name="full_name" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gender" class="form-select">
                        <option>Nam</option>
                        <option>Nữ</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Năm sinh</label>
                    <input type="date" name="birth_year" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input name="phone" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">CCCD</label>
                    <input name="cccd" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Yêu cầu đặc biệt</label>
                <textarea name="special_request" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tình trạng y tế</label>
                <input name="medical_condition" class="form-control">
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-add">
                    + Thêm khách
                </button>
            </div>

        </form>
    </div>

         <!-- DANH SÁCH KHÁCH -->
    <div class="card mb-4">

        <div class="section-title mt-0">Danh sách khách đã nhập</div>

        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Năm sinh</th>
                    <th>SĐT</th>
                    <th>CCCD</th>
                    <th>Yêu cầu</th>
                    <th>Y tế</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($guest_list)): ?>
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
                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=deleteGitGuest&index=<?= $index ?>"
                                   onclick="return confirm('Xóa khách này?')"
                                   class="btn btn-sm btn-danger">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Chưa có khách nào được thêm
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <!-- ===============================
         FINISH BOOKING
    =============================== -->
    <form method="POST"
          action="<?= BASE_URL ?>?mode=admin&action=finishGit"
          class="text-end">

        <button class="btn btn-finish"
                onclick="return confirm('Xác nhận lưu toàn bộ khách vào hệ thống?')">
            ✓ Hoàn tất & Lưu toàn bộ khách
        </button>
    </form>

</div>
