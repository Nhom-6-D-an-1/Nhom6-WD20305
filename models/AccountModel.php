<?php
class AccountModel extends BaseModel
{

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

        $stmt->execute([
            ':full_name' => $data['full_name'],
            ':user_name' => $data['user_name'],
            ':password_hash'  => $data['password_hash'],
            ':role'      => $data['role'],
        ]);

        $newUserId = $this->conn->lastInsertId();
        if ($data['role'] === 'guide') {
            $sqlGuide = "INSERT INTO `tour_guide` (user_id) VALUES (:user_id)";
            $stmtGuide = $this->conn->prepare($sqlGuide);
            $stmtGuide->execute([
                ':user_id' => $newUserId
            ]);
        }
    }

    public function deleteAccount($id)
    {
        $sqlGuide = "DELETE FROM tour_guide WHERE user_id = :user_id";
        $stmtGuide = $this->conn->prepare($sqlGuide);
        $stmtGuide->bindParam(':user_id', $id);
        $stmtGuide->execute();

        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->execute();
    }

    // Lấy tài khoản theo ID
    public function getAccountById($id)
    {
        $sql = "SELECT user_id, full_name, username, role 
                FROM users 
                WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //  Thêm hàm kiểm tra username trùng nhưng bỏ qua user hiện tại
    public function checkDuplicateUsername($username, $id)
    {
        $sql = "SELECT user_id FROM users 
                WHERE username = :username AND user_id != :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // Có row = trùng username
    }

    // Cập nhật tài khoản
    public function updateAccount($id, $data)
    {
        // Nếu có password mới, cập nhật luôn, ngược lại giữ nguyên
        if (!empty($data['password_hash'])) {
            $sql = "UPDATE users 
                    SET full_name = :full_name, 
                        username = :username, 
                        password_hash = :password_hash, 
                        role = :role 
                    WHERE user_id = :user_id";

            $params = [
                ':full_name' => $data['full_name'],
                ':username' => $data['username'],
                ':password_hash' => $data['password_hash'],
                ':role' => $data['role'],
                ':user_id' => (int)$id
            ];
        } else {
            $sql = "UPDATE users 
                    SET full_name = :full_name, 
                        username = :username, 
                        role = :role 
                    WHERE user_id = :user_id";

            $params = [
                ':full_name' => $data['full_name'],
                ':username' => $data['username'],
                ':role' => $data['role'],
                ':user_id' => (int)$id
            ];
        }

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function updateUserName($id, $full_name)
    {
        $sql = "UPDATE users SET full_name = :full_name WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':full_name' => $full_name,
            ':id' => $id
        ]);
    }

}
