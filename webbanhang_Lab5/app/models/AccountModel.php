<?php

class AccountModel {
    private $conn;
    private $table_name = "account";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAccountByUsername($username)
    {
        $query = "SELECT * FROM account WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function countNewUsersInMonth() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM account WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalOrders() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM orders");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    // Lấy tất cả tài khoản
    public function getAllAccounts() {
        $stmt = $this->conn->prepare("SELECT id, username, role, created_at FROM account ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin 1 tài khoản
    public function getAccountById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm tài khoản mới
    public function addAccount($username, $password, $role) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO account (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    // Cập nhật tài khoản
    public function updateAccount($id, $username, $role) {
        $stmt = $this->conn->prepare("UPDATE account SET username = :username, role = :role WHERE id = :id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Xoá tài khoản
    public function deleteAccount($id) {
        $stmt = $this->conn->prepare("DELETE FROM account WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getTotalRevenue() {
        $stmt = $this->conn->prepare("
            SELECT SUM(od.quantity * od.price) AS total
            FROM order_details od
            JOIN orders o ON o.id = od.order_id
            WHERE o.status = 'Hoàn thành'
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public function save($username, $name, $password, $role = "user")
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->conn->prepare($query);
        
        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $username = htmlspecialchars(strip_tags($username));
        
        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        
        // Thực thi câu lệnh
        return $stmt->execute();
    }
    public function updatePassword($id, $hashedPassword) {
        $stmt = $this->conn->prepare("UPDATE account SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    // Lấy danh sách đơn hàng theo user
    public function getOrdersByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE account_id = :account_id ORDER BY created_at DESC");
        $stmt->bindParam(':account_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tính tổng tiền đã chi
    public function getTotalSpentByUser($userId) {
        $stmt = $this->conn->prepare("
            SELECT SUM(od.quantity * od.price) AS total
            FROM order_details od
            JOIN orders o ON o.id = od.order_id
            WHERE o.account_id = :userId AND o.status = 'Hoàn thành'
        ");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }


}
