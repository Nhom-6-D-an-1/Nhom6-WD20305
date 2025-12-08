<div class="container-fluid px-4">
    <h3 class="fw-bold mt-4 mb-4">Sửa danh mục tour: <?= $category['category_name'] ?></h3>

    <div class="card">
        <div class="card-body">

            <form action="?mode=admin&action=updatedanhmuc&id=<?= $category['category_id'] ?>" method="POST">

                <div class="mb-3">
                    <label class="form-label">Tên loại tour</label>
                    <input type="text" name="category_name" class="form-control"
                           value="<?= $category['category_name'] ?>" required>
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea name="description" class="form-control" rows="3"><?= $category['description'] ?></textarea>
                </div> -->

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>Đang hoạt động</option>
                        <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>Tạm ẩn</option>
                    </select>
                </div>

                <button class="btn btn-primary">Cập nhật</button>
                <a href="?mode=admin&action=viewsdanhmuc" class="btn btn-secondary">Hủy</a>

            </form>

        </div>
    </div>
</div>
