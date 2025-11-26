<?php

class CheckinModel
{
    private $conn;

    public function __construct() {
        $db = new BaseModel(); 
        $this->conn = $db->getConnection();
    }

    // Lấy danh sách các điểm/chặng check-in (từ tour_itinerary)
    public function getCheckinStages($departure_id)
    {
        $sql = "SELECT stage_description FROM (
                    SELECT 
                        -- Các cột cần sắp xếp
                        day_number,
                        start_time,
                        -- Cột mô tả chặng cuối cùng
                        CONCAT('Ngày ',day_number, ':', place, ' - ', activity) AS stage_description
                    FROM tour_itinerary
                    WHERE departure_id = :departure_id
                    ORDER BY day_number, start_time
                ) AS ordered_stages";
        
        // Vì truy vấn con đã đảm bảo thứ tự, ta chỉ cần fetchAll(PDO::FETCH_COLUMN)
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Lấy ra danh sách các mô tả chặng đã được sắp xếp
        return $stmt->fetchAll(PDO::FETCH_COLUMN); 
    }

    // Lấy danh sách khách hàng và trạng thái check-in tại một chặng cụ thể
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
                -- LEFT JOIN phải nằm ngay sau JOIN/FROM
                LEFT JOIN (
                    -- Chỉ lấy trạng thái checkin cho chặng hiện tại và tour này
                    SELECT 
                        guest_id, 
                        status, 
                        checkin_id, 
                        checkin_time 
                    FROM guest_checkin 
                    WHERE departure_id = :departure_id_inner AND stage_description = :stage_description
                ) AS gc ON g.guest_id = gc.guest_id
                WHERE b.departure_id = :departure_id
                ORDER BY g.full_name";

        // Thực thi
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':departure_id_inner', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':stage_description', $stage_description);
        $stmt->execute(); // Dòng 67
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật/Thêm mới trạng thái check-in
    public function updateCheckinStatus($guest_id, $departure_id, $recorded_by_user_id, $stage_description, $status)
    {
        // 1. Kiểm tra bản ghi cũ
        $checkSql = "SELECT checkin_id FROM guest_checkin 
                     WHERE guest_id = :guest_id 
                     AND departure_id = :departure_id 
                     AND stage_description = :stage_description";
        
        $stmt = $this->conn->prepare($checkSql);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':stage_description', $stage_description);
        $stmt->execute();
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Cập nhật (UPDATE)
            $updateSql = "UPDATE guest_checkin 
                          SET status = :status, 
                              recorded_by_user_id = :recorded_by_user_id,
                              checkin_time = CURRENT_TIMESTAMP
                          WHERE checkin_id = :checkin_id";
            $stmt = $this->conn->prepare($updateSql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':recorded_by_user_id', $recorded_by_user_id, PDO::PARAM_INT);
            $stmt->bindParam(':checkin_id', $existing['checkin_id'], PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Thêm mới (INSERT)
            $insertSql = "INSERT INTO guest_checkin 
                          (guest_id, departure_id, recorded_by_user_id, stage_description, status) 
                          VALUES 
                          (:guest_id, :departure_id, :recorded_by_user_id, :stage_description, :status)";
            $stmt = $this->conn->prepare($insertSql);
            $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
            $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
            $stmt->bindParam(':recorded_by_user_id', $recorded_by_user_id, PDO::PARAM_INT);
            $stmt->bindParam(':stage_description', $stage_description);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
        }
    }

    // Hàm hỗ trợ để chuyển đổi trạng thái DB sang giao diện
    public function getStatusDisplay($status_db) {
        $map = [
            'present' => 'Có mặt',
            'absent' => 'Vắng mặt',
            'late' => 'Đến muộn',
            'pending' => 'Chưa điểm danh'
        ];
        return $map[$status_db] ?? 'Không xác định';
    }
}