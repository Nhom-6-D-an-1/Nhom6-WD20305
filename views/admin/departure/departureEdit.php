<div class="container mt-4">
    <h3>Sửa Chuyến Đi</h3>

    <form method="POST">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Ngày khởi hành</label>
                <input type="date" name="start_date" class="form-control" value="<?= $dep['start_date'] ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control" value="<?= $dep['end_date'] ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Tổng số chỗ</label>
                <input type="number" name="total_seats" class="form-control" value="<?= $dep['total_seats'] ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Còn trống</label>
                <input type="number" class="form-control" value="<?= $dep['available_seats'] ?>" disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label>Giá bán</label>
                <input type="number" name="actual_price" class="form-control" value="<?= $dep['actual_price'] ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Điểm đón</label>
            <input type="text" name="pickup_location" class="form-control" value="<?= $dep['pickup_location'] ?>">
        </div>

        <div class="mb-3">
            <label>Giờ đón</label>
            <input type="time" name="pickup_time" class="form-control" value="<?= $dep['pickup_time'] ?>">
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" class="form-control" rows="3"><?= $dep['note'] ?></textarea>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $dep['version_id'] ?>&tab=departure" class="btn btn-secondary">Hủy</a>
    </form>
</div>