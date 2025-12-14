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
   FILTER
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
  background: #fff;
  border-radius: 14px;
  padding: 22px;
  border: 1px solid #f3f4f6;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
}

/* ===============================
   TABLE
=============================== */
.table thead th {
  background: transparent !important;
  color: #6b7280 !important;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 13px;
  border-bottom: 1px solid #e5e7eb !important;
  padding: 14px 12px !important;
  letter-spacing: .5px;
}

.table tbody td {
  padding: 18px 12px !important;
  font-size: 15px;
  color: #333;
  vertical-align: middle;
  border-bottom: 1px solid #efefef;
}

.table tbody tr:hover {
  background: #f9fafb;
}

/* ===============================
   ALIGN CLASSES (QUAN TRỌNG)
=============================== */
.col-center {
  text-align: center !important;
}

.col-left {
  text-align: left !important;
}

/* ===============================
   BADGE
=============================== */
.badge-status {
  padding: 7px 16px;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 600;
}

.badge-success {
  background: #d1fae5;
  color: #047857;
}

.badge-danger {
  background: #fee2e2;
  color: #b91c1c;
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
  <form method="GET" class="filter-box">
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
        <input type="date" name="from_date" class="form-control"
               value="<?= $_GET['from_date'] ?? '' ?>">
      </div>

      <div class="col-md-3">
        <input type="date" name="to_date" class="form-control"
               value="<?= $_GET['to_date'] ?? '' ?>">
      </div>

      <div class="col-md-2">
        <button class="btn btn-filter w-100">Tìm kiếm</button>
      </div>
    </div>
  </form>

  <!-- TABLE -->
  <div class="table-card">
    <table class="table align-middle">
      <thead>
        <tr>
          <th class="col-center">#</th>
          <th class="col-left">Tên chuyến đi</th>
          <th class="col-left">Khách hàng</th>
          <th class="col-left">Liên hệ</th>
          <th class="col-center">Tổng tiền</th>
          <th class="col-center">Trạng thái</th>
          <th class="col-center">Ngày tạo</th>
          <th class="col-center">Hành động</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($bookings)): ?>
          <?php foreach ($bookings as $i => $b): ?>
            <tr>
              <td class="col-center"><?= $i + 1 ?></td>

              <td class="col-left">
                <strong><?= $b['departure_name'] ?></strong><br>
                <span class="text-muted small">
                  <?= $b['tour_name'] ?> – <?= $b['version_name'] ?>
                </span>
              </td>

              <td class="col-left">
                <strong><?= htmlspecialchars($b['customer_name']) ?></strong>
              </td>

              <td class="col-left">
                <?= htmlspecialchars($b['customer_contact']) ?>
              </td>

              <td class="col-center">
                <?= number_format($b['total_amount'], 0, ',', '.') ?> ₫
              </td>

              <td class="col-center">
                <?php if ($b['status'] === 'completed'): ?>
                  <span class="badge-status badge-success">Đã thanh toán</span>
                <?php else: ?>
                  <span class="badge-status badge-danger">Chưa thanh toán</span>
                <?php endif; ?>
              </td>

              <td class="col-center">
                <?= date('d/m/Y H:i', strtotime($b['created_at'])) ?>
              </td>

              <td class="col-center">
                <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= $b['booking_id'] ?>"
                   class="btn btn-sm btn-info">Chi tiết</a>
                <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= $b['booking_id'] ?>"
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
