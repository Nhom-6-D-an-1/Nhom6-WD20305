<style>
    /* ============================================================================
   WHITE ELEGANCE PREMIUM – Clean, Luxury & Minimal UI
   Designed exclusively for Khiem
   ============================================================================ */

    /* GLOBAL -------------------------------------------------------------- */
    body {
        background: #f7f8fa;
        font-family: "Inter", sans-serif;
        color: #333;
    }

    /* PAGE TITLE ---------------------------------------------------------- */
    .page-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 28px;
        color: #222;
        letter-spacing: -0.5px;
        position: relative;
    }

    .page-title::after {
        content: "";
        width: 60px;
        height: 3px;
        background: #d4af37;  /* Gold champagne */
        border-radius: 3px;
        position: absolute;
        left: 0;
        bottom: -8px;
        opacity: 0.8;
    }

    /* CARD --------------------------------------------------------------- */
    .card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e6e6e6;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        padding: 0;
    }

    .card-body {
        padding: 26px 30px;
    }

    /* BUTTON ADD ---------------------------------------------------------- */
    .btn-success {
        background: #d4af37;
        border: none;
        padding: 11px 24px;
        border-radius: 10px;
        color: #fff;
        font-weight: 700;
        letter-spacing: .4px;
        transition: 0.25s ease;
    }

    .btn-success:hover {
        background: #bb9730;
        transform: translateY(-2px);
    }

    /* TABLE HEADER --------------------------------------------------------- */
    .table thead th {
        background: #fafafa;
        color: #333 !important;
        padding: 14px 12px;
        border-bottom: 2px solid #eaeaea !important;
        font-weight: 700;
        font-size: 15.3px;
    }

    /* TABLE BODY ----------------------------------------------------------- */
    .table tbody tr {
        background: #fff;
        transition: 0.25s ease;
    }

    .table tbody tr:hover {
        background: #f4f4f4;
    }

    .table td {
        padding: 14px 12px !important;
        font-size: 15px;
        color: #444;
        vertical-align: middle;
    }

    /* BADGES -------------------------------------------------------------- */
    .badge {
        padding: 7px 16px;
        border-radius: 14px;
        font-size: 13.5px;
        font-weight: 650;
    }

    .bg-success {
        background: #4caf50 !important;
        color: white !important;
    }

    .bg-secondary {
        background: #b9b9b9 !important;
        color: #fff;
    }

    /* ACTION BUTTONS ------------------------------------------------------ */
    .btn-sm {
        padding: 7px 14px !important;
        border-radius: 10px !important;
        font-weight: 600;
        font-size: 13.5px;
    }

    /* Xem – xanh navy sang trọng */
    .btn-info {
        background: #1f4f9a !important;
        border: none;
        color: #fff !important;
    }
    .btn-info:hover {
        background: #183f7a !important;
    }

    /* Sửa – xanh pastel cực nhẹ */
    .btn-primary {
        background: #4c7cff !important;
        border: none;
    }
    .btn-primary:hover {
        background: #3b64d4 !important;
    }

    /* Xóa – đỏ nhẹ */
    .btn-danger {
        background: #e64b4b !important;
    }
    .btn-danger:hover {
        background: #c93d3d !important;
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

            <!-- Bảng dữ liệu (Minimal Premium Style) -->
            <div class="table-wrapper">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:60px;">STT</th>
                            <th>Tên loại tour</th>
                            <th style="width:150px;">Trạng thái</th>
                            <th style="width:200px;">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>

                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($item['category_name'] ?? '') ?>
                                    </td>

                                    <td>
                                        <?php if (($item['status'] ?? 0) == 1): ?>
                                            <span class="badge bg-success">Đang hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Tạm ẩn</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a href="?mode=admin&action=xemchitietdanhmuc&id=<?= $item['category_id'] ?>"
                                            class="btn btn-info btn-sm">Xem</a>

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