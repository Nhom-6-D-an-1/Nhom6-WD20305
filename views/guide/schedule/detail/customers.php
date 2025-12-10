<style>
    .card-custom {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 22px rgba(0,0,0,0.06);
    }

    .table thead.bg-light {
        background: #f8f9fa !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-hover tbody tr {
        transition: 0.25s ease;
    }
    .table-hover tbody tr:hover {
        background: #f5faff;
    }

    .table td, .table th {
        padding: 14px 16px !important;
        vertical-align: middle;
    }

    .customer-name {
        font-weight: 600;
        color: #212529;
    }

    .gender-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .gender-male {
        background: #e7f1ff;
        color: #0d6efd;
    }

    .gender-female {
        background: #ffe6ef;
        color: #d63384;
    }

    .card-footer {
        border-top: 1px solid #f1f1f1;
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

            <!-- TABLE -->
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 ps-4">STT</th>
                        <th class="py-3 ps-4">Tên khách</th>
                        <th class="py-3">Liên hệ</th>
                        <th class="py-3">Thuộc nhóm của</th>
                        <th class="py-3 text-center">Giới tính</th>
                        <th class="py-3">Yêu cầu đặc biệt</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($customersData as $key => $customer): ?>
                    <tr>
                        <td class="ps-4"><?= $key + 1 ?></td>

                        <td class="customer-name">
                            <?= htmlspecialchars($customer['full_name']) ?>
                        </td>

                        <td><?= htmlspecialchars($customer['phone'] ?? '---') ?></td>

                        <td><?= htmlspecialchars($customer['customer_name'] ?? '---') ?></td>

                        <td class="text-center">
                            <?php if (($customer['gender'] ?? '') === 'Nam'): ?>
                                <span class="gender-badge gender-male">Nam</span>
                            <?php elseif (($customer['gender'] ?? '') === 'Nữ'): ?>
                                <span class="gender-badge gender-female">Nữ</span>
                            <?php else: ?>
                                ---
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($customer['special_request'] ?? '---') ?></td>
                    </tr>
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

