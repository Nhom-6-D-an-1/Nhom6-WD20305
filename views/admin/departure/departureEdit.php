<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold">Sửa Chuyến Đi</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST">

                <!-- DATE FIELDS -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ngày khởi hành</label>
                        <input type="date" name="start_date" class="form-control"
                               value="<?= $data_departure['start_date'] ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ngày kết thúc</label>
                        <input type="date" name="end_date" class="form-control"
                               value="<?= $data_departure['end_date'] ?>" required>
                    </div>
                </div>

                <!-- GUESTS + PRICE + TIME -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Số khách tối đa</label>
                        <input type="number" name="max_guests" class="form-control"
                               value="<?= $data_departure['max_guests'] ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Giá bán</label>
                        <input type="number" name="actual_price" class="form-control"
                               value="<?= $data_departure['actual_price'] ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Giờ đón</label>
                        <input type="time" name="pickup_time" class="form-control"
                               value="<?= $data_departure['pickup_time'] ?>">
                    </div>
                </div>

                <!-- PICKUP LOCATION -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Địa điểm đón</label>
                    <input type="text" name="pickup_location" class="form-control"
                           value="<?= $data_departure['pickup_location'] ?>">
                </div>

                <!-- NOTE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ghi chú</label>
                    <textarea name="note" rows="3" class="form-control"><?= $data_departure['note'] ?></textarea>
                </div>

                <!-- STATUS -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="open"      <?= $data_departure['status'] == 'open' ? 'selected' : '' ?>>Mở bán</option>
                        <option value="full"      <?= $data_departure['status'] == 'full' ? 'selected' : '' ?>>Full</option>
                        <option value="closed"    <?= $data_departure['status'] == 'closed' ? 'selected' : '' ?>>Đóng</option>
                        <option value="completed" <?= $data_departure['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                    </select>
                </div>

                <!-- BUTTONS -->
                <div class="mt-3">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-secondary">
                        Hủy
                    </a>
                    <button class="btn btn-primary ms-2">
                        Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
