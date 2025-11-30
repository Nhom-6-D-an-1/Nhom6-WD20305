<div class="col-md-10 p-4">

    <h3 class="mb-4">Danh sách khách: <?= htmlspecialchars($tourName) ?></h3>

    <div class="card p-4">

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">STT</th>
                    <th style="width: 180px;">Tên khách</th>
                    <th style="width: 150px;">Liên hệ</th>
                    <!-- <th style="width: 80px;">Giới tính</th>
                    <th style="width: 100px;">Năm sinh</th> -->
                    <th style="width: 120px;">Tình trạng</th>
                    <th style="width: 180px;">Yêu cầu</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                if (!empty($guests)): 
                    $stt = 1;
                    foreach ($guests as $item): 
                ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= htmlspecialchars($item['customer_name']) ?></td>
                    <td><?= htmlspecialchars($item['customer_contact']) ?></td>

                    <!-- Giới tính -->
                    <!-- <td>
                        <?= !empty($item['gender']) ? htmlspecialchars($item['gender']) : "—" ?>
                    </td> -->

                    <!-- Năm sinh -->
                    <!-- <td>
                        <?= !empty($item['birth_year']) ? htmlspecialchars($item['birth_year']) : "—" ?>
                    </td> -->

                    <!-- Tình trạng thanh toán -->
                    <td>
                        <?php if ($item['status'] == "paid"): ?>
                            <span class="badge bg-success">Đã cọc</span>
                        <?php elseif ($item['status'] == "pending"): ?>
                            <span class="badge bg-warning text-dark">Chưa thanh toán</span>
                        <?php elseif ($item['status'] == "deposit"): ?>
                            <span class="badge bg-primary">Đã cọc</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Không rõ</span>
                        <?php endif; ?>
                    </td>

                    <!-- Yêu cầu đặc biệt -->
                    <td><?= htmlspecialchars($item['special_request'] ?? "Không có") ?></td>
                </tr>
                <?php endforeach; else: ?>
                
                <tr>
                    <td colspan="7" class="text-center text-muted">Chưa có khách</td>
                </tr>

                <?php endif; ?>
            </tbody>
        </table>

        <a href="?mode=admin&action=viewtourdetail&id=<?= $tour_id ?>" 
        class="btn btn-secondary mt-3">
        Quay lại
        </a>

    </div>
</div>
