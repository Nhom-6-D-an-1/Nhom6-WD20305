
<div class="col-12">
    <h2 class="">Tour của tôi</h2>

    <!-- Form tìm kiếm -->
     <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-center">
                <div class="col-lg-4 col-md-6">
                    <select class="form-select">
                        <option value="0" hidden>--Chọn tour--</option>
                        <option value="1">Chưa có tour</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <input type="date" class="form-control">
                </div>
                <div class="col-lg-3 col-md-6">
                    <select class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option>Sắp tới</option>
                        <option>Đang diễn ra</option>
                        <option>Hoàn tất</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </form>
        </div>
     </div>

     <!-- Bảng danh sách tour -->
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mã tour</th>
                            <th>Tour</th>
                            <th>Ngày khởi hành</th>
                            <th class="">Số khách</th>
                            <th class="">Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($scheduleData as $value){ ?>
                            <tr>
                                <td><?php $value['departure_id'] ?></td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>?action=detail-schedule-info" class="btn btn-primary">Xem</a>
                                    <a href="<?= BASE_URL ?>?action=viewcheck-in" class="btn btn-success">Checkin</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
</div>