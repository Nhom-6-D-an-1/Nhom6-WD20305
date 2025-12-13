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
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

/* ===============================
   FORM
=============================== */
.form-control,
.form-select {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
    font-size: 14px;
}

textarea {
    resize: none;
}

/* ===============================
   BUTTON
=============================== */
.btn-add {
    background: #dbeafe;
    color: #1e40af;
    border-radius: 10px;
    font-weight: 700;
    padding: 10px 22px;
}

.btn-add:hover {
    background: #bfdbfe;
}

.btn-delete {
    border-radius: 8px;
    font-weight: 600;
}

/* ===============================
   TABLE
=============================== */
.table thead th {
    background: transparent !important;
    color: #6b7280;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .4px;
    border-bottom: 1px solid #e5e7eb !important;
}

.table tbody tr {
    border-bottom: 1px solid #f1f1f1;
    transition: background .2s ease;
}

.table tbody tr:hover {
    background: #f8fbff;
}

.table tbody td {
    font-size: 14px;
    vertical-align: middle;
}

/* ===============================
   BADGE
=============================== */
.badge-day {
    background: #dbeafe;
    color: #1e40af;
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
}

/* ===============================
   IMAGE
=============================== */
.diary-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 10px;
}

/* ===============================
   EMPTY ROW
=============================== */
.empty-row {
    padding: 28px 0 !important;
    font-size: 15px;
    font-weight: 600;
    color: #b91c1c;
}
</style>

<div class="container-fluid px-4">

    <!-- TITLE -->
    <div class="page-title">Nhật ký tour</div>

    <!-- ===============================
         ADD DIARY FORM
    =============================== -->
    <div class="card mb-4">
        <div class="card-body">

            <form method="post"
                  enctype="multipart/form-data"
                  id="diaryForm"
                  onsubmit="return validateSearchForm()">

                <input type="hidden" name="departure_id"
                       value="<?= (int)($selectedDepartureId ?? 0) ?>">

                <div class="row g-3">

                    <div class="col-lg-6">
                        <textarea name="note"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Diễn biến sự cố, nội dung nhật ký..."></textarea>
                    </div>

                    <div class="col-lg-3">
                        <textarea name="handling_method"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Cách xử lý..."></textarea>
                    </div>

                    <div class="col-lg-3">
                        <textarea name="customer_feedback"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Phản hồi khách hàng..."></textarea>
                    </div>

                    <div class="col-lg-6">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <select name="itinerary_id" class="form-select">
                            <option value="">-- Ngày xảy ra sự cố --</option>
                            <?php foreach ($itineraryDays as $day): ?>
                                <option value="<?= $day['itinerary_id'] ?>">
                                    Ngày <?= $day['day_number'] ?> – <?= htmlspecialchars($day['place']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-lg-2 text-end">
                        <button type="submit" class="btn btn-add w-100">
                            + Thêm nhật ký
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- ===============================
         DIARY LIST
    =============================== -->
    <div class="card">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th class="ps-4">Thời gian</th>
                        <th class="text-center">Ngày</th>
                        <th>Nội dung</th>
                        <th>Cách xử lý</th>
                        <th>Phản hồi</th>
                        <th class="text-center">Hình ảnh</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (empty($selectedDepartureId)): ?>

                    <tr>
                        <td colspan="7" class="text-center empty-row">
                            Hôm nay bạn không có tour đang diễn ra
                        </td>
                    </tr>

                <?php elseif (!empty($diaryData)): ?>

                    <?php foreach ($diaryData as $diary): ?>
                        <tr>

                            <td class="ps-4 text-muted small">
                                <div><?= date('H:i', strtotime($diary['created_at'])) ?></div>
                                <div><?= date('d/m/Y', strtotime($diary['created_at'])) ?></div>
                            </td>

                            <td class="text-center">
                                <?php if (!empty($diary['day_number'])): ?>
                                    <span class="badge-day">
                                        Ngày <?= $diary['day_number'] ?>
                                    </span>
                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($diary['log_content']) ?></td>
                            <td><?= htmlspecialchars($diary['handling_method'] ?: '--') ?></td>
                            <td><?= htmlspecialchars($diary['customer_feedback'] ?: '--') ?></td>

                            <td class="text-center">
                                <?php if (!empty($diary['image'])): ?>
                                    <img src="<?= BASE_ASSETS_UPLOADS . $diary['image'] ?>"
                                         class="diary-img">
                                <?php else: ?>
                                    <span class="text-muted">Không có</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <a href="<?= BASE_URL ?>?mode=guide&action=deleteDiary&id=<?= $diary['log_id'] ?>&departure_id=<?= (int)($_GET['departure_id'] ?? 0) ?>"
                                   class="btn btn-danger btn-sm btn-delete"
                                   onclick="return confirm('Bạn có chắc muốn xoá nhật ký này?')">
                                    Xoá
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" class="text-center empty-row">
                            Chưa có nhật ký nào
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<script>
function validateSearchForm() {
    const note = document.querySelector('#diaryForm textarea[name="note"]').value.trim();
    const departureId = document.querySelector('#diaryForm input[name="departure_id"]').value;

    if (!departureId || departureId == 0) {
        alert("Vui lòng chọn tour trước khi thêm nhật ký");
        return false;
    }
    if (note === "") {
        alert("Vui lòng nhập nội dung nhật ký");
        return false;
    }
    return true;
}
</script>
