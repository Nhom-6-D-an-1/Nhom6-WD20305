<div class="container mt-4">

    <h3 class="mb-3">Sửa Phiên Bản Tour</h3>
    <p class="text-muted">Tour: <?= $data_version['tour_name'] ?></p>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <!-- Tên -->
        <div class="mb-3">
            <label class="form-label fw-bold">Tên phiên bản</label>
            <input type="text" class="form-control" name="version_name"
                value="<?= $data_version['version_name'] ?>" required>
        </div>

        <!-- Mã -->
        <div class="mb-3">
            <label class="form-label fw-bold">Mã phiên bản</label>
            <input type="text" class="form-control" name="version_code"
                value="<?= $data_version['version_code'] ?>" required>
        </div>

        <!-- Mùa -->
        <div class="mb-3">
            <label class="form-label fw-bold">Mùa</label>
            <input type="text" class="form-control" name="season"
                value="<?= $data_version['season'] ?>" required>
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label class="form-label fw-bold">Giá</label>
            <input type="number" class="form-control" name="price"
                value="<?= $data_version['price'] ?>" required>
        </div>

        <!-- Ngày áp dụng -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Từ ngày</label>
                <input type="date" class="form-control"
                    name="valid_from" value="<?= $data_version['valid_from'] ?>" required>
            </div>

            <div class="col">
                <label class="form-label">Đến ngày</label>
                <input type="date" class="form-control"
                    name="valid_to" value="<?= $data_version['valid_to'] ?>" required>
            </div>
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái</label>
            <select class="form-select" name="status">
                <option value="active" <?= $data_version['status'] == "active" ? 'selected' : '' ?>>Đang chạy</option>
                <option value="inactive" <?= $data_version['status'] == "inactive" ? 'selected' : '' ?>>Ngừng</option>
            </select>
        </div>

        <!-- Chính sách -->
        <div class="mb-3">
            <label class="form-label fw-bold">Chính sách</label>
            <textarea class="form-control" rows="6"
                name="policies"><?= $data_version['policies'] ?></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>" class="btn btn-secondary">Hủy</a>
        <button class="btn btn-primary">Lưu thay đổi</button>

    </form>
</div>