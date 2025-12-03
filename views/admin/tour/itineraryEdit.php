<div class="container mt-4">

    <h3 class="mb-3">Sửa Ngày Lịch Trình</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label fw-bold">Ngày thứ</label>
            <input type="number" name="day_number" class="form-control"
                value="<?= $day['day_number'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tiêu đề</label>
            <input type="text" name="title" class="form-control"
                value="<?= $day['title'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nội dung chi tiết</label>
            <textarea class="form-control" rows="6" name="content"><?= $day['content'] ?></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&tab=itinerary"
            class="btn btn-secondary">Hủy</a>
        <button class="btn btn-primary">Lưu thay đổi</button>



    </form>

</div>