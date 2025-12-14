<?php
// Biến cần có từ Controller:
// $selectedDepartureId
// $diaryData
?>

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
    }

    /* ===============================
   CARD – APPLE STYLE
=============================== */
    .card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
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
   BADGE DAY
=============================== */
    .badge-day {
        background: #e0f2fe;
        color: #0369a1;
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
    }

    /* ===============================
   IMAGE
=============================== */
    .diary-img {
        width: 70px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
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
    <?php if (empty($selectedDepartureId)): ?>
        <div class="alert alert-danger text-center mt-3">
            Hôm nay bạn không có tour đang diễn ra.
        </div>
    <?php else : ?>



        <!-- Form thêm nhật ký -->
        <div class="card shadow-sm border-0 mb-4 diary-card">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center diary-form-row">
                    <form method="post" enctype="multipart/form-data" id="diaryForm" onsubmit="return validateSearchForm()">
                        <input type="hidden" name="departure_id" value="<?= (int)($selectedDepartureId ?? 0) ?>">
                        <div class="row g-3 diary-form-row">
                            <!-- Nội dung nhật ký -->
                            <div class="col-12 col-lg-6">
                                <textarea name="note" rows="2" class="form-control diary-input"
                                    placeholder="Diễn biến sự cố, nội dung nhật ký..."></textarea>
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
                                                Ngày <?= (int)$diary['day_number'] ?>
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
                                                class="diary-img"
                                                alt="Diary image">
                                        <?php else: ?>
                                            <span class="text-muted">Không có</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="<?= BASE_URL ?>?mode=guide&action=deleteDiary&id=<?= (int)$diary['log_id'] ?>&departure_id=<?= (int)($_GET['departure_id'] ?? 0) ?>"
                                            class="btn btn-danger btn-sm"
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
<?php endif; ?>
<!-- ===============================
     VALIDATE FORM
=============================== -->
<script>
    function validateSearchForm() {
        const note = document.querySelector('#diaryForm textarea[name="note"]')?.value.trim();
        const departureId = document.querySelector('#diaryForm input[name="departure_id"]')?.value;

        if (!departureId || departureId == 0) {
            alert("Vui lòng chọn tour trước khi thêm nhật ký");
            return false;
        }

        if (!note) {
            alert("Vui lòng nhập nội dung nhật ký");
            return false;
        }

        return true;
    }
</script>