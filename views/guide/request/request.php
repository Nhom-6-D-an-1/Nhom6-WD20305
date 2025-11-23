<div class="col-12">
    <h2>Yêu cầu đặc biệt</h2>
    <form action="<?= BASE_URL ?>" method="get" class="mb-4">
        <input type="hidden" name="mode" value="guide">
        <input type="hidden" name="action" value="viewrequest">

        <div class="d-flex align-items-center gap-2 bg-white p-3 rounded shadow-sm border">
            <label class="fw-bold">Lọc theo Tour:</label>
            <select name="tour_id" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">-- Chọn Tour để xem --</option>
                <?php foreach ($list_tour as $tour): ?>
                    <option value="<?= $tour['tour_id'] ?>"
                        <?= (isset($_GET['tour_id']) && $_GET['tour_id'] == $tour['tour_id']) ? 'selected' : '' ?>>
                        <?= $tour['tour_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (isset($_GET['tour_id']) && $_GET['tour_id']): ?>
                <a href="<?= BASE_URL ?>?mode=guide&action=viewrequest" class="btn btn-secondary btn-sm">Xóa lọc</a>
            <?php endif; ?>
        </div>
    </form>
    <form action="<?= BASE_URL ?>?mode=guide&action=viewrequest" method="post" class="border rounded-3 p-4 d-flex flex-wrap align-items-center gap-3 bg-white shadow-sm">
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
            <span class="text-danger" style="position: absolute; top: 100%; left: 0; width: 100%; font-size: 13px; margin-top: 2px; white-space: nowrap;"><?php if (isset($_SESSION['flash_error'])): ?>
                    <?= $_SESSION['flash_error'];
                                                                                                                                                                unset($_SESSION['flash_error']) ?> <?php endif ?></span>
        </div>



        <div class="flex-grow-1">
            <input type="text" name="medical_condition" class="form-control custom-input py-2" placeholder="Bệnh lý (nếu có)">
        </div>

        <div>
            <button class="btn btn-primary px-4 py-2 fw-medium">Thêm yêu cầu</button>
        </div>

    </form>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle mb-0 customer-table">
        <thead>
            <tr>
                <th class="ps-4 py-3 col-2">STT</th>
                <th class="py-3 col-4">Tên khách hàng</th>
                <th class="py-3 col-3">Yêu cầu</th>
                <th class="py-3 col-2 ">Bệnh lý</th>
                <th class="py-3 col-2 ">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value): ?>
                <tr class="customer-row">
                    <td class="ps-4 fw-semibold"><?= $key + 1 ?></td>
                    <td><?= $value['full_name'] ?></td>
                    <td><?= $value['description'] ?></td>
                    <td><?= $value['medical_condition'] ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>?mode=guide&action=deleteRequest&id=<?= $value['request_id'] ?>" class="btn btn-danger" onclick=" return confirm('Bạn có muốn xóa yêu cầu không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>