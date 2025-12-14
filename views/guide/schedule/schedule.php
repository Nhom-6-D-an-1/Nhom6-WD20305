<?php
$today = today();

$filteredSchedule = array_filter($scheduleData, function ($tour) use ($today) {

    $status = ($tour['end_date'] < $today)
        ? 'HoanTat'
        : (($tour['start_date'] > $today) ? 'SapToi' : 'DangDienRa');

    // Lần đầu vào trang: không có filter => hiển thị Sắp tới + Đang diễn ra
    if (
        !isset($_GET['start_date']) &&
        !isset($_GET['status']) &&
        !isset($_GET['departure_id'])
    ) {
        return ($status == 'SapToi' || $status == 'DangDienRa');
    }

    $match = true;

    // Lọc theo tour
    if (!empty($_GET['departure_id']) && $_GET['departure_id'] != 0) {
        $match = $match && ($tour['departure_id'] == $_GET['departure_id']);
    }

    // Lọc theo ngày
    if (!empty($_GET['start_date'])) {
        $match = $match && ($tour['start_date'] == $_GET['start_date']);
    }

    // Lọc theo trạng thái
    if (!empty($_GET['status'])) {
        $match = $match && ($status == $_GET['status']);
    }

    return $match;
});
?>

<!-- ====================== STYLE PREMIUM ====================== -->
<style>
    .page-title {
        font-size: 30px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 20px;
    }

    .premium-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        padding: 22px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    .form-control,
    .form-select {
        border-radius: 10px !important;
        padding: 10px 14px !important;
        border: 1px solid #d1d5db !important;
    }

    /* Button tìm kiếm */
    .btn-search {
        background: #dbeafe !important;
        color: #1e40af !important;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-search:hover {
        background: #bfdbfe !important;
    }

    /* Button xem */
    .btn-view {
        background: #dbeafe !important;
        color: #1e40af !important;
        font-weight: 600;
        border-radius: 10px;
        padding: 6px 14px;
        border: none;
    }

    .btn-view:hover {
        background: #bfdbfe !important;
    }

    /* Button Checkin */
    .btn-checkin {
        background: #dcfce7 !important;
        color: #166534 !important;
        font-weight: 600;
        border-radius: 10px;
        padding: 6px 14px;
        border: none;
    }

    .btn-checkin:hover {
        background: #bbf7d0 !important;
    }

    /* Table */
    .table thead th {
        background: #fafafa !important;
        color: #6b7280 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        padding: 14px;
        border-bottom: 1px solid #e5e7eb !important;
    }

    .table tbody tr:hover {
        background: #f9fafb !important;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
    }

    /* Sắp tới – pastel vàng */
    .badge-sap-toi {
        border-color: #fde68a !important;
        background: #fef9c3 !important;
        color: #b45309 !important;
    }

    /* Đang diễn ra – pastel xanh lá */
    .badge-dang-dien-ra {
        border-color: #bbf7d0 !important;
        background: #dcfce7 !important;
        color: #166534 !important;
    }

    /* Hoàn tất – xám nhẹ */
    .badge-hoan-tat {
        background: #e5e7eb !important;
        color: #374151 !important;
    }
</style>


<!-- ====================== PAGE CONTENT ====================== -->

<div class="col-12">

    <h2 class="page-title">Tour của tôi</h2>

    <!-- FORM TÌM KIẾM -->
    <div class="premium-card mb-4">
        <form class="row g-3" method="get" action="<?= BASE_URL ?>" onsubmit="return validateSearchForm()">

            <input type="hidden" name="mode" value="guide">
            <input type="hidden" name="action" value="viewSchedule">

            <!-- Ngày -->
            <div class="col-lg-5 col-md-6">
                <input type="date" class="form-control" name="start_date"
                    value="<?= $_GET['start_date'] ?? '' ?>">
            </div>

            <!-- Trạng thái -->
            <div class="col-lg-5 col-md-6">
                <select class="form-select" name="status">
                    <option value="">Tất cả trạng thái</option>
                    <option value="SapToi" <?= (@$_GET['status'] == 'SapToi') ? 'selected' : '' ?>>Sắp tới</option>
                    <option value="DangDienRa" <?= (@$_GET['status'] == 'DangDienRa') ? 'selected' : '' ?>>Đang diễn ra</option>
                    <option value="HoanTat" <?= (@$_GET['status'] == 'HoanTat') ? 'selected' : '' ?>>Hoàn tất</option>
                </select>
            </div>

            <!-- Nút -->
            <div class="col-lg-2 col-md-6 d-grid">
                <button class="btn btn-search">Tìm kiếm</button>
            </div>

        </form>
    </div>


    <!-- TABLE LIST -->
    <div class="premium-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Mã tour</th>
                        <th>Tour</th>
                        <th>Ngày khởi hành</th>
                        <th>Số khách</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($filteredSchedule)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger py-3">
                                Sắp tới bạn không có tour nào cần dẫn.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($filteredSchedule as $value): ?>

                            <?php
                            if ($value['end_date'] < $today) {
                                $status = "Hoàn tất";
                                $statusClass = "badge-hoan-tat";
                            } elseif ($value['start_date'] > $today) {
                                $status = "Sắp tới";
                                $statusClass = "badge-sap-toi";
                            } else {
                                $status = "Đang diễn ra";
                                $statusClass = "badge-dang-dien-ra";
                            }
                            ?>

                            <tr>
                                <td><?= $value['departure_id'] ?></td>
                                <td class="fw-semibold"><?= $value['tour_name'] ?></td>
                                <td><?= date('d/m/Y', strtotime($value['start_date'])) ?></td>
                                <td><?= $value['max_guests'] ?> khách</td>

                                <td>
                                    <span class="badge-status <?= $statusClass ?>">
                                        <?= $status ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-view btn-sm">Xem</a>

                                    <a href="<?= BASE_URL ?>?mode=guide&action=viewcheckin&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-checkin btn-sm">Checkin</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<script>
    function validateSearchForm() {
        const departureId = document.querySelector('select[name="departure_id"]').value;
        const startDate = document.querySelector('input[name="start_date"]').value;
        const status = document.querySelector('select[name="status"]').value;

        if ((departureId == "0" || departureId == "") && startDate == "" && status == "") {
            alert("Vui lòng chọn ít nhất 1 trường để tìm kiếm");
            return false; // chặn submit
        }
        return true; // cho phép submit
    }
</script>

<!-- VALIDATE -->
<!-- <script>
    function validateSearchForm() {
        const date = document.querySelector('input[name="start_date"]').value;
        const status = document.querySelector('select[name="status"]').value;

        if (!date && !status) {
            alert("Vui lòng chọn ít nhất 1 trường để tìm kiếm.");
            return false;
        }
        return true;
    }
</script> -->