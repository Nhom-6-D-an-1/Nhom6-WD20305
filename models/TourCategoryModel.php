<?php
class TourCategoryModel extends BaseModel
{
    protected $table = 'tour_category';

    public function __construct()
    {
        parent::__construct();
    }

    // Lấy tất cả danh mục tour
    public function getAllCategories()
    {
        $sql = "SELECT category_id, category_name FROM `tour_category` ORDER BY category_id ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục tour
    public function addCategory($data)
    {
        $sql = "INSERT INTO `tour_category` (category_name) VALUES (:category_name)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':category_name' => $data['category_name'] ?? ''
        ]);
    }

    // Xóa danh mục tour
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM `tour_category` WHERE category_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
