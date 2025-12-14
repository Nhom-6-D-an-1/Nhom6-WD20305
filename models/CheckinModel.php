
<?php

class CheckinModel
{
    private $conn;

    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // Lấy version_id từ departure_id
    private function getVersionIdByDeparture($departure_id)
    {
        $sql = "SELECT version_id FROM departure WHERE departure_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$departure_id]);
        return $stmt->fetchColumn();
    }

    // Lấy danh sách các chặng check-in từ tour_itinerary
    public function getCheckinStages($departure_id)
    {
        // Chuyển đúng từ departure_id → version_id
        $version_id = $this->getVersionIdByDeparture($departure_id);

        if (!$version_id) return [];

        $sql = "SELECT 
                    day_number,
                    place,
                    activity,
                    start_time,
                    end_time,
                    CONCAT('Ngày ', day_number, ': ', place, ' - ', activity) AS stage_description
                FROM tour_itinerary
                WHERE version_id = :version_id
                ORDER BY day_number, start_time";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':version_id', $version_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy check-in trạng thái của từng khách
    public function getGuestsAndCheckinStatus($departure_id, $stage_description)
    {
        $sql = "SELECT 
                    g.guest_id,
                    g.full_name,
                    COALESCE(gc.status, 'pending') AS status,
                    gc.checkin_id,
                    gc.checkin_time
                FROM guest AS g
                JOIN booking AS b ON g.booking_id = b.booking_id
                LEFT JOIN (
                    SELECT guest_id, status, checkin_id, checkin_time
                    FROM guest_checkin
                    WHERE departure_id = :d1 AND stage_description = :stage
                ) AS gc ON g.guest_id = gc.guest_id
                WHERE b.departure_id = :d2
                ORDER BY g.full_name";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':d1', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':d2', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':stage', $stage_description);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật hoặc thêm trạng thái mới
    public function updateCheckinStatus($guest_id, $departure_id, $recorded_by_user_id, $stage_description, $status)
    {
        $checkSql = "SELECT checkin_id FROM guest_checkin
                     WHERE guest_id = :guest_id
                       AND departure_id = :departure_id
                       AND stage_description = :stage";

        $stmt = $this->conn->prepare($checkSql);
        $stmt->bindParam(':guest_id', $guest_id);
        $stmt->bindParam(':departure_id', $departure_id);
        $stmt->bindParam(':stage', $stage_description);
        $stmt->execute();

        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $updateSql = "UPDATE guest_checkin
                          SET status = :status,
                              recorded_by_user_id = :rby,
                              checkin_time = CURRENT_TIMESTAMP
                          WHERE checkin_id = :id";

            $stmt = $this->conn->prepare($updateSql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':rby', $recorded_by_user_id);
            $stmt->bindParam(':id', $existing['checkin_id']);
            $stmt->execute();
        } else {
            $insertSql = "INSERT INTO guest_checkin 
                          (guest_id, departure_id, recorded_by_user_id, stage_description, status)
                          VALUES (:guest_id, :departure_id, :rby, :stage, :status)";

            $stmt = $this->conn->prepare($insertSql);
            $stmt->bindParam(':guest_id', $guest_id);
            $stmt->bindParam(':departure_id', $departure_id);
            $stmt->bindParam(':rby', $recorded_by_user_id);
            $stmt->bindParam(':stage', $stage_description);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
        }
    }

    public function getStatusDisplay($status_db)
    {
        $map = [
            'present' => 'Có mặt',
            'absent' => 'Vắng mặt',
            'late' => 'Đến muộn',
            'pending' => 'Chưa điểm danh'
        ];
        return $map[$status_db] ?? 'Không xác định';
    }
}
