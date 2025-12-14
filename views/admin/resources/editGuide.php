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

/* ===============================
   SECTION TITLE
=============================== */
.section-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin: 22px 0 14px;
}

/* ===============================
   FORM
=============================== */
.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.form-control,
.form-select {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
    font-size: 14px;
}

/* ===============================
   AVATAR
=============================== */
.avatar-preview {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #f3f4f6;
}

/* ===============================
   BUTTON
=============================== */
.btn-save {
    background: #dbeafe;
    color: #1e40af;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    padding: 10px 22px;
}

.btn-save:hover {
    background: #bfdbfe;
}

.btn-cancel {
    background: #e5e7eb;
    color: #374151;
    border-radius: 10px;
    font-weight: 600;
    padding: 10px 22px;
}

.btn-outline {
    border-radius: 10px;
    font-weight: 600;
}
</style>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div class="page-title mb-0">Cập nhật hồ sơ Hướng dẫn viên</div>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewsresources"
           class="btn btn-outline-secondary btn-outline">
            ← Quay lại
        </a>
    </div>

    <form action="<?= BASE_URL ?>?mode=admin&action=viewEditGuide&id=<?= $data_Guide['user_id'] ?>"
          method="POST"
          enctype="multipart/form-data">

        <div class="row g-4">

            <!-- ===============================
                 LEFT – AVATAR
            =============================== -->
            <div class="col-lg-4">
                <div class="card text-center">

                    <div class="section-title mt-0">Ảnh đại diện</div>

                    <?php if (!empty($data_Guide['avatar'])): ?>
                        <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['avatar'] ?>"
                             class="avatar-preview mb-3"
                             alt="Avatar">
                    <?php endif; ?>

                    <input type="file" name="avatar" class="form-control form-control-sm">
                </div>
            </div>

            <!-- ===============================
                 RIGHT – FORM
            =============================== -->
            <div class="col-lg-8">

                <div class="card mb-4">

                    <!-- PERSONAL INFO -->
                    <div class="section-title">1. Thông tin cá nhân</div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên *</label>
                            <input type="text" class="form-control" name="full_name"
                                   value="<?= htmlspecialchars($data_Guide['full_name']) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" name="birthday"
                                   value="<?= htmlspecialchars($data_Guide['birthday']) ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại *</label>
                            <input type="text" class="form-control" name="phone"
                                   value="<?= htmlspecialchars($data_Guide['phone']) ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="<?= htmlspecialchars($data_Guide['email']) ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tình trạng sức khỏe</label>
                            <select class="form-select" name="health">
                                <option <?= $data_Guide['health']=='Loại 1'?'selected':'' ?>>Loại 1</option>
                                <option <?= $data_Guide['health']=='Loại 2'?'selected':'' ?>>Loại 2</option>
                                <option <?= $data_Guide['health']=='Loại 3'?'selected':'' ?>>Loại 3</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kinh nghiệm (năm)</label>
                            <input type="number" class="form-control" name="experience_years"
                                   value="<?= $data_Guide['experience_years'] ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="gender">
                                <option <?= $data_Guide['gender']=='Nam'?'selected':'' ?>>Nam</option>
                                <option <?= $data_Guide['gender']=='Nữ'?'selected':'' ?>>Nữ</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngôn ngữ *</label>
                            <input type="text" class="form-control" name="languages"
                                   value="<?= htmlspecialchars($data_Guide['languages']) ?>" required>
                        </div>
                    </div>

                    <!-- RATING -->
                    <div class="section-title">2. Đánh giá năng lực</div>
                    <div class="col-md-4 mb-4">
                        <input type="text" class="form-control" name="rating"
                               value="<?= $data_Guide['rating'] ?>">
                    </div>

                    <!-- CERTIFICATE -->
                    <div class="section-title">3. Chứng chỉ chuyên môn</div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tên chứng chỉ</label>
                            <input type="text" class="form-control" name="certificates"
                                   value="<?= htmlspecialchars($data_Guide['certificates']) ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Ảnh chứng chỉ</label>
                            <input type="file" class="form-control" name="certificate_image">
                        </div>

                        <div class="col-md-4">
                            <?php if (!empty($data_Guide['certificate_image'])): ?>
                                <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['certificate_image'] ?>"
                                     class="img-thumbnail"
                                     style="max-width:150px;">
                                <input type="hidden" name="old_certificate_image"
                                       value="<?= $data_Guide['certificate_image'] ?>">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ACTION -->
                    <div class="mt-4 text-end">
                        <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $data_Guide['user_id'] ?>"
                           class="btn btn-cancel me-2">
                            Hủy
                        </a>

                        <button type="submit" class="btn btn-save">
                            💾 Lưu thay đổi
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>
