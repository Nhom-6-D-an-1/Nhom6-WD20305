<?php

?>
<div class="p-4">
          <h3>Danh mục tour</h3>

          <!-- Bộ lọc -->
          <div class="row mb-3">
            <div class="col-md-3">
              <select class="form-select">
                <option selected>Trạng thái</option>
                <option>Đang hoạt động</option>
                <option>Tạm ẩn</option>
              </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
              <button class="btn btn-primary">Tìm kiếm</button>
              <button class="btn btn-success">Thêm loại</button>
            </div>
          </div>

          <!-- Bảng danh mục -->
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>STT</th>
                <th>Tên loại tour</th>
                <th>Mô tả ngắn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Trong nước</td>
                <td>Tour trong lãnh thổ Việt Nam</td>
                <td><span class="badge bg-success">Đang hoạt động</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xoá</button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Quốc tế</td>
                <td>Tour ra nước ngoài</td>
                <td><span class="badge bg-success">Đang hoạt động</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xoá</button>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Theo yêu cầu</td>
                <td>Tour thiết kế riêng</td>
                <td><span class="badge bg-secondary">Tạm ẩn</span></td>
                <td class="table-actions">
                  <button class="btn btn-sm btn-info">Xem</button>
                  <button class="btn btn-sm btn-primary">Sửa</button>
                  <button class="btn btn-sm btn-danger">Xoá</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>