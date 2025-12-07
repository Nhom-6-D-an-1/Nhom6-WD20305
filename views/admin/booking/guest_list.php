<div class="container mt-4">

    <h3>Danh sách khách đoàn</h3>

    <form method="POST" class="card p-3 mb-4">
        
        <h5>Thêm khách</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Họ tên</label>
                <input name="full_name" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Giới tính</label>
                <select name="gender" class="form-select">
                    <option>Nam</option>
                    <option>Nữ</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Năm sinh</label>
                <input type="date" name="birth_year" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>SĐT</label>
            <input name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Yêu cầu đặc biệt</label>
            <textarea name="special_request" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Tình trạng y tế</label>
            <input name="medical_condition" class="form-control">
        </div>

        <button class="btn btn-primary">Thêm khách</button>
    </form>

    <h5>Khách đã nhập</h5>
    <table class="table table-bordered">
        <tr>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Năm sinh</th>
            <th>SĐT</th>
        </tr>

        <?php foreach ($guest_list as $g): ?>
        <tr>
            <td><?= $g['full_name'] ?></td>
            <td><?= $g['gender'] ?></td>
            <td><?= $g['birth_year'] ?></td>
            <td><?= $g['phone'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>