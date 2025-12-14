<?php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
?>

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
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.2);
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
                    <input type="text"
                        name="full_name"
                        class="form-control input-custom <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($old['full_name'] ?? $account['full_name']) ?>">

                    <?php if (isset($errors['full_name'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errors['full_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tên đăng nhập</label>
                    <input type="text"
                        name="username"
                        class="form-control input-custom <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($old['username'] ?? $account['username']) ?>">

                    <?php if (isset($errors['username'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errors['username'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mật khẩu mới</label>
                    <input type="password"
                        name="password"
                        class="form-control input-custom <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                        placeholder="Để trống nếu không muốn thay đổi">

                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errors['password'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Vai trò</label>
                    <select name="role"
                        class="form-select input-custom <?= isset($errors['role']) ? 'is-invalid' : '' ?>">
                        <option value="admin"
                            <?= (($old['role'] ?? $account['role']) === 'admin') ? 'selected' : '' ?>>
                            Admin
                        </option>
                        <option value="guide"
                            <?= (($old['role'] ?? $account['role']) === 'guide') ? 'selected' : '' ?>>
                            Hướng dẫn viên
                        </option>
                    </select>

                    <?php if (isset($errors['role'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errors['role'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary px-4">Cập nhật</button>
                    <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount"
                        class="btn btn-outline-secondary px-4">Hủy</a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php unset($_SESSION['errors'], $_SESSION['old']); ?>