<style>
  /* ===============================
   WRAPPER
=============================== */
  .p-4 {
    padding: 24px !important;
  }

  /* ===============================
   PAGE TITLE STYLE
=============================== */
  .fw-bold h3 {
    font-size: 32px;
    font-weight: 800 !important;
    margin-bottom: 24px;
  }

  /* ===============================
   TABLE BOX STYLE
=============================== */


  .table-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    border: 1px solid #f3f4f6;
    /* Apple soft border */
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    /* soft shadow kiểu Apple */
  }

  .table thead th {
    background-color: transparent !important;
    color: #6b7280 !important;
    /* xám Apple */
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12.5px;
    border-bottom: 1px solid #e5e7eb !important;
    text-align: center;
    padding: 14px 10px !important;
    letter-spacing: .5px;
  }

  .table tbody tr {
    border-bottom: 1px solid #efefef;
  }

  .table tbody tr td {
    padding: 18px 12px !important;
    font-size: 15px;
    color: #333;
  }

  /* Căn giữa các cột số liệu và trạng thái */
  .table tbody td:nth-child(1),
  .table tbody td:nth-child(4),
  .table tbody td:nth-child(5),
  .table tbody td:nth-child(6),
  .table tbody td:nth-child(7),
  .table tbody td:nth-child(8) {
    text-align: center;
  }

  /* Cột tên chuyến đi căn trái */
  .table tbody td:nth-child(2),
  .table tbody td:nth-child(3) {
    text-align: left;
  }

  /* ===============================
   BADGE STATUS (pastel)
=============================== */
  .badge {
    padding: 7px 16px !important;
    border-radius: 12px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
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
   BUTTONS (pastel)
=============================== */
  .btn-sm {
    padding: 7px 14px !important;
    border-radius: 10px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    border: none !important;
  }

  /* Chi tiết – xanh nhạt */
  .btn-info {
    background: #dbeafe !important;
    color: #1e40af !important;
  }

  .btn-info:hover {
    background: #bfdbfe !important;
  }

  /* Sửa – vàng pastel */
  .btn-warning {
    background: #fef3c7 !important;
    color: #92400e !important;
  }

  .btn-warning:hover {
    background: #fde68a !important;
  }

  /* Xóa – đỏ pastel (nếu dùng) */
  .btn-danger {
    background: #fee2e2 !important;
    color: #b91c1c !important;
  }

  .btn-danger:hover {
    background: #fecaca !important;
  }

  /* ===============================
   FILTER FORM STYLE
=============================== */
  .form-select,
  .form-control {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
  }

  .btn-primary {
    background: #dbeafe !important;
    color: #1e40af !important;
    border: none !important;
  }

  .btn-primary:hover {
    background: #bfdbfe !important;
  }
</style>
<div class="container-fluid px-4">
  <h3 class="fw-bold">Quản lý booking</h3>

  <!-- Bộ lọc -->
  <form method="GET" action="">
    <input type="hidden" name="mode" value="admin">
    <input type="hidden" name="action" value="viewsbooking">

    <div class="row mb-3 g-2">

      <div class="col-md-4">
        <select name="departure_id" class="form-select">
          <option value="">-- Chọn chuyến đi --</option>
          <?php foreach ($departures as $d): ?>
            <option value="<?= $d['departure_id'] ?>">
              <?= $d['departure_name'] ?> (<?= date('d/m', strtotime($d['start_date'])) ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-3">
        <input type="date" name="from_date" class="form-control">
      </div>

      <div class="col-md-3">
        <input type="date" name="to_date" class="form-control">
      </div>

      <div class="col-md-2">
        <button class="btn btn-primary w-100 mt-1">Tìm kiếm</button>
      </div>

    </div>
  </form>

  <div class="table-card">
    <!-- Bảng booking -->
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Tên chuyến đi</th>
          <th>Tên khách hàng</th>
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
                <span class="text-muted small"><?= $booking['tour_name'] ?> - <?= $booking['version_name'] ?></span>
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
                <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-info">Chi tiết</a>
                <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center text-muted">Không có dữ liệu booking</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>