<?php
// Bảng yêu cầu đặc biệt
class GuestSpecialRequest
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // Lấy dữ liệu trong bảng
    public function getAllRequest()
    {
        $sql = "SELECT guest_special_request.*, guest.full_name FROM guest_special_request LEFT JOIN guest ON guest_special_request.guest_id = guest.guest_id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm yêu cầu
    public function insertRequest($guest_id, $description, $medical_condition)
    {
        $sql = "INSERT INTO `guest_special_request`(`guest_id`, `description`, `medical_condition`) VALUES (:guest_id,:description,:medical_condition)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':guest_id' => $guest_id,
            ':description' => $description,
            ':medical_condition' => $medical_condition,
        ]);
    }

    // Xóa yêu cầu
    public function deleteRequest($id)
    {
        $sql = "DELETE FROM guest_special_request WHERE request_id = :request_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':request_id', $id);
        $stmt->execute();
    }
}
