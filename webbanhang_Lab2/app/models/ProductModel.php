<?php

class ProductModel {
    private $conn;
    private $table_name = "product";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProducts() {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN category c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductById($id)
{
    $query = "SELECT p.*, COALESCE(c.name, 'Không có danh mục') AS category_name 
              FROM " . $this->table_name . " p 
              LEFT JOIN category c ON p.category_id = c.id
              WHERE p.id = :id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_OBJ);
}


    public function addProduct($name, $description, $price, $category_id, $image) {
        $errors = [];
        
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) 
                  VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', htmlspecialchars(strip_tags($name)));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($description)));
        $stmt->bindParam(':price', htmlspecialchars(strip_tags($price)));
        $stmt->bindParam(':category_id', htmlspecialchars(strip_tags($category_id)));
        $stmt->bindParam(':image', htmlspecialchars(strip_tags($image)));

        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $image) {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, description = :description, price = :price, category_id = :category_id, image = :image 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', htmlspecialchars(strip_tags($name)));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($description)));
        $stmt->bindParam(':price', htmlspecialchars(strip_tags($price)));
        $stmt->bindParam(':category_id', htmlspecialchars(strip_tags($category_id)));
        $stmt->bindParam(':image', htmlspecialchars(strip_tags($image)));

        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
