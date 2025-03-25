<?php include 'app/views/shares/header.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="text-center mb-4">
        <h1 class="display-5">📊 Dashboard Quản Trị Bán Hàng</h1>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $growth; ?>%</h2>
                    <p class="card-text">Tăng trưởng</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $newUsers; ?></h2>
                    <p class="card-text">Người dùng mới</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h2 class="card-title"><?php echo number_format($profit); ?>đ</h2>
                    <p class="card-text">Lợi nhuận</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Các chức năng quản lý (Flash Cards) -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <a href="/webbanhang/Product/manage" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center h-100">
                        <div class="card-body">
                            <h3 class="card-title">📦</h3>
                            <p class="card-text fw-bold">Quản Lý Sản Phẩm</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/webbanhang/Product/add" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center h-100">
                        <div class="card-body">
                            <h3 class="card-title">➕</h3>
                            <p class="card-text fw-bold">Thêm Sản Phẩm</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/webbanhang/Order/list" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center h-100">
                        <div class="card-body">
                            <h3 class="card-title">🧾</h3>
                            <p class="card-text fw-bold">Quản Lý Đơn Hàng</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/webbanhang/Account/manageUsers" class="text-decoration-none text-dark">
                    <div class="card shadow-sm text-center h-100">
                        <div class="card-body">
                            <h3 class="card-title">👥</h3>
                            <p class="card-text fw-bold">Quản Lý Người Dùng</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'app/views/shares/footer.php'; ?>
