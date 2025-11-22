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

        <div class="card-body p-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Mã tour</label>
                    <p class="fw-bold fs-5">T001</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Tên tour</label>
                    <p class="fw-bold fs-5">Sapa - Fansipan 3N2Đ</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Khởi hành</label>
                    <p class="fw-bold">20/11/2025</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Kết thúc</label>
                    <p class="fw-bold">22/11/2025</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Số khách</label>
                    <p class="fw-bold">18/20</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">HDV</label>
                    <p class="fw-bold">Nguyễn Văn HDV</p>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-secondary px-4">Quay lại</button>
            </div>
        </div>
    </div>
</div>