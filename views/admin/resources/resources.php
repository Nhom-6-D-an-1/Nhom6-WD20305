<div class="p-4">
  <h3>Quản lý nhân sự</h3>

  <!-- Bộ lọc và nút thêm -->
  <!-- <div class="d-flex justify-content-between mb-3"> -->
  <!-- <input type="text" class="form-control w-25" placeholder="Tìm HDV..."> -->
  <!-- <button class="btn btn-success">Thêm HDV</button> -->
  <!-- </div> -->

  <!-- Bảng nhân sự -->
  <table class="table table-bordered table-hover">
    <thead class="table">
      <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>Ảnh</th>
        <th>Chứng chỉ</th>
        <th>Ngôn ngữ</th>
        <th>Đánh giá</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data_tourGuide as $key => $value) : ?>
        <tr>
          <td><?= $key + 1 ?></td>
          <td><?= $value['full_name'] ?></td>
          <td>
            <?php if ($value['avatar']) : ?>
              <img src="<?= BASE_ASSETS_UPLOADS . $value['avatar'] ?>" alt="Ảnh" width="100">
            <?php endif; ?>
          </td>
          <td><?= $value['certificates'] ?></td>
          <td><?= $value['languages'] ?></td>
          <td><?= $value['rating'] ?>/5</td>
          <td class="table-actions">
            <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $value['user_id']  ?>" class="btn btn-sm btn-info">Chi Tiết</a>
            <!-- <button class="btn btn-sm btn-danger">Xoá</button> -->
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>