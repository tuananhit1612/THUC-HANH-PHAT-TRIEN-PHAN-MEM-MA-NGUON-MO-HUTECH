<?php

class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function addOrderDetail($orderId, $productId, $quantity, $price) {
        $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function createOrder($accountId, $name, $phone, $address) {
        $stmt = $this->db->prepare("INSERT INTO orders (account_id, name, phone, address, created_at) VALUES (:account_id, :name, :phone, :address, NOW())");
        $stmt->bindParam(":account_id", $accountId, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function getOrdersByUser($userId) {
        $sql = "SELECT * FROM orders WHERE account_id = :account_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':account_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
