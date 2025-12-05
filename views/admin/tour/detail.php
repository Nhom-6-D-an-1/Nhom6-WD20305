<div class="col-md-10 p-4">

    <h3 class="mb-4">Chi tiết tour: <?= $tour['tour_name'] ?></h3>

    <div class="card p-4">

        <div class="row mb-3">
            <div class="col-md-6"><strong>Tên tour:</strong> <?= $tour['tour_name'] ?></div>
            <div class="col-md-6"><strong>Phiên bản:</strong> <?= $tour['version_name'] ?></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6"><strong>Danh mục:</strong> <?= $tour['category_name'] ?></div>
            <div class="col-md-6">
                <strong>Trạng thái:</strong>
                <?= strtotime($tour['start_date']) > time() ? "Hoạt động" : "Tạm dừng" ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6"><strong>Giá:</strong> <?= number_format($tour['price']) ?> đ</div>
            <div class="col-md-6"><strong>HDV phân công:</strong> <?= $tour['guide_name'] ?></div>
        </div>

        <div class="mb-4">
            <strong>Ngày khởi hành:</strong>
            <?= date("d/m/Y", strtotime($tour['start_date'])) ?>
        </div>

        <!-- Nút Danh sách khách -->
        <?php if (!empty($departure_id)): ?>
            <a href="?mode=admin&action=guestlist&departure_id=<?= $departure_id ?>" 
               class="btn btn-primary w-100 mb-2">
                Danh sách khách
            </a>
        <?php else: ?>
            <button class="btn btn-secondary w-100 mb-2" disabled>Không có lịch khởi hành</button>
        <?php endif; ?>

        <a href="?mode=admin&action=viewstour" class="btn btn-secondary w-100">Quay lại</a>

    </div>

</div>
