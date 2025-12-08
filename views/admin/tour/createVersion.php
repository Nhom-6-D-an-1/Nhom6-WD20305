<div class="container-fluid px-4">

    <h3 class="mt-4 mb-1 fw-bold">Tạo Phiên Bản Tour</h3>
    <p class="text-muted mb-4">Thuộc tour: <strong><?= $data['tour_name'] ?></strong></p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Tiêu đề nhỏ -->
            <h5 class="fw-semibold text-primary mb-3">Thông tin phiên bản</h5>

            <form method="post">

                <input type="hidden" name="tour_id" value="<?= $data['tour_id'] ?>">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên phiên bản</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="version_name" placeholder="VD: V1.2 - Hè 2025">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã phiên bản</label>
                            <input type="text" class="form-control"
                                   name="version_code" placeholder="VD: HG-001-V12">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mùa</label>
                            <input type="text" class="form-control" name="season" placeholder="Xuân / Hè / Thu / Đông">
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá (VND)</label>
                            <input type="number" class="form-control" name="price" placeholder="Nhập giá...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày áp dụng</label>
                            <div class="d-flex gap-3">
                                <input type="date" class="form-control" name="valid_from">
                                <input type="date" class="form-control" name="valid_to">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Phần chính sách -->
                <h5 class="fw-semibold text-primary mb-3">Chính sách áp dụng</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="5" name="policies"
                              placeholder="Nhập chính sách cho phiên bản tour..."></textarea>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&tab=versions&id=<?= $data['tour_id'] ?>" 
                       class="btn btn-secondary btn-lg me-2">
                        Quay lại
                    </a>

                    <button class="btn btn-primary btn-lg px-4">
                        Tạo phiên bản
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
