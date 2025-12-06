<?php
class ServiceAssignmentModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function listByDeparture($departure_id)
    {
        $sql = "SELECT sa.*, s.name as service_name
                FROM service_assignment sa
                JOIN service s ON sa.service_id = s.service_id
                WHERE sa.departure_id = :id
                ORDER BY sa.assigned_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetchAll();
    }

    public function addService($departure_id, $service_id, $supplier, $price, $quantity, $notes)
    {
        $sql = "INSERT INTO service_assignment 
                (departure_id, service_id, supplier, price, quantity, notes)
                VALUES (:departure_id, :service_id, :supplier, :price, :quantity, :notes)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'departure_id' => $departure_id,
            'service_id' => $service_id,
            'supplier' => $supplier,
            'price' => $price,
            'quantity' => $quantity,
            'notes' => $notes
        ]);
    }

    public function delete($sa_id)
    {
        $sql = "DELETE FROM service_assignment WHERE sa_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $sa_id]);
    }

    public function getOne($sa_id)
    {
        $sql = "SELECT * FROM service_assignment WHERE sa_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $sa_id]);
        return $stmt->fetch();
    }
}
