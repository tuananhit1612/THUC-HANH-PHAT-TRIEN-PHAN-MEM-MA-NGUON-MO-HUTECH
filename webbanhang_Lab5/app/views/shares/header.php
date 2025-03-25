<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">TTA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/index">Danh sách sản phẩm</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Order/userOrders">Trạng Thái Đơn Hàng</a>
                </li>


                <?php if (SessionHelper::isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin'): ?>
                    <li><a class="nav-link" href="/webbanhang/Account/dashbroad">Dashboard</a></li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/cart">Giỏ Hàng</a>
                </li>
                <?php if (SessionHelper::isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Account/profile"><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">

    <!-- Bootstrap JS & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
