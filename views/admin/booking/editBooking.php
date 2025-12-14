<style>
/* ===============================
   PAGE TITLE
=============================== */
.page-title {
  font-size: 24px;
  font-weight: 700;
  color: #1f2937;
  margin: 8px 0 22px;
  padding-bottom: 10px;
  border-bottom: 1px solid #e5e7eb;
  letter-spacing: -0.3px;
}

/* ===============================
   CARD – APPLE STYLE
=============================== */
.form-card {
  background: #ffffff;
  border-radius: 14px;
  padding: 22px 24px;
  border: 1px solid #f3f4f6;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

/* ===============================
   SECTION TITLE
=============================== */
.section-title {
  font-size: 19px;
  font-weight: 700;
  color: #111827;
  margin: 22px 0 14px;
}

/* ===============================
   FORM CONTROL
=============================== */
.form-label {
  font-size: 13px;
  font-weight: 600;
  color: #374151;
}

.form-control,
.form-select {
  border-radius: 10px !important;
  padding: 10px 14px !important;
  border: 1px solid #dcdcdc !important;
  font-size: 14px;
}

/* ===============================
   BUTTONS
=============================== */
.btn-save {
  background: #d1fae5;
  color: #047857;
  border: none;
  border-radius: 10px;
  font-weight: 700;
  padding: 10px 20px;
}

.btn-save:hover {
  background: #a7f3d0;
}

.btn-cancel {
  background: #e5e7eb;
  color: #374151;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  padding: 10px 20px;
}

.btn-outline {
  border-radius: 10px;
  font-weight: 600;
}
</style>

<div class="container-fluid px-4">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
    <div class="page-title mb-0">Sửa booking</div>

    <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= htmlspecialchars($booking['booking_id'] ?? '') ?>"
       class="btn btn-outline-secondary btn-outline">
      Quay lại
    </a>
  </div>

  <!-- FORM CARD -->
  <div class="form-card">

    <form method="post" action="<?= BASE_URL ?>?mode=admin&action=updatebooking">

      <input type="hidden" name="booking_id"
             value="<?= htmlspecialchars($booking['booking_id'] ?? '') ?>">

      <!-- ===============================
           LỊCH TRÌNH
      =============================== -->
      <div class="section-title">Lịch trình</div>

      <div class="mb-3">
        <label class="form-label">Chọn lịch trình</label>
        <select name="departure_id" class="form-select" onchange="updatePrice(this)">
          <option value="">-- Chọn lịch trình --</option>

          <?php foreach ($departures as $d): ?>
            <option value="<?= $d['departure_id'] ?>"
                    data-price="<?= $d['price'] ?>"
              <?= ($d['departure_id'] == ($booking['departure_id'] ?? null)) ? 'selected' : '' ?>>
              <?= htmlspecialchars($d['version_name']) ?> –
              <?= htmlspecialchars($d['tour_name']) ?>
              (<?= date('d/m/Y', strtotime($d['start_date'])) ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- ===============================
           THÔNG TIN KHÁCH
      =============================== -->
      <div class="section-title">Thông tin khách</div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Tên khách</label>
          <input type="text" name="customer_name" class="form-control"
                 value="<?= htmlspecialchars($booking['customer_name'] ?? '') ?>" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">SĐT</label>
          <input type="text" name="customer_contact" class="form-control"
                 value="<?= htmlspecialchars($booking['customer_contact'] ?? '') ?>" required>
        </div>
      </div>

      <div class="mb-3 col-md-6">
        <label class="form-label">Loại khách</label>
        <select name="customer_type" class="form-select">
          <option value="le" <?= ($booking['customer_type'] ?? '') === 'le' ? 'selected' : '' ?>>Khách lẻ</option>
          <option value="doan" <?= ($booking['customer_type'] ?? '') === 'doan' ? 'selected' : '' ?>>Khách đoàn</option>
        </select>
      </div>

      <!-- ===============================
           THANH TOÁN
      =============================== -->
      <div class="section-title">Thanh toán</div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Tổng tiền</label>
          <input type="number" name="total_amount" class="form-control"
                 value="<?= htmlspecialchars($booking['total_amount'] ?? 0) ?>">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Trạng thái</label>
          <select name="status" class="form-select">
            <option value="pending" <?= ($booking['status'] ?? '') === 'pending' ? 'selected' : '' ?>>
              Chưa thanh toán
            </option>
            <option value="completed" <?= ($booking['status'] ?? '') === 'completed' ? 'selected' : '' ?>>
              Đã thanh toán
            </option>
          </select>
        </div>
      </div>

      <!-- ACTION -->
      <div class="mt-4 d-flex gap-3">
        <button type="submit" class="btn btn-save">Cập nhật</button>

        <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= htmlspecialchars($booking['booking_id']) ?>"
           class="btn btn-cancel">
          Hủy
        </a>
      </div>

    </form>

  </div>

</div>

<script>
function updatePrice(select) {
  const option = select.options[select.selectedIndex];
  const price = option.getAttribute('data-price');
  if (price) {
    document.querySelector('input[name="total_amount"]').value = price;
  }
}
</script>