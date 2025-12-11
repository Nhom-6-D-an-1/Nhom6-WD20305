<style>
    /* ===============================
   TABLE - NOTION / APPLE STYLE
=============================== */

    /* Header nhẹ */
    .table thead th {
        background-color: transparent !important;
        color: #6b7280 !important;
        /* xám Apple */
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12.5px;
        border-bottom: 1px solid #e5e7eb !important;
        text-align: center;
        padding: 14px 10px !important;
        letter-spacing: .5px;
    }

    /* Cells thoáng */
    .table td {
        padding: 14px 12px !important;
        color: #374151;
        /* xám đậm Apple */
        font-size: 15px;
    }

    /* Giảm độ đậm đường phân cách */
    .table tbody tr:not(:last-child) {
        border-bottom: 1px solid #f2f2f2 !important;
    }

    /* Hover tối giản */
    .table-hover tbody tr:hover {
        background-color: #f9fafb !important;
        /* Apple light hover */
    }

    /* Căn giữa / căn trái theo tiêu chuẩn UI */
    .table tbody td:nth-child(1),
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(4),
    .table tbody td:nth-child(5),
    .table tbody td:nth-child(6),
    .table tbody td:nth-child(8),
    .table tbody td:nth-child(9) {
        text-align: center !important;
    }

    /* Cột text dài thì căn trái */
    .table tbody td:nth-child(2),
    .table tbody td:nth-child(7) {
        text-align: left !important;
    }

    /* Bỏ border Bootstrap dày */
    .table-bordered> :not(caption)>*>* {
        border-width: 0 !important;
    }

    /* ===============================
   CARD (khung chứa bảng)
=============================== */
    .table-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #f3f4f6;
        /* Apple soft border */
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        /* soft shadow kiểu Apple */
    }

    /* ===============================
   BADGE (Trạng thái pastel)
=============================== */
    .badge {
        padding: 6px 10px !important;
        font-size: 12px !important;
        border-radius: 6px !important;
        font-weight: 500 !important;
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

    /* ===============================
   BUTTON (tối giản giống Apple)
=============================== */
    .btn-minimal {
        padding: 6px 14px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: white;
        font-size: 13px;
        color: #374151;
        display: inline-block;
        transition: 0.2s ease;
    }

    .btn-minimal:hover {
        background: #f3f4f6;
        transform: translateY(-1px);
    }

    /* Bỏ gạch chân */
    a {
        text-decoration: none !important;
    }

    /* ===============================
   BUTTON COLORS - MINIMAL STYLE
=============================== */

    /* Xanh dương nhạt */
    .btn-minimal-primary {
        border-color: #bfdbfe;
        background: #dbeafe;
        color: #1e3a8a;
    }

    .btn-minimal-primary:hover {
        background: #bfdbfe;
    }

    /* Xanh lá nhạt */
    .btn-minimal-success {
        border-color: #bbf7d0;
        background: #dcfce7;
        color: #166534;
    }

    .btn-minimal-success:hover {
        background: #bbf7d0;
    }

    /* Vàng nhạt */
    .btn-minimal-warning {
        border-color: #fde68a;
        background: #fef9c3;
        color: #b45309;
    }

    .btn-minimal-warning:hover {
        background: #fde68a;
    }

    /* Đỏ nhạt */
    .btn-minimal-danger {
        border-color: #fecaca;
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-minimal-danger:hover {
        background: #fecaca;
    }
</style>
<div class="container-fluid px-4">

    <h3 class="fw-bold">Danh sách chuyến đi</h3>

    <div class="table-card">

        <table class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên chuyến đi</th>
                    <th>Ngày đi</th>
                    <th>Ngày về</th>
                    <th>Số chỗ</th>
                    <th>Còn trống</th>
                    <th>Giá bán</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data_departure as $key => $value): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>

                        <td>
                            <strong><?= $value['departure_name'] ?></strong><br>
                            <span class="text-muted small"><?= $value['tour_name'] ?> - <?= $value['version_name'] ?></span>
                        </td>

                        <td><?= $value['start_date'] ?></td>
                        <td><?= $value['end_date'] ?></td>
                        <td><?= $value['max_guests'] ?></td>
                        <td><strong><?= (int)$value['max_guests'] - (int)$value['current_guests'] ?></strong></td>
                        <td><?= number_format($value['actual_price'], 0, ',', '.') ?> VNĐ</td>

                        <td>
                            <?php if ($value['status'] == 'open'): ?>
                                <span class="badge badge-open">Mở bán</span>
                            <?php elseif ($value['status'] == 'running'): ?>
                                <span class="badge badge-run">Đang chạy</span>
                            <?php else: ?>
                                <span class="badge badge-end">Hoàn thành</span>
                            <?php endif; ?>
                        </td>


                        <td>
                            <a href="<?= BASE_URL ?>?mode=admin&action=departureEdit&id=<?= $value['departure_id'] ?>"
                                class="btn-minimal btn-minimal-warning">Sửa</a>

                            <a href="<?= BASE_URL ?>?mode=admin&action=departureDetail&id=<?= $value['departure_id'] ?>"
                                class="btn-minimal btn-minimal-primary">Chi tiết</a>

                            <a href="<?= BASE_URL ?>?mode=admin&action=createType&id=<?= $value['departure_id'] ?>"
                                class="btn-minimal btn-minimal-success">Thêm booking</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>

</div>