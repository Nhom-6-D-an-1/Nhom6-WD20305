<?php
// Bảng khách hàng
class Guest
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    public function getAllGuest()
    {
        $sql = "SELECT * FROM `guest`";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách khách theo tour
    public function getGuideByTour($tour_id)
    {
        $sql = "SELECT DISTINCT g.guest_id, g.full_name 
            FROM guest g
            JOIN booking b ON g.booking_id = b.booking_id
            JOIN departure d ON b.departure_id = d.departure_id
            JOIN tour_version tv ON d.version_id = tv.version_id
            WHERE tv.tour_id = :tour_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tour_id' => $tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Danh sách khách theo chuyến đi
    public function getGuestsByDeparture($departure_id)
    {
        $sql = "SELECT g.*, b.customer_name, b.customer_contact,
                   sr.description, sr.medical_condition
            FROM guest g
            JOIN booking b ON g.booking_id = b.booking_id
            LEFT JOIN guest_special_request sr ON sr.guest_id = g.guest_id
            WHERE b.departure_id = :id
            ORDER BY g.guest_id ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetchAll();
    }
}
