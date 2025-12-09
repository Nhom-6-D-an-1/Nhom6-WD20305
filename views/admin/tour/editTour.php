<div class="container-fluid px-4">

    <h3 class="mt-4 mb-1 fw-bold">Chỉnh sửa Tour</h3>
    <p class="text-muted mb-4">Mã tour: <strong><?= $data_tour['tour_code'] ?></strong></p>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Nhóm 1 -->
            <h5 class="fw-semibold text-primary mb-3">Thông tin cơ bản</h5>

            <form method="post">

                <div class="row g-4">

                    <!-- Cột trái -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên Tour</label>
                            <input type="text" 
                                   class="form-control form-control-lg"
                                   name="tour_name"
                                   value="<?= $data_tour['tour_name'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mã Tour</label>
                            <input type="text" 
                                   class="form-control"
                                   name="tour_code"
                                   value="<?= $data_tour['tour_code'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục</label>
                            <select class="form-select" name="category_id">
                                <?php foreach ($data_category as $value): ?>
                                    <option value="<?= $value['category_id'] ?>" 
                                        <?= $data_tour['category_id'] == $value['category_id'] ? 'selected' : '' ?>>
                                        <?= $value['category_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thời lượng (ngày)</label>
                            <input type="number" 
                                   class="form-control"
                                   name="duration_days"
                                   value="<?= $data_tour['duration_days'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả ngắn</label>
                            <textarea class="form-control" rows="3" name="short_description"><?= $data_tour['short_description'] ?></textarea>
                        </div>

                    </div>
                </div>

                <hr class="my-4">

                <!-- Nhóm mô tả -->
                <h5 class="fw-semibold text-primary mb-3">Mô tả chi tiết</h5>

                <div class="mb-3">
                    <textarea class="form-control" rows="6" 
                              name="description"><?= $data_tour['description'] ?></textarea>
                </div>

                <!-- Nút -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" 
