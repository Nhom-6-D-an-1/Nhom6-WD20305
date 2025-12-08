<div class="container-fluid px-4">

    <h3 class="mt-4 mb-1 fw-bold">Sửa Phiên Bản Tour</h3>
    <p class="text-muted mb-4">Thuộc tour: <strong><?= $data_version['tour_name'] ?></strong></p>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Section 1 -->
            <h5 class="fw-semibold text-primary mb-3">Thông tin phiên bản</h5>

            <form method="POST">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên phiên bản</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="version_name"
                                   value="<?= $data_version['version_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã phiên bản</label>
                            <input type="text" class="form-control"
                                   name="version_code"
                                   value="<?= $data_version['version_code'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mùa</label>
                            <input type="text" class="form-control"
                                   name="season"
                                   value="<?= $data_version['season'] ?>" required>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá (VND)</label>
                            <input type="number" class="form-control"
                                   name="price"
                                   value="<?= $data_version['price'] ?>" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label fw-semibold">Từ ngày</label>
                                <input type="date" class="form-control"
                                       name="valid_from"
                                       value="<?= $data_version['valid_from'] ?>" required>
                            </div>

                            <div class="col">
                                <label class="form-label fw-semibold">Đến ngày</label>
                                <input type="date" class="form-control"
                                       name="valid_to"
                                       value="<?= $data_version['valid_to'] ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="active" <?= $data_version['status'] == "active" ? 'selected' : '' ?>>
                                    Đang chạy
                                </option>
                                <option value="inactive" <?= $data_version['status'] == "inactive" ? 'selected' : '' ?>>
                                    Ngừng
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Section 2 -->
                <h5 class="fw-semibold text-primary mb-3">Chính sách áp dụng</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="6"
                              name="policies"><?= $data_version['policies'] ?></textarea>
                </div>

                <!-- Nút -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $data_version['version_id'] ?>" 
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
