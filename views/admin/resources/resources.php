<style>
/* ===========================================================
   PAGE TITLE – DASHBOARD STYLE
=========================================================== */
.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 22px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===========================================================
   CARD – APPLE STYLE
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
    transition: .15s ease;
}

.table tbody tr:hover {
    background: #fafafa;
}

.table tbody td {
    padding: 16px 12px !important;
    font-size: 15px;
    vertical-align: middle !important;
    color: #1f2937;
}

/* Align columns */
.table tbody td:nth-child(1),
.table tbody td:nth-child(3),
.table tbody td:nth-child(4),
.table tbody td:nth-child(5),
.table tbody td:nth-child(6),
.table tbody td:nth-child(7) {
    text-align: center !important;
}

/* Name column */
.table tbody td:nth-child(2) {
    text-align: left !important;
    padding-left: 16px !important;
}

/* ===========================================================
   BADGE – PASTEL
=========================================================== */
.badge {
    padding: 6px 14px !important;
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
   BUTTON – PASTEL
=========================================================== */
.btn-sm {
    padding: 7px 14px !important;
    border-radius: 10px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    border: none !important;
}

.btn-info {
    background: #dbeafe !important;
    color: #1e40af !important;
}

.btn-info:hover {
    background: #bfdbfe !important;
}
</style>

<div class="container-fluid px-4">

    <!-- TITLE -->
    <div class="page-title">Quản lý nhân sự (Hướng dẫn viên)</div>

    <!-- CARD -->
    <div class="card">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
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
                    <?php if (!empty($data_tourGuide)): ?>
                        <?php foreach ($data_tourGuide as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>

                                <!-- NAME -->
                                <td class="fw-semibold">
                                    <?= htmlspecialchars($value['full_name'] ?? '') ?>
                                </td>

                                <!-- AVATAR -->
                                <td>
                                    <?php if (!empty($value['avatar'])): ?>
                                        <img src="<?= BASE_ASSETS_UPLOADS . $value['avatar'] ?>"
                                             alt="avatar"
                                             class="rounded"
                                             style="width:70px;height:70px;object-fit:cover;">
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                <!-- CERTIFICATE -->
                                <td>
                                    <?php if (!empty($value['certificates'])): ?>
                                        <span class="badge bg-primary">
                                            <?= htmlspecialchars($value['certificates']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                <!-- LANGUAGE -->
                                <td>
                                    <?php if (!empty($value['languages'])): ?>
                                        <span class="badge bg-success">
                                            <?= htmlspecialchars($value['languages']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                <!-- RATING -->
                                <td>
                                    <span class="fw-semibold">
                                        ⭐ <?= number_format((float)($value['rating'] ?? 0), 1) ?>
                                    </span>
                                    <span class="text-muted">/5</span>
                                </td>

                                <!-- ACTION -->
                                <td>
                                    <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $value['user_id'] ?>"
                                       class="btn btn-info btn-sm w-100">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Chưa có dữ liệu hướng dẫn viên
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
