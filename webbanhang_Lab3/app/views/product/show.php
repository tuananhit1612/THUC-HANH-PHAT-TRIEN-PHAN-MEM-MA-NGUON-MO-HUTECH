<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4 d-flex justify-content-center">
    <div class="card text-center" style="max-width: 600px; width: 100%;">
        <?php if ($product->image): ?>
            <img src="/webbanhang/<?php echo $product->image; ?>" class="card-img-top img-fluid mx-auto d-block w-50" alt="Product Image">
        <?php endif; ?>
        <div class="card-body">
            <h2 class="card-title"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="card-text"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="fw-bold text-primary">Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
            <p class="text-muted">Danh mục: <strong><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></strong></p>
            <a href="/webbanhang/Product/list" class="btn btn-secondary">Quay lại</a>
            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                               class="btn btn-primary btn-sm flex-grow-1 rounded-pill d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
            </a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
