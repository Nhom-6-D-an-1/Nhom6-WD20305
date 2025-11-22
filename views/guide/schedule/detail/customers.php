<div class="col-12">
    <h2 class="h3 fw-bold text-dark mb-4">Chi tiết tour</h2>

    <div class="card shadow-sm border-0 card-custom">
        <div class="card-header bg-white border-0">
            <ul class="nav nav-tabs nav-tabs-custom border-0">
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/info' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=detail-schedule-info">Thông tin</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/itinerary' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=detail-schedule-itinerary">Lịch trình</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/customers' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=detail-schedule-customers">Danh sách khách</a></li>
                <li class="nav-item"><a class="nav-link <?= ($view ?? '') === 'guide/schedule/detail/checkin' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=detail-schedule-checkin">Check-in</a></li>
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
                    <tr>
                        <td class="ps-4">1</td>
                        <td class="fw-semibold">Nguyễn Văn A</td>
                        <td class="text-center"><span class="badge bg-success text-white">Đã check-in</span></td>
                    </tr>
                    <tr>
                        <td class="ps-4">2</td>
                        <td class="fw-semibold">Trần Thị B</td>
                        <td class="text-center"><span class="badge bg-warning text-white">Chưa đến</span></td>
                    </tr>
                    <tr>
                        <td class="ps-4">3</td>
                        <td class="fw-semibold">Đinh Công C</td>
                        <td class="text-center"><span class="badge bg-success text-white">Đã check-in</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="card-footer bg-white py-4">
                <button class="btn btn-secondary">Quay lại</button>
            </div>
        </div>
    </div>
</div>