<div class="col-md-10 p-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div class="flex-grow-1 me-3">
            <input type="text" class="form-control form-control-lg" placeholder="🔍  Tìm kiếm">
        </div>
        <div class="fw-semibold">Xin chào Admin</div>
    </div>

    <h3 class="mb-4">Quản lý tour</h3>

    <!-- BỘ LỌC -->
    <div class="card p-3 mb-4">
        <div class="d-flex align-items-center gap-3">

            <input type="text" class="form-control" style="max-width: 200px;" placeholder="Tìm tour">

            <select class="form-select" style="max-width: 160px;">
                <option value="">Loại tour</option>
            </select>

            <select class="form-select" style="max-width: 160px;">
                <option value="">Trạng thái</option>
            </select>

            <button class="btn btn-dark">Tìm kiếm</button>

            <a href="?mode=admin&action=addtour" class="btn btn-primary">Thêm tour</a>
        </div>
    </div>

    <!-- DANH SÁCH TOUR -->
    <div class="card p-3">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tên tour</th>
                    <th>Danh mục tour</th>
                    <th>Ngày khởi hành</th>
                    <th>Trạng thái</th>
                    <th>Giá tour</th>
                    <th>HDV phân công</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($tours)) : ?>
                    <?php foreach ($tours as $t) : ?>
                        <tr>
                            <td><?= $t['tour_name'] ?></td>
                            <td><?= $t['category_name'] ?></td>

                            <td>
                                <?= $t['start_date'] ? date("d/m/Y H:i", strtotime($t['start_date'])) : '—' ?>
                            </td>

                            <td>
                                <?php if ($t["start_date"] >= date("Y-m-d")) : ?>
                                    <span class="badge bg-success">Hoạt động</span>
                                <?php else : ?>
                                    <span class="badge bg-secondary">Tạm dừng</span>
                                <?php endif; ?>
                            </td>

                            <td><?= $t['price'] ? number_format($t['price']) . " đ" : '—' ?></td>

                            <td><?= $t['guide_name'] ?: '—' ?></td>

                            <td class="text-center">
                                <a href="?mode=admin&action=viewtourdetail&id=<?= $t['tour_id'] ?>" class="btn btn-sm btn-info text-white">Xem</a>
                                <a href="?mode=admin&action=edittour&id=<?= $t['tour_id'] ?>" class="btn btn-sm btn-warning text-white">Sửa</a>
                                <a onclick="return confirm('Bạn có chắc muốn xoá tour này?')" href="?mode=admin&action=deletetour&id=<?= $t['tour_id'] ?>" class="btn btn-sm btn-danger">Xoá</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="7" class="text-center text-muted">Không có tour nào</td></tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>
