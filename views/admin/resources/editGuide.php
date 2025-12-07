<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-user-edit text-primary"></i> Cập nhật hồ sơ Hướng dẫn viên</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewsresources" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
    </div>

    <form action="<?= BASE_URL ?>?mode=admin&action=viewEditGuide&id=<?= $data_Guide['user_id']  ?>" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="form-section-title border-0 text-center">Ảnh đại diện</h6>
                        <div class="avatar-upload mb-3">
                            <?php if ($data_Guide['avatar']) : ?>
                                <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['avatar'] ?>" class="avatar-preview mb-3" width="200">
                            <?php endif; ?>
                            <input class="form-control form-control-sm" type="file" name="avatar">
                        </div>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">

                        <h6 class="form-section-title">1. Thông tin cá nhân</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name" value="<?= $data_Guide['full_name'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" name="birthday" value="<?= $data_Guide['birthday'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" value="<?= $data_Guide['phone'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $data_Guide['email'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tình trạng sức khỏe</label>
                                <select class="form-control" name="health" value=<?= $data_Guide['health'] ?>>
                                    <option value="Loại 1">Loại 1</option>
                                    <option value="Loại 2">Loại 2</option>
                                    <option value="Loại 3">Loại 3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kinh nghiệm (năm)</label>
                                <input type="number" class="form-control" name="experience_years" value="<?= $data_Guide['experience_years'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Giới tính</label>
                                <select class="form-control" name="gender" value="<?= $data_Guide['gender'] ?>">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ngôn ngữ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="languages" value="<?= $data_Guide['languages'] ?>" required>
                            </div>
                        </div>

                        <h6 class=" form-section-title">2. Đánh giá năng lực</h6>
                        <div class="col-md-4">
                            <label class="small text-muted">Đánh giá</label>
                            <input type="text" class="form-control form-control-sm" name="rating" value="<?= $data_Guide['rating'] ?>">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="form-section-title mb-0">3. Chứng chỉ chuyên môn</h6>
                        </div>

                        <div id="certificateList">
                            <div class="cert-row row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="small text-muted">Tên chứng chỉ</label>
                                    <input type="text" class="form-control form-control-sm" name="certificates" value="<?= $data_Guide['certificates'] ?>">
                                </div>
                            </div>
                        </div>

                    <div class="cert-row row g-2 align-items-end mt-3">
                        <div class="col-md-4">
                            <label class="small text-muted">Ảnh chứng chỉ</label>
                            <input type="file" class="form-control form-control-sm" name="certificate_image">
                        </div>

                        <div class="col-md-4">
                            <?php if (!empty($data_Guide['certificate_image'])): ?>
                                <img src="<?= BASE_ASSETS_UPLOADS . $data_Guide['certificate_image'] ?>" 
                                    class="img-thumbnail mt-2"
                                    style="max-width: 150px; height: auto;">
                                <input type="hidden" name="old_certificate_image" value="<?= $data_Guide['certificate_image'] ?>">
                            <?php endif; ?>
                        </div>
                    </div>


                        <div class="mt-4 text-end">
                            <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $data_Guide['user_id']  ?>" class="btn btn-light me-2">Hủy bỏ</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Lưu thay đổi</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>