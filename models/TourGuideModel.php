<?php
// Bảng hướng dẫn viên
class TourGuideModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    public function getAllGuide()
    {
        $sql = "SELECT tour_guide.*, users.full_name FROM tour_guide LEFT JOIN users ON tour_guide.user_id = users.user_id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
