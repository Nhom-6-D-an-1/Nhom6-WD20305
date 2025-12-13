<style>
/* ===============================
   PAGE TITLE
=============================== */
.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin: 8px 0 22px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    letter-spacing: -0.3px;
}

/* ===============================
   CARD – APPLE STYLE
=============================== */
.choice-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 28px;
    border: 1px solid #f3f4f6;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    max-width: 720px;
}

/* ===============================
   CHOICE BUTTON
=============================== */
.choice-btn {
    display: block;
    border-radius: 14px;
    padding: 22px;
    text-decoration: none;
    border: 1px solid transparent;
    transition: .2s ease;
}

.choice-btn h5 {
    font-weight: 700;
    margin-bottom: 6px;
}

.choice-btn p {
    margin: 0;
    font-size: 14px;
}

/* FIT */
.choice-fit {
    background: #e8f1ff;
    color: #1e40af;
    border-color: #c7dbff;
}

.choice-fit:hover {
    background: #dbeafe;
}

/* GIT */
.choice-git {
    background: #e7f8ef;
    color: #065f46;
    border-color: #b6efd1;
}

.choice-git:hover {
    background: #d1fae5;
}

/* BACK */
.btn-back {
    border-radius: 10px;
    font-weight: 600;
}
</style>

<div class="container-fluid px-4">

    <!-- TITLE -->
    <div class="page-title">Chọn loại booking</div>

    <?php
    $departure_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    ?>

    <?php if ($departure_id <= 0): ?>

        <div class="alert alert-danger">
            Không tìm thấy lịch trình phù hợp!
            <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture"
               class="btn btn-sm btn-secondary ms-2">
                Quay lại
            </a>
        </div>

    <?php else: ?>

        <div class="choice-card">

            <p class="text-muted mb-4">
                Vui lòng chọn loại hình booking cho lịch trình
                <strong>#<?= $departure_id ?></strong>
            </p>

            <div class="row g-3">

                <!-- FIT -->
                <div class="col-md-6">
                    <a href="<?= BASE_URL ?>?mode=admin&action=createFit&id=<?= $departure_id ?>"
                       class="choice-btn choice-fit">
                        <h5>Khách lẻ (FIT)</h5>
                        <p>Đặt tour cho 1 khách hoặc nhóm nhỏ</p>
                    </a>
                </div>

                <!-- GIT -->
                <div class="col-md-6">
                    <a href="<?= BASE_URL ?>?mode=admin&action=createGit&id=<?= $departure_id ?>"
                       class="choice-btn choice-git">
                        <h5>Khách đoàn (GIT)</h5>
                        <p>Đặt tour cho đoàn nhiều khách</p>
                    </a>
                </div>

            </div>

            <div class="mt-4">
                <a href="<?= BASE_URL ?>?mode=admin&action=viewDeparture"
                   class="btn btn-outline-secondary btn-back">
                    ← Quay lại chọn lịch trình
                </a>
            </div>

        </div>

    <?php endif; ?>

</div>
