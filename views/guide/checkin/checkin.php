    <div class="col-12">
    <h2>Check in, điểm danh</h2>
    <div class="dropdown d-flex gap-3 align-items-center">
        <form method="get" id="tourFilterForm" class="d-flex align-items-center">
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
        </form>

        <?php if (!empty($stages)) { ?>
            <form method="get" id="stageFilterForm">
                <input type="hidden" name="mode" value="guide">
                <input type="hidden" name="action" value="viewcheckin">
                <input type="hidden" name="departure_id" value="<?php echo htmlspecialchars($selectedDepartureId); ?>">

                <div class="me-3">
                    <select class="form-select" name="stage" onchange="document.getElementById('stageFilterForm').submit()">
                        <option value="" hidden>--Chọn địa điểm/chặng--</option>
                        <?php foreach ($stages as $stage) { ?>
                            <option value="<?php echo htmlspecialchars($stage); ?>"
                                <?php echo ($selectedStage == $stage) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($stage); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </form>
        <?php } else if($selectedDepartureId) { ?>
            <span class="text-danger">Không có lịch trình/chặng để điểm danh.</span>
        <?php } ?>
    </div>
    
    <div class="table-responsive mt-3">
        <table class="table table-hover align-middle mb-0 customer-table">
            <thead>
                <tr>
                    <th class="ps-4 py-3">Tên khách</th>
                    <th class="py-3">Trạng thái (<?php echo htmlspecialchars($selectedStage ?? 'Chưa chọn chặng'); ?>)</th>
                    <th class="py-3 ">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($statusDisplay) && $selectedDepartureId && $selectedStage) { ?>
                    <?php foreach ($statusDisplay as $guest) { ?>
                        <tr class="customer-row">
                            <td class="ps-4 fw-semibold"><?php echo htmlspecialchars($guest['full_name']); ?></td>
                            <td class="status-cell">
                                <span class="<?php 
                                    if ($guest['status'] == 'present') echo 'text-success'; 
                                    else if ($guest['status'] == 'absent') echo 'text-danger'; 
                                    else if ($guest['status'] == 'late') echo 'text-warning'; 
                                    else echo 'text-secondary'; 
                                ?>">
                                    <?php echo htmlspecialchars($guest['display_status']); ?>
                                </span>
                            </td>
                            <td>
                                <form method="post" class="d-flex gap-2 checkin-form">
                                    <input type="hidden" name="action" value="update_checkin">
                                    <input type="hidden" name="guest_id" value="<?php echo $guest['guest_id']; ?>">
                                    <input type="hidden" name="departure_id" value="<?php echo htmlspecialchars($selectedDepartureId); ?>">
                                    <input type="hidden" name="stage_description" value="<?php echo htmlspecialchars($selectedStage); ?>">
                                    
                                    <div class="dropdown">
                                        <select class="form-select status-select" name="status">
                                            <option value="present" <?php echo ($guest['status'] == 'present') ? 'selected' : ''; ?>>Có mặt</option>
                                            <option value="absent" <?php echo ($guest['status'] == 'absent') ? 'selected' : ''; ?>>Vắng mặt</option>
                                            <option value="late" <?php echo ($guest['status'] == 'late') ? 'selected' : ''; ?>>Đến muộn</option>
                                            <option value="" disabled selected hidden>Chọn trạng thái</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else if ($selectedDepartureId) { ?>
                    <tr>
                        <td colspan="3" class="text-center py-4">Vui lòng chọn một Chặng để điểm danh.</td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center py-4">Vui lòng chọn một Tour để xem danh sách khách và điểm danh.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>