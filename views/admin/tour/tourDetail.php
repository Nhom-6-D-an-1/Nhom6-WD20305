<?php
$tab = $_GET['tab'] ?? 'info';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3 class="mb-3">Chi tiết Tour: <?= $data['tour_name'] ?></h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewstour" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
    </div>
    <!-- Tabs -->
    <ul class="nav nav-tabs mt-4">
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
    <div class="tab-content border p-3">

        <!-- Tab 1 -->
        <div class="tab-pane fade <?= $tab == 'info' ? 'show active' : '' ?>" id="info">
            <h5>Thông tin chung</h5>
            <p><strong>Mã Tour:</strong> <?= $data['tour_code'] ?></p>
            <p><strong>Thời lượng:</strong> <?= $data['duration_days'] ?> ngày</p>
            <p><strong>Mô tả:</strong> <?= $data['short_description'] ?></p>
        </div>

        <!-- Tab 2 -->
        <div class="tab-pane fade <?= $tab == 'versions' ? 'show active' : '' ?>" id="versions">
            <div class="d-flex justify-content-between mb-3">
                <h5>Các phiên bản</h5>
                <a href="<?= BASE_URL ?>?mode=admin&action=createVersion&id=<?= $data['tour_id'] ?>" class="btn btn-success"> Tạo phiên bản mới</a>
            </div>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tên phiên bản</th>
                        <th>Giá</th>
                        <th>Ngày áp dụng</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_version as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['version_code'] ?> - <?= $value['season'] ?></td>
                            <td><?= number_format($value['price'], 0, '', '.') ?> VNĐ</td>
                            <td><?= $value['valid_from'] ?> - <?= $value['valid_to'] ?></td>
                            <td><span class="badge bg-success"><?= $value['status'] ?></span></td>
                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=versionDetail&id=<?= $value['version_id'] ?>" class="btn btn-primary btn-sm">Chi tiết</a>
                                <a href="<?= BASE_URL ?>?mode=admin&action=versionCopy" class="btn btn-secondary btn-sm">Sao chép</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Tab 3 -->
        <div class="tab-pane fade <?= $tab == 'history' ? 'show active' : '' ?>" id="history">
            <h5>Lịch sử phiên bản</h5>

            <ul class="list-group">
                <?php foreach ($data_version as  $value): ?>
                    <li class="list-group-item">
                        <strong><?= $value['version_name'] ?></strong> – Tạo ngày: <?= $value['created_at'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>