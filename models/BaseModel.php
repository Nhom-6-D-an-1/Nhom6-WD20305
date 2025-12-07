<?php

class BaseModel
{
    protected $table;
    protected $conn;

    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);

        try {
            $this->conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }


    public function getBookingWithDetails($booking_id)
    {
        $sql = "SELECT * FROM booking WHERE booking_id = :booking_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':booking_id' => $booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        // Lấy danh sách khách
        require_once PATH_MODEL . "GuestModel.php";
        $guestModel = new GuestModel();
        $booking['guests'] = $guestModel->getGuestsByBooking($booking_id);

        return $booking;
    }

    // ✔ Trả về 1 dòng
    public function queryOne($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✔ Trả về nhiều dòng
    public function queryAll($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✔ Dùng cho INSERT / UPDATE / DELETE
    public function queryExecute($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    // Lấy connection nếu cần
    public function getConnection()
    {
        return $this->conn;
    }
}
