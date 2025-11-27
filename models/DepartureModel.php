<?php

class DepartureModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
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
