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

        <div class="card-body py-5">
            <div class=" mb-5">
                <h4 class="fw-bold">Check-in khách cho tour này</h4>
                <div class="text-muted mb-4">
                    <p>Ngày khởi hành: <strong>20/11/2025</strong></p>
                    <p>Địa điểm đón: <strong>Cổng số 1 - Bến xe Mỹ Đình</strong></p>
                    <p>Giờ đón: <strong>07:30 AM</strong></p>
                    <p>Đã check-in: <strong class="text-success">15 / 18 khách</strong></p>
                </div>
                <div class="progress mb-4" style="height: 12px;">
                    <div class="thanh-progress progress-bar bg-success" style="width: 83%;"></div>
                </div>
                <a href="" class="btn btn-primary px-5 btn-lg">Bắt đầu check-in ngay</a>
            </div>
            <div class="mt-4">
                <button class="btn btn-secondary">Quay lại</button>
            </div>
        </div>
    </div>
</div>