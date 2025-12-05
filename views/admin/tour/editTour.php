<div class="container mt-4">
    <h3>Chỉnh Sửa Tour Mới</h3>

    <form class="mt-3" method="post">

        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" class="form-control" name="tour_name" value="<?= $data_tour['tour_name'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã Tour</label>
            <input type="text" class="form-control" name="tour_code" value="<?= $data_tour['tour_code'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select class="form-select" name="category_id">
                <?php foreach ($data_category as $value): ?>
                    <option value="<?= $value['category_id'] ?>" <?php if ($data_tour['category_id'] == $value['category_id']): ?>selected<?php endif; ?>><?= $value['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả ngắn</label>
            <textarea class="form-control" rows="3" name="short_description"><?= $data_tour['short_description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea class="form-control" rows="5" name="description"><?= $data_tour['description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Thời lượng (ngày)</label>
            <input type="number" class="form-control" name="duration_days" value="<?= $data_tour['duration_days'] ?>">
        </div>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" class="btn btn-secondary">Quay lại</a>
        <button class="btn btn-primary ms-2">Cập nhật</button>

    </form>
</div>