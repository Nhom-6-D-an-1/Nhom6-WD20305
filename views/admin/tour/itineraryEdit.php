<div class="container-fluid px-4">

    <h3 class="mt-4 mb-1 fw-bold">Sửa Ngày Lịch Trình</h3>
    <p class="text-muted mb-4">Phiên bản tour: <strong><?= $data_itinerary['version_name'] ?></strong></p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="fw-semibold text-primary mb-3">Thông tin ngày</h5>

            <form method="POST">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày thứ</label>
                            <input type="number"
                                   name="day_number"
                                   value="<?= $data_itinerary['day_number'] ?>"
                                   class="form-control form-control-lg"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Địa điểm</label>
                            <input type="text"
                                   name="place"
                                   value="<?= $data_itinerary['place'] ?>"
                                   class="form-control"
                                   required>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giờ bắt đầu</label>
                            <input type="time"
                                   name="start_time"
                                   value="<?= $data_itinerary['start_time'] ?>"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giờ kết thúc</label>
                            <input type="time"
                                   name="end_time"
                                   value="<?= $data_itinerary['end_time'] ?>"
                                   class="form-control"
                                   required>
                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <h5 class="fw-semibold text-primary mb-3">Hoạt động trong ngày</h5>

                <div class="mb-3">
                    <textarea name="activity"
                              class="form-control"
                              rows="5"
                              required><?= $data_itinerary['activity'] ?></textarea>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_itinerary['version_id'] ?>&tab=itinerary"
                       class="btn btn-secondary btn-lg me-2">
                        Hủy
                    </a>

                    <button class="btn btn-primary btn-lg px-4">
                        Lưu thay đổi
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
