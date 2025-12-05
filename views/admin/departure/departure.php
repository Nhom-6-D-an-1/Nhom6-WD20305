<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Danh sách chuyến đi</h3>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Ngày đi</th>
                <th>Ngày về</th>
                <th>Số chỗ</th>
                <th>Còn trống</th>
                <th>Giá bán</th>
                <th>Điểm đón</th>
                <th>HDV</th>
                <th>Trạng thái</th>
                <th width="140">Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($data_departure)): ?>
                <?php foreach ($data_departure as $dep): ?>
                    <tr>
                        <td><?= $dep['start_date'] ?></td>
                        <td><?= $dep['end_date'] ?></td>

                        <td><?= $dep['total_seats'] ?></td>
                        <td><?= $dep['available_seats'] ?></td>

                        <td><?= number_format($dep['actual_price'], 0, '', '.') ?> VNĐ</td>

                        <td><?= $dep['pickup_location'] ?> <br>
                            <small class="text-muted"><?= $dep['pickup_time'] ?></small>
                        </td>

                        <td><?= $dep['guide_name'] ?? '<span class="text-muted">Chưa phân công</span>' ?></td>

                        <td>
                            <?php if ($dep['status'] == 'open'): ?>
                                <span class="badge bg-success">Mở bán</span>
                            <?php elseif ($dep['status'] == 'full'): ?>
                                <span class="badge bg-danger">Full</span>
                            <?php elseif ($dep['status'] == 'closed'): ?>
                                <span class="badge bg-secondary">Đóng</span>
                            <?php else: ?>
                                <span class="badge bg-info">Hoàn thành</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="<?= BASE_URL ?>?mode=admin&action=departureEdit&id=<?= $dep['departure_id'] ?>"
                                class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <a href="<?= BASE_URL ?>?mode=admin&action=assignGuide&id=<?= $dep['departure_id'] ?>"
                                class="btn btn-primary btn-sm">
                                HDV
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">Chưa có chuyến đi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>