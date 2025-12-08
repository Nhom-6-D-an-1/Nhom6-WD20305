<h3 class="fw-bold mb-4">Thêm booking</h3>

<div class="form-section">

    <!-- Form chỉ dùng để chọn departure → chuyển sang createType -->
    <form method="get" action="<?= BASE_URL ?>">

        <!-- Các tham số điều hướng -->
        <input type="hidden" name="mode" value="admin">
        <input type="hidden" name="action" value="createType"> <!-- FIX tên action -->

        <!-- CHỌN DEPARTURE -->
        <div class="mb-3">
            <label class="form-label">Chọn lịch trình (departure):</label>
            <select name="departure_id" class="form-select" required>
                <option value="">-- Chọn lịch trình --</option>

                <?php if (!empty($departures) && is_array($departures)): ?>
                    <?php foreach ($departures as $d): ?>
                        <option
                            value="<?= htmlspecialchars((string)($d['departure_id'] ?? '')) ?>"
                            data-price="<?= htmlspecialchars((string)($d['price'] ?? 0)) ?>">
                            <?= htmlspecialchars($d['version_name'] ?? '') ?> -
                            <?= htmlspecialchars($d['tour_name'] ?? '') ?>
                            (<?= !empty($d['start_date']) ? date('d/m/Y', strtotime($d['start_date'])) : 'N/A' ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>

            </select>
        </div>

        <div class="mt-4 d-flex gap-3">
            <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-secondary">Huỷ</a>
            <button type="submit" class="btn btn-primary">Tiếp tục</button>
        </div>

    </form>
</div>

<script>
    function updatePrice(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
    }
</script>