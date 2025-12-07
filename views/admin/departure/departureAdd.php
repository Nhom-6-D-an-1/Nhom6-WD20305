<div class="container mt-4">
    <h3>Thêm Chuyến Đi</h3>

    <form method="POST">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Ngày khởi hành</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Số khách tối đa</label>
                <input type="number" name="max_guests" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Giá bán</label>
                <input type="number" name="actual_price" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Giờ đón</label>
                <input type="time" name="pickup_time" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Điểm đón</label>
            <input type="text" name="pickup_location" class="form-control">
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" rows="3" class="form-control"></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>&tab=info" class="btn btn-secondary">Hủy</a>
        <button class="btn btn-success">Lưu</button>
    </form>
</div>