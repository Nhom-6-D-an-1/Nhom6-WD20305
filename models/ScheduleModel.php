<?php

class ScheduleModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }
    // Schedule
    public function getAllScheduleByGuide($guide_id)
    {
        $sql = "SELECT 
                d.departure_id,
                d.start_date,
                d.end_date,
                d.max_guests,
                d.version_id,
                tv.version_name,
                tv.price,
                t.tour_name,
                u.full_name AS guide_name
            FROM assigned_staff a
            JOIN departure d ON a.departure_id = d.departure_id
            JOIN tour_version tv ON d.version_id = tv.version_id
            JOIN tour t ON tv.tour_id = t.tour_id
            JOIN tour_guide tg ON a.guide_id = tg.guide_id
            JOIN users u ON tg.user_id = u.user_id
            WHERE a.guide_id = :guide_id
            ORDER BY d.start_date ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Info
    public function getScheduleInfo($departure_id)
    {
        $sql = "SELECT 
                d.departure_id,
                tv.version_name,
                t.tour_name,
                d.start_date,
                d.end_date,
                d.max_guests,
                COUNT(g.guest_id) AS current_guests,
                COALESCE(u.full_name, 'Chưa có HDV') AS guide_name
            FROM departure d
            JOIN tour_version tv ON d.version_id = tv.version_id
            JOIN tour t ON tv.tour_id = t.tour_id
            LEFT JOIN booking b ON b.departure_id = d.departure_id
            LEFT JOIN guest g ON g.booking_id = b.booking_id
            LEFT JOIN assigned_staff a 
                ON a.departure_id = d.departure_id 
                AND a.role_in_tour = 'Main Guide'
            LEFT JOIN tour_guide tg ON a.guide_id = tg.guide_id
            LEFT JOIN users u ON tg.user_id = u.user_id
            WHERE d.departure_id = :departure_id
            GROUP BY 
                d.departure_id, tv.version_name, t.tour_name,
                d.start_date, d.end_date, d.max_guests, u.full_name
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Itinerary
    public function getScheduleItinerary($version_id) {
        $sql = "SELECT 
                day_number,
                start_time,
                end_time,
                place,
                activity
            FROM tour_itinerary
            WHERE version_id = :version_id
            ORDER BY day_number, start_time
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':version_id', $version_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Gom nhóm theo ngày để tiện hiển thị
        $itinerary = [];
        foreach ($rows as $row) {
            $day = $row['day_number'];
            if (!isset($itinerary[$day])) {
                $itinerary[$day] = [];
            }
            $itinerary[$day][] = $row;
        }

        return $itinerary; // Trả về mảng [day_number => [các hoạt động]]
    }
    // Customers
    public function getScheduleCustomers($departure_id)
    {
        $sql = "SELECT 
                    guest.guest_id,
                    guest.full_name,
                    guest.phone,
                    guest.gender,
                    guest_special_request.description AS special_request
                FROM guest
                JOIN booking ON guest.booking_id = booking.booking_id
                LEFT JOIN guest_special_request ON guest.guest_id = guest_special_request.guest_id
                WHERE booking.departure_id = :departure_id
                ORDER BY guest.full_name ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Check-in
    public function getScheduleCheckin($departure_id)
    {
        $sql = " SELECT 
                d.start_date,
                d.max_guests,
                d.pickup_location,
                d.pickup_time,
                COUNT(gc.guest_id) AS checked_in
            FROM departure d
            LEFT JOIN booking b ON b.departure_id = d.departure_id
            LEFT JOIN guest g ON g.booking_id = b.booking_id
            LEFT JOIN guest_checkin gc 
                ON gc.guest_id = g.guest_id 
                AND gc.departure_id = :departure_id
                AND gc.status = 'present'
            WHERE d.departure_id = :departure_id
            GROUP BY d.departure_id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
