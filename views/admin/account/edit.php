<h3 class="fw-bold mb-4">Sửa tài khoản</h3>

<div class="form-section">
    <form method="post" action="<?= BASE_URL ?>?mode=admin&action=updateaccount">

        <input type="hidden" name="user_id" value="<?= htmlspecialchars($account['user_id'] ?? '') ?>">

        <div class="mb-3">
            <label class="form-label">Họ và tên:</label>
            <input type="text" name="full_name" class="form-control" required value="<?= htmlspecialchars($account['full_name'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Tên đăng nhập:</label>
            <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($account['username'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu mới (để trống nếu không đổi):</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới">
        </div>

        <div class="mb-3">
            <label class="form-label">Vai trò:</label>
            <select name="role" class="form-select">
                <option value="admin" <?= ($account['role'] ?? '') === 'admin' ? 'selected' : '' ?>>admin</option>
                <option value="guide" <?= ($account['role'] ?? '') === 'guide' ? 'selected' : '' ?>>guide</option>
            </select>
        </div>

        <!-- <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <select name="status" class="form-select">
                <option value="1" <?= ($account['status'] ?? 1) == 1 ? 'selected' : '' ?>>Hoạt động</option>
                <option value="0" <?= ($account['status'] ?? 1) == 0 ? 'selected' : '' ?>>Tạm ẩn</option>
            </select>
        </div> -->

        <div class="mt-4 d-flex gap-3">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount" class="btn btn-secondary">Huỷ</a>
        </div>

    </form>
</div>
