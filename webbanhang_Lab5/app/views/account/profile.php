<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h2>👤 Hồ sơ cá nhân</h2>

    <div class="card mb-4 p-3">
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Vai trò:</strong> <?= $user['role'] == 'admin' ? '👑 Admin' : '👤 User' ?></p>
    </div>

    <div class="card mb-4 p-3">
        <h5>💸 Tổng tiền đã chi: 
            <span class="text-success"><?= number_format($totalSpent, 0, ',', '.') ?> VND</span>
        </h5>
    </div>

    <div class="mb-4">
        <h4>📦 Lịch sử đơn hàng</h4>
        <?php if ($orders): ?>
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['id'] ?></td>
                            <td><?= $order['created_at'] ?></td>
                            <td><?= $order['status'] ?></td>
                            <td>
                                <a href="/webbanhang/Order/details/<?= $order['id'] ?>" class="btn btn-sm btn-primary">Xem</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Bạn chưa có đơn hàng nào.</p>
        <?php endif; ?>
    </div>

    <div class="card p-3">
        <h4>🔑 Đổi mật khẩu</h4>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="/webbanhang/Account/changePassword">
            <div class="mb-2">
                <label>Mật khẩu hiện tại:</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Mật khẩu mới:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Xác nhận mật khẩu:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button class="btn btn-warning">Cập nhật</button>
        </form>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
