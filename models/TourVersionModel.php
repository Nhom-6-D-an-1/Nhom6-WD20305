<?php

class TourVersionModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả phiên bản của tour
    public function getAllVersionByTourId($tour_id)
    {
        $sql = "SELECT * FROM tour_version WHERE tour_id = :tour_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['tour_id' => $tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết 1 phiên bản
    public function getOneVersion($id)
    {
        $sql = "SELECT v.*,t.tour_name FROM tour_version v LEFT JOIN tour t ON v.tour_id = t.tour_id WHERE version_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createVersion($tour_id, $version_name, $version_code, $season, $price, $policies, $valid_from, $valid_to)
    {
        $sql = "INSERT INTO `tour_version`(`tour_id`,`version_name`, `version_code`, `season`, `price`, `policies`, `valid_from`, `valid_to`)
         VALUES (:tour_id, :version_name, :version_code, :season, :price, :policies, :valid_from, :valid_to)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':tour_id' => $tour_id,
            ':version_name' => $version_name,
            ':version_code' => $version_code,
            ':season' => $season,
            ':price' => $price,
            ':policies' => $policies,
            ':valid_from' => $valid_from,
            ':valid_to' => $valid_to
        ]);
    }
    public function editVersion() {}
}
