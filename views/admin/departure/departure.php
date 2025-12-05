<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Danh sách chuyến đi</h3>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên chuyến đi</th>
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
                <?php foreach ($data_departure as $key => $value): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['tour_name'] ?></td>
                        <td><?= $value['start_date'] ?></td>
                        <td><?= $value['end_date'] ?></td>
                        <td><?= $value['max_guests'] ?></td>
                        <td><?= (int)$value['max_guests'] -  (int)$value['current_guests'] ?></td>
                        <td><?= number_format($value['actual_price'], 0, '', '.') ?> VNĐ</td>
                        <td><?= $value['pickup_location'] ?> <br>
                            <small class="text-muted"><?= $value['pickup_time'] ?></small>
                        </td>
                        <td><?= $value['guide_name'] ?? '<span class="text-muted">Chưa phân công</span>' ?></td>
                        <td>
                            <?php if ($value['status'] == 'open'): ?>
                                <span class="badge bg-success">Mở bán</span>
                            <?php elseif ($value['status'] == 'full'): ?>
                                <span class="badge bg-danger">Full</span>
                            <?php elseif ($value['status'] == 'closed'): ?>
                                <span class="badge bg-secondary">Đóng</span>
                            <?php else: ?>
                                <span class="badge bg-info">Hoàn thành</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>?mode=admin&action=departureEdit&id=<?= $value['departure_id'] ?>"
                                class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <a href="<?= BASE_URL ?>?mode=admin&action=departureDetail&id=<?= $value['departure_id'] ?>"
                                class="btn btn-primary btn-sm">
                                Chi tiết
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