<style>
    /* ===============================
    PAGE TITLE – Match Dashboard
    =============================== */

    .page-title {
        font-size: 24px !important;
        font-weight: 700 !important;
        color: #1f2937 !important; /* màu xám đậm giống Dashboard */
        margin-bottom: 24px !important;
    }

    /* ===============================
    CARD STYLE – Premium
    =============================== */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef0f3;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        padding: 22px;
    }

    /* ===============================
    BUTTON: ADD NEW (Pastel Blue)
    =============================== */
    .btn-success {
        background: #e8f0ff !important;
        border: 1px solid #c5d6ff !important;
        padding: 10px 18px !important;
        border-radius: 12px !important;
        color: #1e40af !important;
        font-weight: 600 !important;
    }

    .btn-success:hover {
        background: #d6e6ff !important;
    }

    /* ===============================
    TABLE HEADER – Dashboard Style
    =============================== */
    .table thead th {
        background: #f9fafb !important;
        color: #6b7280 !important;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 600;
        border-bottom: 1px solid #eceef2 !important;
        padding: 14px 10px !important;
        letter-spacing: .5px;
    }

    /* ===============================
    TABLE BODY
    =============================== */
    .table tbody tr {
        border-bottom: 1px solid #f0f1f5;
        transition: .15s ease;
    }

    .table tbody tr:hover {
        background: #f7faff;
    }

    .table tbody td {
        padding: 16px 12px !important;
        font-size: 15px;
        vertical-align: middle !important;
        color: #1f2937;
    }

    /* Căn cột */
    .table tbody td:nth-child(1),
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(5) {
        text-align: left !important;
    }

    .table tbody td:nth-child(2),
    .table tbody td:nth-child(4) {
        text-align: left !important;
    }

    /* ===============================
    ACTION BUTTONS – Pastel
    =============================== */
    .btn-sm {
        padding: 7px 14px !important;
        border-radius: 12px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        border: none !important;
        transition: .2s;
    }

    /* Xem – xanh pastel */
    .btn-info {
        background: #e5efff !important;
        color: #2563eb !important;
    }
    .btn-info:hover {
        background: #d6e6ff !important;
    }

    /* Sửa – vàng pastel */
    .btn-primary {
        background: #fff4d8 !important;
        color: #b97500 !important;
    }
    .btn-primary:hover {
        background: #ffe8b5 !important;
    }

    /* Xóa – đỏ pastel */
    .btn-danger {
        background: #ffe5e5 !important;
        color: #d02f2f !important;
    }
    .btn-danger:hover {
        background: #ffd4d4 !important;
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