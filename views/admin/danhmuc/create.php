<style>
    /* ================================
   FORM TITLE
    ================================ */
    .fw-bold {
        font-size: 26px;
        color: #1f2937;
    }

    /* ================================
    CARD
    ================================ */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef0f3;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
    }

    /* ================================
    LABEL
    ================================ */
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    /* ================================
    INPUT + SELECT
    ================================ */
    .form-control,
    .form-select {
        border-radius: 14px !important;
        padding: 11px 14px !important;
        border: 1px solid #dce1e8 !important;
        background: #f9fafb !important;
        font-size: 15px !important;
        transition: 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        background: #ffffff !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
    }

    /* ================================
    BUTTONS
    ================================ */

    /* Lưu */
    .btn-primary {
        background: #e5efff !important;
        color: #2563eb !important;
        border: none !important;
        padding: 10px 22px !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
    }

    .btn-primary:hover {
        background: #d6e6ff !important;
    }

    /* Hủy */
    .btn-secondary {
        background: #f3f4f6 !important;
        color: #374151 !important;
        padding: 10px 20px !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        border: none !important;
    }

    .btn-secondary:hover {
        background: #e5e7eb !important;
    }

</style>
<div class="container-fluid px-4">
    <h3 class="fw-bold mt-4 mb-4">Thêm danh mục tour</h3>

    <div class="card">
        <div class="card-body">

            <form action="?mode=admin&action=storedanhmuc" onsubmit="return validateCategoryForm()" method="POST">

                <div class="mb-3">
                    <label class="form-label">Tên danh mục</label>
                    <input type="text" name="category_name" class="form-control">
                    <span id="nameError" class="text-danger"></span>
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div> -->

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1">Đang hoạt động</option>
                        <option value="0">Tạm ẩn</option>
                    </select>
                </div>

                <button class="btn btn-primary">Lưu</button>
                <a href="?mode=admin&action=viewsdanhmuc" class="btn btn-secondary">Hủy</a>

            </form>

        </div>
    </div>
</div>
<script>
function validateCategoryForm() {
    const nameInput = document.querySelector('input[name="category_name"]');
    const error = document.getElementById('nameError');
    const name = nameInput.value.trim();

    // Reset lỗi
    error.innerHTML = "";

    // 1. Không để trống
    if (name === "") {
        error.innerHTML = "Vui lòng nhập tên danh mục";
        nameInput.focus();
        return false;
    }

    // 2. Không cho chỉ toàn số
    if (/^\d+$/.test(name)) {
        error.innerHTML = "Tên danh mục không được chỉ chứa số";
        nameInput.focus();
        return false;
    }

    // 3. Phải có chữ cái
    if (!/[a-zA-ZÀ-Ỹà-ỹ]/.test(name)) {
        error.innerHTML = "Tên danh mục phải có chữ, không được toàn ký tự đặc biệt";
        nameInput.focus();
        return false;
    }

    // 4. Độ dài tối thiểu
    if (name.length < 3) {
        error.innerHTML = "Tên danh mục quá ngắn (tối thiểu 3 ký tự)";
        nameInput.focus();
        return false;
    }

    return true;
}
</script>