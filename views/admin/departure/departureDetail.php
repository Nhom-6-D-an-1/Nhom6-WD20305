<?php
$tab = $_GET['tab'] ?? 'info';
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3>Chi tiết chuyến đi</h3>
            <p class="text-muted"><?= $data_departure['tour_name'] ?> → <?= $data_departure['version_name'] ?></p>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture" class="btn btn-outline-secondary align-self-center">Quay lại</a>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link <?= $tab == 'info' ? 'active' : '' ?>" href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=info">Thông tin</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab == 'bookings' ? 'active' : '' ?>" href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=bookings">Booking</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab == 'guests' ? 'active' : '' ?>" href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=guests">Khách</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab == 'staff' ? 'active' : '' ?>" href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=staff">Phân bổ nhân sự</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab == 'services' ? 'active' : '' ?>" href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=services">Phân bổ dịch vụ</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab == 'revenue' ? 'active' : '' ?>" href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=revenue">Doanh thu</a></li>
    </ul>

    <div class="tab-content border p-4">
        <!-- INFO -->
        <?php if ($tab == 'info'): ?>
            <h5>Thông tin chuyến</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Tour</th>
                    <td><?= $data_departure['tour_name'] ?></td>
                </tr>
                <tr>
                    <th>Phiên bản</th>
                    <td><?= $data_departure['version_name'] ?></td>
                </tr>
                <tr>
                    <th>Ngày đi</th>
                    <td><?= $data_departure['start_date'] ?> → <?= $data_departure['end_date'] ?></td>
                </tr>
                <tr>
                    <th>Số chỗ</th>
                    <td><?= $data_departure['max_guests'] ?></td>
                </tr>
                <tr>
                    <th>Trạng thái</th>
                    <td><?php if ($data_departure['status'] == 'open'): ?>
                            <span class="badge bg-success">Mở bán</span>
                        <?php elseif ($data_departure['status'] == 'full'): ?>
                            <span class="badge bg-danger">Full</span>
                        <?php elseif ($data_departure['status'] == 'closed'): ?>
                            <span class="badge bg-secondary">Đóng</span>
                        <?php else: ?>
                            <span class="badge bg-info">Hoàn thành</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        <?php endif; ?>

        <!-- BOOKINGS -->
        <?php if ($tab == 'bookings'): ?>
            <h5>Danh sách booking</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người đặt</th>
                        <th>Số khách</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_booking as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($value['customer_name']) ?> <br><small><?= $value['customer_contact'] ?></small></td>
                            <td><?= $value['total_guests'] ?></td>
                            <td>
                                <?php if ($value['status'] == 'completed'): ?>
                                    <span class="badge bg-success">Đã thanh toán</span>
                                <?php elseif ($value['status'] == 'deposit'): ?>
                                    <span class="badge bg-danger">Đã hủy</span>
                                <?php elseif ($value['status'] == 'pending'): ?>
                                    <span class="badge bg-secondary">Chờ xác nhận</span>
                                <?php else: ?>
                                    <span class="badge bg-info">Đã cọc</span>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($value['total_amount'] ?? 0, 0, '', '.') ?> VNĐ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- GUESTS -->
        <?php if ($tab == 'guests'): ?>
            <h5>Danh sách khách tham gia chuyến</h5>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Năm sinh</th>
                        <th>SĐT</th>
                        <th>Thuộc booking</th>
                        <th>Yêu cầu đặc biệt</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data_guest as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['full_name'] ?></td>
                            <td><?= $value['gender'] ?></td>
                            <td><?= $value['birth_year'] ?></td>
                            <td><?= $value['phone'] ?></td>
                            <td>
                                <?= $value['customer_name'] ?><br>
                                <small><?= $value['customer_contact'] ?></small>
                            </td>
                            <td>
                                <?= $value['description'] ?: '—' ?><br>
                                <?php if ($value['medical_condition']): ?>
                                    <small class="text-danger"><?= $value['medical_condition'] ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- STAFF -->
        <?php if ($tab == 'staff'): ?>
            <div class="d-flex justify-content-between mb-3">
                <h5>Phân bổ nhân sự</h5>
            </div>

            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['flash_error'];
                                                unset($_SESSION['flash_error']); ?></div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['flash_success'];
                                                    unset($_SESSION['flash_success']); ?></div>
            <?php endif; ?>

            <div class="card p-3 mb-4">
                <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=departureDetail&id=<?= $_GET['id'] ?>">
                    <input type="hidden" name="departure_id" value="<?= $_GET['id'] ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Hướng dẫn viên</label>
                            <select name="guide_id" class="form-select" required>
                                <?php foreach ($data_guide as $value): ?>
                                    <option value="<?= $value['guide_id'] ?>"><?= $value['full_name'] ?> (<?= $value['languages'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Vai trò</label>
                            <input name="role_in_tour" class="form-control" value="Guide">
                        </div>
                        <div class="col-md-5">
                            <label>Ghi chú</label>
                            <input name="notes" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-success mt-3">Thêm HDV</button>
                </form>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Vai trò</th>
                        <th>Ghi chú</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_assignment as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['full_name'] ?></td>
                            <td><?= $value['role_in_tour'] ?></td>
                            <td><?= $value['notes'] ?></td>
                            <td><?= $value['assigned_at'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=deleteStaff&id=<?= $value['assignment_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- SERVICES -->
        <?php if ($tab == 'services'): ?>
            <div class="d-flex justify-content-between mb-3">
                <h5>Phân bổ dịch vụ</h5>
            </div>

            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['flash_error'];
                                                unset($_SESSION['flash_error']); ?></div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['flash_success'];
                                                    unset($_SESSION['flash_success']); ?></div>
            <?php endif; ?>

            <div class="card p-3 mb-4">
                <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=addService">
                    <input type="hidden" name="departure_id" value="<?= $data_departure['departure_id'] ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Dịch vụ</label>
                            <select name="service_id" class="form-select" required>
                                <?php foreach ($data_service as $value): ?>
                                    <option value="<?= $value['service_id'] ?>"><?= $value['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Nhà cung cấp</label>
                            <input name="supplier" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Giá</label>
                            <input name="price" class="form-control" type="number" step="0.01">
                        </div>
                        <div class="col-md-1">
                            <label>Số lượng</label>
                            <input name="quantity" class="form-control" type="number" value="1">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button class="btn btn-success w-100">Gán dịch vụ</button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <textarea name="notes" class="form-control" placeholder="Ghi chú"></textarea>
                    </div>
                </form>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Dịch vụ</th>
                        <th>Nhà cung cấp</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Ghi chú</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_service_assignment as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['service_name'] ?></td>
                            <td><?= $value['supplier'] ?></td>
                            <td><?= number_format($value['price'], 0, '', '.') ?></td>
                            <td><?= $value['quantity'] ?></td>
                            <td><?= $value['notes'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>?mode=admin&action=deleteService&id=<?= $value['sa_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- REVENUE -->
        <?php if ($tab == 'revenue'): ?>
            <h5>Doanh thu chuyến</h5>
            <?php $r = $revenue; ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3 mb-3"><b>Số booking:</b> <?= $r['booking_count'] ?></div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 mb-3"><b>Tổng khách:</b> <?= $r['total_guests'] ?></div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 mb-3"><b>Doanh thu:</b> <?= number_format($r['revenue'] ?? 0, 0, '', '.') ?> VNĐ</div>
                </div>
            </div>

            <!-- Bảng chi tiết booking -->
            <h6>Chi tiết booking</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người đặt</th>
                        <th>Số khách</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_booking as $key => $value): ?>
                        <tr>
                            <td><?= $value['booking_id'] ?></td>
                            <td><?= htmlspecialchars($value['customer_name']) ?></td>
                            <td><?= $value['total_guests'] ?></td>
                            <td><?= number_format($value['total_amount'] ?? 0, 0, '', '.') ?></td>
                            <td><?php if ($value['status'] == 'completed'): ?>
                                    <span class="badge bg-success">Đã thanh toán</span>
                                <?php elseif ($value['status'] == 'deposit'): ?>
                                    <span class="badge bg-danger">Đã hủy</span>
                                <?php elseif ($value['status'] == 'pending'): ?>
                                    <span class="badge bg-secondary">Chờ xác nhận</span>
                                <?php else: ?>
                                    <span class="badge bg-info">Đã cọc</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>
</div>