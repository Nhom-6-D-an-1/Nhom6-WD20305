<div class="container mt-4">
    <h3>Thêm tài khoản</h3>

    <form action="<?= BASE_URL ?>?mode=admin&action=storeaccount" method="POST" class="mt-3">

        <div class="mb-3">
            <label>Họ và tên</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="user_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role" class="form-select" required>
            <option value="admin">Admin</option>
            <option value="guide">Hướng dẫn viên</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select" required>
                <option value="1">Hoạt động</option>
                <option value="0">Tạm ẩn</option>
            </select>
        </div>

        <button class="btn btn-success">Lưu</button>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount" class="btn btn-secondary">Hủy</a>
    </form>
</div>
