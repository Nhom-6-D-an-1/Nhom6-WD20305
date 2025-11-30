<?php
class AccountModel extends BaseModel{

    public function __construct()
    {
        parent::__construct();
    }
    public function getAllAccounts()
    {
        $sql = "SELECT * FROM `users` ORDER BY user_id ASC;";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertAccount($data)
    {
    $sql = "INSERT INTO `users` (full_name, username, password_hash, role)
            VALUES (:full_name, :user_name, :password_hash, :role)";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':full_name' => $data['full_name'],
        ':user_name' => $data['user_name'],
        ':password_hash'  => $data['password_hash'],
        ':role'      => $data['role'],
        // ':status'    => $data['status'],
    ]);
    }
    public function deleteAccount($id)
    {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->execute();
    }

}
?>