<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trạng Thái Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include 'app/views/shares/header.php'; ?>
    
    <div class="container mt-5">
        <h2 class="text-center mb-4">🛍️ Trạng Thái Đơn Hàng</h2>

        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Người nhận</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th> Hành Động </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="fw-bold">#<?php echo $order['id']; ?></td>
                                <td><?php echo htmlspecialchars($order['name']); ?></td>
                                <td><?php echo htmlspecialchars($order['phone']); ?></td>
                                <td><?php echo htmlspecialchars($order['address']); ?></td>
                                <td>
                                    <?php 
                                        $status_classes = [
                                            'Chờ xử lý' => 'warning', 
                                            'Đang giao' => 'primary', 
                                            'Hoàn thành' => 'success', 
                                            'Đã hủy' => 'danger'
                                        ];
                                        $status_icons = [
                                            'Chờ xử lý' => '⏳',
                                            'Đang giao' => '🚚',
                                            'Hoàn thành' => '✅',
                                            'Đã hủy' => '❌'
                                        ];
                                    ?>
                                    <span class="badge bg-<?php echo $status_classes[$order['status']]; ?>">
                                        <?php echo $status_icons[$order['status']] . ' ' . $order['status']; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                <td><a href="/webbanhang/Order/details/<?php echo $order['id']; ?>" class="btn btn-sm btn-primary">Xem chi tiết</a>
</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center" role="alert">
                <h4 class="alert-heading">🛒 Bạn chưa có đơn hàng nào!</h4>
                <p>Hãy đặt hàng ngay để tận hưởng những ưu đãi hấp dẫn.</p>
                <a href="/webbanhang/Product/index" class="btn btn-secondary mt-3">Tiếp tục mua sắm</a>
            </div>
        <?php endif; ?>
    </div>
    
    <?php include 'app/views/shares/footer.php'; ?>
</body>
</html>