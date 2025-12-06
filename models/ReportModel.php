<?php

class ReportModel extends BaseModel {

    /* ===============================
        1) TỔNG DOANH THU
       =============================== */
    public function totalRevenue() {
        $sql = "SELECT SUM(total_amount) AS revenue
                FROM booking 
                WHERE status != 'cancelled'";
        return $this->queryOne($sql)['revenue'] ?? 0;
    }


    /* ===============================
        2) TỔNG CHI PHÍ
       =============================== */
    public function totalExpense() {
        $sql = "SELECT SUM(amount) AS expense
                FROM tour_finance 
                WHERE type = 'expense'";
        return $this->queryOne($sql)['expense'] ?? 0;
    }



    /* ===============================
        3) SỐ TOUR TỔ CHỨC
       =============================== */
    public function totalTours() {
        $sql = "SELECT COUNT(*) AS total FROM departure";
        return $this->queryOne($sql)['total'] ?? 0;
    }


    /* ===============================
        4) TỔNG KHÁCH THAM GIA
       =============================== */
    public function totalGuests() {
        $sql = "SELECT SUM(total_guests) AS guests
                FROM booking
                WHERE status != 'cancelled'";
        return $this->queryOne($sql)['guests'] ?? 0;
    }


    /* ===============================
        5) RATE BOOKING
       =============================== */
    public function bookingRate($start, $end) {

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
    public function bookingStatus($start, $end) {
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
    public function profitByTour() {
        $sql = "
            SELECT 
                t.tour_name,

                -- Tổng doanh thu theo tour
                COALESCE((
                    SELECT SUM(b.total_amount)
                    FROM booking b
                    JOIN departure d ON d.departure_id = b.departure_id
                    JOIN tour_version v ON v.version_id = d.version_id
                    WHERE v.tour_id = t.tour_id
                    AND b.status != 'cancelled'
                ), 0) AS revenue,

                -- Tổng chi phí theo tour
                COALESCE((
                    SELECT SUM(f.amount)
                    FROM tour_finance f
                    JOIN departure d ON d.departure_id = f.departure_id
                    JOIN tour_version v ON v.version_id = d.version_id
                    WHERE v.tour_id = t.tour_id
                    AND f.type = 'expense'
                ), 0) AS cost
            FROM tour t
        ";

        $data = $this->queryAll($sql);

        foreach ($data as &$row) {
            $row['profit'] = $row['revenue'] - $row['cost'];
        }

        return $data;
    }





        public function guidePerformance($start, $end) {
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


}
