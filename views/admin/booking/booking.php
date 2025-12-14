<style>
/* ===============================
   WRAPPER
=============================== */
.container-fluid {
  padding: 24px;
}


.page-title {
  font-size: 28px;
  font-weight: 700;
  color: #1f2937;
  margin: 8px 0 22px;
  letter-spacing: -0.3px;
}


/* ===============================
   FILTER BOX
=============================== */
.filter-box {
  margin-bottom: 18px;
}

.filter-box .form-select,
.filter-box .form-control {
  border-radius: 10px !important;
  padding: 10px 14px !important;
  border: 1px solid #dcdcdc !important;
  font-size: 14px;
}

.btn-filter {
  background: #dbeafe;
  color: #1e40af;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  padding: 10px;
}

.btn-filter:hover {
  background: #bfdbfe;
}

/* ===============================
   TABLE CARD
=============================== */
.table-card {
  background: #ffffff;
  border-radius: 14px;
  padding: 22px;
  border: 1px solid #f3f4f6;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
}

/* ===============================
   TABLE HEADER
=============================== */
.table thead th {
  background: transparent !important;
  color: #6b7280 !important;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 12.5px;
  border-bottom: 1px solid #e5e7eb !important;
  text-align: center;
  padding: 14px 10px !important;
  letter-spacing: .5px;
}

/* ===============================
   TABLE BODY
=============================== */
.table tbody tr {
  border-bottom: 1px solid #efefef;
  transition: .15s ease;
}

.table tbody tr:hover {
  background: #f9fafb;
}

.table tbody td {
  padding: 18px 12px !important;
  font-size: 15px;
  color: #333;
  vertical-align: middle;
}

/* Align columns */
.table tbody td:nth-child(1),
.table tbody td:nth-child(4),
.table tbody td:nth-child(5),
.table tbody td:nth-child(6),
.table tbody td:nth-child(7),
.table tbody td:nth-child(8) {
  text-align: center;
}

.table tbody td:nth-child(2),
.table tbody td:nth-child(3) {
  text-align: left;
}

/* ===============================
   BADGE STATUS
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

/* ===============================
   BUTTONS
=============================== */
.btn-sm {
  padding: 7px 14px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 600;
  border: none;
}

.btn-info {
  background: #dbeafe;
  color: #1e40af;
}

.btn-info:hover {
  background: #bfdbfe;
}

.btn-warning {
  background: #fef3c7;
  color: #92400e;
}

.btn-warning:hover {
  background: #fde68a;
}
</style>

<div class="container-fluid">

  <!-- TITLE -->
  <div class="page-title">Quản lý booking</div>

  <!-- FILTER -->
  <form method="GET" action="" class="filter-box">
    <input type="hidden" name="mode" value="admin">
    <input type="hidden" name="action" value="viewsbooking">

    <div class="row g-2">
      <div class="col-md-4">
        <select name="departure_id" class="form-select">
          <option value="">-- Chọn chuyến đi --</option>
          <?php foreach ($departures as $d): ?>
            <option value="<?= $d['departure_id'] ?>"
              <?= ($_GET['departure_id'] ?? '') == $d['departure_id'] ? 'selected' : '' ?>>
              <?= $d['departure_name'] ?> (<?= date('d/m', strtotime($d['start_date'])) ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-3">
        <input type="date" name="from_date" value="<?= $_GET['from_date'] ?? '' ?>" class="form-control">
      </div>

      <div class="col-md-3">
        <input type="date" name="to_date" value="<?= $_GET['to_date'] ?? '' ?>" class="form-control">
      </div>

      <div class="col-md-2">
        <button class="btn btn-filter w-100">Tìm kiếm</button>
      </div>
    </div>
  </form>

  <!-- TABLE -->
  <div class="table-card">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Tên chuyến đi</th>
          <th>Khách hàng</th>
          <th>Liên hệ</th>
          <th>Tổng tiền</th>
          <th>Trạng thái</th>
          <th>Ngày tạo</th>
          <th>Hành động</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($bookings)): ?>
          <?php foreach ($bookings as $key => $booking): ?>
            <tr>
              <td><?= $key + 1 ?></td>

              <td>
                <strong><?= $booking['departure_name'] ?></strong><br>
                <span class="text-muted small">
                  <?= $booking['tour_name'] ?> – <?= $booking['version_name'] ?>
                </span>
              </td>

              <td><?= htmlspecialchars($booking['customer_name']) ?></td>
              <td><?= htmlspecialchars($booking['customer_contact']) ?></td>

              <td><?= number_format($booking['total_amount'], 0, ',', '.') ?> ₫</td>

              <td>
                <?php if ($booking['status'] === 'completed'): ?>
                  <span class="badge bg-success">Đã thanh toán</span>
                <?php else: ?>
                  <span class="badge bg-secondary">Chưa thanh toán</span>
                <?php endif; ?>
              </td>

              <td><?= date('d/m/Y H:i', strtotime($booking['created_at'])) ?></td>

              <td>
                <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= $booking['booking_id'] ?>"
                   class="btn btn-sm btn-info">Chi tiết</a>
                <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= $booking['booking_id'] ?>"
                   class="btn btn-sm btn-warning">Sửa</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center text-muted">
              Không có dữ liệu booking
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>
