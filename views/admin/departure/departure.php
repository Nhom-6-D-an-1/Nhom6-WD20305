<div class="container-fluid px-4">

    <h3 class="mt-4 mb-3 ">Danh sách chuyến đi</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
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
                        <th width="150">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($data_departure)): ?>
                        <?php foreach ($data_departure as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>

                                <td><?= $value['tour_name'] ?> - <?= $value['version_name'] ?></td>

                                <td><?= $value['start_date'] ?></td>

                                <td><?= $value['end_date'] ?></td>

                                <td><?= $value['max_guests'] ?></td>

                                <td class="fw-bold">
                                    <?= (int)$value['max_guests'] - (int)$value['current_guests'] ?>
                                </td>

                                <td><?= number_format($value['actual_price'], 0, ',', '.') ?> VNĐ</td>

                                <td>
                                    <?= htmlspecialchars($value['pickup_location'] ?? '') ?>
                                    <br>
                                    <small class="text-muted"><?= $value['pickup_time'] ?></small>
                                </td>

                                <td>
                                    <?= $value['full_name']
                                        ? '<span class="text-success fw-semibold">' . $value['full_name'] . '</span>'
                                        : '<span class="text-muted">Chưa phân công</span>'
                                    ?>
                                </td>

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

                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>?mode=admin&action=departureEdit&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-warning btn-sm">
                                        Sửa
                                    </a>

                                    <a href="<?= BASE_URL ?>?mode=admin&action=departureDetail&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-primary btn-sm">
                                        Chi tiết
                                    </a>
                                    <a href="<?= BASE_URL ?>?mode=admin&action=createType&id=<?= $value['departure_id'] ?>"
                                        class="btn btn-success btn-sm mt-1">
                                        Thêm booking
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted">Chưa có chuyến đi nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>