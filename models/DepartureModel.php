<?php

class DepartureModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDepartures()
    {
        $sql = "SELECT d.*, v.version_name, t.tour_name
                FROM departure d
                JOIN tour_version v ON d.version_id = v.version_id
                JOIN tour t ON v.tour_id = t.tour_id
                ORDER BY d.start_date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOneDeparture($id)
    {
        $sql = "SELECT d.*, v.version_name, t.tour_name
                FROM departure d
                JOIN tour_version v ON d.version_id = v.version_id
                JOIN tour t ON v.tour_id = t.tour_id
                WHERE d.departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    public function createDeparture($data)
    {
        $sql = "INSERT INTO departure 
                (version_id, start_date, end_date, max_guests, current_guests,
                 actual_price, pickup_location, pickup_time, note, status)
                VALUES 
                (:version_id, :start_date, :end_date, :max_guests, :current_guests,
                 :actual_price, :pickup_location, :pickup_time, :note, :status)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }


    public function updateDeparture($id, $data)
    {
        $sql = "UPDATE departure SET 
                start_date = :start_date,
                end_date = :end_date,
                max_guests = :max_guests,
                actual_price = :actual_price,
                pickup_location = :pickup_location,
                pickup_time = :pickup_time,
                note = :note,
                status = :status
                WHERE departure_id = :id";

        $stmt = $this->conn->prepare($sql);
        $data["id"] = $id;

        return $stmt->execute($data);
    }

    public function deleteDeparture($id)
    {
        $sql = "DELETE FROM departure WHERE departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
