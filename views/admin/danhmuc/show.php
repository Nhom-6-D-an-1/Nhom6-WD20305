<style>
    /* PAGE TITLE */
    .fw-bold {
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    /* CARD */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef0f3;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* LABEL */
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    /* READ-ONLY INPUT */
    .form-control:disabled {
        background: #f3f4f6 !important;
        border-radius: 14px !important;
        border: 1px solid #e5e7eb !important;
        color: #4b5563 !important;
        padding: 11px 14px !important;
        font-size: 15px;
        opacity: 1 !important;
    }

    /* BUTTON – BACK */
    .btn-secondary {
        background: #e5e7eb !important;
        color: #374151 !important;
        padding: 10px 20px !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        border: none !important;
        transition: .2s;
    }

    .btn-secondary:hover {
        background: #d4d6da !important;
    }

</style>
<div class="container-fluid px-4">
    <h3 class="fw-bold mt-4 mb-4">Chi tiết danh mục tour: <?= $category['category_name'] ?></h3>

    <div class="card">
        <div class="card-body">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Tên loại tour</label>
                    <input type="text" class="form-control" value="<?= $category['category_name'] ?>" disabled>
                </div>

                <!-- <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control" rows="3" disabled><?= $category['description'] ?></textarea>
            </div> -->

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <input type="text" class="form-control"
                        value="<?= $category['status'] == 1 ? 'Đang hoạt động' : 'Tạm ẩn' ?>" disabled>
                </div>

                <a href="?mode=admin&action=viewsdanhmuc" class="btn btn-secondary">Quay lại</a>

            </div>
        </div>
    </div>