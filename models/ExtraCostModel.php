<?php
class ExtraCostModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function addCost($data)
    {
        $sql = "INSERT INTO extra_cost (departure_id, cost_name, amount, note)
                VALUES (:departure_id, :cost_name, :amount, :note)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getByDeparture($departure_id)
    {
        $sql = "SELECT * FROM extra_cost WHERE departure_id = :id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sumCost($departure_id)
    {
        $sql = "SELECT COALESCE(SUM(amount), 0) AS total 
            FROM extra_cost 
            WHERE departure_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);

        return (int)$stmt->fetchColumn();
    }
}
