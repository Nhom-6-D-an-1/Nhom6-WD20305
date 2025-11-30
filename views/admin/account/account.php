<div class="p-4">
          <h3>Quản lý tài khoản</h3>

          <!-- Bộ lọc -->
          <div class="row mb-3">
            <div class="col-md-3">
              <select class="form-select">
                <option selected disabled>Vai trò</option>
                <option>admin</option>
                <option>guide</option>
              </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
              <button class="btn btn-primary">Tìm kiếm</button>
              <a href="<?= BASE_URL ?>?mode=admin&action=addaccount"><button class="btn btn-success">Thêm tài khoản</button></a>
            </div>
          </div>

          <!-- Bảng tài khoản -->
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>Mã tài khoản</th>
                <th>Tên</th>
                <th>Tên đăng nhập</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($accounts) && is_array($accounts)): ?>
                <?php foreach ($accounts as $account): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($account['user_id'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($account['full_name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($account['username'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($account['role'] ?? ''); ?></td>
                    <td>
                      <?php if (($account['status'] ?? 0) == 1): ?>
                        <span class="badge bg-success">Hoạt động</span>
                      <?php else: ?>
                        <span class="badge bg-secondary">Tạm ẩn</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="" class="btn btn-sm btn-info">Sửa</a>
                      <a href="<?= BASE_URL ?>?mode=admin&action=deleteaccount&id=<?= urlencode($account['user_id']) ?>" 
                      class="btn btn-sm btn-danger" 
                      onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
                      Xóa
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">Không có tài khoản nào.</td>
                </tr>
              <?php endif; ?>
            </tbody>
        </div>