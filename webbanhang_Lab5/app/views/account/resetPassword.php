<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-5">
    <h3>🔄 Đặt lại mật khẩu cho tài khoản <strong><?= htmlspecialchars($user['username']) ?></strong></h3>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="/webbanhang/Account/updatePassword/<?= $user['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="password">Mật khẩu mới:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm">Xác nhận mật khẩu:</label>
            <input type="password" name="confirm" class="form-control" required>
        </div>
        <button class="btn btn-success">Cập nhật mật khẩu</button>
    </form>
</div>


<?php include 'app/views/shares/footer.php'; ?>