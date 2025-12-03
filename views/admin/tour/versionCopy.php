<div class="container mt-4">

    <h3>Sao Chép Phiên Bản Tour</h3>
    <p class="text-muted">Phiên bản gốc: <?= $version['name'] ?></p>

    <form action="" method="POST">

        <div class="alert alert-info">
            Khi sao chép:
            <ul>
                <li>Thông tin phiên bản sẽ được copy</li>
                <li>Lịch trình sẽ được copy</li>
                <li>Hình ảnh sẽ được copy</li>
                <li>Phiên bản cũ được giữ nguyên</li>
            </ul>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tên phiên bản mới</label>
            <input type="text" required class="form-control"
                name="new_version_name"
                value="<?= $version['name'] ?> - Copy">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Mã phiên bản mới</label>
            <input type="text" required class="form-control"
                name="new_version_code"
                value="<?= $version['code'] ?>_COPY">
        </div>
        <a href="<?= BASE_URL ?>?mode=admin&action=tourDetail&tab=versions" class="btn btn-secondary">Hủy</a>
        <button class="btn btn-primary">Xác nhận sao chép</button>

    </form>

</div>