<?php

class TourCategoryModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy toàn bộ danh mục
    public function getAllCategories($status = null)
    {
        $sql = "SELECT * FROM tour_category";

        if ($status !== null) {
            $sql .= " WHERE status = :status";
        }

        $stmt = $this->conn->prepare($sql);

        if ($status !== null) {
            $stmt->execute(["status" => $status]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục
    public function addCategory($data)
    {
        $sql = "INSERT INTO tour_category (category_name, description, status) 
                VALUES (:category_name, :description, :status)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            "category_name" => $data['category_name'],
            "description"   => $data['description'],
            "status"        => $data['status']
        ]);

        return $this->conn->lastInsertId();
    }

    // Lấy theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM tour_category WHERE category_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật danh mục
    public function updateDanhmuc($id, $data)
    {
        $sql = "UPDATE tour_category 
                SET category_name = :category_name,
                    description   = :description,
                    status        = :status
                WHERE category_id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            "category_name" => $data['category_name'],
            "description"   => $data['description'],
            "status"        => $data['status'],
            "id"            => $id
        ]);
    }

    // Xóa danh mục
    public function deleteDanhmuc($id)
    {
        $sql = "DELETE FROM tour_category WHERE category_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        return $stmt->rowCount();
    }
}
