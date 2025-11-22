<?php

class ScheduleModel{
    private $conn;
    public function __construct() {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    /* ======================================================
        1. LẤY DANH SÁCH LỊCH LÀM VIỆC CỦA HƯỚNG DẪN VIÊN
       ====================================================== */
    public function getAllByGuide($guide_id) {
        $sql = "
            SELECT 
                departure.departure_id,
                departure.start_date,
                departure.end_date,
                departure.max_guests,
                departure.tour_version_id,
                tour_version.version_name,
                tour_version.price,
                tour.tour_name,
                users.full_name AS guide_name
            FROM assigned_staff
            JOIN departure ON assigned_staff.departure_id = departure.departure_id
            JOIN tour_version ON departure.tour_version_id = tour_version.version_id
            JOIN tour ON tour_version.tour_id = tour.tour_id
            JOIN users ON assigned_staff.user_id = users.user_id
            WHERE assigned_staff.user_id = :guide_id
            ORDER BY departure.start_date ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ======================================================
        2. LẤY THÔNG TIN TRANG INFO
       ====================================================== */
    public function getInfo($departure_id) {
        $sql = "
            SELECT 
                departure.*,
                tour_version.version_name,
                tour_version.price,
                tour_version.itinerary,
                tour.tour_name,
                tour.description AS tour_description
            FROM departure
            JOIN tour_version ON departure.tour_version_id = tour_version.version_id
            JOIN tour ON tour_version.tour_id = tour.tour_id
            WHERE departure.departure_id = :departure_id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ======================================================
        3. LẤY LỊCH TRÌNH (ITINERARY)
       ====================================================== */
    public function getItinerary($departure_id) {
        $sql = "
            SELECT 
                tour_version.itinerary,
                tour_version.version_name,
                tour.tour_name
            FROM departure
            JOIN tour_version ON departure.tour_version_id = tour_version.version_id
            JOIN tour ON tour_version.tour_id = tour.tour_id
            WHERE departure.departure_id = :departure_id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ======================================================
        4. DANH SÁCH KHÁCH (CUSTOMERS)
       ====================================================== */
    public function getCustomers($departure_id) {
        $sql = "
            SELECT 
                guest.guest_id,
                guest.full_name,
                booking.booking_id,
                guest_checkin.status AS checkin_status
            FROM guest
            JOIN booking ON guest.booking_id = booking.booking_id
            LEFT JOIN guest_checkin ON guest.guest_id = guest_checkin.guest_id
            WHERE booking.departure_id = :departure_id
            ORDER BY guest.full_name ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ======================================================
        5. CHECK-IN (CHI TIẾT)
       ====================================================== */
    public function getCheckin($departure_id) {
        $sql = "
            SELECT 
                guest.guest_id,
                guest.full_name,
                guest_checkin.status,
                guest_checkin.stage_description,
                guest_checkin.checkin_time
            FROM guest
            JOIN booking ON guest.booking_id = booking.booking_id
            LEFT JOIN guest_checkin ON guest.guest_id = guest_checkin.guest_id
            WHERE booking.departure_id = :departure_id
            ORDER BY guest.full_name ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':departure_id', $departure_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}