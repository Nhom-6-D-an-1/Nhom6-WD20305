<?php
// Bảng tour
class TourModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    public function getAllTour()
    {
        $sql = "SELECT t.*, v.version_code, v.season FROM tour t LEFT JOIN tour_version v ON v.version_id = (
    SELECT MAX(v2.version_id)
    FROM tour_version v2
    WHERE v2.tour_id = t.tour_id
)";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOneTour($id)
    {
        $sql = "SELECT t.*, v.* FROM tour t LEFT JOIN tour_version v ON t.tour_id = v.tour_id WHERE t.tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
