<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold mb-0">Booking khách lẻ</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewsbooking" class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeFit">

                <input type="hidden" name="departure_id" 
                       value="<?= htmlspecialchars($_GET['departure_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                <!-- THÔNG TIN KHÁCH -->
                <h5 class="fw-semibold text-primary mb-3">Thông tin khách</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Họ tên</label>
                        <input name="full_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Giới tính</label>
                        <select name="gender" class="form-select">
                            <option>Nam</option>
                            <option>Nữ</option>
                        </select>
                    </div>
                </div>
        <div class="mb-3">
            <label>SĐT</label>
            <input name="phone" class="form-control" required>
        </div>
              <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ngày sinh</label>
                        <input type="date" name="birth_year" class="form-control" required>
                    </div>
        <div class=" mb-3"><label>CCCD</label>
            <input name="cccd" class="form-control">
        </div>
        <div class="mb-3">
            <label>Yêu cầu đặc biệt</label>
            <textarea name="special_request" class="form-control"></textarea>
        </div>

                
                <!-- THANH TOÁN -->
                <h5 class="fw-semibold text-primary mt-4 mb-3">Thanh toán</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tổng tiền</label>
                        <input type="number" class="form-control" 
                               name="total_amount"
                               placeholder="Bỏ trống = lấy giá tour tự động">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="pending">Chờ xác nhận</option>
                            <option value="deposit">Đã đặt cọc</option>
                            <option value="completed">Đã thanh toán</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-4">
                    <button class="btn btn-success px-4">Tạo booking</button>
                </div>

            </form>

        </div>
    </div>
</div>
