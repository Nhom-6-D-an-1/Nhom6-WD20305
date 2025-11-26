<h3 class="fw-bold mb-4">Chi tiết tour</h3>

<div class="form-section">
    <form method="post" action="<?= BASE_URL ?>?mode=admin&action=showtour">

        <input type="hidden" name="tour_id" value="<?= htmlspecialchars($tour['tour_id'] ?? '') ?>">

        <div class="mb-3">
            <label class="form-label">Danh mục tour:</label>
            <input type="number" name="category_id" class="form-control" placeholder="Nhập ID danh mục" 
                   value="<?= htmlspecialchars((string)($tour['category_id'] ?? '')) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Tên tour:</label>
            <input type="text" name="tour_name" class="form-control" placeholder="Nhập tên tour" 
                   value="<?= htmlspecialchars($tour['tour_name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả tour"><?= htmlspecialchars($tour['description'] ?? '') ?></textarea>
        </div>

        <div class="mt-4 d-flex gap-3">
            <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" class="btn btn-secondary">Quay Lại</a>
        </div>

    </form>
</div>
