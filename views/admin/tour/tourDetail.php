<style>
    /* ===========================
   PAGE TITLE
    =========================== */
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .page-subtitle {
        color: #6b7280;
        margin-bottom: 20px;
        font-size: 15px;
    }

    /* ===========================
    CARD WRAPPER
    =========================== */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef0f3;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        padding: 24px;
    }

    /* ===========================
    SECTION TITLE
    =========================== */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 14px;
    }

    /* ===========================
    BUTTONS
    =========================== */
    .btn-outline-secondary {
        border-radius: 12px !important;
        padding: 10px 18px !important;
        font-weight: 600 !important;
        border: 1px solid #d1d5db !important;
        color: #374151 !important;
    }

    .btn-outline-secondary:hover {
        background: #f3f4f6 !important;
    }

    .btn-success {
        background: #e6f9e8 !important;
        color: #059669 !important;
        padding: 10px 18px !important;
        border-radius: 12px !important;
        border: none !important;
        font-weight: 600 !important;
    }

    .btn-success:hover {
        background: #d1f2d4 !important;
    }

    .btn-primary {
        background: #e5efff !important;
        color: #2563eb !important;
        border: none !important;
        padding: 8px 18px !important;
        border-radius: 12px !important;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #d6e6ff !important;
    }

    /* ===========================
    BOOTSTRAP TABS – PREMIUM
    =========================== */
    .nav-tabs {
        border-bottom: 1px solid #e5e7eb !important;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        color: #6b7280;
        padding: 10px 18px;
        border: none !important;
        border-radius: 10px 10px 0 0 !important;
        transition: .15s;
    }

    .nav-tabs .nav-link:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .nav-tabs .nav-link.active {
        background: #e8f0ff !important;
        color: #2563eb !important;
        border-bottom: 2px solid #2563eb !important;
    }

    /* ===========================
    TABLE – PREMIUM
    =========================== */
    .table {
        border-radius: 14px;
        overflow: hidden;
    }

    .table thead {
        background: #f9fafb !important;
    }

    .table thead th {
        padding: 14px 10px;
        font-size: 13px;
        font-weight: 700;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb !important;
    }

    .table tbody tr {
        transition: .15s;
    }

    .table tbody tr:hover {
        background: #f7faff;
    }

    .table td {
        padding: 14px 10px !important;
        font-size: 15px;
        color: #1f2937;
    }

    /* ===========================
    BADGES
    =========================== */
    .badge {
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 10px;
    }

    .bg-success {
        background: #e6f9e8 !important;
        color: #0f8a47 !important;
    }

    .bg-danger {
        background: #ffe5e5 !important;
        color: #b91c1c !important;
    }

    /* ===========================
    LIST GROUP STYLE
    =========================== */
    .list-group-item {
        border: 1px solid #e5e7eb !important;
        padding: 14px 16px !important;
        border-radius: 10px !important;
        margin-bottom: 10px;
    }

    .list-group-item strong {
        font-size: 15px;
        color: #1f2937;
    }

    .list-group-item small {
        color: #6b7280;
    }

</style>
<?php $tab = $_GET['tab'] ?? 'info'; ?>

<div class="container-fluid px-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h3 class="fw-bold mb-1">Chi tiết Tour</h3>
            <p class="text-muted mb-0">Tour: <strong><?= $data['tour_name'] ?></strong></p>
        </div>

        <a href="<?= BASE_URL ?>?mode=admin&action=viewstour"
            class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <!-- CARD chứa toàn bộ Tabs -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <button class="nav-link <?= $tab == 'info' ? 'active' : '' ?>"
                        data-bs-toggle="tab" data-bs-target="#info">
                        Thông tin chung
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link <?= $tab == 'versions' ? 'active' : '' ?>"
                        data-bs-toggle="tab" data-bs-target="#versions">
                        Phiên bản tour
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link <?= $tab == 'history' ? 'active' : '' ?>"
                        data-bs-toggle="tab" data-bs-target="#history">
                        Lịch sử phiên bản
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                <!-- Tab 1: Thông tin chung -->
                <div class="tab-pane fade <?= $tab == 'info' ? 'show active' : '' ?>" id="info">

                    <h5 class="fw-semibold text-primary mb-3">Thông tin chung</h5>

                    <p><strong>Mã Tour:</strong> <?= $data['tour_code'] ?></p>
                    <!-- <p><strong>Danh mục:</strong> <?= $data['category_name'] ?></p> -->
                    <p><strong>Thời lượng:</strong> <?= $data['duration_days'] ?> ngày</p>

                    <div class="mt-2">
                        <strong>Mô tả chi tiết:</strong>
                        <p class="mt-1"><?= nl2br($data['description']) ?></p>
                    </div>
                </div>

                <!-- Tab 2: Phiên bản tour -->
                <div class="tab-pane fade <?= $tab == 'versions' ? 'show active' : '' ?>" id="versions">

                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-semibold text-primary">Các phiên bản</h5>
                        <a href="<?= BASE_URL ?>?mode=admin&action=createVersion&id=<?= $data['tour_id'] ?>"
                            class="btn btn-success">
                            + Tạo phiên bản mới
                        </a>
                    </div>

                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Phiên bản</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Ngày áp dụng</th>
                                <th>Trạng thái</th>
                                <th style="width:160px;">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data_version as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>

                                    <td><?= $value['version_code'] ?> - <?= $value['season'] ?></td>

                                    <td><?php if (!empty($value['image_url'])): ?>
                                            <img src="<?= BASE_ASSETS_UPLOADS . $value['image_url'] ?>"
                                                alt="Avatar"
                                                width="100">
                                        <?php endif; ?>
                                    </td>

                                    <td><?= number_format($value['price'], 0, ',', '.') ?>đ</td>

                                    <td>
                                        <?= $value['valid_from'] ?> <br>
                                        <small class="text-muted">→ <?= $value['valid_to'] ?></small>
                                    </td>

                                    <td>
                                        <span class="badge <?= $value['status'] == 'active' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $value['status'] == 'active' ? 'Đang chạy' : 'Tạm dừng' ?>
                                        </span>
                                    </td>

                                    <td>
                                        <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $value['version_id'] ?>"
                                            class="btn btn-primary btn-sm">Chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

                <!-- Tab 3: Lịch sử -->
                <div class="tab-pane fade <?= $tab == 'history' ? 'show active' : '' ?>" id="history">
                    <h5 class="fw-semibold text-primary mb-3">Lịch sử phiên bản</h5>

                    <ul class="list-group">
                        <?php foreach ($data_version as $value): ?>
                            <li class="list-group-item">
                                <strong><?= $value['version_name'] ?></strong>
                                <br>
                                <small class="text-muted">Tạo ngày: <?= $value['created_at'] ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>

        </div>
    </div>

</div>