<h2 class="mb-4 fw-bold">Dashboard tổng hợp</h2>

<!-- THỐNG KÊ TỔNG QUAN -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6 class="text-muted">Tổng doanh thu</h6>
            <h4 class="fw-bold text-success"><?= number_format($revenue) ?> đ</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6 class="text-muted">Tổng chi phí</h6>
            <h4 class="fw-bold text-danger"><?= number_format($expense) ?> đ</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6 class="text-muted">Lợi nhuận</h6>
            <?php 
                $profitColor = $profit >= 0 ? "text-primary" : "text-danger fw-bold";
            ?>
            <h4 class="fw-bold <?= $profitColor ?>"><?= number_format($profit) ?> đ</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6 class="text-muted">Số tour tổ chức</h6>
            <h4 class="fw-bold"><?= $tours ?></h4>
        </div>
    </div>
</div>


<!-- LỢI NHUẬN THEO TOUR -->
<h4 class="fw-bold mb-3">Lợi nhuận theo tour</h4>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width: 30%">Tour</th>
            <th style="width: 20%; text-align:right;">Doanh thu</th>
            <th style="width: 20%; text-align:right;">Chi phí</th>
            <th style="width: 20%; text-align:right;">Lợi nhuận</th>
        </tr>
    </thead>
    <tbody>

        <?php if (empty($tourProfit)): ?>
            <tr>
                <td colspan="4" class="text-center text-muted py-3">
                    Không có dữ liệu trong khoảng thời gian đã chọn.
                </td>
            </tr>
        <?php else: ?>

            <?php foreach ($tourProfit as $row): 
                $profitColor = $row["profit"] >= 0 ? "text-success" : "text-danger fw-bold";
            ?>
            <tr>
                <td><?= $row["tour_name"] ?></td>

                <td style="text-align:right;">
                    <?= number_format($row["revenue"]) ?> đ
                </td>

                <td style="text-align:right;">
                    <?= number_format($row["cost"]) ?> đ
                </td>

                <td style="text-align:right;" class="<?= $profitColor ?>">
                    <?= number_format($row["profit"]) ?> đ
                </td>
            </tr>
            <?php endforeach; ?>

        <?php endif; ?>

    </tbody>
</table>
