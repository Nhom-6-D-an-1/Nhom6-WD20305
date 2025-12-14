<style>
/* ===============================
   PAGE TITLE
=============================== */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 22px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===============================
   CARD – APPLE STYLE
=============================== */
.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

.card-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 14px;
}

/* ===============================
   AVATAR
=============================== */
.avatar {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #f3f4f6;
}

/* ===============================
   BADGE
=============================== */
.badge {
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
}

.bg-success {
    background: #d1fae5 !important;
    color: #047857 !important;
}

.bg-primary {
    background: #dbeafe !important;
    color: #1e40af !important;
}

.bg-info {
    background: #e0f2fe !important;
    color: #075985 !important;
}

/* ===============================
   INFO ITEM
=============================== */
.info-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f1f1f1;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: #6b7280;
    font-size: 14px;
}

.info-value {
    font-weight: 600;
    color: #1f2937;
}

/* ===============================
   STAT BOX
=============================== */
.stat-box {
    background: #f9fafb;
    border-radius: 12px;
    padding: 16px;
    flex: 1;
}

.stat-number {
    font-size: 26px;
    font-weight: 800;
    color: #111827;
}

/* ===============================
   BUTTON
=============================== */
.btn-outline-primary,
.btn-outline-secondary {
    border-radius: 10px;
    font-weight: 600;
}
</style>

<div class="container-fluid px-4">

    <div class="page-title">Chi tiết hướng dẫn viên</div>

    <div class="row g-4">

        <!-- ===============================
             LEFT – PROFILE
        =============================== -->
        <div class="col-lg-4">

            <div class="card text-center">

                <?php if (!empty($data_Guide['avatar'])): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['avatar'] ?>"
                         class="avatar mx-auto mb-3"
                         alt="Avatar">
                <?php endif; ?>

                <h5 class="fw-bold mb-1"><?= htmlspecialchars($data_Guide['full_name']) ?></h5>
                <p class="text-muted mb-2">ID: <?= $data_Guide['guide_id'] ?></p>

                <div class="mb-3">
                    <span class="badge bg-success"><?= htmlspecialchars($data_Guide['status']) ?></span>
                    <?php if (!empty($data_Guide['certificates'])): ?>
                        <span class="badge bg-primary"><?= htmlspecialchars($data_Guide['certificates']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="d-grid gap-2">
                    <div class="btn btn-outline-secondary btn-sm">
                        📞 <?= htmlspecialchars($data_Guide['phone']) ?>
                    </div>
                    <div class="btn btn-outline-secondary btn-sm">
                        ✉ <?= htmlspecialchars($data_Guide['email']) ?>
                    </div>
                </div>

            </div>

        </div>

        <!-- ===============================
             RIGHT – INFO
        =============================== -->
        <div class="col-lg-8">

            <!-- STATS -->
            <div class="d-flex gap-3 mb-4">
                <div class="stat-box">
                    <div class="text-muted small">Đánh giá</div>
                    <div class="stat-number">
                        ⭐ <?= number_format((float)$data_Guide['rating'], 1) ?>
                        <small class="text-muted fs-6">/5</small>
                    </div>
                </div>

                <a href="<?= BASE_URL ?>?mode=admin&action=viewEditGuide&id=<?= $data_Guide['user_id'] ?>"
                   class="btn btn-outline-primary align-self-center px-4">
                    Chỉnh sửa
                </a>

                <a href="<?= BASE_URL ?>?mode=admin&action=viewsresources"
                   class="btn btn-outline-secondary align-self-center px-4">
                    ← Quay lại
                </a>
            </div>

            <!-- BASIC INFO -->
            <div class="card mb-4">
                <div class="card-title">Thông tin cơ bản</div>

                <div class="info-item">
                    <span class="info-label">Ngày sinh</span>
                    <span class="info-value"><?= htmlspecialchars($data_Guide['birthday']) ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">Giới tính</span>
                    <span class="info-value"><?= htmlspecialchars($data_Guide['gender']) ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">Sức khỏe</span>
                    <span class="info-value text-success"><?= htmlspecialchars($data_Guide['health']) ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">Ngôn ngữ</span>
                    <span class="badge bg-info"><?= htmlspecialchars($data_Guide['languages']) ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">Kinh nghiệm</span>
                    <span class="badge bg-info"><?= $data_Guide['experience_years'] ?> năm</span>
                </div>
            </div>

            <!-- CERTIFICATE -->
            <div class="card">
                <div class="card-title">Chứng chỉ & Bằng cấp</div>

                <?php if (!empty($data_Guide['certificate_image'])): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['certificate_image'] ?>"
                         class="img-fluid rounded border"
                         style="max-height:260px;">
                <?php else: ?>
                    <p class="text-muted">Không có ảnh chứng chỉ</p>
                <?php endif; ?>
            </div>

        </div>

    </
