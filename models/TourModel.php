<?php

class TourModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /* ==========================================================
        LẤY DANH SÁCH TOUR (MÀN HÌNH QUẢN LÝ TOUR)
       ========================================================== */
    public function getFullInfo()
    {
        $sql = "
            SELECT 
                t.tour_id,
                t.tour_name,
                c.category_name,

                /* Giá tour - lấy theo version đầu tiên */
                (
                    SELECT v.price
                    FROM tour_version v
                    WHERE v.tour_id = t.tour_id
                    ORDER BY v.version_id ASC
                    LIMIT 1
                ) AS price,

                /* Ngày khởi hành sớm nhất */
                (
                    SELECT d.start_date
                    FROM departure d
                    JOIN tour_version v2 ON d.version_id = v2.version_id
                    WHERE v2.tour_id = t.tour_id
                    ORDER BY d.start_date ASC
                    LIMIT 1
                ) AS start_date,

                /* Hướng dẫn viên */
                (
                    SELECT u.full_name
                    FROM assigned_staff a
                    JOIN users u ON u.user_id = a.user_id
                    JOIN departure d2 ON d2.departure_id = a.departure_id
                    JOIN tour_version v3 ON v3.version_id = d2.version_id
                    WHERE v3.tour_id = t.tour_id
                    LIMIT 1
                ) AS guide_name

            FROM tour t
            LEFT JOIN tour_category c ON t.category_id = c.category_id
            ORDER BY t.tour_id DESC
        ";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ==========================================================
        LẤY 1 TOUR ĐẦY ĐỦ – CHO MÀN EDIT TOUR
       ========================================================== */
    public function getFullById($id)
    {
        $sql = "
            SELECT 
                t.tour_id,
                t.tour_name,
                t.category_id,
                c.category_name,
                v.price,
                d.start_date,
                u.user_id AS guide_id,
                u.full_name AS guide_name

            FROM tour t
            LEFT JOIN tour_category c ON t.category_id = c.category_id
            LEFT JOIN tour_version v ON v.tour_id = t.tour_id
            LEFT JOIN departure d ON d.version_id = v.version_id
            LEFT JOIN assigned_staff a ON a.departure_id = d.departure_id
            LEFT JOIN users u ON u.user_id = a.user_id
            WHERE t.tour_id = :id
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ==========================================================
        THÊM TOUR ĐẦY ĐỦ (TOUR → VERSION → DEPARTURE → STAFF)
       ========================================================== */
    public function insertFull($data)
    {
        try {
            $this->conn->beginTransaction();

            /* 1. Insert tour */
            $sql1 = "
                INSERT INTO tour (category_id, tour_name, description)
                VALUES (:category_id, :tour_name, :description)
            ";
            $stmt = $this->conn->prepare($sql1);
            $stmt->execute([
                ":category_id" => $data["category_id"],
                ":tour_name"   => $data["tour_name"],
                ":description" => ""
            ]);

            $tour_id = $this->conn->lastInsertId();

            /* 2. Insert tour version */
            $sql2 = "
                INSERT INTO tour_version (tour_id, version_name, price, itinerary)
                VALUES (:tour_id, :version_name, :price, :itinerary)
            ";
            $stmt = $this->conn->prepare($sql2);
            $stmt->execute([
                ":tour_id"      => $tour_id,
                ":version_name" => "Mặc định",
                ":price"        => $data["price"],
                ":itinerary"    => ""
            ]);

            $version_id = $this->conn->lastInsertId();

            /* 3. Insert departure */
            $sql3 = "
                INSERT INTO departure 
                (version_id, start_date, end_date, pickup_location, pickup_time, max_guests)
                VALUES (:version_id, :start_date, :end_date, :pickup_location, :pickup_time, :max_guests)
            ";
            $stmt = $this->conn->prepare($sql3);
            $stmt->execute([
                ":version_id"      => $version_id,
                ":start_date"      => $data["start_date"],
                ":end_date"        => $data["start_date"],
                ":pickup_location" => "",
                ":pickup_time"     => "00:00",
                ":max_guests"      => 30
            ]);

            $departure_id = $this->conn->lastInsertId();

            /* 4. Thêm hướng dẫn viên nếu có */
            if (!empty($data["user_id"])) {

                $sql4 = "
                    INSERT INTO assigned_staff (departure_id, user_id, role_in_tour)
                    VALUES (:departure_id, :user_id, :role_in_tour)
                ";
                $stmt = $this->conn->prepare($sql4);
                $stmt->execute([
                    ":departure_id" => $departure_id,
                    ":user_id"      => $data["user_id"],
                    ":role_in_tour" => "Hướng dẫn viên"
                ]);
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    /* ==========================================================
        UPDATE TOUR
       ========================================================== */
    public function update($id, $data)
    {
        $sql = "
            UPDATE tour 
            SET category_id = :category_id, tour_name = :tour_name
            WHERE tour_id = :id
        ";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":category_id" => $data["category_id"],
            ":tour_name"   => $data["tour_name"],
            ":id"          => $id
        ]);
    }

    /* ==========================================================
        UPDATE VERSION + DEPARTURE + STAFF
       ========================================================== */
    public function updateFull($id, $data)
    {
        /* 1. Update tour */
        $this->update($id, $data);

        /* 2. Update price */
        $sql = "
            UPDATE tour_version SET price = :price WHERE tour_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":price" => $data["price"],
            ":id"    => $id
        ]);

        /* 3. Update departure date */
        $sql = "
            UPDATE departure d
            JOIN tour_version v ON d.version_id = v.version_id
            SET d.start_date = :start_date
            WHERE v.tour_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":start_date" => $data["start_date"],
            ":id"         => $id
        ]);

        /* 4. Update hướng dẫn viên */
        $sql = "
            UPDATE assigned_staff a
            JOIN departure d ON a.departure_id = d.departure_id
            JOIN tour_version v ON d.version_id = v.version_id
            SET a.user_id = :user_id
            WHERE v.tour_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":user_id" => $data["user_id"],
            ":id"      => $id
        ]);
    }

    /* ==========================================================
        XÓA TOUR FULL
       ========================================================== */
    public function delete($id)
    {
        /* 1. Xóa staff */
        $sql = "
            DELETE a FROM assigned_staff a
            JOIN departure d ON a.departure_id = d.departure_id
            JOIN tour_version v ON d.version_id = v.version_id
            WHERE v.tour_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);

        /* 2. Xóa departure */
        $sql = "
            DELETE d FROM departure d
            JOIN tour_version v ON d.version_id = v.version_id
            WHERE v.tour_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);

        /* 3. Xóa version */
        $sql = "DELETE FROM tour_version WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);

        /* 4. Xóa tour */
        $sql = "DELETE FROM tour WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

    /* ==========================================================
        LẤY DANH MỤC TOUR
       ========================================================== */
    public function getCategories()
    {
        return $this->conn
            ->query("SELECT * FROM tour_category ORDER BY category_name ASC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ==========================================================
        LẤY LIST HƯỚNG DẪN VIÊN
       ========================================================== */
    public function getGuides()
    {
        return $this->conn
            ->query("SELECT * FROM users WHERE role = 'guide'")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ==========================================================
        LẤY CHI TIẾT TOUR – MÀN DETAIL
       ========================================================== */
    public function getTourDetail($tour_id)
    {
        $sql = "
            SELECT 
                t.tour_id,
                t.tour_name,
                c.category_name,
                v.version_id,
                v.version_name,
                v.price,
                d.departure_id,
                d.start_date,
                u.full_name AS guide_name
            FROM tour t
            
            JOIN tour_category c ON t.category_id = c.category_id

            /* Lấy đúng version mới nhất */
            JOIN tour_version v ON v.tour_id = t.tour_id

            /* Lấy đúng departure theo version */
            LEFT JOIN departure d ON d.version_id = v.version_id

            /* Lấy guide nếu có */
            LEFT JOIN assigned_staff a ON a.departure_id = d.departure_id
            LEFT JOIN users u ON u.user_id = a.user_id

            WHERE t.tour_id = :id
            
            /* Quan trọng: ưu tiên departure có ngày gần nhất */
            ORDER BY d.start_date ASC
            
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $tour_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    /* ==========================================================
        LẤY DANH SÁCH KHÁCH THEO BOOKING
       ========================================================== */
  public function getBookingsByDeparture($departure_id)
    {
        $sql = "
            SELECT 
                b.booking_id,
                b.customer_name,
                b.customer_contact,
                b.status
            FROM booking b
            WHERE b.departure_id = :departure_id
            ORDER BY b.booking_id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":departure_id" => $departure_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /* ==========================================================
        LẤY TÊN TOUR THEO DEPARTURE
       ========================================================== */
    public function getTourNameByDeparture($departure_id)
    {
        $sql = "
            SELECT t.tour_name
            FROM departure d
            JOIN tour_version v ON v.version_id = d.version_id
            JOIN tour t ON t.tour_id = v.tour_id
            WHERE d.departure_id = :departure_id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":departure_id" => $departure_id]);

        return $stmt->fetchColumn();
    }

    public function getTourIdByDeparture($departure_id)
    {
        $sql = "SELECT t.tour_id
                FROM departure d
                JOIN tour_version v ON d.version_id = v.version_id
                JOIN tour t ON t.tour_id = v.tour_id
                WHERE d.departure_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$departure_id]);

        return $stmt->fetchColumn();
    }

    public function getDeparturesByTour($tour_id)
    {
        $sql = "
            SELECT d.departure_id, d.start_date
            FROM departure d
            JOIN tour_version v ON d.version_id = v.version_id
            WHERE v.tour_id = ?
            ORDER BY d.start_date ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ==========================================================
    LẤY DANH SÁCH KHÁCH FULL THEO DEPARTURE
   ========================================================== */
    public function getGuestsFullByDeparture($departure_id)
    {
        $sql = "
            SELECT 
                b.customer_name,
                b.customer_contact,
                b.status,

                g.gender,
                g.birth_year,
                g.full_name,
                g.phone,

                COALESCE(sr.description, 'Không có') AS special_request

            FROM booking b
            LEFT JOIN guest g ON g.booking_id = b.booking_id
            LEFT JOIN guest_special_request sr ON sr.guest_id = g.guest_id

            WHERE b.departure_id = :departure_id
            ORDER BY b.booking_id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":departure_id" => $departure_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
