<style>
    .form-card {
        border-radius: 14px;
        padding-bottom: 10px;
    }

    .input-custom {
        height: 45px;
        border-radius: 10px;
        border: 1px solid #d9d9d9;
        transition: 0.2s;
        background: #fff;
    }

    .input-custom:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13,110,253,0.2);
    }

    .btn-primary {
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-outline-secondary {
        border-radius: 10px;
        font-weight: 600;
    }
</style>

<div class="container mt-4">
    <div class="card shadow border-0 form-card">

        <div class="card-header bg-white border-0 pt-4 pb-0">
            <h3 class="fw-bold">Sửa tài khoản</h3>
            <p class="text-muted mt-1 mb-0">Cập nhật thông tin cần thay đổi bên dưới</p>
        </div>

        <div class="card-body">

            <form action="<?= BASE_URL ?>?mode=admin&action=updateaccount" method="POST">

                <input type="hidden" name="user_id"
                       value="<?= htmlspecialchars($account['user_id']) ?>">

                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Họ và tên</label>
                    <input type="text" name="full_name"
                           class="form-control input-custom"
                           value="<?= htmlspecialchars($account['full_name']) ?>"
                           required>
                </div>

                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tên đăng nhập</label>
                    <input type="text" name="username"
                           class="form-control input-custom"
                           value="<?= htmlspecialchars($account['username']) ?>"
                           required>
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mật khẩu mới</label>
                    <input type="password" name="password"
                           class="form-control input-custom"
                           placeholder="Để trống nếu không muốn thay đổi">
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Vai trò</label>
                    <select name="role" class="form-select input-custom" required>
                        <option value="admin" <?= $account['role'] == 'admin' ? 'selected' : '' ?>>
                            Admin
                        </option>
                        <option value="guide" <?= $account['role'] == 'guide' ? 'selected' : '' ?>>
                            Hướng dẫn viên
                        </option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary px-4">Cập nhật</button>
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount"
                       class="btn btn-outline-secondary px-4">Hủy</a>
                </div>

            </form>
        </div>

    </form>
</div>
