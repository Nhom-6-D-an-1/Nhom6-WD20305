<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Chi tiết danh mục tour: <?= $category['category_name'] ?></h3>

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Tên danh mục tour</label>
                <input type="text" class="form-control" value="<?= $category['category_name'] ?>" disabled>
            </div>

            <!-- <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control" rows="3" disabled><?= $category['description'] ?></textarea>
            </div> -->

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <input type="text" class="form-control"
                       value="<?= $category['status'] == 1 ? 'Đang hoạt động' : 'Tạm ẩn' ?>" disabled>
            </div>

            <a href="?mode=admin&action=viewsdanhmuc" class="btn btn-secondary">Quay lại</a>

        </div>
    </div>
</div>
