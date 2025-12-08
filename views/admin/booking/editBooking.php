<h3 class="fw-bold mb-4">Sửa booking</h3>

<div class="form-section">
    <form method="post" action="<?= BASE_URL ?>?mode=admin&action=updatebooking">

        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id'] ?? '') ?>">

        <div class="mb-3">
            <label class="form-label">Chọn lịch trình (departure):</label>
            <select name="departure_id" class="form-select" onchange="updatePrice(this)">
                <option value="">-- Chọn lịch trình --</option>
                <?php if (!empty($departures) && is_array($departures)): ?>
                    <?php foreach ($departures as $d): ?>
                        <option value="<?= htmlspecialchars((string)($d['departure_id'] ?? '')) ?>"
                            data-price="<?= htmlspecialchars((string)($d['price'] ?? 0)) ?>"
                            <?= ($d['departure_id'] ?? null) == ($booking['departure_id'] ?? null) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($d['version_name'] ?? ''); ?> - <?= htmlspecialchars($d['tour_name'] ?? ''); ?> (<?= !empty($d['start_date']) ? date('d/m/Y', strtotime($d['start_date'])) : 'N/A' ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên khách:</label>
            <input type="text" name="customer_name" class="form-control" placeholder="Nhập họ tên khách"
                value="<?= htmlspecialchars($booking['customer_name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">SĐT:</label>
            <input type="text" name="customer_contact" class="form-control" placeholder="090xxxxxxx"
                value="<?= htmlspecialchars($booking['customer_contact'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại khách:</label>
            <select name="customer_type" class="form-select">
                <option value="le" <?= ($booking['customer_type'] ?? '') === 'le' ? 'selected' : '' ?>>Khách lẻ</option>
                <option value="doan" <?= ($booking['customer_type'] ?? '') === 'doan' ? 'selected' : '' ?>>Khách đoàn</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tổng tiền:</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" placeholder="Nhập tổng tiền"
                value="<?= htmlspecialchars((string)($booking['total_amount'] ?? 0)) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <select name="status" class="form-select">
                <option value="pending" <?= ($booking['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Chưa thanh toán</option>
                <!-- <option value="deposit" <?= ($booking['status'] ?? '') === 'deposit' ? 'selected' : '' ?>>deposit</option> -->
                <option value="completed" <?= ($booking['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Đã thanh toán</option>
                <!-- <option value="cancelled" <?= ($booking['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>cancelled</option> -->
            </select>
        </div>

        <div class="mt-4 d-flex gap-3">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= htmlspecialchars($booking['booking_id'] ?? '') ?>" class="btn btn-secondary">Huỷ</a>
        </div>

    </form>
</div>

<script>
    function updatePrice(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const amountInput = document.querySelector('input[name="total_amount"]');
        if (price && price !== '0') {
            amountInput.value = price;
        }
    }
</script>