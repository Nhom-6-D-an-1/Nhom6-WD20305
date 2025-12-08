<div class="container-fluid px-4">

    <h3 class="mt-4 mb-4 fw-bold">Tạo Tour Mới</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Tiêu đề nhỏ -->
            <h5 class="fw-semibold mb-3 text-primary">Thông tin cơ bản</h5>

            <form method="post" class="mt-2">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên Tour</label>
                            <input type="text" class="form-control form-control-lg" 
                                   name="tour_name" placeholder="Nhập tên tour...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã Tour</label>
                            <input type="text" class="form-control" 
                                   name="tour_code" placeholder="Ví dụ: HG-001">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục Tour</label>
                            <select class="form-select" name="category_id">
                                <?php foreach ($data_category as $value): ?>
                                    <option value="<?= $value['category_id'] ?>">
                                        <?= htmlspecialchars($value['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thời lượng (ngày)</label>
                            <input type="number" class="form-control" 
                                   name="duration_days" placeholder="Ví dụ: 3">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả ngắn</label>
                            <textarea class="form-control" rows="3"
                                      name="short_description"
                                      placeholder="Nhập mô tả ngắn..."></textarea>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Mô tả chi tiết -->
                <h5 class="fw-semibold mb-3 text-primary">Chi tiết Tour</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="6" 
                              name="description" placeholder="Nhập nội dung chi tiết tour..."></textarea>
                </div>


                <!-- Nút hành động -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" 
                       class="btn btn-secondary btn-lg me-2">
                        Quay lại
                    </a>

                    <button class="btn btn-primary btn-lg px-4">
                        Lưu Tour
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
