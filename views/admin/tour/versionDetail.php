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
    CARD
    =========================== */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    .card-header {
        border-radius: 16px 16px 0 0 !important;
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

    .btn-danger {
        background: #fee2e2 !important;
        color: #b91c1c !important;
        border-radius: 10px !important;
        font-weight: 600;
    }

    .btn-danger:hover {
        background: #fecaca !important;
    }

    /* ===========================
    TABS
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
    }

    .nav-tabs .nav-link.active {
        background: #e8f0ff !important;
        color: #2563eb !important;
        border-bottom: 2px solid #2563eb !important;
    }

    /* ===========================
    TABLE STYLE
    =========================== */
    .table-bordered {
        border: 1px solid #e5e7eb !important;
    }

    .table th {
        width: 240px;
        background: #f9fafb;
        font-weight: 600;
        color: #374151;
    }

    .table td {
        color: #1f2937;
        font-size: 15px;
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
        color: #059669 !important;
    }

    .bg-danger {
        background: #ffe5e5 !important;
        color: #b91c1c !important;
    }

    /* ===========================
    ITINERARY ACCORDION
    =========================== */
    .card-header.bg-primary {
        background: #2563eb !important;
        color: white !important;
        border-radius: 16px 16px 0 0 !important;
    }

    .card-body p strong {
        color: #374151;
        font-weight: 600;
    }

    /* ===========================
    IMAGE GALLERY
    =========================== */
    .card-img-top {
        border-radius: 14px 14px 0 0 !important;
        object-fit: cover;
        height: 180px;
    }

    .card-body img {
        width: 100%;
        border-radius: 12px;
    }


</style>
<?php $tab = $_GET['tab'] ?? 'info'; ?>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h3 class="page-title">Chi tiết Phiên Bản: <?= $data_version['version_name'] ?></h3>
            <p class="page-subtitle">Thuộc tour: <strong><?= $data_version['tour_name'] ?></strong></p>
        </div>

        <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&tab=versions&id=<?= $data_version['tour_id'] ?>"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <!-- CARD WRAPPER -->
    <div class="card">
        <div class="card-body">

            <!-- TABS -->
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <button class="nav-link <?= $tab == 'info' ? 'active' : '' ?>"
                            data-bs-toggle="tab" data-bs-target="#info">
                        Thông tin phiên bản
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link <?= $tab == 'itinerary' ? 'active' : '' ?>"
                            data-bs-toggle="tab" data-bs-target="#itinerary">
                        Lịch trình
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link <?= $tab == 'images' ? 'active' : '' ?>"
                            data-bs-toggle="tab" data-bs-target="#images">
                        Hình ảnh
                    </button>
                </li>
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content">

                <!-- TAB 1: THÔNG TIN PHIÊN BẢN -->
                <div class="tab-pane fade <?= $tab == 'info' ? 'show active' : '' ?>" id="info">

                    <h5 class="section-title">Thông tin phiên bản</h5>

                    <table class="table mt-3">
                        <tbody>
                            <tr>
                                <th>Tên phiên bản</th>
                                <td><?= $data_version['version_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Mã phiên bản</th>
                                <td><?= $data_version['version_code'] ?></td>
                            </tr>
                            <tr>
                                <th>Giá gốc</th>
                                <td><?= number_format($data_version['price'], 0, ',', '.') ?> VNĐ</td>
                            </tr>
                            <tr>
                                <th>Thời gian áp dụng</th>
                                <td><?= $data_version['valid_from'] ?> → <?= $data_version['valid_to'] ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <span class="badge <?= $data_version['status'] == 'active' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $data_version['status'] == 'active' ? 'Đang hoạt động' : 'Tạm dừng' ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= BASE_URL ?>?mode=admin&action=editVersion&id=<?= $data_version['version_id'] ?>"
                           class="btn btn-primary">
                            Sửa phiên bản
                        </a>

                        <a href="<?= BASE_URL ?>?mode=admin&action=departureAdd&id=<?= $data_version['version_id'] ?>"
                           class="btn btn-success">
                            + Thêm chuyến đi
                        </a>
                    </div>

                </div>

                <!-- TAB 2: LỊCH TRÌNH -->
                <div class="tab-pane fade <?= $tab == 'itinerary' ? 'show active' : '' ?>" id="itinerary">

                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="section-title mb-0">Lịch trình Tour</h5>
                        <a href="<?= BASE_URL ?>?mode=admin&action=itineraryAdd&id=<?= $data_version['version_id'] ?>"
                           class="btn btn-success">
                            + Thêm lịch trình
                        </a>
                    </div>

                    <?php foreach ($data_itinerary as $value): ?>
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Ngày <?= $value['day_number'] ?>: <?= $value['place'] ?>
                            </div>
                            <div class="card-body">

                                <p><strong>Thời gian:</strong> <?= $value['start_time'] ?> → <?= $value['end_time'] ?></p>
                                <p><strong>Hoạt động:</strong> <?= nl2br($value['activity']) ?></p>

                                <div class="d-flex gap-2">
                                    <a href="<?= BASE_URL ?>?mode=admin&action=itineraryEdit&id=<?= $value['itinerary_id'] ?>&tab=itinerary"
                                       class="btn btn-primary btn-sm">
                                        Sửa
                                    </a>

                                    <a href="<?= BASE_URL ?>?mode=admin&action=deleteItinerary&id=<?= $value['itinerary_id'] ?>"
                                       onclick="return confirm('Bạn có chắc muốn xóa?')"
                                       class="btn btn-danger btn-sm">
                                        Xóa
                                    </a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <!-- TAB 3: HÌNH ẢNH -->
                <div class="tab-pane fade <?= $tab == 'images' ? 'show active' : '' ?>" id="images">

                    <h5 class="section-title">Hình ảnh phiên bản tour</h5>

                    <!-- Upload -->
                    <form method="POST"
                          action="<?= BASE_URL ?>?mode=admin&action=addImage&id=<?= $data_version['version_id'] ?>"
                          enctype="multipart/form-data"
                          class="mb-4">
                        <label class="form-label">Thêm hình ảnh</label>
                        <input type="file" class="form-control" name="image_url" multiple>

                        <button class="btn btn-success mt-2">Upload ảnh</button>
                    </form>

                    <!-- GALLERY -->
                    <?php if (!empty($data_image['image_url'])): ?>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                    <img src="<?= BASE_ASSETS_UPLOADS . $data_image['image_url'] ?>" class="card-img-top">

                                    <div class="card-body text-center">
                                        <a href="<?= BASE_URL ?>?mode=admin&action=deleteImage&id=<?= $data_version['version_id'] ?>"
                                           onclick="return confirm('Bạn có chắc muốn xóa ảnh này?')"
                                           class="btn btn-danger btn-sm">
                                            Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>
