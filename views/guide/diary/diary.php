<div class="col-12">
    <h2>Nhật ký tour</h2>
    
    <form method="get" id="tourFilterForm">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewdiary">
        <div class="col-12 col-lg-6 mb-2">
            <select class="form-select" name="departure_id" onchange="document.getElementById('tourFilterForm').submit()">
                <option value="0" hidden>--Chọn tour--</option>
                <?php if (!empty($assignedTours)) { ?>
                    <?php foreach ($assignedTours as $tour) { ?>
                        <option value="<?php echo $tour['departure_id']; ?>"
                            <?php echo (isset($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : ''; ?>>
                            <?php echo $tour['tour_name']; ?> 
                            (<?php echo date('d/m', strtotime($tour['start_date'])); ?> - <?php echo date('d/m', strtotime($tour['end_date'])); ?>)
                        </option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </form>

    <!-- Form thêm nhật ký -->
    <div class="card shadow-sm border-0 mb-4 diary-card">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center diary-form-row">
                <form method="post" enctype="multipart/form-data" id="diaryForm">
                    <input type="hidden" name="departure_id" value="<?= (int)($_GET['departure_id'] ?? 0) ?>"> <!-- Cast to int -->
                    <div class="row g-3 align-items-center diary-form-row">
                        <div class="col-12 col-lg-6">
                            <input type="text" name="note" required class="form-control form-control-lg diary-input" placeholder="Diễn biến, nhật ký, phản hồi khách...">
                        </div>
                        <div class="col-12 col-lg-4">
                            <input type="file" name="image" class="form-control form-control-lg diary-file">
                        </div>
                        <div class="col-12 col-lg-2">
                            <button type="submit" class="btn btn-primary diary-btn w-100 fw-semibold">Thêm nhật ký</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Danh sách các mục nhật ký -->
    <div class="card shadow-sm border-0 diary-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 diary-table">
                    <thead class="bg-light text-secondary small text-uppercase fw-semibold">
                        <tr>
                            <th class="ps-4 py-3 diary-time-col">Thời gian</th>
                            <th class="py-3">Nội dung</th>
                            <th class="py-3 text-center diary-img-col">Hình ảnh</th>
                            <th class="py-3 text-center diary-action-col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        <?php if(!empty($diaryData)) { ?>
                            <?php foreach($diaryData as $diary) { ?>
                                <?php if(empty($diary)) continue; ?>
                                <tr class="diary-row">
                                    <td class="ps-4 py-4 text-muted small diary-time">
                                        <?php $diaryDate = $diary['created_at'] ?? null; ?>
                                        <div><?= $diaryDate ? date('H:i', strtotime($diaryDate)) : '--:--' ?></div>
                                        <div><?= $diaryDate ? date('d/m/Y', strtotime($diaryDate)) : '--/--/----' ?></div>
                                    </td>
                                    <td class="py-4 diary-content">
                                        <div class="fw-semibold"><?= htmlspecialchars($diary['log_content'] ?? 'Không có') ?></div>
                                    </td>
                                    <td class="text-center py-4 diary-img">
                                        <?php if(!empty($diary['image'])) { ?>
                                            <img src="<?= BASE_ASSETS_UPLOADS . $diary['image'] ?>" alt="Hình ảnh" class="diary-img-thumb rounded">
                                        <?php } else { ?>
                                            <span class="text-secondary small">Không có</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center py-4 diary-action">
                                        <?php if(isset($diary['log_id'])) { ?>
                                            <a href="<?php echo BASE_URL; ?>?mode=guide&action=deleteDiary&id=<?php echo $diary['log_id']; ?>" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Bạn có chắc muốn xoá nhật ký này?')">
                                            Xoá
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4" class="text-center text-secondary py-4">Chưa có nhật ký nào</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
