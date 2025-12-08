<?php
class GuestModel
{
    private $conn;

    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // 1. Lấy toàn bộ khách
    public function getAllGuest()
    {
        $sql = "SELECT * FROM guest ORDER BY guest_id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Lấy khách theo booking
    public function getGuestsByBooking($booking_id)
    {
        $sql = "SELECT * FROM guest WHERE booking_id = :booking_id ORDER BY guest_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':booking_id' => $booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Thêm khách FIT/GIT
    public function addGuest($data)
    {
        $sql = "INSERT INTO guest (booking_id, full_name, gender, birth_year, phone)
                VALUES (:booking_id, :full_name, :gender, :birth_year, :phone)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':booking_id' => $data['booking_id'],
            ':full_name'  => $data['full_name'],
            ':gender'     => $data['gender'],
            ':birth_year' => $data['birth_year'],
            ':phone'      => $data['phone']
        ]);

        return $this->conn->lastInsertId();
    }


    // 4. Thêm yêu cầu đặc biệt
    public function addSpecialRequest($data)
    {
        $sql = "INSERT INTO guest_special_request (guest_id, description, medical_condition)
                VALUES (:guest_id, :description, :medical_condition)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':guest_id'          => $data['guest_id'],
            ':description'       => $data['description'] ?? '',
            ':medical_condition' => $data['medical_condition'] ?? '',
        ]);
    }


    // 5. Lấy tất cả yêu cầu đặc biệt theo khách
    public function getSpecialRequestByGuest($guest_id)
    {
        $sql = "SELECT * FROM guest_special_request 
                WHERE guest_id = :guest_id 
                ORDER BY request_id DESC 
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':guest_id' => $guest_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // CHỈ TRẢ 1 DÒNG
    }


    // 6. Lấy khách theo tour
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
