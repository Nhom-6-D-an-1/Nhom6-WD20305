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
                        <th class="ps-4">Thời gian</th>
                        <th>Địa điểm</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="3" class="bg-white fw-bold ps-4 py-3">Ngày 1: 20/11/2025</td></tr>
                    <tr>
                        <td class="ps-5 text-muted">08:00 - 09:00</td>
                        <td>Bến xe Mỹ Đình</td>
                        <td>Xe đón khách</td>
                    </tr>
                    <tr>
                        <td class="ps-5 text-muted">10:00 - 12:00</td>
                        <td>Bãi Cát Cát</td>
                        <td>Tham quan, chụp ảnh</td>
                    </tr>

                    <tr><td colspan="3" class="bg-white fw-bold ps-4 py-3">Ngày 2: 21/11/2025</td></tr>
                    <tr>
                        <td class="ps-5 text-muted">07:00 - 08:00</td>
                        <td>Khách sạn</td>
                        <td>Ăn sáng</td>
                    </tr>
                    <tr>
                        <td class="ps-5 text-muted">08:00 - 12:00</td>
                        <td>Fansipan</td>
                        <td>Trekking</td>
                    </tr>

                    <tr><td colspan="3" class="bg-white fw-bold ps-4 py-3">Ngày 3: 22/11/2025</td></tr>
                    <tr>
                        <td class="ps-5 text-muted">07:00 - 08:00</td>
                        <td>Khách sạn</td>
                        <td>Ăn sáng</td>
                    </tr>
                    <tr>
                        <td class="ps-5 text-muted">09:00 - 12:00</td>
                        <td>Chợ Sapa</td>
                        <td>Mua sắm</td>
                    </tr>
                </tbody>
            </table>
            <div class="card-footer bg-white py-4">
                <button class="btn btn-secondary">Quay lại</button>
            </div>
        </div>
    </div>
</div>