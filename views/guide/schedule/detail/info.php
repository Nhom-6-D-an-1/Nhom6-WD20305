<div class="col-12">
    <h2 class="h3 fw-bold text-dark mb-4">Chi tiết tour</h2>

    <div class="card shadow-sm border-0 card-custom">
        <div class="card-header bg-white border-0">
            <ul class="nav nav-tabs nav-tabs-custom border-0">
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/info' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $departure_id ?>">Thông tin</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/itinerary' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-itinerary&id=<?= $departure_id ?>">Lịch trình</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/customers' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-customers&id=<?= $departure_id ?>">Danh sách khách</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/checkin' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-checkin&id=<?= $departure_id ?>">Check-in</a></li>
            </ul>
        </div>

        <div class="card-body p-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Mã tour</label>
                    <p class="fw-bold fs-5"><?php echo $infoData['departure_id'] ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Tên tour</label>
                    <p class="fw-bold fs-5"><?php echo $infoData['tour_name'] ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Khởi hành</label>
                    <p class="fw-bold"><?= date('d/m/Y', strtotime($infoData['start_date'])) ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Kết thúc</label>
                    <p class="fw-bold"><?= date('d/m/Y', strtotime($infoData['end_date'])) ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Số khách</label>
                    <p class="fw-bold"><?php echo $infoData['current_guests'] ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">HDV</label>
                    <p class="fw-bold"><?php echo $infoData['guide_name'] ?></p>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info" class="btn btn-secondary px-4">Quay lại</a>
            </div>
        </div>
    </div>
</div>