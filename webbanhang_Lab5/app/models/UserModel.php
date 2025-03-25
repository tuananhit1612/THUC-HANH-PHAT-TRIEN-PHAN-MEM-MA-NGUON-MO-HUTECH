<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy thông tin user theo account_id
    public function getUserByAccountId($accountId) {
        $stmt = $this->db->prepare("SELECT name, phone, address FROM users WHERE account_id = :account_id");
        $stmt->bindParam(":account_id", $accountId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật hoặc thêm user
    public function saveOrUpdateUser($accountId, $name, $phone, $address) {
        $user = $this->getUserByAccountId($accountId);
        
        if ($user) {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, phone = :phone, address = :address WHERE account_id = :account_id");
        } else {
            $stmt = $this->db->prepare("INSERT INTO users (account_id, name, phone, address) VALUES (:account_id, :name, :phone, :address)");
        }

        $stmt->bindParam(":account_id", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
