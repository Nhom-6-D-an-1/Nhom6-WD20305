<div class="col-12">
    <h2>Danh sách khách</h2>

    <form method="get" id="tourFilterForm">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewcustomers">
        <div class="col-12 col-lg-6 mb-2">
            <select class="form-select" name="departure_id" onchange="document.getElementById('tourFilterForm').submit()">
                <option value="0" hidden>--Chọn tour--</option>
                <?php foreach ($assignedTours as $tour): ?>
                    <option value="<?= $tour['departure_id'] ?>"
                        <?= (isset($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : '' ?>>
                        <?= $tour['tour_name'] ?> 
                        (<?= date('d/m', strtotime($tour['start_date'])) ?> - <?= date('d/m', strtotime($tour['end_date'])) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
    <div class="card shadow-sm border-0 customer-card">
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0 customer-table">
                    <thead>
                        <tr>
                            <th class="py-3">STT</th>
                            <th class="ps-4 py-3">Tên khách</th>
                            <th class="py-3">Liên hệ</th>
                            <th class="text-center px-5">Nhóm</th>
                            <th class="py-3">Yêu cầu đặc biệt</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($_GET['departure_id'])): ?>
                            <?php if(!empty($allCustomersData)){ ?>
                                <?php foreach($allCustomersData as $key => $customers): ?>
                                    <tr class="customer-row">
                                        <td><?= $key +1 ?></td>
                                        <td class="ps-4 fw-semibold"><?= $customers['guest_name'] ?></td>
                                        <td><?= $customers['customer_contact'] ?></td>
                                        <td class="text-center"><span class="badge customer-group-badge"><?= $customers['group_type'] ?></span></td>
                                        <td class="fw-medium"><?= $customers['special_request'] ?? 'Không có' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php }else{ ?>
                                <tr>
                                    <td colspan="6" class="text-center text-danger">Chưa có danh sách khách.</td>
                                </tr>
                            <?php } ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-danger">Vui lòng chọn tour.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>