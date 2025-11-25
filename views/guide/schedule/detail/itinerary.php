<div class="col-12">
    <h2 class="h3 fw-bold text-dark mb-4">Chi tiết tour: <?= $infoData['tour_name'] ?></h2>

    <div class="card shadow-sm border-0 card-custom">
        <div class="card-header bg-white border-0">
            <ul class="nav nav-tabs nav-tabs-custom border-0">
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/info' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info&id=<?= $departure_id ?>">Thông tin</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/itinerary' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-itinerary&id=<?= $departure_id ?>">Lịch trình</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/customers' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-customers&id=<?= $departure_id ?>">Danh sách khách</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/checkin' ? 'active' : '' ?>" href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-checkin&id=<?= $departure_id ?>">Check-in</a></li>
            </ul>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Thời gian</th>
                        <th>Địa điểm</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itineraryData as $day => $activities): ?>
                        <tr>
                            <td class="fw-bold" colspan="3">Ngày <?= $day ?></td>
                        </tr>
                        <?php foreach ($activities as $act): ?>
                            <tr>
                                <td><?= $act['start_time'] ?> - <?= $act['end_time'] ?></td>
                                <td><?= $act['place'] ?></td>
                                <td><?= $act['activity'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="card-footer bg-white py-4">
                <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info" class="btn btn-secondary px-4">Quay lại</a>
            </div>
        </div>
    </div>
</div>