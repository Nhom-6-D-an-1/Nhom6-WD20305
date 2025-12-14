<style>
    /* ===============================
    PAGE TITLE – Match Dashboard
    =============================== */
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 24px;
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
    BUTTON: ADD NEW
    =============================== */
    .btn-success {
        background: #e8f0ff;
        border: 1px solid #c5d6ff;
        padding: 10px 18px;
        border-radius: 12px;
        color: #1e40af;
        font-weight: 600;
    }
    .btn-success:hover {
        background: #d6e6ff;
    }

    /* ===============================
    TABLE
    =============================== */
    .table thead th {
        background: #f9fafb;
        color: #6b7280;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: 600;
        border-bottom: 1px solid #eceef2;
        padding: 14px 10px;
        letter-spacing: .5px;
    }

    .table tbody td {
        padding: 16px 12px;
        font-size: 15px;
        vertical-align: middle;
        color: #1f2937;
    }

    .table tbody tr:hover {
        background: #f7faff;
    }

    /* ===============================
    ACTION BUTTONS
    =============================== */
    .btn-sm {
        padding: 7px 14px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
    }

    .btn-info {
        background: #e5efff;
        color: #2563eb;
    }
    .btn-info:hover {
        background: #d6e6ff;
    }

    .btn-primary {
        background: #fff4d8;
        color: #b97500;
    }
    .btn-primary:hover {
        background: #ffe8b5;
    }

    .btn-danger {
        background: #ffe5e5;
        color: #d02f2f;
    }
    .btn-danger:hover {
        background: #ffd4d4;
    }
</style>

<div class="container-fluid px-4">

    <h3 class="fw-bold mt-4 mb-4 page-title">Danh sách Tour</h3>

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

                            <td>
                                <?= htmlspecialchars($value['tour_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($value['tour_code'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <td>
                                <strong><?= htmlspecialchars($value['version_code'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                                <?php if (!empty($value['season'])): ?>
                                    <span class="text-muted small">
                                        - <?= htmlspecialchars($value['season'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
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
                    <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
