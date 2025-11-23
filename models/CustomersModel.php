<?php

class CustomersModel{
    private $conn;
    public function __construct() {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }
    public function getAllCustomers($guide_id)  {
        $sql = "SELECT 
                g.guest_id,
                g.full_name AS guest_name,
                b.customer_contact,
                b.customer_name AS group_name,
                CASE WHEN COALESCE(gc.cnt,0) > 2 THEN 'Đoàn' ELSE 'Lẻ' END AS group_type,
                GROUP_CONCAT(DISTINCT gsr.description SEPARATOR '; ') AS special_request,
                GROUP_CONCAT(DISTINCT gsr.medical_condition SEPARATOR '; ') AS medical_condition
            FROM assigned_staff a
            JOIN departure d ON a.departure_id = d.departure_id
            JOIN booking b ON b.departure_id = d.departure_id
            JOIN guest g ON g.booking_id = b.booking_id
            LEFT JOIN (
                SELECT booking_id, COUNT(*) AS cnt
                FROM guest
                GROUP BY booking_id
            ) gc ON gc.booking_id = b.booking_id
            LEFT JOIN guest_special_request gsr ON gsr.guest_id = g.guest_id
            WHERE a.user_id = :guide_id
            GROUP BY g.guest_id, g.full_name, b.customer_contact, b.customer_name, gc.cnt
            ORDER BY b.customer_name ASC, g.full_name ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAssignedTours($guide_id) {
        $sql = "SELECT DISTINCT
                d.departure_id,
                t.tour_name,
                d.start_date,
                d.end_date
            FROM assigned_staff a
            JOIN departure d ON a.departure_id = d.departure_id
            JOIN tour_version tv ON d.version_id = tv.version_id
            JOIN tour t ON tv.tour_id = t.tour_id
            WHERE a.user_id = :guide_id
            ORDER BY d.start_date ASC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
