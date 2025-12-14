<style>
    /* ===============================
   PAGE TITLE
=============================== */
    .fw-bold {
        font-size: 32px;
        font-weight: 800 !important;
        margin-bottom: 24px;
        color: #1f2937;
    }

    /* ===============================
   CARD
=============================== */
    .card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    }

    /* ===============================
   ADD BUTTON (Gold pastel)
=============================== */
    .btn-success {
        background: #fff8da !important;
        border: 1px solid #d6c278 !important;
        padding: 10px 18px !important;
        border-radius: 10px !important;
        color: #7c5e10 !important;
        font-weight: 600 !important;
    }

    .btn-success:hover {
        background: #ffefb5 !important;
    }

    /* ===============================
   TABLE HEADER
=============================== */
    .table thead th {
        background: transparent !important;
        color: #6b7280 !important;
        text-transform: uppercase;
        font-size: 12.5px;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb !important;
        text-align: left !important;
        padding: 14px 10px !important;
        letter-spacing: .4px;
    }

    /* ===============================
   TABLE BODY
=============================== */
    .table tbody tr {
        border-bottom: 1px solid #efefef;
    }

    .table tbody td {
        padding: 16px 12px !important;
        font-size: 15px;
        vertical-align: middle !important;
    }

    /* Căn giữa các cột số, mã tour, hành động */
    .table tbody td:nth-child(1),
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(5) {
        text-align: left !important;
    }

    /* Cột tên tour — căn trái */
    .table tbody td:nth-child(2) {
        text-align: left !important;
        padding-left: 18px !important;
    }

    /* Cột phiên bản — căn trái */
    .table tbody td:nth-child(4) {
        text-align: left !important;
    }

    /* ===============================
   BUTTONS (Pastel)
=============================== */
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

    <h3 class="fw-bold mt-4 mb-4">Danh sách Tour</h3>

    <div class="card mb-4">
        <div class="card-body">

            <!-- Thanh hành động -->
            <div class="d-flex justify-content-between mb-3">
                <div></div>
                <a href="<?= BASE_URL ?>?mode=admin&action=createTour" class="btn btn-success">
                    + Tạo tour mới
                </a>
            </div>

            <!-- Bảng Tour -->
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Tên Tour</th>
                        <th style="width:160px;">Mã Tour</th>
                        <th style="width:220px;">Phiên bản hiện tại</th>
                        <th style="width:200px;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <td><?= htmlspecialchars($value['tour_name']) ?></td>

                            <td><?= htmlspecialchars($value['tour_code']) ?></td>

                            <td>
                                <strong><?= htmlspecialchars($value['version_code']) ?></strong>
                                <?php if (!empty($value['season'])): ?>
                                    <span class="text-muted small"> - <?= htmlspecialchars($value['season']) ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&id=<?= $value['tour_id'] ?>"
                                    class="btn btn-info btn-sm">Xem</a>

                                <a href="<?= BASE_URL ?>?mode=admin&action=editTour&id=<?= $value['tour_id'] ?>"
                                    class="btn btn-primary btn-sm">Sửa</a>

                                <a onclick="return confirm('Bạn có muốn xóa tour này?')"
                                    href="<?= BASE_URL ?>?mode=admin&action=deleteTour&id=<?= $value['tour_id'] ?>"
                                    class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger mt-3">
                    <?= $_SESSION['flash_error'];
                    unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>