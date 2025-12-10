<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="fw-bold">Quản lý nhân sự (Hướng dẫn viên)</h3>
    </div>

    <!-- CARD CHÍNH -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- BẢNG NHÂN SỰ -->
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 70px;">#</th>
                        <th>Họ tên</th>
                        <th style="width: 120px;">Ảnh</th>
                        <th>Chứng chỉ</th>
                        <th>Ngôn ngữ</th>
                        <th style="width: 120px;">Đánh giá</th>
                        <th style="width: 150px;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data_tourGuide as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <!-- TÊN HDV -->
                            <td class="fw-semibold">
                                <?= htmlspecialchars($value['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <!-- ẢNH ĐẠI DIỆN -->
                            <td>
                                <?php if (!empty($value['avatar'])): ?>
                                    <img src="<?= BASE_ASSETS_UPLOADS . $value['avatar'] ?>"
                                        alt="Avatar"
                                        class="img-fluid rounded"
                                        style="width: 90px; height: 90px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>

                            <!-- CHỨNG CHỈ -->
                            <td>
                                <?php if (!empty($value['certificates'])): ?>
                                    <span class="badge bg-primary">
                                        <?= htmlspecialchars($value['certificates'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <!-- NGÔN NGỮ -->
                            <td>
                                <?php if (!empty($value['languages'])): ?>
                                    <span class="badge bg-success">
                                        <?= htmlspecialchars($value['languages'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>

                            <!-- ĐÁNH GIÁ -->
                            <td>
                                ⭐ <?= (float)$value['rating'] ?>/5
                            </td>

                            <!-- ACTION -->
                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=viewGuideDetail&id=<?= $value['user_id'] ?>"
                                    class="btn btn-info btn-sm w-100">
                                    Chi tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>