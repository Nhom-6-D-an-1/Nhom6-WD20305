<style>
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 22px;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 14px;
        padding: 20px 22px;
        border: 1px solid #eef1f4;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        transition: 0.25s ease;
    }

    .info-box:hover {
        background: #f1f6ff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.07);
    }

    .info-label {
        font-size: .85rem;
        color: #6c757d;
        margin-bottom: 6px;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .info-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 10px 22px !important;
        font-weight: 500;
    }
</style>

<div class="col-12">

    <h2 class="h3 fw-bold text-dark mb-4">
        Chi tiết tour: <?= $infoData['tour_name'] ?>
    </h2>

    <div class="card shadow-sm border-0 card-custom">

        <!-- NAV TABS -->
        <div class="card-header bg-white border-0">
            <ul class="nav nav-tabs nav-tabs-custom border-0">
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/info' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $departure_id ?>">Thông tin</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/itinerary' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-itinerary&id=<?= $departure_id ?>">Lịch trình</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/customers' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-customers&id=<?= $departure_id ?>">Danh sách khách</a></li>
                <!-- <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/checkin' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-checkin&id=<?= $departure_id ?>">Check-in</a></li> -->
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="card-body p-5">

            <div class="info-grid">

                <div class="info-box">
                    <div class="info-label">Mã tour</div>
                    <div class="info-value"><?= $infoData['departure_id'] ?></div>
                </div>

                <div class="info-box">
                    <div class="info-label">Tên tour</div>
                    <div class="info-value"><?= $infoData['tour_name'] ?></div>
                </div>

                <div class="info-box">
                    <div class="info-label">Khởi hành</div>
                    <div class="info-value"><?= date('d/m/Y', strtotime($infoData['start_date'])) ?></div>
                </div>

                <div class="info-box">
                    <div class="info-label">Kết thúc</div>
                    <div class="info-value"><?= date('d/m/Y', strtotime($infoData['end_date'])) ?></div>
                </div>

                <div class="info-box">
                    <div class="info-label">Số khách</div>
                    <div class="info-value"><?= $infoData['current_guests'] ?></div>
                </div>

                <div class="info-box">
                    <div class="info-label">Hướng dẫn viên</div>
                    <div class="info-value"><?= $infoData['guide_name'] ?></div>
                </div>

            </div>

            <div class="mt-4">
                <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info"
                   class="btn btn-secondary px-4">
                    Quay lại
                </a>
            </div>

        </div>
    </div>
</div>
