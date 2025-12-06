<?php
class AssignedStaffModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // Lấy thông tin hướng dẫn viên theo chuyến đi
    public function getByDeparture($departure_id)
    {
        $sql = "SELECT a.*, u.full_name, g.phone, g.languages
                FROM assigned_staff a
                JOIN tour_guide g ON a.guide_id = g.guide_id
                JOIN users u ON u.user_id = g.user_id
                WHERE a.departure_id = :id
                ORDER BY a.assigned_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetchAll();
    }

    public function addGuideByDeparture($departure_id, $guide_id, $role, $notes)
    {
        // kiểm tra trùng lịch
        if (!$this->isGuideAvailable($guide_id, $departure_id)) {
            return ['ok' => false, 'error' => 'Hướng dẫn viên bị trùng lịch'];
        }
        $sql = "INSERT INTO assigned_staff (departure_id, guide_id, role_in_tour, notes)
                VALUES (:dep, :gid, :role, :notes)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['dep' => $departure_id, 'gid' => $guide_id, 'role' => $role, 'notes' => $notes]);
            return ['ok' => true, 'id' => $this->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }

    public function delete($assignment_id)
    {
        $sql = "DELETE FROM assigned_staff WHERE assignment_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $assignment_id]);
    }


    private function getDepartureDates($departure_id)
    {
        $sql = "SELECT start_date, end_date FROM departure WHERE departure_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetch();
    }


    public function isGuideAvailable($guide_id, $departure_id, $exclude_assignment_id = null)
    {
        $dates = $this->getDepartureDates($departure_id);
        if (!$dates) return false;
        $start = $dates['start_date'];
        $end = $dates['end_date'];

        $sql = "SELECT COUNT(*) AS cnt
                FROM assigned_staff a
                JOIN departure d ON a.departure_id = d.departure_id
                WHERE a.guide_id = :gid
                  AND d.start_date <= :end_date
                  AND d.end_date >= :start_date";
        $params = ['gid' => $guide_id, 'start_date' => $start, 'end_date' => $end];
        if ($exclude_assignment_id) {
            $sql .= " AND a.assignment_id != :ex";
            $params['ex'] = $exclude_assignment_id;
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $r = $stmt->fetch();
        return ($r['cnt'] == 0);
    }


    public function getAllGuides()
    {
        $sql = "SELECT t.*, u.full_name FROM tour_guide t LEFT JOIN users u ON t.user_id = u.user_id ORDER BY u.full_name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOne($assignment_id)
    {
        $sql = "SELECT * FROM assigned_staff WHERE assignment_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $assignment_id]);
        return $stmt->fetch();
    }
}
