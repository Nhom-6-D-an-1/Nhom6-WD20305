<?php

class TourImageModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }

    public function getImagesByVersion($version_id)
    {
        $sql = "SELECT * FROM tour_image WHERE version_id = :version_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['version_id' => $version_id]);
        return $stmt->fetch();
    }

    public function insertImage($version_id, $image_url)
    {
        $sql = "INSERT INTO tour_image (version_id, image_url)
                VALUES (:version_id, :image_url)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'version_id' => $version_id,
            'image_url' => $image_url
        ]);
    }

    public function updateImage($version_id, $image_url)
    {
        $sql = "UPDATE tour_image 
                SET image_url = :image_url
                WHERE version_id = :version_id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'version_id' => $version_id,
            'image_url' => $image_url
        ]);
    }

    public function deleteImage($image_id)
    {
        $sql = "DELETE FROM tour_image WHERE image_id = :image_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['image_id' => $image_id]);
    }
}
