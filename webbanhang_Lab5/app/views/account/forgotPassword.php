<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-5">
    <h3>🔐 Quên mật khẩu</h3>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="/webbanhang/Account/verifyUsername" method="POST">
        <div class="mb-3">
            <label for="username">Nhập tài khoản:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <button class="btn btn-primary">Tiếp tục</button>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>