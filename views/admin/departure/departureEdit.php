<div class="container mt-4">
    <h3>Sửa Chuyến Đi</h3>

    <form method="POST">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Ngày khởi hành</label>
                <input type="date" name="start_date" class="form-control"
                    value="<?= $data_departure['start_date'] ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control"
                    value="<?= $data_departure['end_date'] ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Số khách tối đa</label>
                <input type="number" name="max_guests" class="form-control"
                    value="<?= $data_departure['max_guests'] ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Giá bán</label>
                <input type="number" name="actual_price" class="form-control"
                    value="<?= $data_departure['actual_price'] ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Giờ đón</label>
                <input type="time" name="pickup_time" class="form-control"
                    value="<?= $data_departure['pickup_time'] ?>">
            </div>
        </div>

        <div class="mb-3">
            <label>Điểm đón</label>
            <input type="text" name="pickup_location" class="form-control"
                value="<?= $data_departure['pickup_location'] ?>">
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" rows="3" class="form-control"><?= $data_departure['note'] ?></textarea>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="open" <?= $data_departure['status'] == 'open' ? 'selected' : '' ?>>Mở bán</option>
                <option value="full" <?= $data_departure['status'] == 'full' ? 'selected' : '' ?>>Full</option>
                <option value="closed" <?= $data_departure['status'] == 'closed' ? 'selected' : '' ?>>Đóng</option>
                <option value="completed" <?= $data_departure['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
            </select>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture"
            class="btn btn-secondary">Hủy</a>
        <button class="btn btn-primary">Cập nhật</button>


    </form>
</div>