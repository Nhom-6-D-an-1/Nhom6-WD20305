    <div class="col-12">
        <h2>Check in, điểm danh</h2>
        <div class="dropdown d-flex gap-3 align-items-center">
            <!-- <form method="get" id="tourFilterForm" class="d-flex align-items-center">
            <input type="hidden" name="mode" value="guide">
            <input type="hidden" name="action" value="viewcheckin">
            <input type="hidden" name="stage" value="<?php echo htmlspecialchars($selectedStage ?? ''); ?>">

            <div class="me-3">
                <select class="form-select" name="departure_id" onchange="document.getElementById('tourFilterForm').submit()">
                    <option value="" hidden>--Chọn tour--</option>
                    <?php if (!empty($assignedTours)) { ?>
                        <?php foreach ($assignedTours as $tour) {
                            $tour_display = $tour['tour_name'] . ' (' . date('d/m', strtotime($tour['start_date'])) . ' - ' . date('d/m', strtotime($tour['end_date'])) . ')';
                        ?>
                            <option value="<?php echo $tour['departure_id']; ?>"
                                <?php echo (isset($selectedDepartureId) && $selectedDepartureId == $tour['departure_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($tour_display); ?> 
                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </form> -->

            <?php if (!empty($noRunningTour) && $noRunningTour): ?>
                <div class="text-danger">Hôm nay bạn không có tour đang diễn ra để điểm danh.</div>
            <?php elseif (!empty($stages)) : ?>
                <form method="get" id="stageFilterForm">
                    <input type="hidden" name="mode" value="guide">
                    <input type="hidden" name="action" value="viewcheckin">
                    <input type="hidden" name="departure_id" value="<?php echo htmlspecialchars($selectedDepartureId); ?>">

                    <div class="me-3">
                        <select class="form-select" name="stage" onchange="document.getElementById('stageFilterForm').submit()">
                            <option value="" hidden>--Chọn địa điểm/chặng--</option>
                            <?php foreach ($stages as $stage) : ?>
                                <option value="<?php echo htmlspecialchars($stage['stage_description']); ?>"
                                    <?php echo ($selectedStage == $stage['stage_description']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($stage['label']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            <?php else: ?>
                <span class="text-danger">Không có lịch trình để điểm danh.</span>
            <?php endif; ?>
        </div>

        <div class="table-responsive mt-3">
            <form method="post">
                <input type="hidden" name="action" value="update_checkin_multi">
                <input type="hidden" name="departure_id" value="<?php echo $selectedDepartureId; ?>">
                <input type="hidden" name="stage_description" value="<?php echo htmlspecialchars($selectedStage); ?>">
                <table class="table table-hover align-middle mb-0 customer-table">
                    <thead>
                        <tr>
                            <th class="ps-4 py-3">Tên khách</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 ">Thời gian check-in</th>
                            <th class="py-3 ">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($statusDisplay) && $selectedDepartureId && $selectedStage) { ?>
                            <?php foreach ($statusDisplay as $guest) { ?>
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
                                        <?php
                                        echo $guest['checkin_time']
                                            ? date('H:i d/m', strtotime($guest['checkin_time']))
                                            : '--';
                                        ?>
                                    </td>
                                    <td>
                                        <!-- <form method="post" class="d-flex gap-2 checkin-form"> -->
                                        <!-- <input type="hidden" name="action" value="update_checkin"> -->
                                        <input type="hidden" name="guest_id[]" value="<?php echo $guest['guest_id']; ?>">
                                        <input type="hidden" name="departure_id" value="<?php echo htmlspecialchars($selectedDepartureId); ?>">
                                        <input type="hidden" name="stage_description" value="<?php echo htmlspecialchars($selectedStage); ?>">

                                        <div class="dropdown">
                                            <select class="form-select status-select" name="status[]">
                                                <option value="" disabled selected hidden>Chọn trạng thái</option>

                                                <option value="present" <?php echo ($guest['status'] == 'present') ? 'selected' : ''; ?>>Có mặt</option>
                                                <option value="absent" <?php echo ($guest['status'] == 'absent') ? 'selected' : ''; ?>>Vắng mặt</option>
                                            </select>
                                        </div>
                                        <!-- <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button> -->
                                        <!-- </form> -->
                                    </td>

                                </tr>
                            <?php } ?>
                        <?php } else if ($selectedDepartureId) { ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-danger">Vui lòng chọn một chặng.</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-danger">Vui lòng chọn một tour.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-lg px-4">Cập nhật tất cả</button>
                </div>
            </form>
        </div>

    </div>