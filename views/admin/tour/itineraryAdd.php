<div class="container mt-4">

    <h3 class="mb-3">Thêm Ngày Lịch Trình</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label fw-bold">Ngày thứ</label>
            <input type="number" name="day_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nội dung chi tiết</label>
            <textarea class="form-control" rows="6" name="content"></textarea>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&tab=itinerary"
            class="btn btn-secondary">Hủy</a>
        <button class="btn btn-success">Thêm ngày</button>



    </form>

</div>