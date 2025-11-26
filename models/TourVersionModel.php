<?php

class TourVersionModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả phiên bản của tour
    public function getByTourId($tour_id)
    {
        $sql = "SELECT * FROM tour_version WHERE tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll();
    }

    // Lấy chi tiết 1 phiên bản
    public function getById($id)
    {
        $sql = "SELECT * FROM tour_version WHERE version_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
