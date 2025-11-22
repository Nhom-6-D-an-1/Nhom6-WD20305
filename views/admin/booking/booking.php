 <?php ?>
 <div class="p-4">
          <h3>Quản lý booking</h3>

          <!-- Bộ lọc -->
          <div class="row mb-3">
            <div class="col-md-3">
              <select class="form-select">
                <option selected disabled>Trạng thái</option>
                <option>Chờ xác nhận</option>
                <option>Đã cọc</option>
                <option>Hoàn tất</option>
                <option>Hủy</option>
              </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
              <button class="btn btn-primary">Tìm kiếm</button>
              <button class="btn btn-success">Thêm booking</button>
            </div>
          </div>

          <!-- Bảng booking -->
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>Mã booking</th>
                <th>Khách hàng</th>
                <th>Tour</th>
                <th>Ngày đặt</th>
                <th>Số khách</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>BK001</td>
                <td>Nguyễn Văn A</td>
                <td>Tour Sapa 3N2Đ</td>
                <td>15/11/2025</td>
                <td>2</td>
                <td><span class="badge bg-warning text-dark">Chờ xác nhận</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
              <tr>
                <td>BK002</td>
                <td>Công ty ABC</td>
                <td>Tour Bangkok 4N3Đ</td>
                <td>16/11/2025</td>
                <td>15</td>
                <td><span class="badge bg-info text-dark">Đã cọc</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
              <tr>
                <td>BK003</td>
                <td>Trần Thị B</td>
                <td>Tour Đà Nẵng 2N1Đ</td>
                <td>14/11/2025</td>
                <td>1</td>
                <td><span class="badge bg-success">Hoàn tất</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
              <tr>
                <td>BK004</td>
                <td>Đoàn gia đình C</td>
                <td>Tour Phú Quốc 3N2Đ</td>
                <td>17/11/2025</td>
                <td>4</td>
                <td><span class="badge bg-secondary">Hủy</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

    