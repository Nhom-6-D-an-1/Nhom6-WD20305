<style>
    /* --- TITLE --- */
    .title-main {
        font-size: 1.6rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 18px;
    }

    /* --- FILTER CARD --- */
    .filter-card {
        border-radius: 14px;
        background: #fff;
        padding: 24px 26px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.07);
    }

    .filter-card .form-select,
    .filter-card .form-control {
        border-radius: 10px !important;
        padding: 10px 14px !important;
        box-shadow: 0 1px 5px rgba(0,0,0,0.05);
    }

    /* --- TABLE --- */
    .tour-table thead {
        background: #f8f9fa !important;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .tour-table tbody tr:hover {
        background: #f4f9ff;
        transition: 0.25s ease;
    }

    .tour-table td {
        padding: 14px 18px !important;
        font-size: 0.95rem;
    }

    /* --- BADGES --- */
    .badge-sap-toi {
        background: #0d6efd;
    }
    .badge-dang-dien-ra {
        background: #ffc107;
        color: #000 !important;
    }
    .badge-hoan-tat {
        background: #198754;
    }

    /* --- BUTTONS --- */
    .btn-action {
        padding: 6px 14px !important;
        border-radius: 8px !important;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .btn-view {
        background: #0d6efd;
        border: none;
    }

    .btn-checkin {
        background: #198754;
        border: none;
    }

    .btn-view:hover,
    .btn-checkin:hover {
        opacity: 0.85;
    }
</style>

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

<div class="col-12">
    <h2 class="">Tour của tôi</h2>

    <!-- Form tìm kiếm -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-center" method="get" action="<?= BASE_URL ?>" onsubmit="return validateSearchForm()">
                <input type="hidden" name="mode" value="guide">
                <input type="hidden" name="action" value="viewSchedule">
                <!-- Chọn tour -->
                <!-- <div class="col-lg-4 col-md-6">
                    <select class="form-select" name="departure_id">
                        <option value="0" hidden>--Chọn tour--</option>
                        <?php foreach ($assignedTours as $tour): ?>
                            <option value="<?= $tour['departure_id'] ?>"
                                <?= (isset($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : '' ?>>
                                <?= $tour['tour_name'] ?> (<?= date('d/m/Y', strtotime($tour['start_date'])) ?> - <?= date('d/m/Y', strtotime($tour['end_date'])) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> -->

                <!-- Ngày -->
                <div class="col-lg-5 col-md-6">
                    <input type="date" class="form-control" name="start_date" value="<?= $_GET['start_date'] ?? '' ?>">
                </div>

                <!-- Trạng thái -->
                <div class="col-lg-5 col-md-6">
                    <select class="form-select" name="status">
                        <option value="">Tất cả trạng thái</option>
                        <option value="SapToi" <?= (isset($_GET['status']) && $_GET['status'] == 'SapToi') ? 'selected' : '' ?>>Sắp tới</option>
                        <option value="DangDienRa" <?= (isset($_GET['status']) && $_GET['status'] == 'DangDienRa') ? 'selected' : '' ?>>Đang diễn ra</option>
                        <option value="HoanTat" <?= (isset($_GET['status']) && $_GET['status'] == 'HoanTat') ? 'selected' : '' ?>>Hoàn tất</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 tour-table">

                    <thead>
                        <tr>
                            <th class="ps-4">Mã tour</th>
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
                                <td colspan="6" class="text-center py-4 text-danger">Không có tour nào.</td>
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
                                    <td class="ps-4"><?= $value['departure_id'] ?></td>
                                    <td><?= $value['tour_name'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($value['start_date'])) ?></td>
                                    <td><?= $value['max_guests'] ?> khách</td>

                                    <td>
                                        <span class="px-2 py-1 rounded text-white <?= $statusClass ?>">
                                            <?= $status ?>
                                        </span>
                                    </td>

                                    <td class="text-center d-flex justify-content-center gap-2">

                                        <a class="btn btn-view btn-action"
                                           href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $value['departure_id'] ?>">
                                            Xem
                                        </a>

                                        <a class="btn btn-checkin btn-action"
                                           href="<?= BASE_URL ?>?mode=guide&action=viewcheckin&id=<?= $value['departure_id'] ?>">
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