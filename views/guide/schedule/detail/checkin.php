<style>

/* CARD STYLE */
.card-custom {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 22px rgba(0,0,0,0.06);
}

/* TABS PRO */
.nav-tabs-custom .nav-link {
    font-weight: 600;
    padding: 12px 20px;
    color: #6c757d;
    border: none;
    border-bottom: 3px solid transparent;
    transition: 0.25s ease;
}

.nav-tabs-custom .nav-link:hover {
    color: #0d6efd;
    background: #f8f9fa;
}

.nav-tabs-custom .nav-link.active {
    color: #0d6efd !important;
    background: transparent;
    border-bottom: 3px solid #0d6efd;
}

/* TITLE */
.card-custom h4 {
    font-size: 1.45rem;
    margin-bottom: 12px;
}

/* INFO BLOCK BEAUTIFY */
.text-muted p {
    margin-bottom: 6px;
    font-size: 1rem;
}

/* PROGRESS BAR */
.progress {
    background-color: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
}

.thanh-progress {
    border-radius: 10px;
    transition: width 0.4s ease;
}

/* BUTTONS */
.btn-lg {
    border-radius: 12px;
    padding: 12px 28px;
    font-size: 1.1rem;
    font-weight: 600;
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
                <li class="nav-item">
                    <a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/info' ? 'active' : '' ?>"
                       href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $departure_id ?>">
                        Thông tin
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/itinerary' ? 'active' : '' ?>"
                       href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-itinerary&id=<?= $departure_id ?>">
                        Lịch trình
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/customers' ? 'active' : '' ?>"
                       href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-customers&id=<?= $departure_id ?>">
                        Danh sách khách
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/checkin' ? 'active' : '' ?>"
                       href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-checkin&id=<?= $departure_id ?>">
                        Check-in
                    </a>
                </li>
            </ul>
        </div>

        <!-- CARD BODY CONTENT -->
        <div class="card-body py-5">

            <div class="mb-5">

                <h4 class="fw-bold">Check-in khách cho tour này</h4>

                <div class="text-muted mb-4">
                    <p>Ngày khởi hành: <strong><?= date('d/m/Y', strtotime($checkinData['start_date'])) ?></strong></p>
                    <p>Địa điểm đón: <strong><?= $checkinData['pickup_location'] ?></strong></p>
                    <p>Giờ đón: <strong><?= $checkinData['pickup_time'] ?></strong></p>
                    <p>Đã check-in: 
                        <strong class="text-success">
                            <?= $checkinData['checked_in'] ?> / <?= $checkinData['max_guests'] ?> khách
                        </strong>
                    </p>
                </div>

                <div class="progress mb-4" style="height: 12px;">
                    <?php $progressBar = $checkinData['checked_in'] / $checkinData['max_guests']; ?>
                    <div class="thanh-progress progress-bar bg-success"
                         style="width: <?= $progressBar * 100 ?>%;"></div>
                </div>

                <a href="<?= BASE_URL ?>?mode=guide&action=viewcheckin"
                   class="btn btn-primary px-5 btn-lg">
                    Bắt đầu check-in ngay
                </a>
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
