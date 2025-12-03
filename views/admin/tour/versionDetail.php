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
                        <td><span class="badge bg-success"><?= $data_version['status'] ?></span></td>
                    </tr>
                </tbody>
            </table>

            <a href="<?= BASE_URL ?>?mode=admin&action=editVersion" class="btn btn-warning">Sửa phiên bản</a>
        </div>

        <!-- TAB 2: LỊCH TRÌNH -->
        <div class="tab-pane fade <?= $tab == 'itinerary' ? 'show active' : '' ?>" id="itinerary">

            <div class="d-flex justify-content-between mb-3">
                <h5>Lịch trình Tour</h5>
                <a href="<?= BASE_URL ?>?mode=admin&action=itineraryAdd" class="btn btn-success btn-sm"> Thêm ngày</a>
            </div>

            <div class="accordion" id="itineraryList">

                <div class="accordion-item mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#day1">
                            Ngày 1: Hà Nội → Hà Giang
                        </button>
                    </h2>

                    <div id="day1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <p>Di chuyển – Tham quan – Ăn trưa…</p>

                            <a href="<?= BASE_URL ?>?mode=admin&action=itineraryEdit" class="btn btn-warning btn-sm">Sửa</a>
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- TAB 3: HÌNH ẢNH -->
        <div class="tab-pane fade <?= $tab == 'images' ? 'show active' : '' ?>" id="images">

            <h5 class="mb-3">Hình ảnh phiên bản tour</h5>

            <!-- Upload -->
            <form enctype="multipart/form-data" method="POST" class="mb-4">
                <label class="form-label fw-bold">Thêm hình ảnh</label>
                <input type="file" class="form-control" name="images[]" multiple>
                <button class="btn btn-success mt-2">Upload ảnh</button>
            </form>

            <!-- IMAGE GALLERY -->
            <div class="row">

                <div class="col-3 mb-3">
                    <div class="card shadow-sm">
                        <img src="https://picsum.photos/300/200" class="card-img-top">
                        <div class="card-body text-center">
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-3">
                    <div class="card shadow-sm">
                        <img src="https://picsum.photos/301/200" class="card-img-top">
                        <div class="card-body text-center">
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="tab-pane fade" id="policy">
            <h5>Chính sách phiên bản tour</h5>

            <textarea class="form-control mt-3" rows="6">Giá bao gồm... 
Giá không bao gồm...
Điều kiện hoàn / hủy...</textarea>

            <button class="btn btn-primary mt-3">Lưu thay đổi</button>
        </div>
    </div>
</div>