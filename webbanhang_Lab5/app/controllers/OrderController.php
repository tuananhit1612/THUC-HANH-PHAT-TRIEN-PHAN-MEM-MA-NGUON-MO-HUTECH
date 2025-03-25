<?php

require_once('app/config/database.php');
require_once('app/models/UserModel.php');
require_once('app/models/OrderModel.php');
require_once('app/helpers/SessionHelper.php');


class OrderController {
    private $db;
    private $orderModel;
    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
    }
    public function checkout() {
        $userData = [
            'name' => '',
            'phone' => '',
            'address' => ''
        ];

        if (SessionHelper::isLoggedIn()) {
            $accountId = $_SESSION['id'];
            $userModel = new UserModel($this->db);
            $userData = $userModel->getUserByAccountId($accountId) ?? $userData;
        }

        include 'app/views/product/checkout.php';
    }
    public function processCheckout() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];

            if (SessionHelper::isLoggedIn()) {
                $accountId = $_SESSION['id'];
                $userModel = new UserModel($this->db);
                $userModel->saveOrUpdateUser($accountId, $name, $phone, $address);
            } else {
                die("Bạn cần đăng nhập để đặt hàng.");
            }

            // Lấy giỏ hàng từ session
            $cart = $_SESSION['cart'] ?? [];

            if (empty($cart)) {
                die("Giỏ hàng trống. Không thể đặt hàng.");
            }

            // Tạo đơn hàng
            $orderId = $this->orderModel->createOrder($accountId, $name, $phone, $address);
            if ($orderId) {
                foreach ($cart as $productId => $item) {
                    $this->orderModel->addOrderDetail($orderId, $productId, $item['quantity'], $item['price']);
                }
                unset($_SESSION['cart']);
                header("Location: /webbanhang/order/orderConfirmation");
                exit();
            }
            else {
                die("Không thể tạo đơn hàng.");
            }
        }
    }
    public function createOrder($accountId, $name, $phone, $address)
    {
        $query = "INSERT INTO orders (account_id, name, phone, address) 
                VALUES (:account_id, :name, :phone, :address)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':account_id', $accountId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // ✅ trả về ID đơn hàng vừa tạo
        }

        return false;
    }

    public function addOrderDetail($orderId, $productId, $quantity, $price)
    {
        $query = "INSERT INTO order_details (order_id, product_id, quantity, price)
                VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Lấy danh sách đơn hàng
    public function list()
    {
        try {
            $query = "SELECT * FROM orders ORDER BY created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }

        include 'app/views/Order/list.php';

    }
    public function userOrders() {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /webbanhang/account/login");
            exit;
        }

        $accountId = $_SESSION['id'];
        $orders = $this->orderModel->getOrdersByUser($accountId);

        include 'app/views/order/orderStatus.php';
    }
    // Cập nhật trạng thái đơn hàng
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
            $orderId = $_POST['order_id'];
            $newStatus = $_POST['status'];

            try {
                $query = "UPDATE orders SET status = :status WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':status', $newStatus, PDO::PARAM_STR);
                $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
                $stmt->execute();

                header("Location: /webbanhang/Order/list");
                exit();
            } catch (PDOException $e) {
                die("Lỗi cập nhật trạng thái: " . $e->getMessage());
            }
        } else {
            die("Dữ liệu không hợp lệ.");
        }
    }
    public function details($id)
{
    if (!isset($_SESSION['id'])) {
        header("Location: /webbanhang/account/login");
        exit;
    }

    try {
        // Lấy đơn hàng
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$order) {
            die("Đơn hàng không tồn tại.");
        }

        $currentUserId = $_SESSION['id'];
        $currentUserRole = $_SESSION['role'];

        // ✅ Kiểm tra nếu user thì chỉ xem được đơn hàng của chính họ
        if ($currentUserRole !== 'admin' && $order->account_id != $currentUserId) {
            die("Bạn không có quyền xem đơn hàng này.");
        }

        // Lấy chi tiết đơn hàng
        $query = "SELECT order_details.*, product.name AS product_name, product.image 
                  FROM order_details 
                  JOIN product ON order_details.product_id = product.id 
                  WHERE order_details.order_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $orderDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        die("Lỗi truy vấn: " . $e->getMessage());
    }

    include 'app/views/Order/details.php';
}
    

public function delete($id)
{
    try {
        // Xóa chi tiết đơn hàng trước
        $query = "DELETE FROM order_details WHERE order_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Xóa đơn hàng
        $query = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /webbanhang/Order/list");
        exit();

    } catch (PDOException $e) {
        die("Lỗi xóa đơn hàng: " . $e->getMessage());
    }
}
    public function orderConfirmation()
    {
        include 'app/views/product/orderConfirmation.php';

    }
}
?>
