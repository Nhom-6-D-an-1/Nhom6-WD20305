<div class="container mt-4">
    <h3>Tạo Phiên Bản Tour</h3>
    <p class="text-muted">Thuộc tour: <?= $data['tour_name'] ?></p>

    <form class="mt-3" method="post">
        <input type="hidden" name="tour_id" value="<?= $data['tour_id'] ?>">
        <div class="mb-3">
            <label class="form-label">Tên phiên bản</label>
            <input type="text" class="form-control" name="version_name" placeholder="V1.2 - Summer 2025">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã phiên bản</label>
            <input type="text" class="form-control" name="version_code" placeholder="HG-001-V12">
        </div>

        <div class="mb-3">
            <label class="form-label">Mùa</label>
            <input type="text" class="form-control" name="season">
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" class="form-control" name="price">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày áp dụng</label>
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" name="valid_from">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="valid_to">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Chính sách</label>
            <textarea class="form-control" rows="4" name="policies"></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&tab=versions&id=<?= $data['tour_id'] ?>" class="btn btn-secondary">Quay lại</a>
        <button class="btn btn-primary">Tạo phiên bản</button>

    </form>
</div>