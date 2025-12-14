<style>
/* ===============================
   PAGE TITLE
=============================== */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===============================
   CARD – APPLE STYLE
=============================== */
.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

/* ===============================
   FILTER BAR
=============================== */
.filter-bar {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

/* ===============================
   TABLE
=============================== */
.table thead th {
    background: transparent !important;
    color: #6b7280;
    font-size: 12px;
    text-transform: uppercase;
    border-bottom: 1px solid #e5e7eb !important;
    letter-spacing: .4px;
}

.table tbody td {
    font-size: 14px;
    vertical-align: middle;
}

/* ===============================
   STATUS COLOR
=============================== */
.text-present {
    color: #047857;
    font-weight: 600;
}

.text-absent {
    color: #b91c1c;
    font-weight: 600;
}

.text-late {
    color: #b45309;
    font-weight: 600;
}

/* ===============================
   BUTTON
=============================== */
.btn-update {
    background: #dbeafe;
    color: #1e40af;
    border-radius: 10px;
    font-weight: 700;
    padding: 10px 24px;
}

.btn-update:hover {
    background: #bfdbfe;
}
</style>

<div class="container-fluid px-4">

    <!-- TITLE -->
    <div class="page-title">Check-in / Điểm danh</div>

    <!-- ===============================
         FILTER
    =============================== -->
    <div class="card mb-4">

        <div class="filter-bar">

            <?php if (!empty($noRunningTour) && $noRunningTour): ?>

                <span class="text-danger">
                    Hôm nay bạn không có tour đang diễn ra để điểm danh.
                </span>

            <?php elseif (!empty($stages)): ?>

                <form method="get" id="stageFilterForm" class="d-flex gap-3 align-items-center">
                    <input type="hidden" name="mode" value="guide">
                    <input type="hidden" name="action" value="viewcheckin">
                    <input type="hidden" name="departure_id"
                           value="<?= htmlspecialchars($selectedDepartureId); ?>">

                    <select class="form-select"
                            name="stage"
                            onchange="document.getElementById('stageFilterForm').submit()">
                        <option value="" hidden>-- Chọn địa điểm / chặng --</option>

                        <?php foreach ($stages as $stage): ?>
                            <option value="<?= htmlspecialchars($stage['stage_description']); ?>"
                                <?= ($selectedStage == $stage['stage_description']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($stage['label']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

            <?php else: ?>

                <span class="text-danger">
                    Không có lịch trình để điểm danh.
                </span>

            <?php endif; ?>

        </div>

    </div>

    <!-- ===============================
         TABLE CHECK-IN
    =============================== -->
    <div class="card">

        <form method="post">
            <input type="hidden" name="action" value="update_checkin_multi">
            <input type="hidden" name="departure_id" value="<?= $selectedDepartureId; ?>">
            <input type="hidden" name="stage_description" value="<?= htmlspecialchars($selectedStage); ?>">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="ps-4">Tên khách</th>
                            <th>Trạng thái</th>
                            <th>Thời gian check-in</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($statusDisplay) && $selectedDepartureId && $selectedStage): ?>

                            <?php foreach ($statusDisplay as $guest): ?>
                                <tr>

                                    <td class="ps-4 fw-semibold">
                                        <?= htmlspecialchars($guest['full_name']) ?>
                                    </td>

                                    <td>
                                        <span class="<?=
                                            match ($guest['status']) {
                                                'present' => 'text-present',
                                                'absent'  => 'text-absent',
                                                'late'    => 'text-late',
                                                default   => 'text-muted',
                                            }
                                        ?>">
                                            <?= htmlspecialchars($guest['display_status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $guest['checkin_time']
                                            ? date('H:i d/m', strtotime($guest['checkin_time']))
                                            : '--'; ?>
                                    </td>

                                    <td>
                                        <input type="hidden" name="guest_id[]" value="<?= $guest['guest_id']; ?>">

                                        <select class="form-select"
                                                name="status[]">
                                            <option value="" disabled hidden>Chọn trạng thái</option>
                                            <option value="present"
                                                <?= ($guest['status'] == 'present') ? 'selected' : ''; ?>>
                                                Có mặt
                                            </option>
                                            <option value="absent"
                                                <?= ($guest['status'] == 'absent') ? 'selected' : ''; ?>>
                                                Vắng mặt
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php elseif ($selectedDepartureId): ?>

                            <tr>
                                <td colspan="4" class="text-center text-danger py-4">
                                    Vui lòng chọn một chặng.
                                </td>
                            </tr>

                        <?php else: ?>

                            <tr>
                                <td colspan="4" class="text-center text-danger py-4">
                                    Vui lòng chọn một tour.
                                </td>
                            </tr>

                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-update">
                    ✓ Cập nhật tất cả
                </button>
            </div>

        </form>

    </div>

</div>
