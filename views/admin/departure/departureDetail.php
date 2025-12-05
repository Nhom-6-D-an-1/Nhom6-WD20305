<div class="container mt-4">

    <h3>Chi tiết chuyến đi</h3>
    <p class="text-muted"><?= $data_departure['tour_name'] ?> → <?= $data_departure['version_name'] ?></p>

    <table class="table table-bordered">
        <tr>
            <th>Ngày đi</th>
            <td><?= $data_departure['start_date'] ?></td>
        </tr>
        <tr>
            <th>Ngày về</th>
            <td><?= $data_departure['end_date'] ?></td>
        </tr>
        <tr>
            <th>Giá bán</th>
            <td><?= number_format($data_departure['actual_price']) ?>đ</td>
        </tr>
        <tr>
            <th>Số khách</th>
            <td><?= $data_departure['current_guests'] ?>/<?= $data_departure['max_guests'] ?></td>
        </tr>
        <tr>
            <th>Điểm đón</th>
            <td><?= $data_departure['pickup_location'] ?></td>
        </tr>
        <tr>
            <th>Giờ đón</th>
            <td><?= $data_departure['pickup_time'] ?></td>
        </tr>
        <tr>
            <th>Ghi chú</th>
            <td><?= $data_departure['note'] ?></td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td><?php if ($data_departure['status'] == 'open'): ?>
                    <span class="badge bg-success">Mở bán</span>
                <?php elseif ($data_departure['status'] == 'full'): ?>
                    <span class="badge bg-danger">Full</span>
                <?php elseif ($data_departure['status'] == 'closed'): ?>
                    <span class="badge bg-secondary">Đóng</span>
                <?php else: ?>
                    <span class="badge bg-info">Hoàn thành</span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-secondary">Quay lại</a>
    <a href="<?= BASE_URL ?>?mode=admin&action=viewAssignments&departure_id=<?= $data_departure['departure_id'] ?>" class="btn btn-primary">
        Phân công nhân sự
    </a>


</div>