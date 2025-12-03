<div class="container mt-4">

    <h3 class="mb-3">Sửa Phiên Bản Tour</h3>
    <p class="text-muted">Tour: <?= $version['tour_name'] ?></p>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <!-- Tên -->
        <div class="mb-3">
            <label class="form-label fw-bold">Tên phiên bản</label>
            <input type="text" class="form-control" name="version_name"
                value="<?= $version['name'] ?>" required>
        </div>

        <!-- Mã -->
        <div class="mb-3">
            <label class="form-label fw-bold">Mã phiên bản</label>
            <input type="text" class="form-control" name="version_code"
                value="<?= $version['code'] ?>" required>
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label class="form-label fw-bold">Giá</label>
            <input type="number" class="form-control" name="price"
                value="<?= $version['price'] ?>" required>
        </div>

        <!-- Ngày áp dụng -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Từ ngày</label>
                <input type="date" class="form-control"
                    name="valid_from" value="<?= $version['valid_from'] ?>" required>
            </div>

            <div class="col">
                <label class="form-label">Đến ngày</label>
                <input type="date" class="form-control"
                    name="valid_to" value="<?= $version['valid_to'] ?>" required>
            </div>
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái</label>
            <select class="form-select" name="status">
                <option value="1" <?= $version['status'] == 1 ? 'selected' : '' ?>>Đang chạy</option>
                <option value="0" <?= $version['status'] == 0 ? 'selected' : '' ?>>Ngừng</option>
            </select>
        </div>

        <!-- Chính sách -->
        <div class="mb-3">
            <label class="form-label fw-bold">Chính sách</label>
            <textarea class="form-control" rows="6"
                name="policies"><?= $version['policies'] ?></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail" class="btn btn-secondary">Hủy</a>
        <button class="btn btn-primary">Lưu thay đổi</button>

    </form>
</div>