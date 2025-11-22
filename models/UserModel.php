<?php
class UserModel {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function checkLogin($username) {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
