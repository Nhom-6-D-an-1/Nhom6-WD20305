<?php

?>

<div class="col-12">
    <h2 class="">Tour của tôi</h2>

    <!-- Form tìm kiếm -->
     <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-center">
                <div class="col-lg-4 col-md-6">
                    <input type="text" class="form-control" placeholder="Nhập từ khoá (mã tour, tên tour...)">
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
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
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
                            <th class="text-center">Số khách</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
</div>