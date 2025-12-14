<style>
    :root {

        /* Màu chính: Tím Indigo hiện đại */
        --primary: #4F46E5;
        --primary-dark: #3730a3;
        --primary-light: #EEF2FF;
        /* Màu nền nhạt của màu chính */

        /* Màu trạng thái */
        --success: #10B981;
        /* Xanh lá tươi */
        --success-bg: #D1FAE5;

        --warning: #F59E0B;
        /* Vàng cam */
        --warning-bg: #FEF3C7;

        --danger: #EF4444;
        /* Đỏ hồng */
        --danger-bg: #FEE2E2;

        /* Màu nền & Chữ */
        --bg-body: #F3F4F6;
        /* Xám rất nhạt, dịu mắt */
        --bg-card: #FFFFFF;
        --text-main: #1F2937;
        /* Đen xám (không đen tuyền) */
        --text-sub: #6B7280;
        /* Xám trung tính */
        --border: #E5E7EB;
    }

    body {
        /* font-family: 'Inter', sans-serif; */
        background-color: var(--bg-body);
        color: var(--text-main);
        font-size: 14px;
    }

    /* --- 1. Top Bar --- */
    .top-bar {
        background: var(--bg-card);
        padding: 16px 30px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-main);
        letter-spacing: -0.025em;
    }

    /* --- 2. Filter Select (Nút chọn năm) --- */
    .custom-select-wrapper {
        position: relative;
    }

    .custom-select {
        appearance: none;
        background-color: var(--bg-card);
        border: 1px solid var(--border);
        padding: 10px 36px 10px 16px;
        border-radius: 8px;
        font-weight: 500;
        color: var(--text-main);
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .custom-select:hover {
        border-color: var(--primary);
    }

    .custom-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    /* --- 3. Stat Cards (Thẻ thống kê) --- */
    .stat-card {
        background: var(--bg-card);
        border-radius: 16px;
        /* Bo góc tròn hơn */
        padding: 24px;
        border: 1px solid var(--border);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: var(--primary-light);
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
    }

    /* Phối màu icon theo biến */
    .icon-primary {
        background: var(--primary-light);
        color: var(--primary);
    }

    .icon-success {
        background: var(--success-bg);
        color: var(--success);
    }

    .icon-warning {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .icon-danger {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-sub);
        font-weight: 500;
    }

    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text-main);
        margin-top: 4px;
        letter-spacing: -0.025em;
    }

    /* --- 4. Charts & Table Container --- */
    .content-card {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border);
        padding: 24px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        height: 100%;
    }

    .card-header-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* --- 5. Table Styling --- */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: var(--bg-body);
        color: var(--text-sub);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 12px 24px;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .modern-table thead th:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        border-left: 1px solid var(--border);
    }

    .modern-table thead th:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        border-right: 1px solid var(--border);
    }

    .modern-table tbody td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        color: var(--text-main);
    }

    .modern-table tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge {
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-pos {
        background: var(--success-bg);
        color: var(--success);
    }

    .badge-neg {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .content-card {
        padding-left: 32px;
    }
</style>




<div class="top-bar">
    <h1 class="page-title">Dashboard Tổng Quan</h1>

    <div class="d-flex align-items-center gap-3">
        <form method="GET" class="custom-select-wrapper">
            <input type="hidden" name="mode" value="admin">
            <input type="hidden" name="action" value="dashboard">
            <i class='bx bx-calendar' style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--text-sub);"></i>
            <select name="year" class="custom-select" onchange="this.form.submit()">
                <?php for ($y = date('Y') - 5; $y <= date('Y'); $y++): ?>
                    <option value="<?= $y ?>" <?= $y == $year ? "selected" : "" ?>>
                        Năm <?= $y ?>
                    </option>
                <?php endfor ?>
            </select>
        </form>


    </div>
</div>

<div class="container-fluid px-4 pb-5">

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Tổng doanh thu</div>
                        <div class="stat-value"><?= number_format($revenue) ?></div>
                        <!-- <div class="text-success small fw-medium mt-1"><i class='bx bx-trending-up'></i> +12.5%</div> -->
                    </div>
                    <div class="icon-box icon-primary"><i class='bx bx-wallet'></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Tổng chi phí</div>
                        <div class="stat-value"><?= number_format($expense) ?></div>
                        <!-- <div class="text-danger small fw-medium mt-1"><i class='bx bx-trending-down'></i> -2.4%</div> -->
                    </div>
                    <div class="icon-box icon-danger"><i class='bx bx-cart'></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Lợi nhuận ròng</div>
                        <div class="stat-value" style="color: var(--success);"><?= number_format($profit) ?></div>
                        <div class="text-secondary small fw-medium mt-1">Biên LN: <?= $revenue > 0 ? round(($profit / $revenue) * 100, 1) : 0 ?>%</div>
                    </div>
                    <div class="icon-box icon-success"><i class='bx bx-line-chart'></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Tổng số Tour</div>
                        <div class="stat-value"><?= $tours ?></div>
                        <div class="text-secondary small fw-medium mt-1">Đã hoàn thành</div>
                    </div>
                    <div class="icon-box icon-warning"><i class='bx bx-map-pin'></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="card-header-title">
                    <i class='bx bx-bar-chart-square text-primary'></i>
                    Biểu đồ doanh thu năm <?= $year ?>
                </div>
                <div style="height: 320px;">
                    <canvas id="chartMonth"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="content-card">
                <div class="card-header-title">
                    <i class='bx bx-pie-chart-alt-2 text-primary'></i>
                    Tỷ trọng theo quý
                </div>
                <div style="height: 320px; position: relative;">
                    <canvas id="chartQuarter"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="content-card">
                <div class="card-header-title">
                    <i class='bx bx-history text-primary'></i>
                    Lịch sử tăng trưởng
                </div>
                <div style="height: 250px;">
                    <canvas id="chartYear"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card p-0 overflow-hidden">
        <div class="p-4 border-bottom">
            <h5 class="m-0 fw-bold text-dark">Lợi nhuận theo tour</h5>
        </div>
        <div class="table-responsive">
            <table class="modern-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Tên Tour</th>
                        <th class="text-end">Doanh thu</th>
                        <th class="text-end">Chi phí</th>
                        <th class="text-center pe-4">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tourProfit as $t):
                        $currProfit = $t["revenue"] - $t["cost"] - $t["ex_cost"];
                        $isProfit = $currProfit >= 0;
                    ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold" style="color: var(--text-main);"><?= $t["departure_name"] ?> (<?= $t["tour_name"] ?>
                                    - <?= $t["version_name"] ?>)<br>
                                    <small><?= $t["start_date"] ?> → <?= $t["end_date"] ?></small>
                                </div>
                            </td>
                            <td class="text-end" style="font-family: monospace; font-size: 0.95rem;">
                                <?= number_format($t["revenue"]) ?>
                            </td>
                            <td class="text-end text-danger" style="font-family: monospace; font-size: 0.95rem; opacity: 0.8;">
                                - <?= number_format($t["cost"] + $t["ex_cost"]) ?>
                            </td>
                            <td class="text-center pe-4">
                                <span class="badge <?= $isProfit ? 'badge-pos' : 'badge-neg' ?>">
                                    <?= $isProfit ? '<i class="bx bx-up-arrow-alt"></i>' : '<i class="bx bx-down-arrow-alt"></i>' ?>
                                    <?= number_format(abs($currProfit)) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- Chart Config: Indigo Theme ---
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#6B7280';

    const themeColor = '#4F46E5'; // Indigo 600
    const themeBg = 'rgba(79, 70, 229, 0.1)';

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                border: {
                    display: false
                },
                grid: {
                    color: '#F3F4F6'
                }
            }
        }
    };

    // 1. Chart Month (Line with Fill)
    const ctxMonth = document.getElementById('chartMonth').getContext('2d');
    const grad = ctxMonth.createLinearGradient(0, 0, 0, 300);
    grad.addColorStop(0, 'rgba(79, 70, 229, 0.25)');
    grad.addColorStop(1, 'rgba(79, 70, 229, 0)');

    new Chart(ctxMonth, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($byMonth, 'month')) ?>,
            datasets: [{
                label: 'Doanh thu',
                data: <?= json_encode(array_column($byMonth, 'revenue')) ?>,
                borderColor: themeColor,
                backgroundColor: grad,
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: themeColor,
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: commonOptions
    });

    // 2. Chart Quarter (Doughnut)
    new Chart(document.getElementById('chartQuarter'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($byQuarter, 'quarter')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($byQuarter, 'revenue')) ?>,
                backgroundColor: [
                    '#4F46E5', // Indigo
                    '#818CF8', // Light Indigo
                    '#C7D2FE', // Very Light
                    '#312E81' // Dark Indigo
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                }
            }
        }
    });

    // 3. Chart Year (Bar)
    new Chart(document.getElementById('chartYear'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($byYear, 'year')) ?>,
            datasets: [{
                label: 'Doanh thu',
                data: <?= json_encode(array_column($byYear, 'revenue')) ?>,
                backgroundColor: themeColor,
                borderRadius: 4,
                barThickness: 30
            }]
        },
        options: commonOptions
    });
</script>