<?php ?>
<div class="p-4">
  <h3>Quản lý booking</h3>

  <!-- Bộ lọc -->
  <div class="row mb-3">
    <div class="col-md-3">
      <select class="form-select">
        <option selected disabled>Trạng thái</option>
        <option>deposit</option>
        <option>pending</option>
        <option>completed</option>
        <option>cancelled</option>
      </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
      <button class="btn btn-primary">Tìm kiếm</button>
      <a href="<?= BASE_URL ?>?mode=admin&action=views_add_booking"><button class="btn btn-success">Thêm booking</button></a>
    </div>
  </div>

  <!-- Bảng booking -->
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Mã booking</th>
        <th>Mã lịch trình</th>
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
        <?php foreach ($bookings as $booking): ?>
          <tr>
            <td><?php echo htmlspecialchars($booking['booking_id'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($booking['departure_id'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($booking['customer_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($booking['customer_contact'] ?? ''); ?></td>
            <td><?php echo number_format((float)($booking['total_amount'] ?? 0), 0, ',', '.'); ?> ₫</td>
            <td>
              <?php
                $status = $booking['status'] ?? '';
                $badgeClass = 'bg-secondary';
                if ($status === 'deposit') $badgeClass = 'bg-info';
                elseif ($status === 'pending') $badgeClass = 'bg-warning';
                elseif ($status === 'completed') $badgeClass = 'bg-success';
                elseif ($status === 'cancelled') $badgeClass = 'bg-danger';
              ?>
              <span class="badge <?php echo $badgeClass; ?>">
                <?php echo htmlspecialchars($status); ?>
              </span>
            </td>
            <td><?php echo !empty($booking['created_at']) ? date('d/m/Y H:i', strtotime($booking['created_at'])) : ''; ?></td>
            <td>
              <a href="<?= BASE_URL ?>?mode=admin&action=showbooking&id=<?= urlencode($booking['booking_id']) ?>" class="btn btn-sm btn-info">Chi tiết</a>
              <a href="<?= BASE_URL ?>?mode=admin&action=suabooking&id=<?= urlencode($booking['booking_id']) ?>" class="btn btn-sm btn-warning">Sửa</a>
              <a href="<?= BASE_URL ?>?mode=admin&action=deletebooking&id=<?= urlencode($booking['booking_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa booking #<?= htmlspecialchars($booking['booking_id'] ?? '') ?>?');">Xóa</a>
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

