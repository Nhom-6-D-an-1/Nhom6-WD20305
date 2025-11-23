<?php ?>
<div class="p-4">
  <h3>Danh mục tour</h3>

  <!-- Thêm danh mục -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="post" action="<?= BASE_URL ?>?mode=admin&action=addcategory">
        <div class="row g-2">
          <div class="col-md-6">
            <input type="text" name="category_name" class="form-control" placeholder="Tên danh mục tour" required>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Thêm loại</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Bảng danh mục -->
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Tên loại tour</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($categories) && is_array($categories)): ?>
        <?php foreach ($categories as $cat): ?>
          <tr>
            <td><?php echo htmlspecialchars($cat['category_id'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($cat['category_name'] ?? ''); ?></td>
            <td>
              <a href="<?= BASE_URL ?>?mode=admin&action=deletecategory&id=<?= urlencode($cat['category_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?');">Xoá</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center">Không có danh mục nào</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>