<style>
/* ===============================
   PAGE TITLE
=============================== */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 6px 0 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===============================
   FILTER CARD
=============================== */
.filter-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px 26px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

.filter-card .form-select,
.filter-card .form-control {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
}

/* ===============================
   TABLE
=============================== */
.tour-table thead th {
    background: transparent !important;
    color: #6b7280;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .4px;
    border-bottom: 1px solid #e5e7eb !important;
}

.tour-table tbody tr {
    border-bottom: 1px solid #f1f1f1;
    transition: background .2s ease;
}

.tour-table tbody tr:hover {
    background: #f8fbff;
}

.tour-table td {
    font-size: 14px;
    padding: 14px 16px !important;
    vertical-align: middle;
}

/* ===============================
   STATUS BADGE
=============================== */
.badge-sap-toi {
    background: #dbeafe;
    color: #1e40af;
}
.badge-dang-dien-ra {
    background: #fef3c7;
    color: #92400e;
}
.badge-hoan-tat {
    background: #d1fae5;
    color: #065f46;
}

/* ===============================
   BUTTON
=============================== */
.btn-action {
    padding: 6px 14px !important;
    border-radius: 8px !important;
    font-weight: 600;
    font-size: 14px;
    border: none;
}

.btn-view {
    background: #dbeafe;
    color: #1e40af;
}

.btn-checkin {
    background: #dcfce7;
    color: #166534;
}

.btn-view:hover { background: #bfdbfe; }
.btn-checkin:hover { background: #bbf7d0; }
</style>

<?php
$today = today();

$filteredSchedule = array_filter($scheduleData, function ($tour) use ($today) {

    $status = ($tour['end_date'] < $today)
        ? 'HoanTat'
        : (($tour['start_date'] > $today) ? 'SapToi' : 'DangDienRa');

    // Lần đầu vào: chỉ hiển thị sắp tới + đang diễn ra
    if (
        empty($_GET['start_date']) &&
        empty($_GET['status'])
    ) {
        return in_array($status, ['SapToi', 'DangDienRa']);
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
    }

    if (!empty($_GET['start_date'])) {
        $match = $match && ($tour['start_date'] == $_GET['start_date']);
    }

    if (!empty($_GET['status'])) {
        $match = $match && ($status == $_GET['status']);
    }
</style>


<!-- ====================== PAGE CONTENT ====================== -->

<div class="col-12">

    <!-- TITLE -->
    <div class="page-title">Tour của tôi</div>

    <!-- FILTER -->
    <div class="filter-card mb-4">
        <form class="row g-3 align-items-center"
              method="get"
              action="<?= BASE_URL ?>"
              onsubmit="return validateSearchForm()">

            <input type="hidden" name="mode" value="guide">
            <input type="hidden" name="action" value="viewSchedule">

            <div class="col-lg-5">
                <input type="date"
                       class="form-control"
                       name="start_date"
                       value="<?= $_GET['start_date'] ?? '' ?>">
            </div>

            <div class="col-lg-5">
                <select class="form-select" name="status">
                    <option value="">Tất cả trạng thái</option>
                    <option value="SapToi" <?= ($_GET['status'] ?? '') == 'SapToi' ? 'selected' : '' ?>>Sắp tới</option>
                    <option value="DangDienRa" <?= ($_GET['status'] ?? '') == 'DangDienRa' ? 'selected' : '' ?>>Đang diễn ra</option>
                    <option value="HoanTat" <?= ($_GET['status'] ?? '') == 'HoanTat' ? 'selected' : '' ?>>Hoàn tất</option>
                </select>
            </div>

            <div class="col-lg-2">
                <button class="btn btn-primary w-100">Tìm kiếm</button>
            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="card">
        <div class="table-responsive">
            <table class="table tour-table align-middle mb-0">

                <thead>
                    <tr>
                        <th class="ps-4">Mã tour</th>
                        <th>Tên tour</th>
                        <th>Khởi hành</th>
                        <th>Số khách</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($filteredSchedule)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-danger fw-semibold">
                                Không có tour phù hợp
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($filteredSchedule as $tour): ?>

                            <?php
                            if ($tour['end_date'] < $today) {
                                $statusText = 'Hoàn tất';
                                $badge = 'badge-hoan-tat';
                            } elseif ($tour['start_date'] > $today) {
                                $statusText = 'Sắp tới';
                                $badge = 'badge-sap-toi';
                            } else {
                                $statusText = 'Đang diễn ra';
                                $badge = 'badge-dang-dien-ra';
                            }
                            ?>

                            <tr>
                                <td class="ps-4"><?= $tour['departure_id'] ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($tour['tour_name']) ?></td>
                                <td><?= date('d/m/Y', strtotime($tour['start_date'])) ?></td>
                                <td><?= $tour['max_guests'] ?> khách</td>
                                <td>
                                    <span class="px-3 py-1 rounded <?= $badge ?>">
                                        <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="text-center d-flex justify-content-center gap-2">
                                    <a class="btn btn-view btn-action"
                                       href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $tour['departure_id'] ?>">
                                        Xem
                                    </a>
                                    <a class="btn btn-checkin btn-action"
                                       href="<?= BASE_URL ?>?mode=guide&action=viewcheckin&id=<?= $tour['departure_id'] ?>">
                                        Check-in
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- VALIDATE -->
<script>
function validateSearchForm() {
    const startDate = document.querySelector('input[name="start_date"]').value;
    const status = document.querySelector('select[name="status"]').value;

    if (startDate === "" && status === "") {
        alert("Vui lòng chọn ít nhất 1 điều kiện để tìm kiếm");
        return false;
    }
    return true;
}
</script>
