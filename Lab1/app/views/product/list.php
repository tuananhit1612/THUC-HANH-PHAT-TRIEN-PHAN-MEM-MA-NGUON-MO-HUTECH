<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary">Danh sách sản phẩm</h2>
        <h5 class="text-center text-warning">🔥Trần Tuấn Anh🔥</h5>


        <div class="text-end mb-3">
            <a href="/Lab1/Product/add" class="btn btn-success">➕ Thêm sản phẩm mới</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product->getID(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>₫</td>
                        <td>
                            <a href="/Lab1/Product/edit/<?php echo $product->getID(); ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                            <a href="/Lab1/Product/delete/<?php echo $product->getID(); ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">🗑️ Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Thêm Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
