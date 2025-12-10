<style>
    /* ==== GENERAL CARD ==== */
.section-card {
    background: #fff;
    border-radius: 14px;
    padding: 26px 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
}

/* ==== TITLE ==== */
    .title-line {
        font-size: 1.6rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 18px;
    }

/* ==== FILTER STYLE ==== */
.filter-box select {
    border-radius: 12px;
    padding: 10px 14px;
    font-size: 0.95rem;
    border: 1px solid #e0e6ed;
    background-color: #fff;
    transition: 0.25s;
}

.filter-box select:hover {
    border-color: #b9c3d4;
}

.filter-box form {
    background: #f8fafc;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid #edf1f5;
}

/* ==== TABLE HEADER ==== */
.customer-table thead tr {
    background: #f8f9fa !important;
}

.customer-table th {
    font-size: 0.85rem;
    text-transform: uppercase;
    color: #687280;
    letter-spacing: 0.5px;
    font-weight: 600;
}

/* ==== ROW HOVER ==== */
.customer-row {
    transition: background 0.25s;
}
.customer-row:hover {
    background: #f3f8ff !important;
}

/* ==== STATUS SELECT ==== */
.status-select {
    border-radius: 10px;
    padding: 8px 12px;
    border: 1px solid #dce2ea;
    min-width: 150px;
    background-color: #fff;
    transition: 0.25s ease;
}

.status-select:hover {
    border-color: #b5c1d3;
}

/* ==== ACTION BUTTON ==== */
.btn-sm {
    padding: 8px 18px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
}

.btn-primary.btn-sm {
    background: #0d6efd;
    border: none;
    transition: 0.25s;
}

.btn-primary.btn-sm:hover {
    background: #0b5ed7;
}

/* ==== CHECKIN FORM LAYOUT ==== */
.checkin-form {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: nowrap;
}

.checkin-form button {
    white-space: nowrap;
}

.status-select {
    width: 170px;
}

</style>

<div class="container-fluid px-4">

    <!-- TITLE -->
    <h2 class="title-line mt-4">Check-in / Điểm danh</h2>

    <!-- FILTER CARD -->
    <div class="section-card filter-box mb-4">

        <div class="d-flex flex-wrap gap-3 align-items-center">

            <!-- Chọn tour -->
            <form method="get" id="tourFilterForm" class="d-flex align-items-center gap-2">
                <input type="hidden" name="mode" value="guide">
                <input type="hidden" name="action" value="viewcheckin">
                <input type="hidden" name="stage" value="<?= htmlspecialchars($selectedStage ?? '') ?>">

                <label class="fw-semibold text-secondary">Tour:</label>
                <select class="form-select" name="departure_id"
                        onchange="document.getElementById('tourFilterForm').submit()">
                    <option value="" hidden>-- Chọn tour --</option>

                    <?php foreach ($assignedTours as $tour): ?>
                        <?php 
                            $tour_display = $tour['tour_name'] . 
                            ' (' . date('d/m', strtotime($tour['start_date'])) . 
                            ' - ' . date('d/m', strtotime($tour['end_date'])) . ')';
                        ?>
                        <option value="<?= $tour['departure_id'] ?>"
                            <?= ($selectedDepartureId == $tour['departure_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tour_display) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <!-- Chọn chặng -->
            <?php if (!empty($stages)): ?>
                <form method="get" id="stageFilterForm" class="d-flex align-items-center gap-2">
                    <input type="hidden" name="mode" value="guide">
                    <input type="hidden" name="action" value="viewcheckin">
                    <input type="hidden" name="departure_id" value="<?= htmlspecialchars($selectedDepartureId) ?>">

                    <label class="fw-semibold text-secondary">Chặng:</label>
                    <select class="form-select" name="stage"
                            onchange="document.getElementById('stageFilterForm').submit()">
                        <option value="" hidden>-- Chọn chặng / điểm --</option>

                        <?php foreach ($stages as $stage): ?>
                            <option value="<?= htmlspecialchars($stage) ?>"
                                <?= ($selectedStage == $stage) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($stage) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

            <?php else: ?>
                <span class="text-danger ms-2 fst-italic">* Không có chặng để điểm danh.</span>
            <?php endif; ?>

        </div>
    </div>


    <!-- TABLE CARD -->
    <div class="section-card">

        <div class="table-responsive mt-2">
            <table class="table table-hover align-middle customer-table">

                <thead>
                    <tr>
                        <th class="ps-4 py-3">Tên khách</th>
                        <th class="py-3">Trạng thái (<?= htmlspecialchars($selectedStage ?: 'Chưa chọn') ?>)</th>
                        <th class="py-3">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                <?php if ($selectedDepartureId && $selectedStage && !empty($statusDisplay)): ?>

                    <?php foreach ($statusDisplay as $guest): ?>
                        <tr class="customer-row">

                            <td class="ps-4 fw-semibold"><?= htmlspecialchars($guest['full_name']) ?></td>

                            <td class="fw-semibold">
                                <span class="<?=
                                    match ($guest['status']) {
                                        'present' => 'text-success',
                                        'absent'  => 'text-danger',
                                        'late'    => 'text-warning',
                                        default   => 'text-secondary',
                                    }
                                ?>">
                                    <?= htmlspecialchars($guest['display_status']) ?>
                                </span>
                            </td>

                            <td>
                                <form method="post" class="checkin-form">
                                    <input type="hidden" name="action" value="update_checkin">
                                    <input type="hidden" name="guest_id" value="<?= $guest['guest_id'] ?>">
                                    <input type="hidden" name="departure_id" value="<?= $selectedDepartureId ?>">
                                    <input type="hidden" name="stage_description" value="<?= $selectedStage ?>">

                                    <select name="status" class="form-select status-select">
                                        <option value="present" <?= ($guest['status']=='present')?'selected':'' ?>>Có mặt</option>
                                        <option value="absent"  <?= ($guest['status']=='absent')?'selected':'' ?>>Vắng mặt</option>
                                        <option value="late"    <?= ($guest['status']=='late')?'selected':'' ?>>Đến muộn</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                <?php elseif ($selectedDepartureId): ?>
                    <tr><td colspan="3" class="text-center py-4 text-danger">Vui lòng chọn chặng.</td></tr>

                <?php else: ?>
                    <tr><td colspan="3" class="text-center py-4 text-danger">Vui lòng chọn tour.</td></tr>

                <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>
