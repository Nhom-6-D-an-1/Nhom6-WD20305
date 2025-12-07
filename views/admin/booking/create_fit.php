<div class="container mt-4">
    <h3>Booking khách lẻ</h3>

    <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeFit">

        <input type="hidden" name="departure_id" value="<?= $_GET['departure_id'] ?>">

        <div class="mb-3">
            <label>Họ tên</label>
            <input name="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Giới tính</label>
            <select name="gender" class="form-select">
                <option>Nam</option>
                <option>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Năm sinh</label>
            <input type="date" name="birth_year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>SĐT</label>
            <input name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Yêu cầu đặc biệt</label>
            <textarea name="special_request" class="form-control"></textarea>
        </div>

        <!-- ⭐ THÊM TỔNG TIỀN ⭐ -->
        <div class="mb-3">
            <label>Tổng tiền</label>
            <input type="number" class="form-control" 
                   name="total_amount" 
                   placeholder="Nhập tổng tiền hoặc để trống để tự lấy giá tour">
        </div>

        <!-- ⭐ THÊM TRẠNG THÁI ⭐ -->
        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="pending">pending</option>
                <option value="deposit">deposit</option>
                <option value="completed">completed</option>
                <option value="cancelled">cancelled</option>
            </select>
        </div>

        <button class="btn btn-success">Tạo booking</button>

    </form>
</div>
