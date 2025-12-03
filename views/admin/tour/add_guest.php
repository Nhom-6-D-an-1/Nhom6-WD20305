<div class="col-md-12 p-4">

    <div class="card p-4">
        <form action="?mode=admin&action=storeguest" method="POST">

            <!-- Gửi departure_id để thêm khách đúng chuyến -->
            <input type="hidden" name="departure_id" value="<?= $_GET['departure_id'] ?>">

            <!-- Tên khách -->
            <label class="form-label">Tên khách</label>
            <input type="text" name="full_name" class="form-control mb-3" required>

            <!-- SĐT -->
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control mb-3" required>

            <!-- Giới tính -->
            <label class="form-label">Giới tính</label>
            <select name="gender" class="form-select mb-3">
                <option value="">-- Chọn --</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>

            <!-- Năm sinh -->
            <label class="form-label">Năm sinh</label>
            <input type="number" name="birth_year" class="form-control mb-3">

            <!-- Yêu cầu đặc biệt -->
            <label class="form-label">Yêu cầu đặc biệt</label>
            <textarea name="special_request" class="form-control mb-3"></textarea>

            <button class="btn btn-primary">Thêm khách</button>

            <!-- Nút quay lại đúng departure_id -->
            <a href="?mode=admin&action=guestlist&departure_id=<?= $_GET['departure_id'] ?>"
                class="btn btn-secondary">
                Quay lại
            </a>

        </form>
    </div>

</div>