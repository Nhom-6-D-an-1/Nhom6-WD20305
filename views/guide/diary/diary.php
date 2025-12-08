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
                <form method="post" enctype="multipart/form-data" id="diaryForm" onsubmit="return validateSearchForm()">
                    <input type="hidden" name="departure_id" value="<?= (int)($_GET['departure_id'] ?? 0) ?>">
                    <div class="row g-3 diary-form-row">
                        <!-- Nội dung nhật ký -->
                        <div class="col-12 col-lg-6">
                            <textarea name="note" rows="2" class="form-control diary-input"
                                placeholder="Diễn biến sự cố, nội dung nhật ký..." ></textarea>
                        </div>
                        <!-- Cách xử lý -->
                        <div class="col-12 col-lg-3">
                            <textarea name="handling_method" rows="2" class="form-control"
                                placeholder="Cách xử lý..."></textarea>
                        </div>
                        <!-- Phản hồi khách hàng -->
                        <div class="col-12 col-lg-3">
                            <textarea name="customer_feedback" rows="2" class="form-control"
                                placeholder="Phản hồi của khách hàng..."></textarea>
                        </div>
                        <!-- Ảnh -->
                        <div class="col-12 col-lg-6">
                            <input type="file" name="image" class="form-control diary-file">
                        </div>
                        <!-- Ngày xảy ra sự cố -->
                        <div class="col-12 col-lg-4">
                            <select name="itinerary_id" class="form-select">
                                <option value="">-- Ngày xảy ra sự cố --</option>
                                <?php foreach ($itineraryDays as $day): ?>
                                    <option value="<?= $day['itinerary_id'] ?>">
                                        Ngày <?= $day['day_number'] ?> - <?= htmlspecialchars($day['place']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Nút -->
                        <div class="col-12 col-lg-2 text-end">
                            <button type="submit" class="btn btn-primary diary-btn fw-semibold">
                                Thêm nhật ký
                            </button>
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
                            <th class="ps-4 py-3">Thời gian</th>
                            <th class="py-3 text-center">Ngày sự cố</th>
                            <th class="py-3">Nội dung</th>
                            <th class="py-3">Cách xử lý</th>
                            <th class="py-3">Phản hồi của khách</th>
                            <th class="py-3 text-center">Hình ảnh</th>
                            <th class="py-3 text-center">Hành động</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                    <?php if(empty($_GET['departure_id'])): ?>
                        <tr>
                            <td colspan="7" class="text-center text-danger">Vui lòng chọn tour.</td>
                        </tr>
                    <?php else: ?>
                        <?php if (!empty($diaryData)) { ?>
                            <?php foreach ($diaryData as $diary) { ?>
                                <?php if (empty($diary)) continue; ?>

                                <tr class="diary-row">

                                    <!-- Thời gian -->
                                    <td class="ps-4 py-4 text-muted small">
                                        <?php $diaryDate = $diary['created_at'] ?? null; ?>
                                        <div><?= $diaryDate ? date('H:i', strtotime($diaryDate)) : '--:--' ?></div>
                                        <div><?= $diaryDate ? date('d/m/Y', strtotime($diaryDate)) : '--/--/----' ?></div>
                                    </td>

                                    <!-- Ngày sự cố -->
                                    <td class="text-center py-4">
                                        <?php if (!empty($diary['day_number'])): ?>
                                            <span class="badge bg-primary">Ngày <?= $diary['day_number'] ?></span>
                                        <?php else: ?>
                                            <span class="text-secondary small">--</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Nội dung -->
                                    <td class="py-4">
                                        <?= htmlspecialchars($diary['log_content'] ?? 'Không có') ?>
                                    </td>

                                    <!-- Cách xử lý -->
                                    <td class="py-4 small">
                                        <?= !empty($diary['handling_method']) 
                                                ? htmlspecialchars($diary['handling_method']) 
                                                : '<span class="text-secondary small">--</span>' ?>
                                    </td>

                                    <!-- Phản hồi khách -->
                                    <td class="py-4 small">
                                        <?= !empty($diary['customer_feedback']) 
                                                ? htmlspecialchars($diary['customer_feedback']) 
                                                : '<span class="text-secondary small">--</span>' ?>
                                    </td>

                                    <!-- Hình ảnh -->
                                    <td class="text-center py-4">
                                        <?php if(!empty($diary['image'])) { ?>
                                            <img src="<?= BASE_ASSETS_UPLOADS . $diary['image'] ?>" 
                                                alt="Hình ảnh" class="rounded" width="80" height="80">
                                        <?php } else { ?>
                                            <span class="text-secondary small">Không có</span>
                                        <?php } ?>
                                    </td>

                                    <!-- Xóa -->
                                    <td class="text-center py-4">
                                        <a href="<?= BASE_URL ?>?mode=guide&action=deleteDiary&id=<?= $diary['log_id'] ?>&departure_id=<?= (int)($_GET['departure_id'] ?? 0) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xoá nhật ký này?')">
                                            Xoá
                                        </a>
                                    </td>
                                </tr>

                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-danger">Chưa có nhật ký nào</td>
                            </tr>
                        <?php } ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
function validateSearchForm() {
    const note = document.querySelector('#diaryForm textarea[name="note"]').value.trim();
    const departureId = document.querySelector('#diaryForm input[name="departure_id"]').value;

    if (departureId == "0" || departureId == "") {
        alert("Vui lòng chọn tour trước khi thêm nhật ký");
        return false;
    }

    if (note === "") {
        alert("Vui lòng nhập diễn biến nhật ký");
        return false;
    }

    return true;
}
</script>