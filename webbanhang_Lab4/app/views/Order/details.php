<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Chi tiết đơn hàng #<?php echo $order->id; ?></h1>

    <div class="card p-3 mb-3">
        <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($order->name, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order->phone, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order->address, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Ngày đặt hàng:</strong> <?php echo $order->created_at; ?></p>
    </div>

    <h3>Sản phẩm đã đặt:</h3>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($orderDetails as $item): ?>
                <?php $subtotal = $item->quantity * $item->price; ?>
                <?php $total += $subtotal; ?>
                <tr>
                    <td>
                        <img src="/webbanhang/<?php echo htmlspecialchars($item->image, ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="Product Image" style="max-width: 80px;">
                    </td>
                    <td><?php echo htmlspecialchars($item->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $item->quantity; ?></td>
                    <td><?php echo number_format($item->price, 0, ',', '.'); ?> VND</td>
                    <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="text-end">Tổng tiền: <span class="text-danger fw-bold"><?php echo number_format($total, 0, ',', '.'); ?> VND</span></h4>

    <div class="d-flex justify-content-between mt-3">
        <a href="/webbanhang/Order/list" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
