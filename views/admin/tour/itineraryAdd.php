<div class="container mt-4">
    <h3>Thêm Ngày Lịch Trình</h3>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Ngày thứ</label>
            <input type="number" name="day_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giờ bắt đầu</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giờ kết thúc</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa điểm</label>
            <input type="text" name="place" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hoạt động</label>
            <textarea name="activity" class="form-control" rows="4" required></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&tab=itinerary&id=<?= $data_version['version_id'] ?>"
            class="btn btn-secondary">Hủy</a>
        <button class="btn btn-success">Thêm ngày</button>
    </form>
</div>