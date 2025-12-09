<div class="container-fluid px-4">

    <h3 class="mt-4 mb-1 fw-bold">Thêm Ngày Lịch Trình</h3>
    <p class="text-muted mb-4">Phiên bản tour: <strong><?= $data_version['version_name'] ?></strong></p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="fw-semibold text-primary mb-3">Thông tin ngày lịch trình</h5>

            <form method="POST">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày thứ</label>
                            <input type="number" name="day_number" class="form-control form-control-lg"
                                   placeholder="VD: 1, 2, 3..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Địa điểm</label>
                            <input type="text" name="place" class="form-control"
                                   placeholder="Nhập địa điểm..." required>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giờ bắt đầu</label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giờ kết thúc</label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <!-- Hoạt động -->
                <h5 class="fw-semibold text-primary mb-3">Hoạt động trong ngày</h5>

                <div class="mb-3">
                    <textarea name="activity" class="form-control" rows="5"
                              placeholder="Nhập nội dung hoạt động..." required></textarea>
                </div>

                <!-- Nút -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&tab=itinerary&id=<?= $data_version['version_id'] ?>"
                       class="btn btn-secondary btn-lg me-2">
                        Hủy
                    </a>

                    <button class="btn btn-success btn-lg px-4">
                        Thêm ngày
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
