<div class="p-4">
          <h3>Quản lý tài khoản</h3>

          <!-- Bộ lọc -->
          <div class="row mb-3">
            <div class="col-md-3">
              <select class="form-select">
                <option selected disabled>Vai trò</option>
                <option>Admin</option>
                <option>HDV</option>
              </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
              <button class="btn btn-primary">Tìm kiếm</button>
              <button class="btn btn-success">Thêm tài khoản</button>
            </div>
          </div>

          <!-- Bảng tài khoản -->
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Nguyễn Văn An</td>
                <td>an@gmail.com</td>
                <td>Admin</td>
                <td><span class="badge bg-success">Hoạt động</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-warning">Khóa</button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Trần Thị HDV</td>
                <td>hdv2@tour.com</td>
                <td>HDV</td>
                <td><span class="badge bg-success">Hoạt động</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-warning">Khóa</button>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Lê Văn Test</td>
                <td>test@tour.com</td>
                <td>HDV</td>
                <td><span class="badge bg-secondary">Đã khoá</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-success">Mở khoá</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>