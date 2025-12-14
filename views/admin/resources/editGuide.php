<?php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
?>

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
    }

    /* CARD */
    .card {
        background: #fff;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    }

    /* FORM */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #dcdcdc;
        font-size: 14px;
    }

    /* AVATAR */
    .avatar-preview {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #f3f4f6;
    }

    /* BUTTON */
    .btn-save {
        background: #dbeafe;
        color: #1e40af;
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
</style>

<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div class="page-title mb-0">Cập nhật hồ sơ Hướng dẫn viên</div>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewsresources"
            class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>

    <form action="<?= BASE_URL ?>?mode=admin&action=viewEditGuide&id=<?= $data_Guide['user_id'] ?>"
        method="POST"
        enctype="multipart/form-data">

        <div class="row g-4">

            <!-- AVATAR -->
            <div class="col-lg-4">
                <div class="card text-center">

                    <div class="fw-bold mb-3">Ảnh đại diện</div>

                    <?php if (!empty($data_Guide['avatar'])): ?>
                        <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['avatar'] ?>"
                            class="avatar-preview mb-3">
                    <?php endif; ?>

                    <input type="file" name="avatar" class="form-control form-control-sm">
                </div>
            </div>

            <!-- FORM -->
            <div class="col-lg-8">
                <div class="card">

                    <!-- THÔNG TIN CÁ NHÂN -->
                    <div class="fw-bold mb-3">1. Thông tin cá nhân</div>

                    <div class="row g-3 mb-4">

                        <!-- Họ tên -->
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên *</label>
                            <input type="text"
                                name="full_name"
                                class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['full_name'] ?? $data_Guide['full_name']) ?>">
                            <?php if (isset($errors['full_name'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['full_name'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Ngày sinh -->
                        <div class="col-md-6">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date"
                                name="birthday"
                                class="form-control"
                                value="<?= htmlspecialchars($old['birthday'] ?? $data_Guide['birthday']) ?>">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại *</label>
                            <input type="text"
                                name="phone"
                                class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['phone'] ?? $data_Guide['phone']) ?>">
                            <?php if (isset($errors['phone'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['phone'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['email'] ?? $data_Guide['email']) ?>">
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['email'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Health -->
                        <div class="col-md-6">
                            <label class="form-label">Tình trạng sức khỏe</label>
                            <select name="health" class="form-select">
                                <?php foreach (['Loại 1', 'Loại 2', 'Loại 3'] as $h): ?>
                                    <option value="<?= $h ?>"
                                        <?= (($old['health'] ?? $data_Guide['health']) == $h) ? 'selected' : '' ?>>
                                        <?= $h ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Experience -->
                        <div class="col-md-6">
                            <label class="form-label">Kinh nghiệm (năm)</label>
                            <input type="number"
                                name="experience_years"
                                class="form-control"
                                value="<?= htmlspecialchars($old['experience_years'] ?? $data_Guide['experience_years']) ?>">
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <label class="form-label">Giới tính</label>
                            <select name="gender" class="form-select">
                                <option value="Nam" <?= (($old['gender'] ?? $data_Guide['gender']) == 'Nam') ? 'selected' : '' ?>>Nam</option>
                                <option value="Nữ" <?= (($old['gender'] ?? $data_Guide['gender']) == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                            </select>
                        </div>

                        <!-- Languages -->
                        <div class="col-md-6">
                            <label class="form-label">Ngôn ngữ *</label>
                            <input type="text"
                                name="languages"
                                class="form-control <?= isset($errors['languages']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($old['languages'] ?? $data_Guide['languages']) ?>">
                            <?php if (isset($errors['languages'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $errors['languages'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- RATING -->
                    <div class="fw-bold mb-2">2. Đánh giá năng lực</div>
                    <input type="text" name="rating" class="form-control mb-4"
                        value="<?= htmlspecialchars($old['rating'] ?? $data_Guide['rating']) ?>">

                    <!-- CERT -->
                    <div class="fw-bold mb-2">3. Chứng chỉ chuyên môn</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input type="text" name="certificates" class="form-control"
                                value="<?= htmlspecialchars('' ?? $data_Guide['certificates']) ?>">
                        </div>

                        <div class="col-md-4">
                            <input type="file" name="certificate_image" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <?php if (!empty($data_Guide['certificate_image'])): ?>
                                <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['certificate_image'] ?>"
                                    class="img-thumbnail" style="max-width:150px;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ACTION -->
                    <div class="text-end">
                        <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $data_Guide['user_id'] ?>"
                            class="btn btn-cancel me-2">Hủy</a>
                        <button class="btn btn-save">💾 Lưu thay đổi</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<?php unset($_SESSION['errors'], $_SESSION['old']); ?>