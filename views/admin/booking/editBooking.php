<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold mb-0">Sửa booking</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= htmlspecialchars($booking['booking_id'] ?? '') ?>"
           class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="post" action="<?= BASE_URL ?>?mode=admin&action=updatebooking">

                <input type="hidden" name="booking_id"
                       value="<?= htmlspecialchars($booking['booking_id'] ?? '') ?>">

                <!-- THÔNG TIN LỊCH TRÌNH -->
                <h5 class="fw-semibold text-primary mb-3">Lịch trình (Departure)</h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Chọn lịch trình:</label>
                    <select name="departure_id" class="form-select" onchange="updatePrice(this)">
                        <option value="">-- Chọn lịch trình --</option>

                        <?php if (!empty($departures)): ?>
                            <?php foreach ($departures as $d): ?>
                                <option value="<?= htmlspecialchars((string)($d['departure_id'])) ?>"
                                        data-price="<?= htmlspecialchars((string)($d['price'])) ?>"
                                    <?= ($d['departure_id'] == ($booking['departure_id'] ?? null)) ? 'selected' : '' ?>>

                                    <?= htmlspecialchars($d['version_name'] ?? '') ?>
                                    -
                                    <?= htmlspecialchars($d['tour_name'] ?? '') ?>
                                    (<?= !empty($d['start_date']) ? date('d/m/Y', strtotime($d['start_date'])) : 'N/A' ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- THÔNG TIN KHÁCH -->
                <h5 class="fw-semibold text-primary mt-4 mb-3">Thông tin khách</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tên khách</label>
                        <input type="text" name="customer_name" class="form-control" required
                               placeholder="Nhập họ tên"
                               value="<?= htmlspecialchars($booking['customer_name'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">SĐT</label>
                        <input type="text" name="customer_contact" class="form-control" required
                               placeholder="090xxxxxxx"
                               value="<?= htmlspecialchars($booking['customer_contact'] ?? '') ?>">
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Loại khách</label>
                    <select name="customer_type" class="form-select">
                        <option value="le" <?= ($booking['customer_type'] ?? '') === 'le' ? 'selected' : '' ?>>Khách lẻ</option>
                        <option value="doan" <?= ($booking['customer_type'] ?? '') === 'doan' ? 'selected' : '' ?>>Khách đoàn</option>
                    </select>
                </div>

                <!-- THANH TOÁN -->
                <h5 class="fw-semibold text-primary mt-4 mb-3">Thanh toán</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tổng tiền</label>
                        <input type="number" name="total_amount" class="form-control" step="0.01"
                               placeholder="Nhập tổng tiền"
                               value="<?= htmlspecialchars((string)($booking['total_amount'] ?? 0)) ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="pending" <?= ($booking['status'] ?? '') === 'pending' ? 'selected' : '' ?>>
                                Chưa thanh toán
                            </option>
                            <option value="completed" <?= ($booking['status'] ?? '') === 'completed' ? 'selected' : '' ?>>
                                Đã thanh toán
                            </option>
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-success px-4">Cập nhật</button>
                    <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= htmlspecialchars($booking['booking_id']) ?>"
                       class="btn btn-secondary px-4">
                        Hủy
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- AUTO PRICE SCRIPT -->
<script>
    function updatePrice(selectElement) {
        const selected = selectElement.options[selectElement.selectedIndex];
        const price = selected.getAttribute('data-price');
        if (!price || price === '0') return;

        document.querySelector('input[name="total_amount"]').value = price;
    }
</script>
