<?php ?>
<div class="p-4">
  <h3>Quản lý booking</h3>

  <!-- Bộ lọc -->
  <form method="GET" action="">
    <input type="hidden" name="mode" value="admin">
    <input type="hidden" name="action" value="viewsbooking">

    <div class="row mb-3">

      <!-- Tìm theo tên chuyến đi -->
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

      <!-- Tìm theo ngày bắt đầu -->
      <div class="col-md-3">
        <input type="date" name="from_date" class="form-control">
      </div>

      <!-- Tìm theo ngày kết thúc -->
      <div class="col-md-3">
        <input type="date" name="to_date" class="form-control">
      </div>

      <div class="col-md-2 d-flex gap-2">
        <button class="btn btn-primary">Tìm kiếm</button>
      </div>

    </div>
  </form>


  <!-- Bảng booking -->
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
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
      <?php if (!empty($bookings) && is_array($bookings)): ?>
        <?php foreach ($bookings as $key => $booking): ?>
          <tr>
            <td><?= $key + 1  ?></td>
            <td><?= $booking['departure_name'] ?><br>
              <span class="text-muted small" style="font-size: 12px;"><?= $booking['tour_name'] ?> - <?= $booking['version_name'] ?></span>
            </td>
            <td><?php echo htmlspecialchars($booking['customer_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($booking['customer_contact'] ?? ''); ?></td>
            <td><?php echo number_format((float)($booking['total_amount'] ?? 0), 0, ',', '.'); ?> ₫</td>
            <td>
              <?php

              $status = $booking['status'] ?? '';
              $statusText = ($status === 'completed') ? 'Đã thanh toán' : 'Chưa thanh toán';
              $statusColor = ($status === 'completed') ? 'bg-success' : 'bg-secondary';
              ?>
              <p><span class="badge <?= $statusColor ?>"><?= $statusText ?></span></p>
            </td>
            <td><?php echo !empty($booking['created_at']) ? date('d/m/Y H:i', strtotime($booking['created_at'])) : ''; ?></td>
            <td>
              <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= urlencode($booking['booking_id']) ?>" class="btn btn-sm btn-info">Chi tiết</a>
              <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= urlencode($booking['booking_id']) ?>" class="btn btn-sm btn-warning">Sửa</a>
              <!-- <a href="<?= BASE_URL ?>?mode=admin&action=deletebooking&id=<?= urlencode($booking['booking_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa booking #<?= htmlspecialchars($booking['booking_id'] ?? '') ?>?');">Xóa</a> -->
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" class="text-center">Không có dữ liệu booking</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>