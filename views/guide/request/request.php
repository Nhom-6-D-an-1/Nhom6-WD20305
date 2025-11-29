<div class="col-12">
    <h2>Yêu cầu đặc biệt</h2>
    <form method="get" id="tourFilterForm">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewrequest">
        <div class="col-12 col-lg-6 mb-2">
            <select class="form-select" name="departure_id" onchange="document.getElementById('tourFilterForm').submit()">
                <option value="0" hidden>--Chọn tour--</option>
                <?php if (!empty($assignedTours)) { ?>
                    <?php foreach ($assignedTours as $tour) { ?>
                        <option value="<?php echo $tour['departure_id']; ?>"
                            <?php echo (isset($_GET['departure_id']) && $_GET['departure_id'] == $tour['departure_id']) ? 'selected' : ''; ?>>
                            <?php echo $tour['tour_name']; ?> 
                            (<?php echo date('d/m', strtotime($tour['start_date'])); ?> - <?php echo date('d/m', strtotime($tour['end_date'])); ?>)
                        </option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </form>
    <!-- <form action="<?= BASE_URL ?>?mode=guide&action=viewrequest" method="post" class="border rounded-3 p-4 d-flex flex-wrap align-items-center gap-3 bg-white shadow-sm">
        <div class="flex-grow-1">
            <select name="guest_id" class="form-control custom-input py-2" <?= empty($data_guest) ? 'disabled' : '' ?>>
                <option value="" disabled selected>
                    <?= empty($data_guest) ? '-- Vui lòng chọn Tour trước --' : '-- Chọn khách hàng --' ?>
                </option>
                <?php foreach ($data_guest as $value): ?>
                    <option value="<?= $value['guest_id'] ?>"><?= $value['full_name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="flex-grow-1" style="position: relative;">
            <input type="text" name="description" class="form-control custom-input py-2" placeholder="Yêu cầu">
            <span class="text-danger" style="position: absolute; top: 100%; left: 0; width: 100%; font-size: 13px; margin-top: 2px; white-space: nowrap;">
                <?php if (isset($_SESSION['flash_error'])): ?>
                    <?= $_SESSION['flash_error'];
                    unset($_SESSION['flash_error']) ?> <?php endif ?></span>
        </div>



        <div class="flex-grow-1">
            <input type="text" name="medical_condition" class="form-control custom-input py-2" placeholder="Bệnh lý (nếu có)">
        </div>

        <div>
            <button class="btn btn-primary px-4 py-2 fw-medium">Thêm yêu cầu</button>
        </div>

    </form> -->
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle mb-0 customer-table">
        <thead>
            <tr>
                <th class="ps-4 py-3 col-2">STT</th>
                <th class="py-3 col-3">Tên khách hàng</th>
                <th class="py-3 col-4">Yêu cầu</th>
                <th class="py-3 col-2 ">Bệnh lý</th>
                <th class="py-3 col-2 ">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($filteredSchedule)): ?>
                <tr>
                    <td colspan="6" class="text-center">Không có tour nào.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data as $key => $value): ?>
                    <tr class="customer-row">
                        <td class="ps-4 fw-semibold"><?= $key + 1 ?></td>
                        <td><?= $value['full_name'] ?></td>
                        <td><?= $value['description'] ?></td>
                        <td><?= $value['medical_condition'] ?? 'Không có' ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>?mode=guide&action=deleteRequest&id=<?= $value['request_id'] ?>" class="btn btn-danger" onclick=" return confirm('Bạn có muốn xóa yêu cầu không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>