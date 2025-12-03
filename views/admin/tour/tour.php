<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="mb-3">Danh sách Tour</h3>
        <a href="<?= BASE_URL ?>?mode=admin&action=createTour" class="btn btn-success"> Tạo tour mới</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên Tour</th>
                <th>Mã Tour</th>
                <th>Phiên bản hiện tại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['tour_name'] ?></td>
                    <td><?= $value['tour_code'] ?></td>
                    <td><?= $value['version_code'] ?> - <?= $value['season'] ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&id=<?= $value['tour_id'] ?>" class="btn btn-primary btn-sm">Chi tiết</a>
                        <!-- <a href="<?= BASE_URL ?>?mode=admin&action=tourVersion" class="btn btn-warning btn-sm">Quản lý phiên bản</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>