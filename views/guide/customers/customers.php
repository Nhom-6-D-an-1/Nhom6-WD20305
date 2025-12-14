
<style>
/* ===============================
   PAGE TITLE
=============================== */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===============================
   CARD – APPLE STYLE
=============================== */
.card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

/* ===============================
   FILTER
=============================== */
.form-select {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
    font-size: 14px;
}

/* ===============================
   TABLE
=============================== */
.table thead th {
    background: transparent !important;
    color: #6b7280;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .4px;
    border-bottom: 1px solid #e5e7eb !important;
}

.table tbody tr {
    border-bottom: 1px solid #f1f1f1;
    transition: background .2s ease;
}

.table tbody tr:hover {
    background: #f8fbff;
}

.table tbody td {
    font-size: 14px;
    vertical-align: middle;
}

/* ===============================
   BADGE
=============================== */
.badge-group {
    background: #dbeafe;
    color: #1e40af;
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
}

/* ===============================
   EMPTY ROW
=============================== */
.empty-row {
    padding: 28px 0 !important;
    font-size: 15px;
    font-weight: 600;
    color: #b91c1c;
}
</style>

<div class="container-fluid px-4">

    <!-- TITLE -->
    <div class="page-title">Danh sách khách</div>

    <!-- ===============================
         FILTER
    =============================== -->
    <form method="get" id="tourFilterForm" class="mb-4">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewcustomers">
        <div class="col-12 col-lg-6 mb-2">
            <select class="form-select" name="departure_id" onchange="document.getElementById('tourFilterForm').submit()">
                <option value="0" hidden>--Chọn tour--</option>
                <?php foreach ($assignedTours as $tour): ?>
                    <option value="<?= $tour['departure_id'] ?>"
                        <?= (!empty($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tour['tour_name']) ?>
                        (<?= date('d/m', strtotime($tour['start_date'])) ?>
                        - <?= date('d/m', strtotime($tour['end_date'])) ?>)
                    </option>
                <?php endforeach; ?>

            </select>
        </div>
    </form>

    <!-- ===============================
         TABLE
    =============================== -->
    <div class="card">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th style="width:70px;">#</th>
                        <th class="ps-4">Tên khách</th>
                        <th>Liên hệ</th>
                        <th class="text-center">Nhóm</th>
                        <th>Yêu cầu đặc biệt</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($_GET['departure_id'])): ?>

                        <?php if (!empty($allCustomersData)): ?>
                            <?php foreach ($allCustomersData as $key => $customers): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>

                                    <td class="ps-4 fw-semibold">
                                        <?= htmlspecialchars($customers['guest_name']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($customers['customer_contact']) ?>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge-group">
                                            <?= htmlspecialchars($customers['group_type']) ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($customers['special_request'] ?? 'Không có') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center empty-row">
                                    Chưa có danh sách khách
                                </td>
                            </tr>
                        <?php endif; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center empty-row">
                                Vui lòng chọn tour để xem danh sách khách
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>
</div>