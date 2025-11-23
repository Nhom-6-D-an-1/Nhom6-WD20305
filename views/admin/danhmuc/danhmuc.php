<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Danh mục tour</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Thanh hành động -->
            <div class="d-flex justify-content-between mb-3">

                <!-- Bộ lọc trạng thái -->
                <form method="GET" action="" class="d-flex">
                    <input type="hidden" name="mode" value="admin">
                    <input type="hidden" name="action" value="viewsdanhmuc">

                    <select name="status" class="form-select me-2" style="width:180px;">
                        <option value="">Trạng thái</option>
                        <option value="1" <?= isset($_GET['status']) && $_GET['status']=='1' ? 'selected' : '' ?>>
                            Đang hoạt động
                        </option>
                        <option value="0" <?= isset($_GET['status']) && $_GET['status']=='0' ? 'selected' : '' ?>>
                            Tạm ẩn
                        </option>
                    </select>

                    <button class="btn btn-primary">Tìm kiếm</button>
                </form>

                <!-- Nút thêm -->
                <a href="?mode=admin&action=adddanhmuc" class="btn btn-success">
                    + Thêm loại tour
                </a>
            </div>

            <!-- Bảng dữ liệu -->
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:60px;">STT</th>
                        <th>Tên loại tour</th>
                        <th style="width:350px;">Mô tả ngắn</th>
                        <th style="width:150px;">Trạng thái</th>
                        <th style="width:200px;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($list)): ?>
                        <?php foreach($list as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>

                                <td><?= $item['category_name'] ?></td>

                                <td><?= $item['description'] ?></td>

                                <td>
                                    <?php if ($item['status'] == 1): ?>
                                        <span class="badge bg-success">Đang hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tạm ẩn</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="?mode=admin&action=xemchitietdanhmuc&id=<?= $item['category_id'] ?>" 
                                       class="btn btn-info btn-sm">Xem</a>

                                    <a href="?mode=admin&action=suadanhmuc&id=<?= $item['category_id'] ?>" 
                                       class="btn btn-primary btn-sm">Sửa</a>

                                    <a href="?mode=admin&action=xoadanhmuc&id=<?= $item['category_id'] ?>"
                                       onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"
                                       class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có danh mục nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
