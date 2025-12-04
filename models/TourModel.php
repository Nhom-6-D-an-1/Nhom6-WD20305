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
        $sql = "SELECT * FROM tour WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTour($category_id, $tour_code, $tour_name, $description, $duration_days, $short_description)
    {
        $sql = "INSERT INTO `tour`(`category_id`, `tour_code`, `tour_name`, `description`, `duration_days`, `short_description`) 
        VALUES (:category_id, :tour_code, :tour_name, :description, :duration_days, :short_description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':category_id' => $category_id,
            ':tour_code' => $tour_code,
            ':tour_name' => $tour_name,
            ':description' => $description,
            ':duration_days' => $duration_days,
            ':short_description' => $short_description
        ]);
    }

    public function editTour($category_id, $tour_code, $tour_name, $description, $duration_days, $short_description, $id)
    {
        $sql = "UPDATE `tour` SET
        `category_id`=:category_id, 
        `tour_code`=:tour_code, 
        `tour_name`=:tour_name, 
        `description`=:description, 
        `duration_days`=:duration_days, 
        `short_description`=:short_description
        WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':category_id' => $category_id,
            ':tour_code' => $tour_code,
            ':tour_name' => $tour_name,
            ':description' => $description,
            ':duration_days' => $duration_days,
            ':short_description' => $short_description,
            ':id' => $id
        ]);
    }

    public function deleteTour($id)
    {
        $sql = "DELETE FROM tour WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
