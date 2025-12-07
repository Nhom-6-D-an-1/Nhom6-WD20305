<?php
// Bảng hướng dẫn viên
class TourGuideModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    public function getAllGuide()
    {
        $sql = "SELECT tour_guide.*, users.full_name FROM tour_guide LEFT JOIN users ON tour_guide.user_id = users.user_id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneGuide($id)
    {
        $sql = "SELECT tour_guide.*, users.* FROM tour_guide LEFT JOIN users ON tour_guide.user_id = users.user_id WHERE tour_guide.user_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateGuide($full_name, $birthday, $phone, $email, $avatar, $gender, $languages, $rating, $experience_years, $certificates, $health, $notes, $id)
    {
        $sql = "UPDATE `tour_guide` LEFT JOIN `users` ON tour_guide.user_id = users.user_id SET `full_name`=:full_name,`birthday`=:birthday,`phone`=:phone,`email`=:email,`avatar`=:avatar,`gender`=:gender,`languages`=:languages,`rating`=:rating,`experience_years`=:experience_years,`certificates`=:certificates,`health`=:health,`notes`=:notes WHERE tour_guide.user_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':full_name' => $full_name,
            ':birthday' => $birthday,
            ':phone' => $phone,
            ':email' => $email,
            ':avatar' => $avatar,
            ':gender' => $gender,
            ':languages' => $languages,
            ':rating' => $rating,
            ':experience_years' => $experience_years,
            ':certificates' => $certificates,
            ':health' => $health,
            ':notes' => $notes,
            ':id' => $id,
        ]);
    }
    // Thêm để lấy user_id
    public function getByUserId($user_id)
    {
        $sql = "SELECT * FROM tour_guide WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
