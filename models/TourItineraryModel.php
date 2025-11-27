<?php

class TourItineraryModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy lịch trình theo phiên bản
    public function getByVersionId($version_id)
    {
        $sql = "SELECT * FROM tour_itinerary WHERE departure_id = :version_id ORDER BY day_number ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['version_id' => $version_id]);
        return $stmt->fetchAll();
    }

    // Thêm lịch trình
    public function insert($data)
    {
        $sql = "INSERT INTO tour_itinerary 
                (departure_id, day_number, start_time, end_time, place, activity)
                VALUES 
                (:departure_id, :day_number, :start_time, :end_time, :place, :activity)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Sửa lịch trình
    public function update($id, $data)
    {
        $sql = "UPDATE tour_itinerary SET
                day_number = :day_number,
                start_time = :start_time,
                end_time = :end_time,
                place = :place,
                activity = :activity
                WHERE itinerary_id = :id";

        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Xoá lịch trình
    public function delete($id)
    {
        $sql = "DELETE FROM tour_itinerary WHERE itinerary_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
