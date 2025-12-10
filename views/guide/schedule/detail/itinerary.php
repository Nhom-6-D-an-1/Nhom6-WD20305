<style>
    .itinerary-day {
        background: #eef4ff;
        padding: 14px 18px;
        border-radius: 10px;
        font-weight: 700;
        color: #0d6efd;
        font-size: 1rem;
        border-left: 4px solid #0d6efd;
        margin-top: 10px;
        margin-bottom: 4px;
    }

    .table-itinerary thead {
        background: #f8f9fa !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-itinerary tbody tr:hover {
        background: #f5faff;
        transition: 0.25s ease;
    }

    .table-itinerary td {
        padding: 14px 16px !important;
        vertical-align: middle;
        font-size: 0.95rem;
    }

    /* Time column */
    .time-range {
        font-weight: 600;
        color: #495057;
    }

    .place-text {
        font-weight: 600;
        color: #0d6efd;
    }

    .activity-text {
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

        <div class="card-body p-0">

            <table class="table table-hover mb-0 table-itinerary">
                <thead>
                    <tr>
                        <th class="ps-4 py-3">Thời gian</th>
                        <th class="py-3">Địa điểm</th>
                        <th class="py-3">Hoạt động</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($itineraryData as $day => $activities): ?>

                    <!-- BLOCK NGÀY -->
                    <tr>
                        <td colspan="3">
                            <div class="itinerary-day">Ngày <?= $day ?></div>
                        </td>
                    </tr>

                    <!-- LIST HOẠT ĐỘNG -->
                    <?php foreach ($activities as $act): ?>
                        <tr>
                            <td class="time-range">
                                <?= $act['start_time'] ?> - <?= $act['end_time'] ?>
                            </td>
                            <td class="place-text">
                                <?= htmlspecialchars($act['place']) ?>
                            </td>
                            <td class="activity-text">
                                <?= htmlspecialchars($act['activity']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="card-footer bg-white py-4">
                <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info"
                   class="btn btn-secondary px-4">
                    Quay lại
                </a>
            </div>

        </div>

    </div>
</div>
