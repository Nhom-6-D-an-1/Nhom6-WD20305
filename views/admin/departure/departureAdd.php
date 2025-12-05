<div class="container mt-4">
    <h3>Thêm Chuyến Đi</h3>

    <form method="POST">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày khởi hành</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Tổng số chỗ</label>
                <input type="number" name="total_seats" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Giá bán</label>
                <input type="number" name="actual_price" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">HDV phụ trách</label>
                <select name="guide_id" class="form-select">
                    <option value="">-- Chưa phân công --</option>
                    <?php foreach ($data_guides as $g): ?>
                        <option value="<?= $g['user_id'] ?>"><?= $g['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Điểm đón</label>
            <input type="text" name="pickup_location" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Giờ đón</label>
            <input type="time" name="pickup_time" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>&tab=info" class="btn btn-secondary">Hủy</a>
        <button class="btn btn-success">Lưu chuyến đi</button>

    </form>
</div>