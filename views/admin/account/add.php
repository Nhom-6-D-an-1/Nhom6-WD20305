<style>
    /* FORM CARD */
    .form-card {
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid #eef0f3;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* INPUT */
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
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }

    /* LABEL */
    .form-label {
        font-weight: 600;
        color: #374151;
    }

    /* BUTTON LƯU (Primary pastel) */
    .btn-save {
        background: #e8f0ff !important;
        color: #2563eb !important;
        border: none !important;
        padding: 10px 26px !important;
        border-radius: 12px !important;
        font-weight: 600;
    }
    .btn-save:hover {
        background: #d6e6ff !important;
    }

    /* BUTTON HỦY */
    .btn-cancel {
        background: #f3f4f6 !important;
        color: #374151 !important;
        border: none !important;
        padding: 10px 26px !important;
        border-radius: 12px !important;
        font-weight: 600;
    }
    .btn-cancel:hover {
        background: #e5e7eb !important;
    }

</style>

<div class="container mt-4">

    <div class="card form-card p-4">

        <h3 class="fw-bold mb-1">Thêm tài khoản</h3>
        <p class="text-muted mb-4">Điền đầy đủ thông tin bên dưới để tạo tài khoản mới</p>

        <form action="<?= BASE_URL ?>?mode=admin&action=storeaccount" method="POST">

            <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input type="text" name="full_name" class="form-control input-custom" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" name="user_name" class="form-control input-custom" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control input-custom" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="role" class="form-select input-custom" required>
                    <option value="admin">Admin</option>
                    <option value="guide">Hướng dẫn viên</option>
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn-save">Lưu</button>
                <a href="<?= BASE_URL ?>?mode=admin&action=viewsaccount" class="btn-cancel">Hủy</a>
            </div>

        </form>

    </div>

</div>

