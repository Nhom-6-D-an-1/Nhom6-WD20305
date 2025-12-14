<h3 class="fw-bold mb-4">Sửa booking</h3>

<div class="form-section">
    <form method="post" action="<?= BASE_URL ?>?mode=admin&action=updatebooking" onsubmit="return validateForm()">

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
            <small class="text-danger" id="departureError"></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên khách:</label>
            <input type="text" name="customer_name" class="form-control" placeholder="Nhập họ tên khách"
                value="<?= htmlspecialchars($booking['customer_name'] ?? '') ?>">
             <small class="text-danger" id="nameError"></small>
        </div>

        <div class="mb-3">
            <label class="form-label">SĐT:</label>
            <input type="text" name="customer_contact" class="form-control" placeholder="090xxxxxxx"
                value="<?= htmlspecialchars($booking['customer_contact'] ?? '') ?>">
            <small class="text-danger" id="phoneError"></small>
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
            <small class="text-danger" id="amountError"></small>
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
function validateForm() {
    let ok = true;

    const departure = document.querySelector('[name="departure_id"]');
    const name = document.querySelector('[name="customer_name"]');
    const phone = document.querySelector('[name="customer_contact"]');
    const amount = document.querySelector('[name="total_amount"]');

    const depErr = document.getElementById('departureError');
    const nameErr = document.getElementById('nameError');
    const phoneErr = document.getElementById('phoneError');
    const amountErr = document.getElementById('amountError');

    depErr.innerHTML = nameErr.innerHTML = phoneErr.innerHTML = amountErr.innerHTML = "";

    if (departure.value === "") {
        depErr.innerHTML = "Vui lòng chọn lịch trình";
        ok = false;
    }

    if (name.value.trim() === "" || !/[a-zA-ZÀ-ỹ]/.test(name.value)) {
        nameErr.innerHTML = "Tên không hợp lệ";
        ok = false;
    }

    if (!/^0\d{9}$/.test(phone.value)) {
        phoneErr.innerHTML = "SĐT không hợp lệ";
        ok = false;
    }

    if (amount.value !== "" && Number(amount.value) < 0) {
        amountErr.innerHTML = "Tổng tiền phải ≥ 0";
        ok = false;
    }

    return ok;
}
</script>