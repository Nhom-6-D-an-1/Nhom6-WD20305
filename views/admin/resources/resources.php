<style>
    /* ===========================================================
   PAGE TITLE
=========================================================== */
    .fw-bold {
        font-size: 32px;
        font-weight: 800 !important;
        margin-bottom: 24px;
        color: #1f2937;
    }

    /* ===========================================================
   WRAPPER CARD
=========================================================== */
    .card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    }

    /* ===========================================================
   TABLE HEADER
=========================================================== */
    .table thead th {
        background-color: transparent !important;
        color: #6b7280 !important;
        text-transform: uppercase;
        font-size: 12.5px;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb !important;
        text-align: center !important;
        letter-spacing: .4px;
        padding: 14px 10px !important;
    }

    /* ===========================================================
   TABLE BODY
=========================================================== */
    .table tbody tr {
        border-bottom: 1px solid #efefef;
        transition: 0.15s ease;
    }

    .table tbody tr:hover {
        background: #fafafa;
    }

    .table tbody td {
        padding: 16px 12px !important;
        font-size: 15px;
        vertical-align: middle !important;
    }

    /* Căn giữa các cột số liệu */
    .table tbody td:nth-child(1),
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(4),
    .table tbody td:nth-child(6),
    .table tbody td:nth-child(5),
    .table tbody td:nth-child(7) {
        text-align: center !important;
    }

    /* Cột tên HDV căn trái */
    .table tbody td:nth-child(2) {
        text-align: center !important;
        padding-left: 20px !important;
    }

    /* ===========================================================
   BADGE STYLE (Pastel)
=========================================================== */
    .badge {
        padding: 6px 12px !important;
        border-radius: 10px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
    }

    .bg-primary {
        background: #dbeafe !important;
        color: #1e40af !important;
    }

    .bg-success {
        background: #d1fae5 !important;
        color: #065f46 !important;
    }

    /* ===========================================================
   BUTTON (Pastel)
=========================================================== */
    .btn-sm {
        padding: 7px 14px !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        border: none !important;
    }

    /* Chi tiết – xanh pastel */
    .btn-info {
        background: #dbeafe !important;
        color: #1e40af !important;
    }

    .btn-info:hover {
        background: #bfdbfe !important;
    }
</style>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold">Quản lý nhân sự (Hướng dẫn viên)</h3>
    </div>

    <!-- CARD -->
    <div class="card">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">#</th>
                        <th>Họ tên</th>
                        <th style="width:120px;">Ảnh</th>
                        <th>Chứng chỉ</th>
                        <th>Ngôn ngữ</th>
                        <th style="width:120px;">Đánh giá</th>
                        <th style="width:140px;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data_tourGuide as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <!-- TÊN HDV -->
                            <td class="fw-semibold">
                                <?= htmlspecialchars($value['full_name'] ?? '') ?>
                            </td>

                            <!-- ẢNH -->
                            <td>
                                <?php if (!empty($value['avatar'])): ?>
                                    <img src="<?= BASE_ASSETS_UPLOADS . $value['avatar'] ?>"
                                        class="img-fluid rounded"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>

                            <!-- CHỨNG CHỈ -->
                            <td>
                                <?php if (!empty($value['certificates'])): ?>
                                    <span class="badge bg-primary">
                                        <?= htmlspecialchars($value['certificates']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <!-- NGÔN NGỮ -->
                            <td>
                                <?php if (!empty($value['languages'])): ?>
                                    <span class="badge bg-success">
                                        <?= htmlspecialchars($value['languages']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <!-- ĐÁNH GIÁ -->
                            <td>
                                ⭐ <?= number_format((float)$value['rating'], 1) ?>/5
                            </td>

                            <!-- NÚT -->
                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $value['user_id'] ?>"
                                    class="btn btn-info btn-sm w-100">
                                    Chi tiết
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>