<?php

class DiaryModel {
    private $conn;

    public function __construct() {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // NEW: Lấy danh sách các ngày trong lịch trình của tour (để chọn "Thời gian sự cố")
    public function getItineraryDays($departure_id) {
        $sql = "
            SELECT ti.itinerary_id, ti.day_number, ti.place, ti.activity
            FROM tour_itinerary ti
            JOIN departure d ON ti.version_id = d.version_id
            WHERE d.departure_id = :departure_id
            ORDER BY ti.day_number ASC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATED: Lấy tất cả nhật ký + thông tin ngày sự cố (nếu có)
    public function getAllDiaryByGuide($guide_id, $departure_id = 0) {
        $sql = "SELECT 
                    tl.log_id,
                    tl.departure_id,
                    tl.log_content,
                    tl.image,
                    tl.created_at,
                    tl.itinerary_id,
                    tl.handling_method,
                    tl.customer_feedback,
                    ti.day_number,
                    ti.place AS incident_place,
                    u.full_name AS guide_name,
                    t.tour_name
                FROM tour_log tl
                JOIN users u ON tl.user_id = u.user_id
                JOIN departure dep ON tl.departure_id = dep.departure_id
                JOIN tour_version tv ON dep.version_id = tv.version_id
                JOIN tour t ON tv.tour_id = t.tour_id
                LEFT JOIN tour_itinerary ti ON tl.itinerary_id = ti.itinerary_id 
                WHERE tl.user_id = :guide_id";

        if ($departure_id > 0) {
            $sql .= " AND tl.departure_id = :departure_id";
        }

        $sql .= " ORDER BY tl.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id, PDO::PARAM_INT);

        if ($departure_id > 0) {
            $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATED: Thêm nhật ký với các trường mới
    public function addDiary($departure_id, $user_id, $log_content, $itinerary_id = null, $handling_method = null, $customer_feedback = null, $imagePath = null, $created_at = null) {

        if (!$created_at) {
            $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
            $now = new DateTime('now', $timezone);
            $created_at = $now->format('Y-m-d H:i:s');
        }

        $sql = "INSERT INTO tour_log 
                (departure_id, user_id, log_content, itinerary_id, handling_method, customer_feedback, image, created_at) 
                VALUES (:departure_id, :user_id, :log_content, :itinerary_id, :handling_method, :customer_feedback, :image, :created_at)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':log_content', $log_content, PDO::PARAM_STR);
        $stmt->bindParam(':itinerary_id', $itinerary_id, PDO::PARAM_INT);        
        $stmt->bindParam(':handling_method', $handling_method, PDO::PARAM_STR); 
        $stmt->bindParam(':customer_feedback', $customer_feedback, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Xoá không thay đổi
    public function deleteDiary($log_id) {
        $sql = "DELETE FROM tour_log WHERE log_id = :log_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':log_id', $log_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}