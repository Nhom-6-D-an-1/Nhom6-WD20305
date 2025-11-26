<?php
// Bảng yêu cầu đặc biệt
class GuestSpecialRequest
{
    // CODE của anh Trịnh

    // private $conn;
    // public function __construct()
    // {
    //     $db = new BaseModel();
    //     $this->conn = $db->getConnection();
    // }

    // // Lấy dữ liệu trong bảng
    // public function getAllRequest($tour_id)
    // {
    //     $sql = "SELECT r.*, g.full_name, t.tour_name 
    //             FROM guest_special_request r
    //             JOIN guest g ON r.guest_id = g.guest_id
    //             LEFT JOIN booking b ON g.booking_id = b.booking_id
    //             LEFT JOIN departure d ON b.departure_id = d.departure_id
    //             LEFT JOIN tour_version tv ON d.version_id = tv.version_id
    //             LEFT JOIN tour t ON tv.tour_id = t.tour_id
    //             WHERE t.tour_id = :tour_id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([':tour_id' => $tour_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // // Thêm yêu cầu
    // public function insertRequest($guest_id, $description, $medical_condition)
    // {
    //     $sql = "INSERT INTO `guest_special_request`(`guest_id`, `description`, `medical_condition`) VALUES (:guest_id,:description,:medical_condition)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([
    //         ':guest_id' => $guest_id,
    //         ':description' => $description,
    //         ':medical_condition' => $medical_condition,
    //     ]);
    // }

    // // Xóa yêu cầu
    // public function deleteRequest($id)
    // {
    //     $sql = "DELETE FROM guest_special_request WHERE request_id = :request_id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':request_id', $id);
    //     $stmt->execute();
    // }

    // CODE của Tú

    // Bảng yêu cầu đặc biệt
    private $conn;

    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả yêu cầu của 1 tour
    public function getAllRequest($tour_id)
    {
        $sql = "SELECT 
                    r.request_id,
                    r.guest_id,
                    r.description,
                    r.medical_condition,
                    g.full_name,
                    t.tour_name
                FROM guest_special_request r
                JOIN guest g ON r.guest_id = g.guest_id
                LEFT JOIN booking b ON g.booking_id = b.booking_id
                LEFT JOIN departure d ON b.departure_id = d.departure_id
                LEFT JOIN tour_version tv ON d.version_id = tv.version_id
                LEFT JOIN tour t ON tv.tour_id = t.tour_id
                WHERE t.tour_id = :tour_id
                ORDER BY r.request_id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm yêu cầu vào database
    public function insertRequest($guest_id, $description, $medical_condition)
    {
        $sql = "INSERT INTO guest_special_request (guest_id, description, medical_condition) 
                VALUES (:guest_id, :description, :medical_condition)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':medical_condition', $medical_condition, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Xóa 1 yêu cầu
    public function deleteRequest($id)
    {
        $sql = "DELETE FROM guest_special_request WHERE request_id = :request_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':request_id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
