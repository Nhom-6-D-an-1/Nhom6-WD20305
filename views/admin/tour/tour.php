<div class="container-fluid px-4">
    <h3 class="fw-bold mt-4 mb-4">Danh sách Tour</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- Thanh hành động -->
            <div class="d-flex justify-content-between mb-3">
                <div></div>

                <a href="<?= BASE_URL ?>?mode=admin&action=createTour" class="btn btn-success">
                    + Tạo tour mới
                </a>
            </div>

            <!-- Bảng dữ liệu -->
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Tên Tour</th>
                        <th style="width:180px;">Mã Tour</th>
                        <th style="width:220px;">Phiên bản hiện tại</th>
                        <th style="width:230px;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <td><?= htmlspecialchars($value['tour_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>

                            <td><?= htmlspecialchars($value['tour_code'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>

                            <td>
                                <?= htmlspecialchars($value['version_code'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                <?= !empty($value['season']) ? ' - ' . htmlspecialchars($value['season'] ?? '', ENT_QUOTES, 'UTF-8') : '' ?>
                            </td>


                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&id=<?= $value['tour_id'] ?>"
                                   class="btn btn-info btn-sm">Xem</a>

                                <a href="<?= BASE_URL ?>?mode=admin&action=editTour&id=<?= $value['tour_id'] ?>"
                                   class="btn btn-primary btn-sm">Sửa</a>

                                <a onclick="return confirm('Bạn có muốn xóa tour không?')"
                                   href="<?= BASE_URL ?>?mode=admin&action=deleteTour&id=<?= $value['tour_id'] ?>"
                                   class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger mt-3">
                    <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
