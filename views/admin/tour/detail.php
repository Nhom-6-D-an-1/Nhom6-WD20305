<div class="col-md-10 p-4">

  <h3>Chi tiết tour</h3>

  <!-- Thông tin tour -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      Thông tin tour
    </div>
    <div class="card-body">
      <p><strong>Tên tour:</strong> <?= $tour['tour_name'] ?></p>
      <p><strong>Danh mục:</strong> <?= $tour['category_id'] ?></p>
      <p><strong>Mô tả:</strong></p>
      <p><?= nl2br($tour['description']) ?></p>
    </div>
  </div>

  <!-- Phiên bản tour -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Phiên bản tour</h4>
    <a href="index.php?controller=tour&action=createVersion&tour_id=<?= $tour['tour_id'] ?>"
       class="btn btn-success">
      + Thêm phiên bản
    </a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Tên phiên bản</th>
        <th>Giá</th>
        <th>Tóm tắt lịch trình</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($versions)): ?>
        <tr>
          <td colspan="4" class="text-center text-muted">Chưa có phiên bản nào</td>
        </tr>
      <?php else: ?>
        <?php foreach ($versions as $v): ?>
          <tr>
            <td><?= $v['version_name'] ?></td>
            <td><?= number_format($v['price']) ?> đ</td>
            <td><?= nl2br($v['itinerary']) ?></td>
            <td>
              <!-- Nút sửa -->
              <a href="index.php?controller=tour&action=editVersion&id=<?= $v['version_id'] ?>"
                 class="btn btn-sm btn-primary">Sửa</a>

              <!-- Nút xóa -->
              <a href="index.php?controller=tour&action=deleteVersion&id=<?= $v['version_id'] ?>&tour_id=<?= $tour['tour_id'] ?>"
                 onclick="return confirm('Xóa phiên bản này?')"
                 class="btn btn-sm btn-danger">
                Xóa
              </a>

              <!-- Nút xem lịch trình -->
              <a href="index.php?controller=tour&action=itinerary&version_id=<?= $v['version_id'] ?>"
                 class="btn btn-sm btn-info">
                Lịch trình
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="index.php?controller=tour&action=index" class="btn btn-secondary mt-3">Quay lại</a>

</div>
