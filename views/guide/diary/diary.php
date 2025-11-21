<div class="col-12">
    <h2>Nhật ký tour</h2>

    <!-- Form thêm nhật ký -->
    <div class="card shadow-sm border-0 mb-4 diary-card">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center diary-form-row">
                <div class="col-12 col-lg-6">
                    <input type="text" class="form-control form-control-lg diary-input" placeholder="Diễn biến, nhật ký, phản hồi khách...">
                </div>
                <div class="col-12 col-lg-4">
                    <input type="file" class="form-control form-control-lg diary-file">
                </div>
                <div class="col-12 col-lg-2">
                    <button class="btn btn-primary diary-btn w-100 fw-semibold">Thêm nhật ký</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách các mục nhật ký -->
    <div class="card shadow-sm border-0 diary-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 diary-table">
                    <thead class="bg-light text-secondary small text-uppercase fw-semibold">
                        <tr>
                            <th class="ps-4 py-3 diary-time-col">Thời gian</th>
                            <th class="py-3">Nội dung</th>
                            <th class="py-3 text-center diary-img-col">Hình ảnh</th>
                            <th class="py-3 text-center diary-action-col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">

                        <!-- Mục nhật ký 1 -->
                        <tr class="diary-row">
                            <td class="ps-4 py-4 text-muted small diary-time">
                                <div>18:00</div>
                                <div class="text-secondary">22/10/2025</div>
                            </td>
                            <td class="py-4 diary-content">
                                <div class="fw-semibold">Khách nôn ra xe</div>
                            </td>
                            <td class="text-center py-4 diary-img">
                                <img src="<?= BASE_URL ?>assets/images/diary-vomit.jpg" alt="Hình ảnh" class="diary-img-thumb rounded">
                            </td>
                            <td class="text-center py-4 diary-action">
                                <button class="btn btn-danger">Xoá</button>
                            </td>
                        </tr>

                        <!-- Mục nhật ký 2 -->
                        <tr class="diary-row">
                            <td class="ps-4 py-4 text-muted small diary-time">
                                <div>09:15</div>
                                <div class="text-secondary">23/10/2025</div>
                            </td>
                            <td class="py-4 diary-content">
                                <div class="fw-semibold">Khởi hành đúng giờ</div>
                            </td>
                            <td class="text-center py-4 diary-img">
                                <img src="<?= BASE_URL ?>assets/images/diary-vomit.jpg" alt="Hình ảnh" class="diary-img-thumb rounded">
                            </td>
                            <td class="text-center py-4 diary-action">
                                <button class="btn btn-danger">Xoá</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
