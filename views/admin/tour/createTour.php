<div class="container mt-4">
    <h3>Tạo Tour Mới</h3>

    <form class="mt-3" method="post">

        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" class="form-control" name="tour_name">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã Tour</label>
            <input type="text" class="form-control" name="tour_code">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select class="form-select" name="category_id">
                <?php foreach ($data_category as $value): ?>
                    <option value="<?= $value['category_id'] ?>"><?= $value['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả ngắn</label>
            <textarea class="form-control" rows="3" name="short_description"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea class="form-control" rows="5" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Thời lượng (ngày)</label>
            <input type="number" class="form-control" name="duration_days">
        </div>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" class="btn btn-secondary">Quay lại</a>
        <button class="btn btn-primary ms-2">Lưu Tour</button>

    </form>
</div>