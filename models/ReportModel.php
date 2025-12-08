<?php

class ReportModel extends BaseModel
{

    /* ===============================
        1) TỔNG DOANH THU
       =============================== */
    public function totalRevenue()
    {
        $sql = "SELECT SUM(b.total_guests * d.actual_price) AS revenue
        FROM booking b
        JOIN departure d ON d.departure_id = b.departure_id
        WHERE b.status != 'completed'";
        return $this->queryOne($sql)['revenue'] ?? 0;
    }


    /* ===============================
        2) TỔNG CHI PHÍ
       =============================== */
    public function totalExpense()
    {
        $sql = "
        SELECT SUM(sa.price * sa.quantity) AS expense
        FROM service_assignment sa
    ";
        $stmt = $this->queryOne($sql);
        return $stmt['expense'] ?? 0;
    }


    /* ===============================
        3) SỐ TOUR TỔ CHỨC
       =============================== */
    public function totalTours()
    {
        $sql = "SELECT COUNT(*) AS total FROM departure";
        return $this->queryOne($sql)['total'] ?? 0;
    }


    /* ===============================
        4) TỔNG KHÁCH THAM GIA
       =============================== */
    public function totalGuests()
    {
        $sql = "SELECT SUM(total_guests) AS guests
                FROM booking
                WHERE status != 'cancelled'";
        return $this->queryOne($sql)['guests'] ?? 0;
    }


    /* ===============================
        5) RATE BOOKING
       =============================== */
    public function bookingRate($start, $end)
    {

        $success = $this->queryOne("
            SELECT COUNT(*) AS success
            FROM booking
            WHERE created_at BETWEEN ? AND ?
            AND status != 'cancelled'
        ", [$start, $end])['success'];

        $total = $this->queryOne("
            SELECT COUNT(*) AS total
            FROM booking
            WHERE created_at BETWEEN ? AND ?
        ", [$start, $end])['total'];

        return ($total == 0) ? 0 : round(($success / $total) * 100);
    }

    /* ===============================
        6) BOOKING STATUS SUMMARY
       =============================== */
    public function bookingStatus($start, $end)
    {
        $sql = "
            SELECT status, COUNT(*) AS total
            FROM booking
            WHERE created_at BETWEEN ? AND ?
            GROUP BY status
        ";

        return $this->queryAll($sql, [$start, $end]);
    }

    /* ===============================
        7) LỢI NHUẬN THEO TOUR — CHUẨN NHẤT
       =============================== */
    public function profitByTour()
    {
        $sql = "SELECT 
            t.tour_id,
            t.tour_name,

            COALESCE((
                SELECT SUM(b.total_guests * d.actual_price)
                FROM departure d
                LEFT JOIN booking b ON b.departure_id = d.departure_id
                WHERE d.version_id IN (
                    SELECT version_id FROM tour_version WHERE tour_id = t.tour_id
                )
                AND b.status = 'completed'
            ), 0) AS revenue,

            COALESCE((
                SELECT SUM(f.amount)
                FROM tour_finance f
                JOIN departure d2 ON d2.departure_id = f.departure_id
                WHERE d2.version_id IN (
                    SELECT version_id FROM tour_version WHERE tour_id = t.tour_id
                )
            ), 0) AS cost
        FROM tour t";

        $data = $this->queryAll($sql);

        foreach ($data as &$row) {
            $row['profit'] = $row['revenue'] - $row['cost'];
        }

        return $data;
    }





    public function guidePerformance($start, $end)
    {
        $sql = "
            SELECT 
                u.full_name,
                COUNT(a.assignment_id) AS tours_led,
                AVG(g.rating) AS avg_rating
            FROM users u
            LEFT JOIN assigned_staff a ON a.user_id = u.user_id
            LEFT JOIN tour_guide g ON g.user_id = u.user_id
            LEFT JOIN departure d ON d.departure_id = a.departure_id
            WHERE d.start_date BETWEEN ? AND ?
            AND u.role = 'guide'
            GROUP BY u.user_id
        ";
        return $this->queryAll($sql, [$start, $end]);
    }

    public function summaryByTour()
    {
        $sql = "
        SELECT 
            t.tour_id,
            t.tour_name,

            -- Doanh thu theo tour (chỉ tính booking đã thanh toán)
            COALESCE((
                SELECT SUM(b.total_amount)
                FROM booking b
                JOIN departure d2 ON d2.departure_id = b.departure_id
                JOIN tour_version v2 ON v2.version_id = d2.version_id
                WHERE v2.tour_id = t.tour_id 
                AND b.status = 'completed'
            ), 0) AS revenue,

            -- Chi phí theo tour (từ bảng phân bổ dịch vụ)
            COALESCE((
                SELECT SUM(sa.price * sa.quantity)
                FROM service_assignment sa
                JOIN departure d3 ON d3.departure_id = sa.departure_id
                JOIN tour_version v3 ON v3.version_id = d3.version_id
                WHERE v3.tour_id = t.tour_id
            ), 0) AS cost
        FROM tour t
    ";

        $data = $this->queryAll($sql);

        foreach ($data as &$row) {
            $row['profit'] = $row['revenue'] - $row['cost'];
        }

        return $data;
    }
}
