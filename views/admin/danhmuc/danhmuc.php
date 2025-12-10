<style>
    /* -------------------------------------------------------
   PAGE TITLE
-------------------------------------------------------- */
    .page-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 24px;
        color: #1f2937;
    }

    /* -------------------------------------------------------
   CARD
-------------------------------------------------------- */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f1f3;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
    }

    /* -------------------------------------------------------
   BUTTON: ADD (Vàng pastel)
-------------------------------------------------------- */
    .btn-success {
        background: #fff8da !important;
        border: 1px solid #e3c76d !important;
        padding: 10px 18px !important;
        border-radius: 10px !important;
        color: #806014 !important;
        font-weight: 600 !important;
    }

    .btn-success:hover {
        background: #ffefb5 !important;
    }

    /* -------------------------------------------------------
   TABLE HEADER
-------------------------------------------------------- */
    .table thead th {
        background-color: transparent !important;
        color: #6b7280 !important;
        text-transform: uppercase;
        font-size: 12.8px;
        font-weight: 600;
        letter-spacing: .4px;
        border-bottom: 1px solid #e5e7eb !important;
        padding: 14px 10px !important;
        text-align: center;
    }

    /* -------------------------------------------------------
   TABLE BODY
-------------------------------------------------------- */
    .table tbody tr {
        border-bottom: 1px solid #efefef;
    }

    .table tbody td {
        padding: 16px 12px !important;
        font-size: 15px;
    }

    /* Căn cột */
    .table tbody td:nth-child(1),
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(4) {
        text-align: center;
    }

    .table tbody td:nth-child(2) {
        text-align: center;
    }

    /* -------------------------------------------------------
   BADGES (Pastel)
-------------------------------------------------------- */
    .badge {
        padding: 7px 16px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 600;
    }

    .bg-success {
        background: #d1fae5 !important;
        color: #065f46 !important;
    }

    .bg-secondary {
        background: #e5e7eb !important;
        color: #374151 !important;
    }

    /* -------------------------------------------------------
   ACTION BUTTONS (Pastel)
-------------------------------------------------------- */
    .btn-sm {
        padding: 7px 14px !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        border: none !important;
    }

    /* Xem – xanh pastel */
    .btn-info {
        background: #dbeafe !important;
        color: #1e40af !important;
    }

    .btn-info:hover {
        background: #bfdbfe !important;
    }

    /* Sửa – vàng pastel */
    .btn-primary {
        background: #fef3c7 !important;
        color: #92400e !important;
    }

    .btn-primary:hover {
        background: #fde68a !important;
    }

    /* Xóa – đỏ pastel */
    .btn-danger {
        background: #fee2e2 !important;
        color: #b91c1c !important;
    }

    .btn-danger:hover {
        background: #fecaca !important;
    }
</style>

<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Danh mục tour</h3>

    <div class="card mb-4">
        <div class="card-body">

            <!-- Thanh hành động -->
            <div class="d-flex justify-content-between mb-3">
                <a href="?mode=admin&action=adddanhmuc" class="btn btn-success">
                    + Thêm danh mục tour
                </a>
            </div>

            <!-- Bảng dữ liệu -->
            <div class="table-wrapper">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:60px;">STT</th>
                            <th>Tên loại tour</th>
                            <th style="width:150px;">Trạng thái</th>
                            <th style="width:300px;">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>

                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($item['category_name']) ?>
                                    </td>

                                    <td>
                                        <?php if ($item['status'] == 1): ?>
                                            <span class="badge bg-success">Đang hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Tạm ẩn</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a href="?mode=admin&action=xemchitietdanhmuc&id=<?= $item['category_id'] ?>"
                                            class="btn btn-info btn-sm">Chi tiết</a>

                                        <a href="?mode=admin&action=suadanhmuc&id=<?= $item['category_id'] ?>"
                                            class="btn btn-primary btn-sm">Sửa</a>

                                        <a href="?mode=admin&action=xoadanhmuc&id=<?= $item['category_id'] ?>"
                                            onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"
                                            class="btn btn-danger btn-sm">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    Không có danh mục nào
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>