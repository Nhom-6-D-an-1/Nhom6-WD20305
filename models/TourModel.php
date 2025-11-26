<?php

class TourModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /* ===================================================
        LẤY DANH SÁCH TOUR ĐẦY ĐỦ
       =================================================== */
    public function getFullInfo()
    {
        $sql = "
            SELECT 
                t.tour_id,
                t.tour_name,
                c.category_name,

                -- Giá tour
                (SELECT v.price 
                 FROM tour_version v 
                 WHERE v.tour_id = t.tour_id 
                 ORDER BY v.version_id ASC 
                 LIMIT 1) AS price,

                -- Ngày khởi hành gần nhất
                (SELECT d.start_date
                 FROM departure d
                 JOIN tour_version v2 ON d.version_id = v2.version_id
                 WHERE v2.tour_id = t.tour_id
                 ORDER BY d.start_date ASC
                 LIMIT 1) AS start_date,

                -- Hướng dẫn viên
                (SELECT u.full_name
                 FROM assigned_staff a
                 JOIN users u ON a.user_id = u.user_id
                 JOIN departure d2 ON a.departure_id = d2.departure_id
                 JOIN tour_version v3 ON d2.version_id = v3.version_id
                 WHERE v3.tour_id = t.tour_id
                 LIMIT 1) AS guide_name

            FROM tour t
            LEFT JOIN tour_category c ON t.category_id = c.category_id
            ORDER BY t.tour_id DESC
        ";

        return $this->conn->query($sql)->fetchAll();
    }

    /* ===================================================
        LẤY 1 TOUR (FULL INFO)
       =================================================== */
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

                u.user_id,
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
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /* ===================================================
        THÊM TOUR ĐẦY ĐỦ
       =================================================== */
    public function insertFull($data)
    {
        try {
            $this->conn->beginTransaction();

            /* 1) TOUR */
            $sql1 = "INSERT INTO tour (category_id, tour_name, description)
                     VALUES (:category_id, :tour_name, :description)";
            $stmt = $this->conn->prepare($sql1);
            $stmt->execute([
                ":category_id" => $data["category_id"],
                ":tour_name"   => $data["tour_name"],
                ":description" => ""
            ]);

            $tour_id = $this->conn->lastInsertId();

            /* 2) VERSION */
            $sql2 = "INSERT INTO tour_version (tour_id, version_name, price, itinerary)
                     VALUES (:tour_id, :version_name, :price, :itinerary)";
            $stmt = $this->conn->prepare($sql2);
            $stmt->execute([
                ":tour_id"      => $tour_id,
                ":version_name" => "Mặc định",
                ":price"        => $data["price"],
                ":itinerary"    => ""
            ]);

            $version_id = $this->conn->lastInsertId();

            /* 3) DEPARTURE */
            $sql3 = "INSERT INTO departure (version_id, start_date, end_date, pickup_location, pickup_time, max_guests)
                     VALUES (:version_id, :start_date, :end_date, :pickup_location, :pickup_time, :max_guests)";
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

            /* 4) STAFF */
            if (!empty($data["user_id"])) {
                $sql4 = "INSERT INTO assigned_staff (departure_id, user_id, role_in_tour)
                         VALUES (:departure_id, :user_id, :role_in_tour)";
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

    /* ===================================================
        SỬA TOUR
       =================================================== */
    public function update($id, $data)
    {
        $sql = "UPDATE tour SET
                    category_id = :category_id,
                    tour_name   = :tour_name
                WHERE tour_id = :id";

        $stmt = $this->conn->prepare($sql);

        // Chỉ lấy đúng 3 biến cần thiết
        $params = [
            ":category_id" => $data["category_id"],
            ":tour_name"   => $data["tour_name"],
            ":id"          => $id
        ];

        return $stmt->execute($params);
    }


    /* ===================================================
        UPDATE PRICE + START DATE + HDV
       =================================================== */
    public function updateFull($id, $data)
    {
        // Update basic tour
        $this->update($id, $data);

        // Update price
        $sql = "UPDATE tour_version SET price = :price WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":price" => $data["price"],
            ":id"    => $id
        ]);

        // Update departure date
        $sql = "UPDATE departure d
                JOIN tour_version v ON d.version_id = v.version_id
                SET d.start_date = :start_date
                WHERE v.tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":start_date" => $data["start_date"],
            ":id"         => $id
        ]);

        // Update HDV
        $sql = "UPDATE assigned_staff a
                JOIN departure d ON a.departure_id = d.departure_id
                JOIN tour_version v ON d.version_id = v.version_id
                SET a.user_id = :user_id
                WHERE v.tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":user_id" => $data["user_id"],
            ":id"      => $id
        ]);
    }


    /* ===================================================
        XÓA TOUR
       =================================================== */
    public function delete($id)
    {
        // 1. Xóa assigned_staff
        $sql = "DELETE a FROM assigned_staff a
                JOIN departure d ON a.departure_id = d.departure_id
                JOIN tour_version v ON d.version_id = v.version_id
                WHERE v.tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);

        // 2. Xóa departure
        $sql = "DELETE d FROM departure d
                JOIN tour_version v ON d.version_id = v.version_id
                WHERE v.tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);

        // 3. Xóa tour_version
        $sql = "DELETE FROM tour_version WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $id]);

        // 4. Cuối cùng xóa tour
        $sql = "DELETE FROM tour WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

    public function getCategories()
    {
        return $this->conn->query("SELECT * FROM tour_category ORDER BY category_name ASC")->fetchAll();
    }

    /* ===================================================
        LẤY HDV
       =================================================== */
    public function getGuides()
    {
        return $this->conn->query("SELECT * FROM users WHERE role = 'guide'")->fetchAll();
    }
}
