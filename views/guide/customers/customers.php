<style>
    .title-line {
        font-size: 1.4rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 20px;
        padding-bottom: 6px;
        border-bottom: 2px solid #e9ecef;
    }

    .customer-card {
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        margin-top: 20px;
    }

    .customer-card .table thead {
        background: #f8f9fa;
    }

    .customer-row {
        transition: background 0.25s ease;
    }
    .customer-row:hover {
        background: #f5faff;
    }

    .customer-group-badge {
        background: #0d6efd;
        padding: 6px 10px;
        border-radius: 8px;
        color: #fff;
        font-size: 0.85rem;
    }

    .form-select {
        border-radius: 10px !important;
        padding: 10px 14px !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .table th {
        font-size: .9rem;
        text-transform: uppercase;
        color: #6c757d;
        letter-spacing: .5px;
    }

    .no-data-row td {
        padding: 30px 0 !important;
        font-size: 1rem;
        color: #dc3545;
        font-weight: 600;
    }
</style>

<div class="col-12">

    <h2 class="title-line">Danh sách khách</h2>

    <!-- FILTER -->
    <form method="get" id="tourFilterForm" class="mb-3">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewcustomers">

        <div class="col-12 col-lg-6">
            <select class="form-select"
                    name="departure_id"
                    onchange="document.getElementById('tourFilterForm').submit()">

                <option value="0" hidden>-- Chọn tour --</option>

                <?php foreach ($assignedTours as $tour): ?>
                    <option value="<?= $tour['departure_id'] ?>"
                        <?= (!empty($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : '' ?>>

                        <?= $tour['tour_name'] ?>
                        (<?= date('d/m', strtotime($tour['start_date'])) ?>
                        - <?= date('d/m', strtotime($tour['end_date'])) ?>)

                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0 customer-card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 customer-table">

                    <thead>
                        <tr>
                            <th>STT</th>
                            <th class="ps-4">Tên khách</th>
                            <th>Liên hệ</th>
                            <th class="text-center">Nhóm</th>
                            <th>Yêu cầu đặc biệt</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($_GET['departure_id'])): ?>

                            <?php if(!empty($allCustomersData)): ?>
                                <?php foreach($allCustomersData as $key => $customers): ?>
                                    <tr class="customer-row">
                                        <td><?= $key + 1 ?></td>

                                        <td class="ps-4 fw-semibold">
                                            <?= htmlspecialchars($customers['guest_name']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($customers['customer_contact']) ?>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge customer-group-badge">
                                                <?= htmlspecialchars($customers['group_type']) ?>
                                            </span>
                                        </td>

                                        <td class="fw-medium">
                                            <?= htmlspecialchars($customers['special_request'] ?? 'Không có') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr class="no-data-row">
                                    <td colspan="6" class="text-center">
                                        Chưa có danh sách khách.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        <?php else: ?>
                            <tr class="no-data-row">
                                <td colspan="6" class="text-center">
                                    Vui lòng chọn tour.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
