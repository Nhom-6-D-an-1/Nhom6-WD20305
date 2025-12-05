<?php
$tab = $_GET['tab'] ?? 'info';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Chi tiết Phiên Bản: <?= $data_version['version_name'] ?></h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&tab=versions&id=<?= $data_version['tour_id'] ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
    </div>
    <p class="text-muted">Thuộc tour: <?= $data_version['tour_name'] ?></p>

    <!-- TAB NAV -->
    <ul class="nav nav-tabs mt-4">

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
    <div class="tab-content border p-4">

        <!-- TAB 1: THÔNG TIN PHIÊN BẢN -->
        <div class="tab-pane fade <?= $tab == 'info' ? 'show active' : '' ?>" id="info">
            <h5>Thông tin phiên bản</h5>

            <table class="table mt-3 table-bordered">
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
                        <td><?= number_format($data_version['price'], 0, '', '.') ?> VNĐ</td>
                    </tr>
                    <tr>
                        <th>Thời gian áp dụng</th>
                        <td><?= $data_version['valid_from'] ?> → <?= $data_version['valid_to'] ?></td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td><span class="<?= $data_version['status'] == 'active' ? 'badge bg-success' : 'badge bg-danger' ?>"><?= $data_version['status'] == 'active' ? 'Đang hoạt động' : 'Tạm dừng' ?></span></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between mb-3">
                <a href="<?= BASE_URL ?>?mode=admin&action=editVersion&id=<?= $data_version['version_id'] ?>" class="btn btn-warning">Sửa phiên bản</a>
                <a href="<?= BASE_URL ?>?mode=admin&action=departureAdd&id=<?= $data_version['version_id'] ?>"
                    class="btn btn-success btn-sm">
                    Thêm chuyến đi
                </a>
            </div>
        </div>

        <!-- TAB 2: LỊCH TRÌNH -->
        <div class="tab-pane fade <?= $tab == 'itinerary' ? 'show active' : '' ?>" id="itinerary">

            <div class="d-flex justify-content-between mb-3">
                <h5>Lịch trình Tour</h5>
                <a href="<?= BASE_URL ?>?mode=admin&action=itineraryAdd&id=<?= $data_version['version_id'] ?>" class="btn btn-success btn-sm"> Thêm lịch trình</a>
            </div>

            <div class="accordion" id="itineraryList">

                <?php foreach ($data_itinerary as $value): ?>
                    <div class="card mb-2">
                        <div class="card-header bg-primary text-white">
                            Ngày <?= $value['day_number'] ?>: <?= $value['place'] ?>
                        </div>
                        <div class="card-body">
                            <p><strong>Thời gian:</strong> <?= $value['start_time'] ?> → <?= $value['end_time'] ?></p>
                            <p><strong>Hoạt động:</strong> <?= $value['activity'] ?></p>

                            <a href="<?= BASE_URL ?>?mode=admin&action=itineraryEdit&id=<?= $value['itinerary_id'] ?>&tab=itinerary" class="btn btn-warning btn-sm">Sửa</a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa?')"
                                href="<?= BASE_URL ?>?mode=admin&action=deleteItinerary&id=<?= $value['itinerary_id'] ?>"
                                class="btn btn-danger btn-sm">Xóa</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- TAB 3: HÌNH ẢNH -->
        <div class="tab-pane fade <?= $tab == 'images' ? 'show active' : '' ?>" id="images">

            <h5 class="mb-3">Hình ảnh phiên bản tour</h5>

            <!-- Upload -->
            <form action="<?= BASE_URL ?>?mode=admin&action=addImage&id=<?= $data_version['version_id'] ?>" enctype="multipart/form-data" method="POST" class="mb-4">
                <label class="form-label fw-bold">Thêm hình ảnh</label>
                <input type="file" class="form-control" name="image_url" multiple>
                <button class="btn btn-success mt-2">Upload ảnh</button>
            </form>

            <!-- IMAGE GALLERY -->
            <?php if (!empty($data_image) && !empty($data_image['image_url'])): ?>
                <div class="row">
                    <div class="col-3 mb-3">
                        <div class="card shadow-sm">
                            <img src="<?= BASE_ASSETS_UPLOADS . $data_image['image_url'] ?>" class="card-img-top">
                            <div class="card-body text-center">
                                <a href="<?= BASE_URL ?>?mode=admin&action=deleteImage&id=<?= $data_version['version_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>