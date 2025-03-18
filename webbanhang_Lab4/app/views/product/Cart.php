<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Giỏ hàng</h1>

    <?php if (!empty($cart)): ?>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($cart as $id => $item): ?>
                    <?php $subtotal = $item['price'] * $item['quantity']; ?>
                    <?php $total += $subtotal; ?>
                    <tr>
                        <td>
                            <?php if (!empty($item['image'])): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" 
                                     alt="Product Image" style="max-width: 80px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="/webbanhang/Product/decreaseQuantity/<?php echo $id; ?>" 
                               class="btn btn-outline-secondary btn-sm">-</a>
                            <span class="mx-2"> <?php echo $item['quantity']; ?> </span>
                            <a href="/webbanhang/Product/increaseQuantity/<?php echo $id; ?>" 
                               class="btn btn-outline-secondary btn-sm">+</a>
                        </td>
                        <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="text-end">Tổng tiền: <span class="text-danger fw-bold"><?php echo number_format($total, 0, ',', '.'); ?> VND</span></h4>

        <div class="d-flex justify-content-between mt-3">
            <a href="/webbanhang/Product/index" class="btn btn-secondary">Tiếp tục mua sắm</a>
            <?php if (SessionHelper::isLoggedIn()): ?>
                <a href="/webbanhang/Order  /checkout" class="btn btn-primary">Thanh Toán</a>
            <?php else: ?>
                <a href="/webbanhang/account/login" class="btn btn-warning"
                   onclick="return confirm('Bạn cần đăng nhập để thực hiện thanh toán. Chuyển đến trang đăng nhập?');">
                    Đăng nhập để Thanh Toán
                </a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Giỏ hàng của bạn đang trống.</p>
        <div class="text-center mt-3">
            <a href="/webbanhang/Product/index" class="btn btn-secondary">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>