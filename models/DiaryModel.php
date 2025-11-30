<?php

class DiaryModel {
    private $conn;

    public function __construct() {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả nhật ký (tour_log) của HDV theo user_id
    public function getAllDiaryByGuide($guide_id, $departure_id = 0) {
        $sql = "SELECT 
                    tl.log_id,
                    tl.departure_id,
                    tl.log_content,
                    tl.image,
                    tl.created_at,
                    u.full_name AS guide_name,
                    t.tour_name
                FROM tour_log tl
                JOIN users u ON tl.user_id = u.user_id
                JOIN departure dep ON tl.departure_id = dep.departure_id
                JOIN tour_version tv ON dep.version_id = tv.version_id
                JOIN tour t ON tv.tour_id = t.tour_id
                WHERE tl.user_id = :guide_id";

        // Nếu chọn tour cụ thể
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

    // Lấy thông tin chi tiết 1 nhật ký
    // public function getDiaryInfo($log_id) {
    //     $sql = "SELECT 
    //                 tl.log_id,
    //                 tl.departure_id,
    //                 tl.log_content,
    //                 tl.image,
    //                 tl.created_at,
    //                 u.full_name AS guide_name,
    //                 t.tour_name,
    //                 dep.start_date,
    //                 dep.end_date
    //             FROM tour_log tl
    //             JOIN users u ON tl.user_id = u.user_id
    //             JOIN departure dep ON tl.departure_id = dep.departure_id
    //             JOIN tour_version tv ON dep.version_id = tv.version_id
    //             JOIN tour t ON tv.tour_id = t.tour_id
    //             WHERE tl.log_id = :log_id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':log_id', $log_id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // Thêm nhật ký mới
    public function addDiary($departure_id, $user_id, $log_content, $imagePath = null, $created_at = null) {
        if (!$created_at) $created_at = date('Y-m-d H:i:s'); // tự động lấy ngày giờ hiện tại

        $sql = "INSERT INTO tour_log (departure_id, user_id, log_content, image, created_at) 
                VALUES (:departure_id, :user_id, :log_content, :image, :created_at)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':log_content', $log_content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imagePath, PDO::PARAM_STR); // bind kiểu string
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Cập nhật nhật ký
    // public function updateDiary($log_id, $log_content, $imagePath = null) {
    //     if ($imagePath) {
    //         $sql = "UPDATE tour_log SET log_content = :log_content, image = :image WHERE log_id = :log_id";
    //     } else {
    //         $sql = "UPDATE tour_log SET log_content = :log_content WHERE log_id = :log_id";
    //     }
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':log_content', $log_content);
    //     $stmt->bindParam(':log_id', $log_id, PDO::PARAM_INT);
    //     if ($imagePath) {
    //         $stmt->bindParam(':image', $imagePath);
    //     }
    //     return $stmt->execute();
    // }

    // Xoá nhật ký
    public function deleteDiary($log_id) {
        $sql = "DELETE FROM tour_log WHERE log_id = :log_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':log_id', $log_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lấy danh sách khách hàng liên quan đến 1 nhật ký (qua departure)
    // public function getDiaryCustomers($log_id) {
    //     $sql = "SELECT 
    //                 g.guest_id,
    //                 g.full_name,
    //                 b.booking_id,
    //                 gc.status AS checkin_status
    //             FROM tour_log tl
    //             JOIN departure dep ON tl.departure_id = dep.departure_id
    //             JOIN booking b ON b.departure_id = dep.departure_id
    //             JOIN guest g ON g.booking_id = b.booking_id
    //             LEFT JOIN guest_checkin gc ON g.guest_id = gc.guest_id AND gc.departure_id = dep.departure_id
    //             WHERE tl.log_id = :log_id
    //             ORDER BY g.full_name ASC";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':log_id', $log_id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}
