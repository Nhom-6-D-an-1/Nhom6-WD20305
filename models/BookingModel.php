<?php
// Model cho Booking
class BookingModel extends BaseModel
{
    protected $table = 'booking';

    public function __construct()
    {
        parent::__construct();
    }

    // Lấy tất cả booking
    public function getAllBooking()
    {
        $sql = "SELECT * FROM booking ORDER BY booking_id ASC;";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy booking theo ID
    public function getBookingById($id)
    { 
        $sql = "SELECT 
                booking_id,
                departure_id,
                customer_name,
                customer_contact,
                total_amount,
                status,
                created_at
            FROM `booking`
            WHERE booking_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy booking theo trạng thái
    // public function getBookingByStatus($status)
    // {
    //     $sql = "SELECT 
    //             booking_id,
    //             departure_id,
    //             customer_name,
    //             customer_contact,
    //             total_amount,
    //             status,
    //             created_at
    //         FROM `booking`
    //         WHERE status = :status
    //         ORDER BY created_at DESC";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':status', $status);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // Thêm booking
    public function addBooking($data)
    {
        $sql = "INSERT INTO `booking` 
            (departure_id, customer_name, customer_contact, total_amount, status, created_at)
            VALUES (:departure_id, :customer_name, :customer_contact, :total_amount, :status, :created_at)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Lấy danh sách departure kèm tour để chọn khi tạo booking
    public function getDepartures()
    {
        $sql = "SELECT d.departure_id, d.start_date, tv.version_name, t.tour_name, tv.price
            FROM departure d
            LEFT JOIN tour_version tv ON d.version_id = tv.version_id
            LEFT JOIN tour t ON tv.tour_id = t.tour_id
            ORDER BY d.start_date ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật booking
    public function updateBooking($id, $data)
    {
        $sql = "UPDATE `booking` SET 
            departure_id = :departure_id,
            customer_name = :customer_name,
            customer_contact = :customer_contact,
            total_amount = :total_amount,
            status = :status
            WHERE booking_id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Lấy chi tiết booking kèm thông tin tour
    public function getBookingWithDetails($id)
    {
        $sql = "SELECT 
                b.booking_id,
                b.departure_id,
                b.customer_name,
                b.customer_contact,
                b.total_amount,
                b.status,
                b.created_at,
                d.start_date,
                tv.version_name,
                tv.price,
                t.tour_name,
                t.description,
                tc.category_name
            FROM `booking` b
            LEFT JOIN departure d ON b.departure_id = d.departure_id
            LEFT JOIN tour_version tv ON d.version_id = tv.version_id
            LEFT JOIN tour t ON tv.tour_id = t.tour_id
            LEFT JOIN tour_category tc ON t.category_id = tc.category_id
            WHERE b.booking_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa booking
    public function deleteBooking($id)
    {
        $sql = "DELETE FROM `booking` WHERE booking_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
