<style>
    /* ======================================================
   ADMIN PREMIUM UI — FULL GLOBAL CSS
   ====================================================== */

    /* ROOT VARIABLES */
    :root {
        --primary: #2563eb;
        --primary-soft: #e8f0ff;

        --success: #22c55e;
        --success-soft: #dcfce7;

        --warning: #fbbf24;
        --warning-soft: #fef3c7;

        --danger: #ef4444;
        --danger-soft: #fee2e2;

        --gray-dark: #1f2937;
        --gray: #374151;
        --gray-light: #6b7280;
        --gray-soft: #f3f4f6;

        --border: #e5e7eb;
        --radius: 14px;
        --radius-card: 16px;

        --shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
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
        padding: 22px;
    }

    /* ======================================================
   BUTTONS (UNIFORM)
   ====================================================== */

    .btn {
        font-weight: 600 !important;
        border-radius: 12px !important;
        padding: 10px 20px !important;
    }

    /* Primary */
    .btn-primary {
        background: var(--primary-soft) !important;
        border: none !important;
        color: var(--primary) !important;
    }

    .btn-primary:hover {
        background: #d6e6ff !important;
    }

    /* Secondary */
    .btn-secondary {
        background: #f3f4f6 !important;
        color: var(--gray-dark) !important;
        border: none !important;
    }

    .btn-secondary:hover {
        background: #e5e7eb !important;
    }

    /* Success */
    .btn-success {
        background: var(--success-soft) !important;
        color: #166534 !important;
        border: none !important;
    }

    .btn-success:hover {
        background: #bbf7d0 !important;
    }

    /* Danger */
    .btn-danger {
        background: var(--danger-soft) !important;
        color: #b91c1c !important;
        border: none !important;
    }

    .btn-danger:hover {
        background: #fecaca !important;
    }

    /* Tiny square minimal buttons (Chi tiết / Sửa / Booking) */
    .action-btn {
        padding: 8px 18px !important;
        border-radius: 12px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        display: inline-block;
    }

    /* Pastel blue */
    .btn-mini-blue {
        background: #e8f0ff;
        color: #2563eb;
    }

    .btn-mini-blue:hover {
        background: #d6e6ff;
    }

    /* Pastel yellow */
    .btn-mini-yellow {
        background: #fff4d8;
        color: #b97600;
    }

    .btn-mini-yellow:hover {
        background: #ffe8b5;
    }

    /* Pastel booking */
    .btn-mini-green {
        background: #e7f5ff;
        color: var(--primary);
    }

    .btn-mini-green:hover {
        background: #d8ecff;
    }

    /* ======================================================
   TABLES — NOTION / APPLE STYLE
   ====================================================== */

    .table-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .table {
        width: 100%;
        border-collapse: collapse !important;
    }

    .table thead th {
        background: #f9fafb !important;
        color: var(--gray-light) !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        padding: 14px 10px;
        border-bottom: 1.6px solid var(--border) !important;
        letter-spacing: .4px;
        text-align: left;
    }

    .table tbody td {
        padding: 14px 12px !important;
        font-size: 15px;
        color: var(--gray-dark);
        border-bottom: 1px solid #f2f3f5;
    }

    .table tbody tr:hover {
        background: #f8fafc !important;
    }

    /* Căn trái cột 2 */
    .table td:nth-child(2) {
        text-align: left !important;
    }

    /* Default center alignment */
    .table td {
        text-align: left;
    }

    /* Remove Bootstrap borders */
    .table-bordered> :not(caption)>*>* {
        border-width: 0 !important;
    }

    /* ======================================================
   BADGES — PASTEL STATUS
   ====================================================== */

    .badge {
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
    }

    /* OPEN */
    .badge-open {
        background: #e0f2fe;
        color: #0369a1;
    }

    /* RUNNING */
    .badge-run {
        background: #dcfce7;
        color: #166534;
    }

    /* COMPLETED */
    .badge-end {
        background: #e5e7eb;
        color: #374151;
    }

    /* FULL */
    .badge-full {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* ======================================================
   TABS STYLE
   ====================================================== */

    .nav-tabs {
        border-bottom: 1px solid var(--border) !important;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        color: var(--gray-light);
        padding: 10px 22px;
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
   FORM INPUT
   ====================================================== */

    .form-control,
    .form-select {
        background: #f9fafb;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 14px;
        font-size: 15px;
        transition: .2s;
    }

    .form-control:focus,
    .form-select:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .15);
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
    }

    /* ======================================================
   ACTION BUTTON GROUP (Chi tiết – Sửa – Booking)
   ====================================================== */

    .action-group {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .action-group a {
        min-width: 95px;
        text-align: center;
    }

    /* ======================================================
   TABLE RESPONSIVE
   ====================================================== */

    @media (max-width: 768px) {
        .table-card {
            padding: 12px;
        }

        .table thead {
            display: none;
        }

        .table tbody tr {
            display: block;
            margin-bottom: 14px;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #eee;
            background: #fff;
        }
    }

    /* Căn chuẩn cho ô người đặt */
    .customer-cell {
        text-align: left !important;
        line-height: 1.35;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }

    /* Tên */
    .customer-name {
        font-weight: 600;
        color: var(--gray-dark);
    }

    /* SĐT */
    .customer-phone {
        font-size: 13px;
        color: var(--gray-light);
        margin-top: 3px;
    }

    /* Fix toàn bảng không lệch hàng */
    .table td {
        vertical-align: middle !important;
    }

    /* =========================
   FIX BOOKING TABLE ALIGN
    ========================= */

    .booking-table {
        table-layout: fixed;
        width: 100%;
    }

    .booking-table th,
    .booking-table td {
        vertical-align: middle !important;
        white-space: nowrap;
    }

    /* Cột # */
    .booking-table th:nth-child(1),
    .booking-table td:nth-child(1) {
        width: 60px;
        text-align: center;
    }

    /* Người đặt */
    .booking-table th:nth-child(2),
    .booking-table td:nth-child(2) {
        width: 240px;
        text-align: left;
        white-space: normal;
    }

    /* Số khách */
    .booking-table th:nth-child(3),
    .booking-table td:nth-child(3) {
        width: 120px;
        text-align: center;
    }

    /* Trạng thái */
    .booking-table th:nth-child(4),
    .booking-table td:nth-child(4) {
        width: 150px;
        text-align: center;
    }

    /* Thanh toán */
    .booking-table th:nth-child(5),
    .booking-table td:nth-child(5) {
        width: 180px;
        text-align: right;
    }

    /* =========================
   BOOKING STATUS & PAYMENT
    ========================= */

    /* Trạng thái */
    .booking-table td:nth-child(4) {
        text-align: center;
    }

    .booking-table .badge {
        min-width: 110px;
        padding: 7px 14px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 999px;
        display: inline-block;
    }

    /* Map màu trạng thái booking */
    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .badge-info {
        background: #e0f2fe;
        color: #075985;
    }

    .badge-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .badge-danger {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* Thanh toán */
    .booking-table td:nth-child(5) {
        text-align: right;
        font-weight: 700;
        color: #1f2937;
        letter-spacing: .3px;
    }

</style>

<?php
$tab = $_GET['tab'] ?? 'info';
?>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h3 class="fw-bold mb-1 page-title">Chi tiết chuyến đi</h3>
            <p class="page-subtitle">
                <?= htmlspecialchars($data_departure['tour_name']) ?> →
                <?= htmlspecialchars($data_departure['version_name']) ?>
            </p>
        </div>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-secondary px-4">
            Quay lại
        </a>
    </div>

    <!-- CARD -->
    <div class="card mb-4">
        <div class="card-body">

            <!-- TABS -->
            <ul class="nav nav-tabs mb-3">
                <?php
                $tabs = [
                    "info"      => "Thông tin",
                    "bookings"  => "Booking",
                    "guests"    => "Khách",
                    "staff"     => "Phân bổ nhân sự",
                    "services"  => "Phân bổ dịch vụ",
                    "revenue"   => "Doanh thu"
                ];
                ?>
                <?php foreach ($tabs as $key => $title): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $tab == $key ? 'active' : '' ?>"
                            href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=<?= $key ?>">
                            <?= $title ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content pt-2">

                <!-- =============================
                     TAB 1 — THÔNG TIN
                ============================== -->
                <?php if ($tab == 'info'): ?>
                    <h5 class="section-title">Thông tin chuyến đi</h5>

                    <table class="table table-bordered info-table">
                        <tbody>
                            <tr>
                                <th>Tour</th>
                                <td><?= htmlspecialchars($data_departure['tour_name']) ?></td>
                            </tr>
                            <tr>
                                <th>Phiên bản</th>
                                <td><?= htmlspecialchars($data_departure['version_name']) ?></td>
                            </tr>
                            <tr>
                                <th>Ngày đi – Ngày về</th>
                                <td><?= $data_departure['start_date'] ?> → <?= $data_departure['end_date'] ?></td>
                            </tr>
                            <tr>
                                <th>Số chỗ</th>
                                <td><?= $data_departure['max_guests'] ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <?php
                                    $status_map = [
                                        "open" => ["badge-open", "Mở bán"],
                                        "running" => ["badge-run", "Đang chạy"],
                                        "completed" => ["badge-end", "Hoàn thành"],
                                        "full" => ["badge-full", "Full"],
                                        "closed" => ["badge-closed", "Đóng"]
                                    ];
                                    $s = $data_departure['status'];
                                    $badge = $status_map[$s][0] ?? "badge-open";
                                    $text  = $status_map[$s][1] ?? "Mở bán";
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= $text ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php endif; ?>

                <!-- =============================
                     TAB 2 — BOOKING
                ============================== -->
                <?php if ($tab == 'bookings'): ?>

                    <h5 class="fw-bold text-primary mb-3" style="font-size: 18px;">Danh sách booking</h5>

                    <div class="table-card">
                            <table class="table booking-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th style="width: 240px; text-align:left;">Người đặt</th>
                                    <th style="width: 120px;">Số khách</th>
                                    <th style="width: 150px;">Trạng thái</th>
                                    <th style="width: 180px; text-align:center;">Thanh toán</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($data_booking)): ?>
                                    <?php foreach ($data_booking as $key => $booking): ?>
                                        <?php
                                        // lấy dữ liệu an toàn, dùng fallback ''
                                        $customer_name    = htmlspecialchars($booking['customer_name'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $customer_contact = htmlspecialchars($booking['customer_contact'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $total_guests     = (int)($booking['total_guests'] ?? 0);
                                        $status_raw       = $booking['status'] ?? '';
                                        $total_amount     = isset($booking['total_amount']) ? number_format($booking['total_amount'], 0, ',', '.') . ' VNĐ' : '0 VNĐ';

                                        // map trạng thái -> class + label
                                        $status_map = [
                                            'completed' => ['badge-success', 'Đã thanh toán'],
                                            'deposit'   => ['badge-info',    'Đã cọc'],
                                            'pending'   => ['badge-secondary', 'Chờ xác nhận'],
                                            'cancel'    => ['badge-danger',  'Đã hủy'],
                                        ];
                                        $status_cls = $status_map[$status_raw][0] ?? 'badge-secondary';
                                        $status_lbl = $status_map[$status_raw][1] ?? ($status_raw ?: '—');
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>

                                            <td class="customer-cell" style="text-align:left;">
                                                <div class="customer-name"><?= $customer_name ?></div>
                                                <?php if ($customer_contact !== ''): ?>
                                                    <div class="customer-phone text-muted" style="font-size:13px; margin-top:4px;">
                                                        <?= $customer_contact ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center"><?= $total_guests ?></td>

                                            <td class="text-center">
                                                <span class="badge <?= $status_cls ?>"><?= $status_lbl ?></span>
                                            </td>

                                            <td class="text-center"><?= $total_amount ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Chưa có booking nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>


                <!-- =============================
                     TAB 3 — KHÁCH
                ============================== -->
                <?php if ($tab == 'guests'): ?>

                    <h5 class="section-title">Danh sách khách tham gia</h5>

                    <div class="table-card">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ tên</th>
                                    <th>Giới tính</th>
                                    <th>Năm sinh</th>
                                    <th>SĐT</th>
                                    <th>Thuộc booking</th>
                                    <th>Yêu cầu đặc biệt</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($data_guest as $i => $g): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($g['full_name']) ?></td>
                                        <td><?= htmlspecialchars($g['gender']) ?></td>
                                        <td><?= htmlspecialchars($g['birth_year']) ?></td>
                                        <td><?= htmlspecialchars($g['phone']) ?></td>
                                        <td>
                                            <?= htmlspecialchars($g['customer_name']) ?><br>
                                            <span class="text-muted small"><?= htmlspecialchars($g['customer_contact']) ?></span>
                                        </td>
                                        <td>
                                            <?= $g['description'] ?: "—" ?>
                                            <?php if (!empty($g['medical_condition'])): ?>
                                                <br><span class="text-danger small"><?= $g['medical_condition'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (empty($data_guest)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Chưa có khách.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>

                <!-- =============================
                     TAB 4 — NHÂN SỰ
                ============================== -->
                <?php if ($tab == 'staff'): ?>

                    <h5 class="section-title">Phân bổ nhân sự</h5>

                    <div class="card p-3 mb-4">
                        <form method="POST" onsubmit="return validateStaffForm()" action="?mode=admin&action=addGuide&id=<?= $_GET['id'] ?>&tab=staff">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Hướng dẫn viên</label>
                                    <select name="guide_id" class="form-select">
                                        <?php foreach ($data_guide as $g): ?>
                                            <option value="<?= $g['guide_id'] ?>">
                                                <?= $g['full_name'] ?> (<?= $g['languages'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger" id="guideError"></small>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Vai trò</label>
                                    <input name="role_in_tour" class="form-control" value="Guide">
                                    <small class="text-danger" id="roleError"></small>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">Ghi chú</label>
                                    <input name="notes" class="form-control">
                                    <span class="text-danger small" id="notesError"></span>
                                </div>
                            </div>
                            <button class="btn btn-success mt-3">Thêm HDV</button>
                        </form>
                    </div>

                    <div class="table-card">
                        <table class="table align-middle table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ tên</th>
                                    <th>Vai trò</th>
                                    <th>Ghi chú</th>
                                    <th>Thời gian</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_assignment as $i => $v): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $v['full_name'] ?></td>
                                        <td><?= $v['role_in_tour'] ?></td>
                                        <td><?= $v['notes'] ?></td>
                                        <td><?= $v['assigned_at'] ?></td>
                                        <td>
                                            <a href="?mode=admin&action=deleteStaff&id=<?= $v['assignment_id'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Xóa nhân sự?')">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($data_assignment)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Chưa có nhân sự.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>

                <!-- =============================
                     TAB 5 — DỊCH VỤ
                ============================== -->
                <?php if ($tab == 'services'): ?>

                    <h5 class="section-title">Phân bổ dịch vụ</h5>

                    <div class="card p-3 mb-4">
                        <form method="POST" onsubmit="return validateServiceForm()" action="?mode=admin&action=addService">
                            <input type="hidden" name="departure_id" value="<?= $data_departure['departure_id'] ?>">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Dịch vụ</label>
                                    <select name="service_id" class="form-select">
                                        <?php foreach ($data_service as $s): ?>
                                            <option value="<?= $s['service_id'] ?>"><?= $s['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger" id="serviceError"></small>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Nhà cung cấp</label>
                                    <input name="supplier" class="form-control">
                                    <small class="text-danger" id="supplierError"></small>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Giá</label>
                                    <input name="price" class="form-control" type="number">
                                    <small class="text-danger" id="priceError"></small>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">SL</label>
                                    <input name="quantity" class="form-control" type="number" value="1">
                                    <small class="text-danger" id="quantityError"></small>
                                </div>

                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-success w-100">Gán</button>
                                </div>
                            </div>

                            <textarea name="notes" class="form-control mt-3" placeholder="Ghi chú..."></textarea>
                            <small class="text-danger" id="serviceNotesError"></small>
                        </form>
                    </div>

                    <div class="table-card">
                        <table class="table align-middle table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dịch vụ</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Giá</th>
                                    <th>SL</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_service_assignment as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= htmlspecialchars($value['service_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($value['supplier'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= number_format($value['price'] ?? 0, 0, '', '.') ?></td>
                                        <td><?= (int)($value['quantity'] ?? 0) ?></td>
                                        <td><?= htmlspecialchars($value['notes'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>?mode=admin&action=deleteService&id=<?= $value['sa_id'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Xóa dịch vụ này?')">
                                                Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($data_service_assignment)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Chưa có dịch vụ.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <h6 class="fw-bold mt-3"><b><?= $data_departure['status'] == 'completed' ? 'Tổng chi phí dịch vụ:' : 'Tổng chi phí dịch vụ dự kiến:' ?> </b>
                        <?= number_format($total_service_cost, 0, '', '.') ?> đ
                    </h6>


                    <h5 class="fw-semibold text-primary mt-5 mb-3">Chi phí phát sinh</h5>
                    <div class="card p-3 mb-4">
                        <form action="?mode=admin&action=addExtraCost" method="POST" class="mb-3">
                            <input type="hidden" name="departure_id" value="<?= $data_departure['departure_id'] ?>">

                            <div class="row">
                                <div class="col-md-4">
                                    <label>Tên chi phí</label>
                                    <input type="text" name="cost_name" class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Số tiền</label>
                                    <input type="number" name="amount" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Ghi chú</label>
                                    <input type="text" name="note" class="form-control">
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button class="btn btn-success w-100">Thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="table-card">
                        <table class="table align-middle table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Tên chi phí</th>
                                    <th>Số tiền</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_extraCost as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['cost_name'] ?></td>
                                        <td><?= number_format($value['amount'], 0, ',', '.') ?> đ</td>
                                        <td><?= $value['note'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 mb-5">
                        <h6 class="fw-bold mt-3"><b><?= $data_departure['status'] == 'completed' ? 'Tổng chi phí phát sinh:' : 'Tổng chi phí phát sinh dự kiến:' ?> </b>
                            <?= number_format($total_service_extraCost, 0, '', '.') ?> đ
                        </h6>
                    </div>
                <?php endif; ?>

                <!-- =============================
                     TAB 6 — DOANH THU
                ============================== -->
                <?php if ($tab == 'revenue'): ?>

                    <h5 class="section-title">Doanh thu chuyến đi</h5>

                    <?php $r = $revenue; ?>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card p-3"><b>Số booking: </b><?= $r['booking_count'] ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3"><b>Tổng khách: </b><?= $r['total_guests'] ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 mb-3">
                                <b><?= $data_departure['status'] == 'completed' ? 'Doanh thu:' : 'Doanh thu dự kiến:' ?> </b>
                                <?= number_format($r['revenue'] ?? 0, 0, '', '.') ?> VNĐ
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-semibold mb-2">Chi tiết booking</h6>

                    <div class="table-card">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Người đặt</th>
                                    <th>Số khách</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_booking as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= htmlspecialchars($value['customer_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= (int)($value['total_guests'] ?? 0) ?></td>
                                        <td><?= number_format($value['total_amount'] ?? 0, 0, '', '.') ?></td>
                                        <td>
                                            <?php if ($value['status'] == 'completed'): ?>
                                                <span class="badge bg-success">Đã thanh toán</span>
                                            <?php elseif ($value['status'] == 'deposit'): ?>
                                                <span class="badge bg-info">Đã cọc</span>
                                            <?php elseif ($value['status'] == 'pending'): ?>
                                                <span class="badge bg-secondary">Chờ xác nhận</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Đã hủy</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
<script>
function hasValidText(value) {
    return /^[^0-9]*[a-zA-ZÀ-Ỹà-ỹ][^0-9]*$/.test(value);
}
function validateStaffForm() {

    const guide = document.querySelector('[name="guide_id"]');
    const role  = document.querySelector('[name="role_in_tour"]');
    const notes = document.querySelector('[name="notes"]');

    const guideErr = document.getElementById('guideError');
    const roleErr  = document.getElementById('roleError');
    const notesErr = document.getElementById('notesError');

    const roleVal  = role.value.trim();
    const notesVal = notes.value.trim();

    guideErr.innerHTML = roleErr.innerHTML = notesErr.innerHTML = "";

    if (!guide.value) {
        guideErr.innerHTML = "Vui lòng chọn hướng dẫn viên";
        guide.focus();
        return false;
    }

    if (roleVal === "") {
        roleErr.innerHTML = "Vui lòng nhập vai trò";
        role.focus();
        return false;
    }

    if (!hasValidText(roleVal)) {
        roleErr.innerHTML = "Vai trò phải có chữ, không được nhập linh tinh";
        role.focus();
        return false;
    }

    if (notesVal !== "" && !hasValidText(notesVal)) {
        notesErr.innerHTML = "Ghi chú phải có chữ, không được nhập linh tinh";
        notes.focus();
        return false;
    }

    return true;
}
function validateServiceForm() {

    const form = document.querySelector('form[action*="addService"]');

    const service  = form.querySelector('[name="service_id"]');
    const supplier = form.querySelector('[name="supplier"]');
    const price    = form.querySelector('[name="price"]');
    const quantity = form.querySelector('[name="quantity"]');
    const notes    = form.querySelector('[name="notes"]');

    const serviceErr  = document.getElementById('serviceError');
    const supplierErr = document.getElementById('supplierError');
    const priceErr    = document.getElementById('priceError');
    const quantityErr = document.getElementById('quantityError');
    const notesErr    = document.getElementById('serviceNotesError');

    serviceErr.innerHTML =
    supplierErr.innerHTML =
    priceErr.innerHTML =
    quantityErr.innerHTML =
    notesErr.innerHTML = "";

    /* Dịch vụ – bắt buộc */
    if (!service.value) {
        serviceErr.innerHTML = "Vui lòng chọn dịch vụ";
        service.focus();
        return false;
    }

    /* Nhà cung cấp – BẮT BUỘC */
    if (supplier.value.trim() === "") {
        supplierErr.innerHTML = "Vui lòng nhập nhà cung cấp";
        supplier.focus();
        return false;
    }

    if (!hasValidText(supplier.value)) {
        supplierErr.innerHTML = "Nhà cung cấp phải có chữ, không được nhập linh tinh";
        supplier.focus();
        return false;
    }

    /* Giá – BẮT BUỘC */
    if (price.value.trim() === "") {
        priceErr.innerHTML = "Vui lòng nhập giá";
        price.focus();
        return false;
    }

    if (Number(price.value) <= 0) {
        priceErr.innerHTML = "Giá phải lớn hơn 0";
        price.focus();
        return false;
    }

    /* Số lượng – bắt buộc */
    if (quantity.value === "" || Number(quantity.value) <= 0) {
        quantityErr.innerHTML = "Số lượng phải lớn hơn 0";
        quantity.focus();
        return false;
    }

    /* Ghi chú – không bắt buộc */
    if (notes.value.trim() !== "" && !hasValidText(notes.value)) {
        notesErr.innerHTML = "Ghi chú phải có chữ, không được nhập linh tinh";
        notes.focus();
        return false;
    }

    return true;
}
</script>
