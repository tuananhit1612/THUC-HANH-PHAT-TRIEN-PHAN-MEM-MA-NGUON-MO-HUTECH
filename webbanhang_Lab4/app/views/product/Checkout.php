<?php 
include 'app/views/shares/header.php'; 
?>

<h1>Thanh toán</h1>

<form method="POST" action="/webbanhang/Order/processCheckout">
    <div class="form-group">
        <label for="name">Họ tên:</label>
        <input type="text" id="name" name="name" class="form-control" 
               value="<?= htmlspecialchars($userData['name'] ?? ''); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" class="form-control" 
               value="<?= htmlspecialchars($userData['phone'] ?? ''); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="address">Địa chỉ:</label>
        <textarea id="address" name="address" class="form-control" required><?= htmlspecialchars($userData['address'] ?? ''); ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Thanh toán</button>
</form>

<a href="/webbanhang/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ hàng</a>

<?php include 'app/views/shares/footer.php'; ?>
