<div class="container py-5">

    <div class="row">
        <div class="col-lg-4">
            <div class="card text-center p-4">
                <div class="mx-auto mb-3">
                    <?php if ($data_Guide['avatar']): ?>
                        <img src=" <?= BASE_ASSETS_UPLOADS . $data_Guide['avatar'] ?>" alt="Avatar" class="rounded-circle profile-header-img" width="200">
                    <?php endif; ?>
                </div>
                <h4 class="mb-1"><?= $data_Guide['full_name'] ?></h4>
                <p class="text-muted mb-2">ID: <?= $data_Guide['guide_id'] ?></p>
                <div class="mb-3">
                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> <?= $data_Guide['status'] ?></span>
                    <span class="badge bg-primary"><?= $data_Guide['certificates'] ?></span>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm"><i class="fas fa-phone"></i> <?= $data_Guide['phone'] ?></button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-envelope"></i> <?= $data_Guide['email'] ?></button>
                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between gap-3">
                        <div class="stat-box flex-fill">
                            <div class="text-muted small"><i class="fas fa-star text-warning"></i> Đánh giá</div>
                            <div class="stat-number"><?= $data_Guide['rating'] ?> <small class="text-muted fs-6">/ 5</small></div>
                        </div>
                        <!-- <div class="stat-box flex-fill"> -->
                        <!-- <div class="text-muted small"><i class="fas fa-flag text-primary"></i> Tour đã dẫn</div> -->
                        <!-- <div class="stat-number">120</div> -->
                        <!-- </div> -->
                        <!-- <div class="stat-box flex-fill"> -->
                        <!-- <div class="text-muted small"><i class="fas fa-smile"></i> Hài lòng</div> -->
                        <!-- <div class="stat-number text-success">98%</div> -->
                        <!-- </div> -->
                        <a href="<?= BASE_URL ?>?mode=admin&action=viewEditGuide&id=<?= $data_Guide['user_id']  ?>" class="btn btn-outline-primary">Chỉnh sửa</a>
                        <a href="<?= BASE_URL ?>?mode=admin&action=viewsresources" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
                    </div>
                </div>

                <div class="card mx-auto" style="max-width: 795px">
                    <div class="card-header bg-white fw-bold">Thông tin cơ bản</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-birthday-cake text-muted me-2"></i> Ngày sinh</span>
                            <span class="fw-bold"><?= $data_Guide['birthday'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-venus-mars text-muted me-2"></i> Giới tính</span>
                            <span><?= $data_Guide['gender'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-heartbeat text-muted me-2"></i> Sức khỏe</span>
                            <span class="text-success fw-bold"><?= $data_Guide['health'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-heartbeat text-muted me-2"></i> Ngôn ngữ</span>
                            <span class="badge bg-info text-dark"><?= $data_Guide['languages'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-heartbeat text-muted me-2"></i> Kinh nghiệm</span>
                            <span class="badge bg-info text-dark"><?= $data_Guide['experience_years'] ?> năm</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-certificate me-2"></i> Chứng chỉ & Bằng cấp
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="row g-0">
                                    <!-- <div class="col-4"> -->
                                    <!-- <img src="https://via.placeholder.com/150?text=Card+HDV" class="img-fluid rounded-start h-100 object-fit-cover" alt="..."> -->
                                    <!-- </div> -->
                                    <div class="col-8">
                                        <div class="card-body p-2">
                                            <h6 class="card-title mb-1"><?= $data_Guide['certificates'] ?></h6>
                                            <!-- <p class="card-text small text-muted mb-1">Số: 79-123456</p> -->
                                            <!-- <p class="card-text small mb-1">Hết hạn: 31/12/2026</p> -->
                                            <span class="badge badge-soft-success">Còn hiệu lực</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6"> -->
                        <!-- <div class="card border h-100"> -->
                        <!-- <div class="row g-0"> -->
                        <!-- <div class="col-4"> -->
                        <!-- <img src="https://via.placeholder.com/150?text=First+Aid" class="img-fluid rounded-start h-100 object-fit-cover" alt="..."> -->
                        <!-- </div> -->
                        <!-- <div class="col-8"> -->
                        <!-- <div class="card-body p-2"> -->
                        <!-- <h6 class="card-title mb-1">Chứng chỉ Sơ cấp cứu</h6> -->
                        <!-- <p class="card-text small text-muted mb-1">Cấp bởi: Chữ thập đỏ</p> -->
                        <!-- <p class="card-text small mb-1">Hết hạn: 01/01/2023</p> -->
                        <!-- <span class="badge badge-soft-danger">Đã hết hạn</span> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            <!-- <div class="card mt-3"> -->
            <!-- <div class="card-header bg-white fw-bold">Ghi chú quản lý</div> -->
            <!-- <div class="card-body"> -->
            <!-- <p class="text-muted fst-italic mb-0"><?= $data_Guide['notes'] ?></p> -->
            <!-- </div> -->
            <!-- </div> -->

        </div>
    </div>
</div>