<style>
/* ================================
   GLOBAL STYLE – Match Dashboard
================================= */
:root {
    --primary: #3b82f6;
    --primary-soft: #e8f0ff;
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --bg-card: #ffffff;
    --bg-soft: #f5f7fb;
    --radius: 16px;
    --shadow: 0 4px 14px rgba(0,0,0,0.06);
}

/* ================================
   PAGE TITLE
================================= */
.page-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 24px;
    color: var(--text-dark);
}

/* ================================
   CARD
================================= */
.card {
    background: var(--bg-card);
    border-radius: var(--radius);
    border: 1px solid #eef0f3;
    box-shadow: var(--shadow);
    padding: 22px;
}

/* ================================
   BUTTON: ADD (match dashboard button)
================================= */
.btn-success {
    background: var(--primary-soft) !important;
    border: none !important;
    padding: 10px 20px !important;
    border-radius: 12px !important;
    color: var(--primary) !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    transition: 0.2s;
}

.btn-success:hover {
    background: #dce7ff !important;
}

/* ================================
   TABLE STYLING
================================= */
.table-wrapper {
    border-radius: var(--radius);
    overflow: hidden;
}

.table thead th {
    background: #f9fafb !important;
    color: var(--text-light) !important;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 14px 10px !important;
    border-bottom: 1px solid #eceef2 !important;
    text-align: center;
}

.table tbody tr {
    border-bottom: 1px solid #f0f1f5;
    transition: 0.15s;
}

.table tbody tr:hover {
    background: #f8faff;
}

.table tbody td {
    padding: 16px 12px !important;
    font-size: 15px;
    color: var(--text-dark);
}

/* Căn cột */
.table tbody td:nth-child(1),
.table tbody td:nth-child(2),
.table tbody td:nth-child(3),
.table tbody td:nth-child(4) {
    text-align: center;
}

/* ================================
   BADGES (Tone pastel giống chart legend)
================================= */
.badge {
    padding: 7px 16px;
    border-radius: 12px;
    font-size: 13.5px;
    font-weight: 600;
}

.bg-success {
    background: #e7f9ee !important;
    color: #0e8f53 !important;
}

.bg-secondary {
    background: #eef0f3 !important;
    color: #475569 !important;
}

/* ================================
   ACTION BUTTONS (Tone xanh – pastel)
================================= */
.btn-sm {
    padding: 8px 15px !important;
    border-radius: 12px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    border: none !important;
    transition: 0.2s;
}

/* Xem – xanh pastel */
.btn-info {
    background: #e5efff !important;
    color: #2563eb !important;
}
.btn-info:hover {
    background: #d6e6ff !important;
}

/* Sửa – vàng nhạt premium */
.btn-primary {
    background: #fff4d8 !important;
    color: #b97500 !important;
}
.btn-primary:hover {
    background: #ffe8b5 !important;
}

/* Xóa – đỏ pastel */
.btn-danger {
    background: #ffe5e5 !important;
    color: #d02f2f !important;
}
.btn-danger:hover {
    background: #ffd4d4 !important;
}

</style>

<div class="container-fluid px-4">

    <h3 class="page-title mt-4">Danh mục tour</h3>

    <div class="card mb-4">
        <div class="card-body">

            <!-- Thanh hành động -->
            <div class="d-flex justify-content-between mb-3">
                <a href="?mode=admin&action=adddanhmuc" class="btn btn-success">
                    + Thêm danh mục tour
                </a>
            </div>

            <!-- Bảng dữ liệu -->
            <div class="table-wrapper">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:60px;">STT</th>
                            <th>Tên loại tour</th>
                            <th style="width:150px;">Trạng thái</th>
                            <th style="width:300px;">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>

                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($item['category_name']) ?>
                                    </td>

                                    <td>
                                        <?php if ($item['status'] == 1): ?>
                                            <span class="badge bg-success">Đang hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Tạm ẩn</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a href="?mode=admin&action=xemchitietdanhmuc&id=<?= $item['category_id'] ?>"
                                            class="btn btn-info btn-sm">Chi tiết</a>

                                        <a href="?mode=admin&action=suadanhmuc&id=<?= $item['category_id'] ?>"
                                            class="btn btn-primary btn-sm">Sửa</a>

                                        <a href="?mode=admin&action=xoadanhmuc&id=<?= $item['category_id'] ?>"
                                            onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"
                                            class="btn btn-danger btn-sm">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    Không có danh mục nào
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>