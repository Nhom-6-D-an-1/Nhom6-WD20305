<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold mb-0">Thêm Booking</h3>
    </div>

    <!-- CARD CHÍNH -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="get" action="<?= BASE_URL ?>">

                <!-- Hidden tham số -->
                <input type="hidden" name="mode" value="admin">
                <input type="hidden" name="action" value="createType">  <!-- action bước tiếp -->

                <!-- CHỌN DEPARTURE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Chọn lịch trình (Departure):</label>
                    <select name="departure_id" class="form-select" required>
                        <option value="">-- Chọn lịch trình --</option>

                        <?php if (!empty($departures)): ?>
                            <?php foreach ($departures as $d): ?>
                                <option 
                                    value="<?= htmlspecialchars((string)($d['departure_id'] ?? '')) ?>"
                                    data-price="<?= htmlspecialchars((string)($d['price'] ?? 0)) ?>"
                                >
                                    <?= htmlspecialchars($d['version_name'] ?? '') ?>  
                                    - <?= htmlspecialchars($d['tour_name'] ?? '') ?> 
                                    • <?= !empty($d['start_date']) 
                                            ? date('d/m/Y', strtotime($d['start_date'])) 
                                            : 'N/A' ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- BUTTONS -->
                <div class="mt-4 d-flex gap-3">
                  <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" 
                       class="btn btn-secondary px-4">
                        Huỷ
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        Tiếp tục
                    </button>

                    
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function updatePrice(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
    }
</script>