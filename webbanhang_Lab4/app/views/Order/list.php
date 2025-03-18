<?php include 'app/views/shares/header.php'; ?>
<?php
if (!SessionHelper::isLoggedIn() || ($_SESSION['role'] ?? '') !== 'admin') {
    echo '<div class="container mt-4">
            <div class="alert alert-danger" role="alert">
                <strong>Bạn không có quyền truy cập!</strong> Chỉ admin mới có thể quản lý đơn hàng.
            </div>
            <a href="/webbanhang" class="btn btn-primary">Quay về trang chủ</a>
          </div>';
    include 'app/views/shares/footer.php';
    exit();
}
?>
<div class="container mt-4">
    <h1 class="text-center">Quản lý đơn hàng</h1>

    <?php if (!empty($orders)): ?>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order->id; ?></td>
                        <td><?php echo htmlspecialchars($order->name, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($order->phone, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($order->address, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo $order->created_at; ?></td>
                        <td>
                            <form method="POST" action="/webbanhang/Order/updateStatus">
                                <input type="hidden" name="order_id" value="<?php echo $order->id; ?>">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="Chờ xử lý" <?php echo ($order->status == 'Chờ xử lý') ? 'selected' : ''; ?>>Chờ xử lý</option>
                                    <option value="Đang giao" <?php echo ($order->status == 'Đang giao') ? 'selected' : ''; ?>>Đang giao</option>
                                    <option value="Hoàn thành" <?php echo ($order->status == 'Hoàn thành') ? 'selected' : ''; ?>>Hoàn thành</option>
                                    <option value="Đã hủy" <?php echo ($order->status == 'Đã hủy') ? 'selected' : ''; ?>>Đã hủy</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="/webbanhang/Order/details/<?php echo $order->id; ?>" class="btn btn-primary btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                        <td>
                            <a href="/webbanhang/Order/delete/<?php echo $order->id; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>
