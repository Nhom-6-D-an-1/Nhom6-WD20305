<div class="container py-5">

    <div class="row">
        <!-- ========================== -->
        <!--       CỘT TRÁI - AVATAR    -->
        <!-- ========================== -->
        <div class="col-lg-4">
            <div class="card text-center p-4">
                <div class="mx-auto mb-3">
                    <?php if (!empty($data_Guide['avatar'])): ?>
                        <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['avatar'] ?>" 
                             alt="Avatar" 
                             class="rounded-circle profile-header-img" width="200">
                    <?php endif; ?>
                </div>

                <h4 class="mb-1"><?= $data_Guide['full_name'] ?></h4>

                <p class="text-muted mb-2">ID: <?= $data_Guide['guide_id'] ?></p>

                <div class="mb-3">
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle"></i> <?= $data_Guide['status'] ?>
                    </span>
                    <span class="badge bg-primary">
                        <?= $data_Guide['certificates'] ?>
                    </span>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-phone"></i> <?= $data_Guide['phone'] ?>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-envelope"></i> <?= $data_Guide['email'] ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- ========================== -->
        <!--    CỘT PHẢI - THÔNG TIN    -->
        <!-- ========================== -->
        <div class="col-lg-8">

            <!-- ==== THỐNG KÊ ==== -->
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between gap-3">
                        <div class="stat-box flex-fill">
                            <div class="text-muted small">
                                <i class="fas fa-star text-warning"></i> Đánh giá
                            </div>
                            <div class="stat-number">
                                <?= $data_Guide['rating'] ?> <small class="text-muted fs-6">/ 5</small>
                            </div>
                        </div>

                        <a href="<?= BASE_URL ?>?mode=admin&action=viewEditGuide&id=<?= $data_Guide['user_id'] ?>"
                           class="btn btn-outline-primary">
                            Chỉnh sửa
                        </a>

                        <a href="<?= BASE_URL ?>?mode=admin&action=viewsresources"
                           class="btn btn-outline-secondary">
                           <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>

                <!-- ==== THÔNG TIN CƠ BẢN ==== -->
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
                            <span><i class="fas fa-language text-muted me-2"></i> Ngôn ngữ</span>
                            <span class="badge bg-info text-dark"><?= $data_Guide['languages'] ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-briefcase text-muted me-2"></i> Kinh nghiệm</span>
                            <span class="badge bg-info text-dark"><?= $data_Guide['experience_years'] ?> năm</span>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- ========================== -->
            <!--     CHỨNG CHỈ - BẰNG CẤP   -->
            <!-- ========================== -->
            <div class="card">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-certificate me-2"></i> Chứng chỉ & Bằng cấp
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <!-- ==== THẺ CHỨNG CHỈ ==== -->
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="row g-0">

                                    <div class="col-12">
                                        <div class="card-body p-2">

                                            <!-- Tên chứng chỉ -->
                                            <h6 class="card-title mb-2"><?= $data_Guide['certificates'] ?></h6>

                                            <!-- ẢNH CHỨNG CHỈ -->
                                            <?php if (!empty($data_Guide['certificate_image'])): ?>
                                                <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['certificate_image'] ?>"
                                                     class="img-fluid rounded border mt-2"
                                                     style="max-height:250px; width:auto;">
                                            <?php else: ?>
                                                <p class="text-muted">Không có ảnh chứng chỉ</p>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div> <!-- row -->
                </div> <!-- card-body -->
            </div> <!-- card -->

        </div> <!-- col-lg-8 -->
    </div> <!-- row -->
</div> <!-- container -->
