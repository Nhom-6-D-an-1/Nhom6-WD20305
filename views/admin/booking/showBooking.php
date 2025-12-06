<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Chi tiết booking</h3>

    <?php if (!empty($booking)): ?>

    <div class="row">

        <!-- ============================
             THÔNG TIN KHÁCH HÀNG
        ============================ -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin khách hàng</h5>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Mã booking:</label>
                            <p><?= htmlspecialchars($booking['booking_id']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Trạng thái:</label>
                            <?php
                                $status = $booking['status'];
                                $badge_class = match($status) {
                                    'pending'   => 'bg-warning',
                                    'deposit'   => 'bg-info',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    default     => 'bg-secondary'
                                };
                            ?>
                            <p><span class="badge <?= $badge_class ?>"><?= htmlspecialchars($status) ?></span></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Tên khách:</label>
                            <p><?= htmlspecialchars($booking['customer_name']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Liên hệ:</label>
                            <p><?= htmlspecialchars($booking['customer_contact']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Loại khách:</label>
                            <?php
                                $type = $booking['customer_type'];
                                $typeText = ($type === 'doan') ? 'Khách đoàn' : 'Khách lẻ';
                                $typeColor = ($type === 'doan') ? 'bg-primary' : 'bg-secondary';
                            ?>
                            <p><span class="badge <?= $typeColor ?>"><?= $typeText ?></span></p>
                        </div>
                    </div>

                    <div>
                        <label class="fw-bold">Ngày tạo booking:</label>
                        <p><?= !empty($booking['created_at']) ? date('d/m/Y H:i:s', strtotime($booking['created_at'])) : 'N/A' ?></p>
                    </div>

                </div>
            </div>

            <!-- ============================
                 THÔNG TIN TOUR
            ============================ -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Thông tin tour</h5>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Tên tour:</label>
                            <p><?= htmlspecialchars($booking['tour_name']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Danh mục:</label>
                            <p><?= htmlspecialchars($booking['category_name']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Phiên bản tour:</label>
                            <p><?= htmlspecialchars($booking['version_name']) ?></p>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Ngày khởi hành:</label>
                            <p><?= date('d/m/Y', strtotime($booking['start_date'])) ?></p>
                        </div>
                    </div>

                    <label class="fw-bold">Mô tả tour:</label>
                    <p><?= htmlspecialchars($booking['description']) ?></p>
                </div>
            </div>

            <!-- ============================
                 DANH SÁCH KHÁCH
            ============================ -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Danh sách khách</h5>
                </div>

                <div class="card-body">

                    <?php if (!empty($guests)): ?>
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Giới tính</th>
                                    <th>Năm sinh</th>
                                    <th>SĐT</th>
                                    <th>Yêu cầu đặc biệt</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($guests as $g): ?>
                                <tr>
                                    <td><?= htmlspecialchars((string)($g['full_name'] ?? '')) ?></td>
                                    <td><?= htmlspecialchars((string)($g['gender'] ?? '')) ?></td>
                                    <td><?= htmlspecialchars((string)($g['birth_year'] ?? '')) ?></td>
                                    <td><?= htmlspecialchars((string)($g['phone'] ?? '')) ?></td>

                                    <td>
                                        <?php 
                                            $sr = $g['special_request'] ?? null;

                                            echo !empty($sr) 
                                                ? htmlspecialchars((string)$sr)
                                                : '<i>Không có</i>';
                                        ?>
                                    </td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p class="text-muted"><i>Chưa có khách nào trong booking này.</i></p>
                    <?php endif; ?>

                </div>
            </div>

        </div>

        <!-- ============================
             CỘT CHI PHÍ
        ============================ -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Chi phí</h5>
                </div>

                <div class="card-body">
                    <label class="fw-bold">Giá tour:</label>
                    <p><?= number_format($booking['price'], 0, ',', '.') ?> VNĐ</p>

                    <label class="fw-bold">Tổng tiền:</label>
                    <p class="text-danger fs-5 fw-bold">
                        <?= number_format($booking['total_amount'], 0, ',', '.') ?> VNĐ
                    </p>

                    <hr>

                    <div class="d-grid gap-3">
                        <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= $booking['booking_id'] ?>" class="btn btn-warning">
                            Chỉnh sửa
                        </a>

                        <a href="<?= BASE_URL ?>?mode=admin&action=viewsbooking" class="btn btn-secondary">
                            Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php else: ?>
        <div class="alert alert-danger">
            Booking không tồn tại!
            <a href="?mode=admin&action=viewsbooking" class="btn btn-sm btn-secondary mt-2">Quay lại</a>
        </div>
    <?php endif; ?>
</div>
