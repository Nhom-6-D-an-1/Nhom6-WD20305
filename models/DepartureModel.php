<?php

class DepartureModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM departure WHERE departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllDepartures()
    {
        $sql = "SELECT d.*,u.full_name, v.version_name, t.tour_name
                FROM departure d
                JOIN tour_version v ON d.version_id = v.version_id
                JOIN tour t ON v.tour_id = t.tour_id
                LEFT JOIN assigned_staff a 
            ON a.assignment_id = (
                SELECT a2.assignment_id 
                FROM assigned_staff a2
                WHERE a2.departure_id = d.departure_id
                ORDER BY a2.assigned_at DESC
                LIMIT 1
            )

        LEFT JOIN tour_guide g ON g.guide_id = a.guide_id
        LEFT JOIN users u ON u.user_id = g.user_id
                ORDER BY d.start_date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOneDeparture($id)
    {
        $sql = "SELECT d.*, v.version_name, t.tour_name
                FROM departure d
                JOIN tour_version v ON d.version_id = v.version_id
                JOIN tour t ON v.tour_id = t.tour_id
                WHERE d.departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    public function createDeparture($data)
    {
        $sql = "INSERT INTO departure 
                (version_id, start_date, end_date, max_guests, current_guests,
                 actual_price, pickup_location, pickup_time, note, status)
                VALUES 
                (:version_id, :start_date, :end_date, :max_guests, :current_guests,
                 :actual_price, :pickup_location, :pickup_time, :note, :status)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }


    public function updateDeparture($id, $data)
    {
        $sql = "UPDATE departure SET 
                start_date = :start_date,
                end_date = :end_date,
                max_guests = :max_guests,
                actual_price = :actual_price,
                pickup_location = :pickup_location,
                pickup_time = :pickup_time,
                note = :note,
                status = :status
                WHERE departure_id = :id";

        $stmt = $this->conn->prepare($sql);
        $data["id"] = $id;

        return $stmt->execute($data);
    }

    public function deleteDeparture($id)
    {
        $sql = "DELETE FROM departure WHERE departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Doanh thu chuyến đi
    public function getRevenueByDeparture($departure_id)
    {
        $sql = "SELECT 
                COUNT(b.booking_id) as booking_count,
                SUM(b.total_guests) as total_guests,
                SUM(IFNULL(b.total_amount,0)) as revenue
            FROM booking b
            WHERE b.departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetch();
    }

    // Tổng tiền đã thêm từ booking
    public function getRevenue($departure_id)
    {
        $sql = "SELECT 
            COUNT(*) AS booking_count,
            SUM(total_guests) AS total_guests,
            SUM(total_amount) AS revenue
        FROM booking
        WHERE departure_id = :id AND status = 'completed'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetch();
    }
}
