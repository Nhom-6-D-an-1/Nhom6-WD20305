<?php
class TourModel extends BaseModel
{
    protected $table = 'tour';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTours()
    {
        $sql = "SELECT tour_id, category_id, tour_name, description FROM `tour` ORDER BY tour_id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTour($data)
    {
        $sql = "INSERT INTO `tour` (category_id, tour_name, description) VALUES (:category_id, :tour_name, :description)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':category_id' => $data['category_id'] ?? null,
            ':tour_name' => $data['tour_name'] ?? '',
            ':description' => $data['description'] ?? ''
        ]);
    }

    public function deleteTour($id)
    {
        $sql = "DELETE FROM `tour` WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
