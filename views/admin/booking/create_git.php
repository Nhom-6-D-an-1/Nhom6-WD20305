<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold mb-0">Booking khách đoàn</h3>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewsbooking" 
           class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=storeGroup">

                <!-- ẨN departure -->
                <input type="hidden" name="departure_id" 
                       value="<?= htmlspecialchars($_GET['departure_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                <!-- THÔNG TIN NGƯỜI ĐẠI DIỆN -->
                <h5 class="fw-semibold text-primary mb-3">Thông tin người đại diện đoàn</h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Họ tên</label>
                    <input name="contact_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Số điện thoại</label>
                    <input name="contact_phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Yêu cầu chung của đoàn</label>
                    <textarea name="group_request" class="form-control" rows="3"></textarea>
                </div>

                <!-- BUTTON -->
                <div class="mt-4">
                    <button class="btn btn-success px-4">Tiếp tục</button>
                </div>

            </form>

        </div>
    </div>
</div>
