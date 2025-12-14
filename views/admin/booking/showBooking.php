<style>
/* ===============================
   PAGE TITLE – DASHBOARD
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
.detail-card {
  background: #ffffff;
  border-radius: 14px;
  padding: 22px;
  border: 1px solid #f3f4f6;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
  margin-bottom: 20px;
}

.detail-title {
  font-size: 19px;
  font-weight: 700;
  color: #111827;
  margin-bottom: 14px;
}

/* ===============================
   DETAIL ITEM
=============================== */
.detail-item {
  margin-bottom: 14px;
}

.detail-item label {
  font-size: 13px;
  color: #6b7280;
  margin-bottom: 4px;
  display: block;
}

.detail-item p {
  margin: 0;
  font-size: 15px;
  font-weight: 600;
  color: #1f2937;
}

/* ===============================
   BADGE – PASTEL
=============================== */
.badge {
  padding: 7px 16px;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 600;
}

.bg-success {
  background: #d1fae5 !important;
  color: #047857 !important;
}

.bg-secondary {
  background: #fee2e2 !important;
  color: #b91c1c !important;
}

.bg-primary {
  background: #dbeafe !important;
  color: #1e40af !important;
}

/* ===============================
   BUTTONS
=============================== */
.btn-warning {
  background: #fef3c7;
  color: #92400e;
  border: none;
  border-radius: 10px;
  font-weight: 600;
}

.btn-warning:hover {
  background: #fde68a;
}

.btn-secondary {
  background: #e5e7eb;
  color: #374151;
  border: none;
  border-radius: 10px;
  font-weight: 600;
}
</style>

<div class="container-fluid px-4">

  <div class="page-title">Chi tiết booking</div>

  <?php if (!empty($booking)): ?>

  <div class="row">

    <!-- LEFT -->
    <div class="col-md-8">

      <!-- KHÁCH HÀNG -->
      <div class="detail-card">
        <div class="detail-title">Thông tin khách hàng</div>

        <div class="row">
          <div class="col-md-6 detail-item">
            <label>Mã booking</label>
            <p>#<?= $booking['booking_id'] ?></p>
          </div>

          <div class="col-md-6 detail-item">
            <label>Trạng thái</label>
            <?php if ($booking['status'] === 'completed'): ?>
              <span class="badge bg-success">Đã thanh toán</span>
            <?php else: ?>
              <span class="badge bg-secondary">Chưa thanh toán</span>
            <?php endif; ?>
          </div>

          <div class="col-md-6 detail-item">
            <label>Tên khách</label>
            <p><?= htmlspecialchars($booking['customer_name']) ?></p>
          </div>

          <div class="col-md-6 detail-item">
            <label>Liên hệ</label>
            <p><?= htmlspecialchars($booking['customer_contact']) ?></p>
          </div>

          <div class="col-md-6 detail-item">
            <label>Loại khách</label>
            <?php if ($booking['customer_type'] === 'doan'): ?>
              <span class="badge bg-primary">Khách đoàn</span>
            <?php else: ?>
              <span class="badge bg-secondary">Khách lẻ</span>
            <?php endif; ?>
          </div>

          <div class="col-md-6 detail-item">
            <label>Ngày tạo</label>
            <p>
            <?= !empty($booking['created_at'])
                ? date('d/m/Y H:i', strtotime($booking['created_at']))
                : '<span class="text-muted">Chưa cập nhật</span>' ?>
            </p>
          </div>
        </div>
      </div>

      <!-- TOUR -->
      <div class="detail-card">
        <div class="detail-title">Thông tin tour</div>

        <div class="row">
          <div class="col-md-6 detail-item">
            <label>Tên tour</label>
            <p><?= htmlspecialchars($booking['tour_name']) ?></p>
          </div>

          <div class="col-md-6 detail-item">
            <label>Danh mục</label>
            <p><?= htmlspecialchars($booking['category_name']) ?></p>
          </div>

          <div class="col-md-6 detail-item">
            <label>Phiên bản</label>
            <p><?= htmlspecialchars($booking['version_name']) ?></p>
          </div>

          <div class="col-md-6 detail-item">
            <label>Ngày khởi hành</label>
            <p><?= date('d/m/Y', strtotime($booking['start_date'])) ?></p>
          </div>
        </div>

        <div class="detail-item">
          <label>Mô tả</label>
          <p><?= htmlspecialchars($booking['description']) ?></p>
        </div>
      </div>

    </div>

    <!-- RIGHT -->
    <div class="col-md-4">

      <div class="detail-card">
        <div class="detail-title">Chi phí</div>

        <div class="detail-item">
          <label>Giá tour</label>
          <p><?= number_format($booking['price'], 0, ',', '.') ?> VNĐ</p>
        </div>

        <div class="detail-item">
          <label>Tổng tiền</label>
          <p class="text-danger fs-5 fw-bold">
            <?= number_format($booking['total_amount'], 0, ',', '.') ?> VNĐ
          </p>
        </div>

        <hr>

        <div class="d-grid gap-2">
          <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= $booking['booking_id'] ?>"
             class="btn btn-warning">Chỉnh sửa</a>

          <a href="<?= BASE_URL ?>?mode=admin&action=viewsbooking"
             class="btn btn-secondary">Quay lại</a>
        </div>
      </div>

    </div>

  </div>

  <?php else: ?>
    <div class="alert alert-danger">
      Booking không tồn tại!
    </div>
  <?php endif; ?>

</div>
