<style>
    /* ======================================================
   GLOBAL VARIABLES — Premium Tour UI
    ====================================================== */
    :root {
        --primary: #2563eb;
        --primary-light: #e8f0ff;

        --gray-dark: #1f2937;
        --gray: #374151;
        --gray-light: #6b7280;

        --border: #eceef2;
        --border-light: #f3f4f6;
        --bg-soft: #f9fafb;

        --radius: 14px;
        --radius-card: 16px;

        --shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
    }

    /* ======================================================
    TYPOGRAPHY
    ====================================================== */
    .page-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--gray-dark);
        margin-bottom: 24px;
    }

    .page-subtitle {
        color: var(--gray-light);
        font-size: 15px;
        margin-top: -10px;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
    }

    /* ======================================================
    CARD
    ====================================================== */
    .card,
    .table-card {
        background: #ffffff;
        border-radius: var(--radius-card);
        border: 1px solid var(--border);
        padding: 22px;
        box-shadow: var(--shadow);
    }

    /* ======================================================
    BUTTONS — Pastel Style (Tour)
    ====================================================== */

    /* Add New (Pastel Blue) */
    .btn-success {
        background: #e8f0ff !important;
        border: 1px solid #c5d6ff !important;
        color: #1e40af !important;
        padding: 10px 18px !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
    }

    .btn-success:hover {
        background: #d6e6ff !important;
    }

    /* Info (Pastel Blue) */
    .btn-info {
        background: #e5efff !important;
        color: #2563eb !important;
        border-radius: 12px !important;
        padding: 7px 14px !important;
        border: none !important;
    }

    .btn-info:hover {
        background: #d6e6ff !important;
    }

    /* Edit (Pastel Yellow) */
    .btn-primary {
        background: #fff4d8 !important;
        color: #b97500 !important;
        border-radius: 12px !important;
        padding: 7px 14px !important;
        border: none !important;
        font-weight: 600 !important;
    }

    .btn-primary:hover {
        background: #ffe8b5 !important;
    }

    /* Delete (Pastel Red) */
    .btn-danger {
        background: #ffe5e5 !important;
        color: #d02f2f !important;
        border-radius: 12px !important;
        padding: 7px 14px !important;
        border: none !important;
        font-weight: 600 !important;
    }

    .btn-danger:hover {
        background: #ffd4d4 !important;
    }

    /* ======================================================
    FORM INPUTS
    ====================================================== */
    .form-control,
    .form-select {
        background: var(--bg-soft);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 14px;
        color: var(--gray-dark);
        font-size: 15px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    /* ======================================================
    TABLE — Premium Tour Style
    ====================================================== */
    .table thead th {
        background: #f9fafb !important;
        color: #6b7280 !important;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 600;
        border-bottom: 1px solid var(--border) !important;
        padding: 14px 10px;
    }

    .table tbody td {
        padding: 16px 12px !important;
        font-size: 15px;
        color: var(--gray-dark);
    }

    .table tbody tr {
        border-bottom: 1px solid #f0f1f5;
    }

    .table tbody tr:hover {
        background: #f7faff;
    }

    /* alignment */
    .table td:nth-child(1),
    .table td:nth-child(3),
    .table td:nth-child(4),
    .table td:nth-child(5),
    .table td:nth-child(6),
    .table td:nth-child(7),
    .table td:last-child {
        text-align: center;
    }

    /* ======================================================
    BADGES — Pastel Tour Style
    ====================================================== */
    .badge {
        padding: 6px 10px !important;
        border-radius: 12px !important;
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

    /* ================================
   HÀNH ĐỘNG – BUTTON GROUP
================================ */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
        /* thu nhỏ khoảng cách */
        justify-content: center;
    }

    /* style chung */
    .action-buttons .btn {
        padding: 6px 12px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        border-radius: 10px !important;
        border: none !important;
        min-width: 84px;
        /* các nút bằng nhau */
        text-align: center;
        transition: .2s ease;
    }

    /* Chi tiết – xanh pastel nhẹ */
    .btn-action-info {
        background: #e9f1ff !important;
        color: #1d4ed8 !important;
    }

    .btn-action-info:hover {
        background: #dbe8ff !important;
    }

    /* Sửa – vàng pastel nhẹ */
    .btn-action-edit {
        background: #fff5da !important;
        color: #b45309 !important;
    }

    .btn-action-edit:hover {
        background: #ffe9b4 !important;
    }

    /* Thêm booking – xanh dương pastel */
    .btn-action-add {
        background: #eef4ff !important;
        color: #2563eb !important;
    }

    .btn-action-add:hover {
        background: #dfeaff !important;
    }

    /* Cột ngày đi / ngày về */
    .table td.col-date,
    .table th.col-date {
        text-align: center !important;
        width: 150px;
        /* cố định width để tất cả thẳng hàng */
        white-space: nowrap;
        /* không cho xuống dòng */
    }
</style>

<div class="container-fluid px-4">

    <h3 class="fw-bold mt-4 mb-4">Danh sách chuyến đi</h3>

    <div class="card mb-4">
        <div class="card-body">

            <!-- Thanh hành động -->
            <div class="d-flex justify-content-between mb-3">
                <div></div>
                <a href="<?= BASE_URL ?>?mode=admin&action=createDeparture"
                    class="btn btn-success">
                    + Tạo chuyến đi mới
                </a>
            </div>

            <!-- Bảng chuyến đi -->
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Tên chuyến đi</th>
                        <th class="col-date">NGÀY ĐI</th>
                        <th class="col-date">NGÀY VỀ</th>
                        <th style="width:100px;">Số chỗ</th>
                        <th style="width:100px;">Còn trống</th>
                        <th style="width:150px;">Giá bán</th>
                        <th style="width:150px;">Trạng thái</th>
                        <th style="width:260px;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data_departure as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <td>
                                <strong><?= htmlspecialchars($value['departure_name']) ?></strong>
                                <br>
                                <span class="text-muted small">
                                    <?= htmlspecialchars($value['tour_name']) ?> - <?= htmlspecialchars($value['version_name']) ?>
                                </span>
                            </td>

                            <td class="col-date"><?= htmlspecialchars($value['start_date']) ?></td>
                            <td class="col-date"><?= htmlspecialchars($value['end_date']) ?></td>
                            <td><?= (int)$value['max_guests'] ?></td>

                            <td><strong><?= (int)$value['max_guests'] - (int)$value['current_guests'] ?></strong></td>

                            <td><?= number_format($value['actual_price'], 0, ',', '.') ?> VNĐ</td>

                            <td>
                                <?php if ($value['status'] == 'open'): ?>
                                    <span class="badge bg-success">Mở bán</span>
                                <?php elseif ($value['status'] == 'running'): ?>
                                    <span class="badge bg-success">Đang chạy</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Hoàn thành</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <div class="action-buttons">

                                    <a href="<?= BASE_URL ?>?mode=admin&action=departureDetail&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-action-info">Chi tiết</a>

                                    <a href="<?= BASE_URL ?>?mode=admin&action=departureEdit&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-action-edit">Sửa</a>

                                    <a href="<?= BASE_URL ?>?mode=admin&action=createType&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-action-add">booking</a>

                                </div>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>