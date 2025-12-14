<?php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
?>

<style>
    .form-card {
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid #eef0f3;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
    }

    .input-custom {
        height: 46px;
        border-radius: 12px;
        border: 1px solid #dfe3e8;
        background: #f9fafb;
        transition: .2s;
    }

    .input-custom:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .btn-save {
        background: #e8f0ff;
        color: #2563eb;
        border: none;
        padding: 10px 26px;
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #d6e6ff;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
        border: none;
        padding: 10px 26px;
        border-radius: 12px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }
</style>

<div class="container mt-4">

    <div class="card form-card p-4">

        <h3 class="fw-bold mb-1">Thêm tài khoản</h3>
        <p class="text-muted mb-4">Điền đầy đủ thông tin bên dưới để tạo tài khoản mới</p>

        <form method="post" action="<?= BASE_URL ?>?mode=admin&action=storeaccount">

            <!-- Họ tên -->
            <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input type="text"
                    name="full_name"
                    class="form-control input-custom <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                    value="<?= htmlspecialchars($old['full_name'] ?? '') ?>">

                <?php if (isset($errors['full_name'])): ?>
                    <div class="invalid-feedback d-block">
                        <?= $errors['full_name'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text"
                    name="user_name"
                    class="form-control input-custom <?= isset($errors['user_name']) ? 'is-invalid' : '' ?>"
                    value="<?= htmlspecialchars($old['user_name'] ?? '') ?>">

                <?php if (isset($errors['user_name'])): ?>
                    <div class="invalid-feedback d-block">
                        <?= $errors['user_name'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password"
                    name="password"
                    class="form-control input-custom <?= isset($errors['password']) ? 'is-invalid' : '' ?>">

                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback d-block">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="role"
                    class="form-select input-custom <?= isset($errors['role']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Chọn vai trò --</option>
                    <option value="admin" <?= ($old['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="guide" <?= ($old['role'] ?? '') === 'guide' ? 'selected' : '' ?>>Hướng dẫn viên</option>
                </select>

                <?php if (isset($errors['role'])): ?>
                    <div class="invalid-feedback d-block">
                        <?= $errors['role'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-2 mt-4">
                <button class="btn-save">Lưu</button>
                <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount" class="btn-cancel">Hủy</a>
            </div>

        </form>

    </div>

</div>

<?php unset($_SESSION['errors'], $_SESSION['old']); ?>