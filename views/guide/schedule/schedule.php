<?php
$today = date('Y-m-d');

// Lọc dữ liệu dựa trên GET
$filteredSchedule = array_filter($scheduleData, function ($tour) use ($today) {
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
        $status = ($tour['end_date'] < $today) ? 'HoanTat' : (($tour['start_date'] > $today) ? 'SapToi' : 'DangDienRa');
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
            <form class="row g-3 align-items-center" method="get" action="<?= BASE_URL ?>">
                <input type="hidden" name="mode" value="guide">
                <input type="hidden" name="action" value="viewSchedule">
                <!-- Chọn tour -->
                <div class="col-lg-4 col-md-6">
                    <select class="form-select" name="departure_id">
                        <option value="0" hidden>--Chọn tour--</option>
                        <?php foreach ($assignedTours as $tour): ?>
                            <option value="<?= $tour['departure_id'] ?>"
                                <?= (isset($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : '' ?>>
                                <?= $tour['tour_name'] ?> (<?= date('d/m/Y', strtotime($tour['start_date'])) ?> - <?= date('d/m/Y', strtotime($tour['end_date'])) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Ngày -->
                <div class="col-lg-3 col-md-6">
                    <input type="date" class="form-control" name="start_date" value="<?= $_GET['start_date'] ?? '' ?>">
                </div>

                <!-- Trạng thái -->
                <div class="col-lg-3 col-md-6">
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

    <!-- Bảng danh sách tour -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
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
                                <td colspan="6" class="text-center">Không có tour nào.</td>
                            </tr>
                        <?php elseif(!isset($_GET['departure_id'])) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Vui lòng chọn tour.</td>
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
                                    <td><?= $value['tour_name'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($value['start_date'])) ?></td>
                                    <td><?= $value['max_guests'] ?> khách</td>
                                    <td><span class="px-2 rounded text-white <?= $statusClass ?>"><?= $status ?></span></td>
                                    <td class="text-center">
                                        <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $value['departure_id'] ?>" class="btn btn-primary">Xem</a>
                                        <a href="<?= BASE_URL ?>?mode=guide&action=viewcheckin&id=<?= $value['departure_id'] ?>" class="btn btn-success">Checkin</a>
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