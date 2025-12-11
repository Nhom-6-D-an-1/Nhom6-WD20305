<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold mb-0">Sửa tài khoản</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount" class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="post" action="<?= BASE_URL ?>?mode=admin&action=updateaccount">

                <input type="hidden" name="user_id"
                       value="<?= htmlspecialchars($account['user_id'] ?? '') ?>">

                <!-- THÔNG TIN CHUNG -->
                <h5 class="fw-semibold text-primary mb-3">Thông tin người dùng</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Họ và tên</label>
                        <input type="text" name="full_name" class="form-control"
                               required
                               value="<?= htmlspecialchars($account['full_name'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control"
                               required
                               value="<?= htmlspecialchars($account['username'] ?? '') ?>">
                    </div>
                </div>

                <!-- MẬT KHẨU -->
                <h5 class="fw-semibold text-primary mt-4 mb-3">Bảo mật</h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mật khẩu mới</label>
                    <input type="password" name="password"
                           class="form-control"
                           placeholder="Để trống nếu không đổi">
                </div>

                <!-- VAI TRÒ -->
                <h5 class="fw-semibold text-primary mt-4 mb-3">Phân quyền</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Vai trò</label>
                        <select name="role" class="form-select">
                            <option value="admin"
                                <?= ($account['role'] ?? '') === 'admin' ? 'selected' : '' ?>>
                                Quản trị viên
                            </option>
                            <option value="guide"
                                <?= ($account['role'] ?? '') === 'guide' ? 'selected' : '' ?>>
                                Hướng dẫn viên
                            </option>
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-success px-4">Cập nhật</button>
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount"
                       class="btn btn-secondary px-4">Hủy</a>
                </div>

            </form>

        </div>
    </div>
</div>
