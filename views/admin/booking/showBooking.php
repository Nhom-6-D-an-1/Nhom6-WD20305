<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Chi tiết booking</h3>

    <?php if ($booking): ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin khách hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Mã booking:</label>
                            <p><?= htmlspecialchars($booking['booking_id'] ?? '') ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Trạng thái:</label>
                            <p>
                                <?php
                                    $status = $booking['status'] ?? 'pending';
                                    $badge_class = match($status) {
                                        'pending' => 'bg-warning',
                                        'deposit' => 'bg-info',
                                        'completed' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                ?>
                                <span class="badge <?= $badge_class ?>"><?= htmlspecialchars($status) ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Tên khách:</label>
                            <p><?= htmlspecialchars($booking['customer_name'] ?? '') ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Số điện thoại:</label>
                            <p><?= htmlspecialchars($booking['customer_contact'] ?? '') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Loại khách:</label>
                        <p>
                        <?php
                            $type = $booking['customer_type'] ?? 'le';
                            $typeText = ($type === 'doan') ? 'Khách đoàn' : 'Khách lẻ';
                            $badgeType = ($type === 'doan') ? 'bg-primary' : 'bg-secondary';
                        ?>
                        <span class="badge <?= $badgeType ?>"><?= $typeText ?></span>
                        </p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="fw-bold">Ngày tạo booking:</label>
                            <p><?= !empty($booking['created_at']) ? date('d/m/Y H:i:s', strtotime($booking['created_at'])) : 'N/A' ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Thông tin tour</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Tên tour:</label>
                            <p><?= htmlspecialchars($booking['tour_name'] ?? 'N/A') ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Danh mục:</label>
                            <p><?= htmlspecialchars($booking['category_name'] ?? 'N/A') ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Phiên bản tour:</label>
                            <p><?= htmlspecialchars($booking['version_name'] ?? 'N/A') ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Ngày khởi hành:</label>
                            <p><?= !empty($booking['start_date']) ? date('d/m/Y', strtotime($booking['start_date'])) : 'N/A' ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="fw-bold">Mô tả tour:</label>
                            <p><?= htmlspecialchars($booking['description'] ?? 'Không có mô tả') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Chi phí</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Giá tour:</label>
                        <p class="fs-6"><?= !empty($booking['price']) ? number_format($booking['price'], 0, ',', '.') . ' VNĐ' : 'N/A' ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Tổng tiền:</label>
                        <p class="fs-5 text-danger fw-bold"><?= number_format($booking['total_amount'] ?? 0, 0, ',', '.') ?> VNĐ</p>
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= $booking['booking_id'] ?>" class="btn btn-warning">Chỉnh sửa</a>
                        <a href="<?= BASE_URL ?>?mode=admin&action=deletebooking&id=<?= $booking['booking_id'] ?>" 
                           onclick="return confirm('Bạn có chắc muốn xóa booking này?')"
                           class="btn btn-danger">Xóa</a>
                        <a href="<?= BASE_URL ?>?mode=admin&action=viewsbooking" class="btn btn-secondary">Quay lại</a>
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
