<div class="container-fluid px-4">
    <h3 class="fw-bold mt-4 mb-4">Sửa danh mục tour: <?= $category['category_name'] ?></h3>

    <div class="card">
        <div class="card-body">

            <form action="?mode=admin&action=updatedanhmuc&id=<?= $category['category_id'] ?>" onsubmit="return validateCategoryForm()" method="POST">

                <div class="mb-3">
                    <label class="form-label">Tên loại tour</label>
                    <input type="text" name="category_name" class="form-control"
                           value="<?= $category['category_name'] ?>">
                    <span id="nameError" class="text-danger"></span>
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea name="description" class="form-control" rows="3"><?= $category['description'] ?></textarea>
                </div> -->

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>Đang hoạt động</option>
                        <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>Tạm ẩn</option>
                    </select>
                </div>

                <button class="btn btn-primary">Cập nhật</button>
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