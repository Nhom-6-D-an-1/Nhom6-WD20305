<div class="col-md-10 p-4">

    <!-- Header -->
    <!-- <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div class="flex-grow-1 me-3">
            <input type="text" class="form-control form-control-lg" placeholder="🔍  Tìm kiếm">
        </div>
        <div>Xin chào <strong>Admin</strong></div>
    </div> -->

    <h3 class="mb-4">Sửa tour: <?= $tour['tour_name'] ?></h3>

    <div class="card p-4">

        <form action="?mode=admin&action=updatetour" method="POST">

            <input type="hidden" name="tour_id" value="<?= $tour['tour_id'] ?>">

            <!-- Tên tour -->
            <label class="form-label">Tên tour</label>
            <input type="text" name="tour_name" class="form-control mb-3"
                   value="<?= $tour['tour_name'] ?>" required>

            <!-- Danh mục -->
            <label class="form-label">Loại tour</label>
            <select name="category_id" class="form-select mb-3" required>
                <?php foreach($categories as $c): ?>
                    <option value="<?= $c['category_id'] ?>"
                        <?= $c['category_id'] == $tour['category_id'] ? 'selected' : '' ?>>
                        <?= $c['category_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Trạng thái (UI only – không lưu DB) -->
            <label class="form-label">Trạng thái</label>
            <select class="form-select mb-3">
                <option <?= strtotime($tour['start_date']) > time() ? 'selected' : '' ?>>Hoạt động</option>
                <option <?= strtotime($tour['start_date']) <= time() ? 'selected' : '' ?>>Tạm dừng</option>
            </select>

            <!-- Giá -->
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control mb-3"
                   value="<?= $tour['price'] ?>" required>

            <!-- Ngày khởi hành -->
            <label class="form-label">Ngày khởi hành</label>
            <input type="datetime-local" name="start_date" class="form-control mb-3"
                   value="<?= date('Y-m-d\TH:i', strtotime($tour['start_date'])) ?>" required>

            <!-- HDV -->
            <label class="form-label">HDV phân công</label>
            <select name="user_id" class="form-select mb-4">
                <option value="">-- Chọn --</option>
                <?php foreach($guides as $g): ?>
                    <option value="<?= $g['user_id'] ?>"
                        <?= isset($tour['user_id']) && $tour['user_id'] == $g['user_id'] ? 'selected' : '' ?>>
                        <?= $g['full_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Các dữ liệu khác không cho sửa -->
            <input type="hidden" name="version_name" value="Phiên bản tiêu chuẩn">
            <input type="hidden" name="pickup_location" value="Không có">
            <input type="hidden" name="pickup_time" value="00:00">
            <input type="hidden" name="max_guests" value="30">

            <div class="d-flex gap-3">
                <button class="btn btn-primary">Sửa</button>
                <a href="?mode=admin&action=viewstour" class="btn btn-secondary">Quay lại</a>
            </div>

        </form>

    </div>
</div>
