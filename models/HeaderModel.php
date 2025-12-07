<?php
class HeaderModel
{
    private $conn;
    public function __construct()
    {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }
    public function getNameUser($username)  {
        $sql = 'SELECT full_name FROM users WHERE username = :username LIMIT 1';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
}
