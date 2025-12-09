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