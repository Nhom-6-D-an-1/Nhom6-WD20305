<?php
$tab = $_GET['tab'] ?? 'info';
?>

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h3 class="fw-bold mb-1">Chi tiết chuyến đi</h3>
            <p class="text-muted mb-0">
                <?= htmlspecialchars($data_departure['tour_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                →
                <?= htmlspecialchars($data_departure['version_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture"
            class="btn btn-outline-secondary">
            Quay lại
        </a>
    </div>

    <!-- CARD CHỨA TABS -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <!-- NAV TABS -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link <?= $tab == 'info' ? 'active' : '' ?>"
                        href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=info">
                        Thông tin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tab == 'bookings' ? 'active' : '' ?>"
                        href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=bookings">
                        Booking
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tab == 'guests' ? 'active' : '' ?>"
                        href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=guests">
                        Khách
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tab == 'staff' ? 'active' : '' ?>"
                        href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=staff">
                        Phân bổ nhân sự
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tab == 'services' ? 'active' : '' ?>"
                        href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=services">
                        Phân bổ dịch vụ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tab == 'revenue' ? 'active' : '' ?>"
                        href="?mode=admin&action=departureDetail&id=<?= $data_departure['departure_id'] ?>&tab=revenue">
                        Doanh thu
                    </a>
                </li>
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content pt-2">

                <!-- INFO TAB -->
                <?php if ($tab == 'info'): ?>
                    <h5 class="fw-semibold text-primary mb-3">Thông tin chuyến</h5>

                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Tour</th>
                                <td><?= htmlspecialchars($data_departure['tour_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                            <tr>
                                <th>Phiên bản</th>
                                <td><?= htmlspecialchars($data_departure['version_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                            <tr>
                                <th>Ngày đi - Ngày về</th>
                                <td><?= $data_departure['start_date'] ?> → <?= $data_departure['end_date'] ?></td>
                            </tr>
                            <tr>
                                <th>Số chỗ</th>
                                <td><?= (int)$data_departure['max_guests'] ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <?php if ($data_departure['status'] == 'open'): ?>
                                        <span class="badge bg-success">Mở bán</span>
                                    <?php elseif ($data_departure['status'] == 'full'): ?>
                                        <span class="badge bg-danger">Full</span>
                                    <?php elseif ($data_departure['status'] == 'closed'): ?>
                                        <span class="badge bg-secondary">Đóng</span>
                                    <?php elseif ($data_departure['status'] == 'completed'): ?>
                                        <span class="badge bg-secondary">Hoàn thành</span>
                                    <?php else : ?>
                                        <span class="badge bg-success">Đang chạy</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

                <!-- BOOKINGS TAB -->
                <?php if ($tab == 'bookings'): ?>
                    <h5 class="fw-semibold text-primary mb-3">Danh sách booking</h5>

                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
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
                                    <td>
                                        <?= htmlspecialchars($value['customer_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        <br>
                                        <small class="text-muted">
                                            <?= htmlspecialchars($value['customer_contact'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </small>
                                    </td>
                                    <td><?= (int)($value['total_guests'] ?? 0) ?></td>
                                    <td>
                                        <?php if ($value['status'] == 'completed'): ?>
                                            <span class="badge bg-success">Đã thanh toán</span>
                                        <?php elseif ($value['status'] == 'deposit'): ?>
                                            <span class="badge bg-info">Đã cọc</span>
                                        <?php elseif ($value['status'] == 'pending'): ?>
                                            <span class="badge bg-secondary">Chờ xác nhận</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Đã hủy</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= number_format($value['total_amount'] ?? 0, 0, '', '.') ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <!-- GUESTS TAB -->
                <?php if ($tab == 'guests'): ?>
                    <h5 class="fw-semibold text-primary mb-3">Danh sách khách tham gia</h5>

                    <table class="table table-hover table-bordered align-middle mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Năm sinh</th>
                                <th>SĐT</th>
                                <th>Thuộc booking</th>
                                <th>Yêu cầu đặc biệt</th>
                                <!-- <th>Hành động</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data_guest as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= htmlspecialchars($value['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($value['gender'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($value['birth_year'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($value['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <?= htmlspecialchars($value['customer_name'] ?? '', ENT_QUOTES, 'UTF-8') ?><br>
                                        <small class="text-muted">
                                            <?= htmlspecialchars($value['customer_contact'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </small>
                                    </td>
                                    <td>
                                        <?= !empty($value['description']) ? htmlspecialchars($value['description'], ENT_QUOTES, 'UTF-8') : '—' ?>
                                        <br>
                                        <?php if (!empty($value['medical_condition'])): ?>
                                            <small class="text-danger">
                                                <?= htmlspecialchars($value['medical_condition'], ENT_QUOTES, 'UTF-8') ?>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <!-- <td><a href="<?= BASE_URL ?>?mode=admin&action=deleteGuest&id=<?= $value['guest_id'] ?>"
                                            onclick="return confirm('Có chắc muốn xóa khách này?')"
                                            class="btn btn-danger btn-sm">
                                            Xóa
                                        </a>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <!-- STAFF TAB -->
                <?php if ($tab == 'staff'): ?>
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-semibold text-primary mb-0">Phân bổ nhân sự</h5>
                    </div>

                    <?php if (!empty($_SESSION['flash_error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['flash_error'];
                            unset($_SESSION['flash_error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['flash_success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['flash_success'];
                            unset($_SESSION['flash_success']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card p-3 mb-4">
                        <form method="POST"
                            action="<?= BASE_URL ?>?mode=admin&action=departureDetail&id=<?= (int)$_GET['id'] ?>&tab=staff">
                            <input type="hidden" name="departure_id" value="<?= (int)$_GET['id'] ?>">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Hướng dẫn viên</label>
                                    <select name="guide_id" class="form-select" required>
                                        <?php foreach ($data_guide as $value): ?>
                                            <option value="<?= $value['guide_id'] ?>">
                                                <?= htmlspecialchars($value['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                                (<?= htmlspecialchars($value['languages'] ?? '', ENT_QUOTES, 'UTF-8') ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Vai trò</label>
                                    <input name="role_in_tour" class="form-control" value="Guide">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">Ghi chú</label>
                                    <input name="notes" class="form-control">
                                </div>
                            </div>

                            <button class="btn btn-success mt-3">
                                Thêm HDV
                            </button>
                        </form>
                    </div>

                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
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
                                    <td><?= htmlspecialchars($value['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($value['role_in_tour'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($value['notes'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= $value['assigned_at'] ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>?mode=admin&action=deleteStaff&id=<?= $value['assignment_id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Xóa nhân sự này khỏi chuyến đi?')">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <!-- SERVICES TAB -->
                <?php if ($tab == 'services'): ?>
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-semibold text-primary mb-0">Phân bổ dịch vụ</h5>
                    </div>

                    <?php if (!empty($_SESSION['flash_error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['flash_error'];
                            unset($_SESSION['flash_error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['flash_success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['flash_success'];
                            unset($_SESSION['flash_success']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card p-3 mb-4">
                        <form method="POST" action="<?= BASE_URL ?>?mode=admin&action=addService">
                            <input type="hidden" name="departure_id" value="<?= $data_departure['departure_id'] ?>">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Dịch vụ</label>
                                    <select name="service_id" class="form-select" required>
                                        <?php foreach ($data_service as $value): ?>
                                            <option value="<?= $value['service_id'] ?>">
                                                <?= htmlspecialchars($value['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Nhà cung cấp</label>
                                    <input name="supplier" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Giá</label>
                                    <input name="price" class="form-control" type="number" step="0.01">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label fw-semibold">SL</label>
                                    <input name="quantity" class="form-control" type="number" value="1">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-success w-100">
                                        Gán dịch vụ
                                    </button>
                                </div>
                            </div>

                            <div class="mt-2">
                                <textarea name="notes" class="form-control" placeholder="Ghi chú"></textarea>
                            </div>
                        </form>
                    </div>

                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
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
                                    <td><?= htmlspecialchars($value['service_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($value['supplier'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= number_format($value['price'] ?? 0, 0, '', '.') ?></td>
                                    <td><?= (int)($value['quantity'] ?? 0) ?></td>
                                    <td><?= htmlspecialchars($value['notes'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>?mode=admin&action=deleteService&id=<?= $value['sa_id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Xóa dịch vụ này?')">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <h5><b><?= $data_departure['status'] == 'completed' ? 'Tổng chi phí dịch vụ:' : 'Tổng chi phí dịch vụ dự kiến:' ?> </b>
                            <?= number_format($total_service_cost, 0, '', '.') ?> đ
                        </h5>
                    </div>

                <?php endif; ?>

                <!-- REVENUE TAB -->
                <?php if ($tab == 'revenue'): ?>
                    <h5 class="fw-semibold text-primary mb-3">Doanh thu chuyến</h5>

                    <?php $r = $revenue; ?>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card p-3 mb-3">
                                <b>Số booking:</b> <?= (int)($r['booking_count'] ?? 0) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 mb-3">
                                <b>Tổng khách:</b> <?= (int)($r['total_guests'] ?? 0) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 mb-3">
                                <b><?= $data_departure['status'] == 'completed' ? 'Doanh thu:' : 'Doanh thu dự kiến:' ?> </b>
                                <?= number_format($r['revenue'] ?? 0, 0, '', '.') ?> VNĐ
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-semibold mb-2">Chi tiết booking</h6>
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
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
                                    <td><?= $key + 1 ?></td>
                                    <td><?= htmlspecialchars($value['customer_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= (int)($value['total_guests'] ?? 0) ?></td>
                                    <td><?= number_format($value['total_amount'] ?? 0, 0, '', '.') ?></td>
                                    <td>
                                        <?php if ($value['status'] == 'completed'): ?>
                                            <span class="badge bg-success">Đã thanh toán</span>
                                        <?php elseif ($value['status'] == 'deposit'): ?>
                                            <span class="badge bg-info">Đã cọc</span>
                                        <?php elseif ($value['status'] == 'pending'): ?>
                                            <span class="badge bg-secondary">Chờ xác nhận</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Đã hủy</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>

            </div><!-- /.tab-content -->

        </div>
    </div>
</div>