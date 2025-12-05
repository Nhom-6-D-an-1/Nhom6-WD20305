<div class="container mt-4">
    <h3>Sửa Ngày Lịch Trình</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Ngày thứ</label>
            <input type="number" name="day_number" value="<?= $data_itinerary['day_number'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giờ bắt đầu</label>
            <input type="time" name="start_time" value="<?= $data_itinerary['start_time'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giờ kết thúc</label>
            <input type="time" name="end_time" value="<?= $data_itinerary['end_time'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa điểm</label>
            <input type="text" name="place" value="<?= $data_itinerary['place'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hoạt động</label>
            <textarea name="activity" class="form-control" rows="4" required><?= $data_itinerary['activity'] ?></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_itinerary['version_id'] ?>&tab=itinerary"
            class="btn btn-secondary">Hủy</a>
        <button class="btn btn-primary">Lưu thay đổi</button>

    </form>
</div>