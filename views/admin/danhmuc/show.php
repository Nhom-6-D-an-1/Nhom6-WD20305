<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Chi tiết loại tour: <?= $category['category_name'] ?></h3>

    <div class="card">
        <div class="card-body">https://github.com/Nhom-6-D-an-1/Nhom6-WD20305/pull/27/conflict?name=views%252Fadmin%252Fdanhmuc%252Fshow.php&base_oid=af76c4efa8379ee0df5763d1bbd8c5a636b132d2&head_oid=91c9ee4dfd24cd6ae09517361952a92a59adcf7c

            <div class="mb-3">
                <label class="form-label">Tên loại tour</label>https://github.com/Nhom-6-D-an-1/Nhom6-WD20305/pull/27/conflict?name=views%252Fadmin%252Fdanhmuc%252Fshow.php&base_oid=af76c4efa8379ee0df5763d1bbd8c5a636b132d2&head_oid=91c9ee4dfd24cd6ae09517361952a92a59adcf7c
                <input type="text" class="form-control" value="<?= $category['category_name'] ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control" rows="3" disabled><?= $category['description'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <input type="text" class="form-control"
                       value="<?= $category['status'] == 1 ? 'Đang hoạt động' : 'Tạm ẩn' ?>" disabled>
            </div>

            <a href="?mode=admin&action=viewsdanhmuc" class="btn btn-secondary">Quay lại</a>

        </div>
    </div>
</div>
