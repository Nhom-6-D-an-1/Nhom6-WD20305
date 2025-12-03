<div class="col-md-12 p-4">

    <!-- Header -->
    <!-- <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div class="flex-grow-1 me-3">
            <input type="text" class="form-control form-control-lg" placeholder="🔍  Tìm kiếm">
        </div>
        <div>Xin chào <strong>Admin</strong></div>
    </div> -->

    <h3 class="mb-4">Thêm tour</h3>

    <div class="card p-4">
        <form action="?mode=admin&action=storetour" method="POST">

            <!-- Tên tour -->
            <label class="form-label">Tên tour</label>
            <input type="text" name="tour_name" class="form-control mb-3" required>

            <!-- Danh mục -->
            <label class="form-label">Danh mục tour</label>
            <select name="category_id" class="form-select mb-3" required>
                <option value="">-- Chọn --</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['category_id'] ?>"><?= $c['category_name'] ?></option>
                <?php endforeach; ?>
            </select>


            <!-- Giá tour -->
            <label class="form-label">Giá tour</label>
            <input type="number" name="price" class="form-control mb-3" placeholder="Nhập giá" required>

            <!-- Ngày khởi hành -->
            <label class="form-label">Ngày khởi hành</label>
            <input type="datetime-local" name="start_date" class="form-control mb-3" required>

            <!-- HDV -->
            <label class="form-label">Hướng dẫn viên phân công</label>
            <select name="user_id" class="form-select mb-3" required>
                <option value="">-- Chọn --</option>
                <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['user_id'] ?>"><?= $g['full_name'] ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Các input cần cho DB nhưng không hiển thị trong UI -->
            <input type="hidden" name="pickup_time" value="08:00">
            <input type="hidden" name="max_guests" value="25">
            <input type="hidden" name="end_date" value="">
            <input type="hidden" name="role_in_tour" value="Hướng dẫn viên">
            <input type="hidden" name="description" value="">
            <input type="hidden" name="itinerary" value="">

            <div class="d-flex gap-3 mt-4">
                <button class="btn btn-primary">Thêm tour</button>
                <a href="?mode=admin&action=viewstour" class="btn btn-secondary">Quay lại</a>
            </div>

        </form>
    </div>
</div>