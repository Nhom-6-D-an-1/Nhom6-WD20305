<style>
  /* ================================
   GLOBAL – MATCH "Danh mục tour"
  ================================ */
  :root {
    --primary: #3b82f6;
    --primary-soft: #e8f0ff;
    --green-soft: #e6f9ee;
    --green-text: #0e8f53;
    --yellow-soft: #fff4d8;
    --yellow-text: #b97500;
    --red-soft: #ffe5e5;
    --red-text: #d02f2f;
    --gray-light: #6b7280;
    --dark: #1f2937;
    --radius: 14px;
    --shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
  }

  /* Page Title */
  .page-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 24px;
  }

  /* Wrapper Card */
  .table-wrapper {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border: 1px solid #eef0f3;
    overflow: hidden;
  }

  /* Add button */
  .btn-add {
    background: var(--primary-soft);
    color: var(--primary);
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 600;
    border: none;
  }

  .btn-add:hover {
    background: #dce7ff;
  }

  /* Table Head */
  .table thead th {
    background: #f9fafb !important;
    color: var(--gray-light);
    font-size: 12.8px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 14px 10px;
    text-align: center;
    border-bottom: 1px solid #eceef2;
  }

  /* Table Rows */
  .table tbody tr {
    border-bottom: 1px solid #f0f1f5;
    transition: 0.15s;
  }

  .table tbody tr:hover {
    background: #f8faff;
  }

  .table tbody td {
    padding: 14px 12px;
    font-size: 15px;
    color: var(--dark);
    text-align: center;
  }

  /* Buttons small */
  .btn-sm {
    padding: 7px 16px;
    border-radius: 10px;
    font-size: 14px !important;
    font-weight: 600;
    border: none;
    transition: .2s;
  }

  /* Chi tiết */
  .btn-info {
    background: #e5efff;
    color: var(--primary);
  }

  .btn-info:hover {
    background: #d6e6ff;
  }

  /* Sửa */
  .btn-warning {
    background: var(--yellow-soft);
    color: var(--yellow-text);
  }

  .btn-warning:hover {
    background: #ffe8b5;
  }

  /* Xóa */
  .btn-danger {
    background: var(--red-soft);
    color: var(--red-text);
  }

  .btn-danger:hover {
    background: #ffd4d4;
  }
</style>
<div class="container-fluid px-4">

  <h3 class="page-title mt-4">Quản lý tài khoản</h3>

  <div class="d-flex justify-content-between mb-3">
    <a href="?mode=admin&action=addaccount" class="btn-add">
      + Thêm tài khoản
    </a>
  </div>

  <div class="table-wrapper">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>STT</th>
          <th>Họ tên</th>
          <th>Tên đăng nhập</th>
          <th>Vai trò</th>
          <th>Hành động</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($accounts as $i => $acc): ?>
          <tr>
            <td><?= $i + 1 ?></td>

            <td class="fw-semibold"><?= htmlspecialchars($acc['full_name']) ?></td>

            <td><?= htmlspecialchars($acc['username']) ?></td>

            <td><?= htmlspecialchars($acc['role']) ?></td>

            <td>
              <a href="?mode=admin&action=editaccount&id=<?= $acc['user_id'] ?>"
                class="btn btn-info btn-sm">Chi tiết</a>

              <a href="?mode=admin&action=editaccount&id=<?= $acc['user_id'] ?>"
                class="btn btn-warning btn-sm">Sửa</a>

              <a href="?mode=admin&action=deleteaccount&id=<?= $acc['user_id'] ?>"
                onclick="return confirm('Xóa tài khoản này?')"
                class="btn btn-danger btn-sm">Xóa</a>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>