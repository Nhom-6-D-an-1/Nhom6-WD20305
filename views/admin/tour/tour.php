<?php
?>
      <div class="col-md-10 p-4">
        <h3>Quản lý tour</h3>

        <!-- Bộ lọc -->
        <div class="row mb-3">
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm tour...">
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Loại tour</option>
              <option>Trong nước</option>
              <option>Quốc tế</option>
              <option>Theo yêu cầu</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Địa điểm</option>
              <option>Hà Nội</option>
              <option>TP.HCM</option>
              <option>Đà Nẵng</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Trạng thái</option>
              <option>Hoạt động</option>
              <option>Tạm dừng</option>
            </select>
          </div>
        </div>

        <!-- Thêm tour -->
        <div class="card mb-4">
          <div class="card-body">
            <form method="post" action="<?php echo BASE_URL; ?>?mode=admin&action=addtour">
              <div class="row g-2">
                <div class="col-md-3">
                  <input type="text" name="tour_name" class="form-control" placeholder="Tên tour" required>
                </div>
                <div class="col-md-2">
                  <input type="number" name="category_id" class="form-control" placeholder="Mã loại" required>
                </div>
                <div class="col-md-5">
                  <input type="text" name="description" class="form-control" placeholder="Mô tả">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-success w-100">Thêm tour</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Bảng dữ liệu -->
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>Mã</th>
              <th>Tên tour</th>
              <th>Mã loại</th>
              <th>Mô tả</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($tours) && is_array($tours)): ?>
              <?php foreach ($tours as $tour): ?>
                <tr>
                  <td><?php echo htmlspecialchars($tour['tour_id'] ?? ''); ?></td>
                  <td><?php echo htmlspecialchars($tour['tour_name'] ?? ''); ?></td>
                  <td><?php echo htmlspecialchars($tour['category_id'] ?? ''); ?></td>
                  <td><?php echo htmlspecialchars($tour['description'] ?? ''); ?></td>
                  <td>
                    <a href="<?= BASE_URL ?>?mode=admin&action=showtour&id=<?= urlencode($tour['tour_id']) ?>" class="btn btn-sm btn-success">Chi tiết</a>
                    <a href="<?= BASE_URL ?>?mode=admin&action=edittour&id=<?= urlencode($tour['tour_id']) ?>" class="btn btn-sm btn-warning">Sửa</a>
                    <a href="<?php echo BASE_URL; ?>?mode=admin&action=deletetour&id=<?php echo urlencode($tour['tour_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tour này?');">Xóa</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center">Không có tour nào</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      