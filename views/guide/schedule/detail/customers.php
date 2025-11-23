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

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">STT</th>
                        <th>Tên khách</th>
                        <th class="text-center">Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customersData as $key => $customer): ?>
                        <tr>
                            <td class="ps-4"><?= $key + 1 ?></td>
                            <td class="fw-semibold"><?= $customer['full_name'] ?></td>
                            <td class="text-center"><span class="badge text-white <?php echo $customer['checkin_status'] == 'present' ? 'bg-success' : 'bg-warning' ?>"><?php echo $customer['checkin_status'] == 'present' ? 'Đã check-in' : 'Chưa check-in' ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="card-footer bg-white py-4">
                <a href="<?= BASE_URL ?>?mode=guide&action=detail-schedule-info" class="btn btn-secondary px-4">Quay lại</a>
            </div>
        </div>
    </div>
</div>