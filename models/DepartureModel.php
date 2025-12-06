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

    public function create($data)
    {
        $sql = "INSERT INTO departure (version_id, start_date, end_date, total_seats, available_seats, actual_price, pickup_location, pickup_time, note, status, guide_id)
                VALUES (:version_id,:start_date,:end_date,:total_seats,:available_seats,:actual_price,:pickup_location,:pickup_time,:note,:status,:guide_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getByTourId($tour_id)
    {
        $sql = "
            SELECT d.*
            FROM departure d
            JOIN tour_version v ON d.version_id = v.version_id
            WHERE v.tour_id = ?
            ORDER BY d.start_date ASC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "
            SELECT d.*, t.tour_name, v.version_name
            FROM departure d
            JOIN tour_version v ON d.version_id = v.version_id
            JOIN tour t ON v.tour_id = t.tour_id
            WHERE d.departure_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
