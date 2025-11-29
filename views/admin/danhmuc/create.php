<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Thêm danh mục tour</h3>

    <div class="card">
        <div class="card-body">

            <form action="?mode=admin&action=storedanhmuc" method="POST">

                <div class="mb-3">
                    <label class="form-label">Tên danh mục</label>
                    <input type="text" name="category_name" class="form-control" required>
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
