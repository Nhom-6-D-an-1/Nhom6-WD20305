<style>
  /* ===========================================================
   MAIN CARD WRAPPER
=========================================================== */
  .table-card,
  .card {
    background: #ffffff;
    border-radius: 14px;
    padding: 22px;
    border: 1px solid #f3f4f6;
    /* Apple thin border */
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    /* Soft Apple shadow */
  }

  /* ===========================================================
   ADD BUTTON (Gold Pastel)
=========================================================== */
  .btn-success {
    background: #fff8da !important;
    border: 1px solid #d6c278 !important;
    padding: 10px 18px !important;
    border-radius: 10px !important;
    color: #7c5e10 !important;
    font-weight: 600 !important;
  }

  .btn-success:hover {
    background: #ffefb5 !important;
  }

  /* ===========================================================
   TABLE HEADER
=========================================================== */
  .table thead th {
    background-color: transparent !important;
    color: #6b7280 !important;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12.5px;
    border-bottom: 1px solid #e5e7eb !important;
    text-align: center !important;
    padding: 14px 10px !important;
    letter-spacing: .5px;
  }

  /* ===========================================================
   TABLE BODY
=========================================================== */
  .table tbody tr {
    border-bottom: 1px solid #efefef;
    transition: 0.15s ease;
  }

  .table tbody tr:hover {
    background: #fafafa;
  }

  .table tbody td {
    padding: 16px 12px !important;
    font-size: 15px;
    vertical-align: middle !important;
  }

  /* ===== Body Alignment ===== */

  /* Căn giữa các cột số liệu */
  .table tbody td:nth-child(1),
  .table tbody td:nth-child(4),
  .table tbody td:nth-child(5),
  .table tbody td:nth-child(6),
  .table tbody td:nth-child(7),
  .table tbody td:nth-child(8),
  .table tbody td:nth-child(9) {
    text-align: center !important;
  }

  /* Căn trái chữ: Tên, Username, Tour Name, Pickup, HDV */
  .table tbody td:nth-child(2),
  .table tbody td:nth-child(3) {
    text-align: left !important;
    padding-left: 100px !important;
  }

  .table tbody td:nth-child(2) {
    padding-left: 200px !important;
  }

  .badge {
    padding: 7px 16px !important;
    border-radius: 12px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    display: inline-block;
  }

  .bg-success {
    background: #d1fae5 !important;
    color: #047857 !important;
  }

  .bg-secondary {
    background: #fee2e2 !important;
    color: #b91c1c !important;
  }

  .btn-sm {
    padding: 7px 14px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    border: none !important;
  }

  /* Chi tiết – Xanh pastel */
  .btn-info {
    background: #dbeafe !important;
    color: #1e40af !important;
  }

  .btn-info:hover {
    background: #bfdbfe !important;
  }

  /* Sửa – Vàng pastel */
  .btn-warning {
    background: #fef3c7 !important;
    color: #92400e !important;
  }

  .btn-warning:hover {
    background: #fde68a !important;
  }

  /* Xóa – Đỏ pastel */
  .btn-danger {
    background: #fee2e2 !important;
    color: #b91c1c !important;
  }

  .btn-danger:hover {
    background: #fecaca !important;
  }

  /* ===========================================================
   FORM INPUTS (Select, Input date)
=========================================================== */
  .form-select,
  .form-control {
    border-radius: 10px !important;
    padding: 10px 14px !important;
    border: 1px solid #dcdcdc !important;
    font-size: 14px;
  }

  .form-select:focus,
  .form-control:focus {
    border-color: #c7c7c7 !important;
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05) !important;
  }

  /* ===========================================================
   FILTER BUTTON (Search)
=========================================================== */
  .btn-primary {
    background: #dbeafe !important;
    color: #1e40af !important;
    border: none !important;
    border-radius: 10px !important;
    padding: 10px 16px !important;
  }

  .btn-primary:hover {
    background: #bfdbfe !important;
  }

  /* ===========================================================
   RESPONSIVE FIX
=========================================================== */
  @media (max-width: 768px) {
    .table-card {
      padding: 12px;
    }

    .btn-sm {
      padding: 6px 10px !important;
      font-size: 13px !important;
    }
  }
</style>
<div class="p-4">
  <h3 class="fw-bold">Quản lý tài khoản</h3>

  <!-- Thanh hành động -->
  <div class="row mb-3">
    <div class="col-md-3">
      <a href="<?= BASE_URL ?>?mode=admin&action=addaccount" class="btn btn-success">
        + Thêm tài khoản
      </a>
    </div>
  </div>
  <div class="table-card">
    <!-- Bảng tài khoản -->
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Tên</th>
          <th>Tên đăng nhập</th>
          <th>Vai trò</th>
          <th>Hành động</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($accounts)): ?>
          <?php foreach ($accounts as $key => $account): ?>
            <tr>
              <td><?= $key + 1 ?></td>

              <td><?= htmlspecialchars($account['full_name']) ?></td>

              <td><?= htmlspecialchars($account['username']) ?></td>

              <td><?= htmlspecialchars($account['role']) ?></td>

              <td>
                <a href="<?= BASE_URL ?>?mode=admin&action=editaccount&id=<?= $account['user_id'] ?>"
                  class="btn btn-sm btn-info">Sửa</a>

                <a href="<?= BASE_URL ?>?mode=admin&action=deleteaccount&id=<?= $account['user_id'] ?>"
                  onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');"
                  class="btn btn-sm btn-danger">
                  Xóa
                </a>
              </td>

            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center text-muted py-3">Không có tài khoản nào.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>