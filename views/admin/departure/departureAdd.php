<div class="container-fluid px-4">

    <h3 class="mt-4 mb-1 fw-bold">Thêm Chuyến Đi</h3>
    <p class="text-muted mb-4">Phiên bản tour: <strong><?= $data_version['version_name'] ?></strong></p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="fw-semibold text-primary mb-3">Thông tin chuyến đi</h5>

            <form method="POST">

                <div class="row g-4">
                    <div class="mt-4">
                        <label class="form-label fw-semibold">Tên chuyến đi</label>
                        <input type="text" name="departure_name" class="form-control" required>
                    </div>
                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày khởi hành</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Số khách tối đa</label>
                            <input type="number" name="max_guests" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Điểm đón</label>
                            <input type="text" name="pickup_location" class="form-control" placeholder="VD: 123 Trần Duy Hưng, Hà Nội">
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá bán</label>
                            <input type="number" name="actual_price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giờ đón</label>
                            <input type="time" name="pickup_time" class="form-control">
                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <!-- Ghi chú -->
                <h5 class="fw-semibold text-primary mb-3">Ghi chú</h5>

                <div class="mb-3">
                    <textarea name="note" rows="4" class="form-control" placeholder="Thông tin bổ sung..."></textarea>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>&tab=info"
                        class="btn btn-secondary btn-lg me-2">
                        Hủy
                    </a>

                    <button class="btn btn-success btn-lg px-4">
                        Lưu chuyến đi
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>