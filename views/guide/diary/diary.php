<style>
    .title-line {
        font-size: 1.6rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 18px;
    }

    .diary-card {
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    .form-select, .form-control {
        border-radius: 10px !important;
        padding: 10px 14px !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .diary-btn {
        border-radius: 10px;
        padding: 10px 20px;
    }

    .diary-table thead {
        background: #f8f9fa;
        border-radius: 10px;
    }

    .diary-row {
        transition: background 0.25s ease;
    }
    .diary-row:hover {
        background: #f5faff;
    }

    .badge-day {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
    }

    .diary-input {
        resize: none;
    }

    .diary-form-row textarea {
        min-height: 70px;
    }

    .no-data-row td {
        padding: 30px 0 !important;
        font-size: 1rem;
        color: #dc3545;
        font-weight: 600;
    }

    .btn-delete-diary {
        border-radius: 8px;
        padding: 6px 14px;
    }

    img.diary-img {
        border-radius: 10px;
        object-fit: cover;
    }
</style>

<div class="col-12">

    <h2 class="title-line">Nhật ký tour</h2>

    <!-- FILTER TOUR -->
    <form method="get" id="tourFilterForm">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewdiary">

        <div class="col-12 col-lg-6 mb-3">
            <select class="form-select" name="departure_id"
                    onchange="document.getElementById('tourFilterForm').submit()">
                <option value="0" hidden>-- Chọn tour --</option>

                <?php foreach ($assignedTours as $tour): ?>
                    <option value="<?= $tour['departure_id'] ?>"
                        <?= (!empty($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : '' ?>>

                        <?= $tour['tour_name'] ?> 
                        (<?= date('d/m', strtotime($tour['start_date'])) ?>
                        - <?= date('d/m', strtotime($tour['end_date'])) ?>)

                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <!-- FORM THÊM NHẬT KÝ -->
    <div class="card shadow-sm border-0 mb-4 diary-card">
        <div class="card-body px-4 py-4">

            <form method="post" enctype="multipart/form-data" id="diaryForm"
                  onsubmit="return validateSearchForm()">
                
                <input type="hidden" name="departure_id"
                       value="<?= (int)($_GET['departure_id'] ?? 0) ?>">

                <div class="row g-3 diary-form-row">

                    <div class="col-12 col-lg-6">
                        <textarea name="note" class="form-control diary-input"
                                  placeholder="Diễn biến nhật ký / sự cố..."></textarea>
                    </div>

                    <div class="col-12 col-lg-3">
                        <textarea name="handling_method" class="form-control diary-input"
                                  placeholder="Cách xử lý..."></textarea>
                    </div>

                    <div class="col-12 col-lg-3">
                        <textarea name="customer_feedback" class="form-control diary-input"
                                  placeholder="Phản hồi khách hàng..."></textarea>
                    </div>

                    <div class="col-12 col-lg-6">
                        <input type="file" name="image" class="form-control">
                    </div>

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

                    <div class="col-12 col-lg-2 text-end">
                        <button type="submit"
                                class="btn btn-primary diary-btn fw-semibold w-100">
                            Thêm nhật ký
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <!-- DANH SÁCH NHẬT KÝ -->
    <div class="card shadow-sm border-0 diary-card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 diary-table">

                    <thead>
                        <tr>
                            <th class="ps-4 py-3">Thời gian</th>
                            <th class="text-center py-3">Ngày sự cố</th>
                            <th class="py-3">Nội dung</th>
                            <th class="py-3">Cách xử lý</th>
                            <th class="py-3">Phản hồi khách</th>
                            <th class="text-center py-3">Hình ảnh</th>
                            <th class="text-center py-3">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if(empty($_GET['departure_id'])): ?>
                        <tr class="no-data-row">
                            <td colspan="7" class="text-center">Vui lòng chọn tour.</td>
                        </tr>
                    <?php else: ?>
                        <?php if (!empty($diaryData)) { ?>
                            <?php foreach ($diaryData as $diary): ?>
                                <?php if (empty($diary)) continue; ?>

                                <tr class="diary-row">

                                    <td class="ps-4 py-4 small text-muted">
                                        <div><?= date('H:i', strtotime($diary['created_at'])) ?></div>
                                        <div><?= date('d/m/Y', strtotime($diary['created_at'])) ?></div>
                                    </td>

                                    <td class="text-center py-4">
                                        <?php if (!empty($diary['day_number'])): ?>
                                            <span class="badge bg-primary badge-day">
                                                Ngày <?= $diary['day_number'] ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-secondary small">--</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="py-4"><?= htmlspecialchars($diary['log_content']) ?></td>

                                    <td class="py-4 small">
                                        <?= htmlspecialchars($diary['handling_method'] ?: '--') ?>
                                    </td>

                                    <td class="py-4 small">
                                        <?= htmlspecialchars($diary['customer_feedback'] ?: '--') ?>
                                    </td>

                                    <td class="text-center py-4">
                                        <?php if(!empty($diary['image'])): ?>
                                            <img src="<?= BASE_ASSETS_UPLOADS . $diary['image'] ?>"
                                                 width="80" height="80"
                                                 class="diary-img" />
                                        <?php else: ?>
                                            <span class="text-secondary small">Không có</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center py-4">
                                        <a href="<?= BASE_URL ?>?mode=guide&action=deleteDiary&id=<?= $diary['log_id'] ?>&departure_id=<?= (int)($_GET['departure_id'] ?? 0) ?>"
                                           class="btn btn-danger btn-sm btn-delete-diary"
                                           onclick="return confirm('Bạn có chắc muốn xoá nhật ký này?')">
                                            Xoá
                                        </a>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr class="no-data-row">
                                <td colspan="7" class="text-center">Chưa có nhật ký nào.</td>
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