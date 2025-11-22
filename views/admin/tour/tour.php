<?php
?>
      <div class="col-md-10 p-4">
        <h3>Quản lý tour</h3>

        <!-- Bộ lọc -->
        <div class="row mb-3">
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm tour...">
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Loại tour</option>
              <option>Trong nước</option>
              <option>Quốc tế</option>
              <option>Theo yêu cầu</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Địa điểm</option>
              <option>Hà Nội</option>
              <option>TP.HCM</option>
              <option>Đà Nẵng</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Trạng thái</option>
              <option>Hoạt động</option>
              <option>Tạm dừng</option>
            </select>
          </div>
        </div>

        <!-- Bảng dữ liệu -->
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>Tên tour</th>
              <th>Loại tour</th>
              <th>Địa điểm</th>
              <th>Ngày khởi hành</th>
              <th>Trạng thái</th>
              <th>Giá tour</th>
              <th>HDV phân công</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Tour Hà Nội - Sapa 3N2Đ</td>
              <td>Trong nước</td>
              <td>Hà Nội - Sapa</td>
              <td>20/11/2025 08:00</td>
              <td><span class="badge bg-secondary">Tạm dừng</span></td>
              <td>5,000,000đ</td>
              <td>Nguyễn Văn A</td>
              <td class="table-actions">
                <button class="btn btn-sm btn-primary">Sửa</button>
                <button class="btn btn-sm btn-danger">Xóa</button>
                <button class="btn btn-sm btn-info">Xem</button>
              </td>
            </tr>
            <!-- Thêm các dòng khác tương tự -->
          </tbody>
        </table>
      </div>

      