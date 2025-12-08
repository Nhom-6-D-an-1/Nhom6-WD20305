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
                status
            FROM `booking`
            WHERE booking_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy booking theo trạng thái
    public function getBookingByStatus($status)
    {
        $sql = "SELECT 
                booking_id,
                departure_id,
                customer_name,
                customer_contact,
                total_amount,
                status
            FROM `booking`
            WHERE status = :status
            ORDER BY booking_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm booking
    public function addBooking($data)
    {
        $sql = "INSERT INTO booking 
        (departure_id, customer_name, customer_contact, customer_type, total_amount, status, created_at)
        VALUES (:departure_id, :customer_name, :customer_contact, :customer_type, :total_amount, :status, :created_at)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':departure_id'    => $data['departure_id'],
            ':customer_name'   => $data['customer_name'],
            ':customer_contact' => $data['customer_contact'],
            ':customer_type'   => $data['customer_type'],
            ':total_amount'    => $data['total_amount'],
            ':status'          => $data['status'],
            ':created_at'      => date("Y-m-d H:i:s"),
        ]);
        return $this->conn->lastInsertId();
    }



    // Lấy danh sách departure kèm tour để chọn khi tạo booking
    public function getDepartures()
    {
        $sql = "SELECT 
                    d.departure_id, 
                    d.start_date, 
                    tv.version_name, 
                    t.tour_name, 
                    tv.price
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
        $sql = "UPDATE booking SET 
            departure_id     = :departure_id,
            customer_name    = :customer_name,
            customer_contact = :customer_contact,
            customer_type    = :customer_type,
            total_amount     = :total_amount,
            status           = :status,
            total_guests     = :total_guests
        WHERE booking_id = :id";

        $data['id'] = $id;

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getDeparturePrice($departure_id)
    {
        $sql = "SELECT price FROM tour_version tv
                JOIN departure d ON d.version_id = tv.version_id
                WHERE d.departure_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $departure_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['price'] ?? 0;
    }


    // Lấy chi tiết booking kèm thông tin tour
    public function getBookingWithDetails($id)
    {
        // 1. Lấy thông tin booking + departure + version + tour + category
        $sql = "SELECT 
                    b.booking_id,
                    b.departure_id,
                    b.customer_name,
                    b.customer_contact,
                    b.total_amount,
                    b.status,
                    b.customer_type, 
                    d.start_date,
                    tv.version_name,
                    tv.price,
                    t.tour_name,
                    t.description,
                    tc.category_name
                FROM booking b
                LEFT JOIN departure d ON b.departure_id = d.departure_id
                LEFT JOIN tour_version tv ON d.version_id = tv.version_id
                LEFT JOIN tour t ON tv.tour_id = t.tour_id
                LEFT JOIN tour_category tc ON t.category_id = tc.category_id
                WHERE b.booking_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$booking) {
            return null;
        }

        // 2. Lấy danh sách khách thuộc booking
        require_once PATH_MODEL . "GuestModel.php";
        $guestModel = new GuestModel();
        $guests = $guestModel->getGuestsByBooking($id);

        // 3. Thêm danh sách khách vào mảng booking
        $booking['guests'] = $guests;

        return $booking;
    }


    // Xóa booking
    public function deleteBooking($id)
    {
        $sql = "DELETE FROM `booking` WHERE booking_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lấy tất cả booking của chuyến đi
    public function getAllBookingInDeparture($departure_id)
    {
        $sql = "SELECT * FROM `booking` WHERE departure_id = :id ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $departure_id]);
        return $stmt->fetchAll();
    }
}
