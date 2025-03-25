<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Danh sách sản phẩm</h1>

    <!-- Tìm kiếm sản phẩm -->
    <form method="GET" action="/webbanhang/Product/index" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm sản phẩm..." 
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <button type="submit" class="btn btn-primary btn-sm">🔍</button>
    </form>

    
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100 border-0 rounded-3">
                        <?php if (!empty($product->image)): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 class="card-img-top p-2" 
                                 alt="Product Image" 
                                 style="height: 200px; object-fit: cover; border-radius: 15px;">
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" 
                                   class="text-decoration-none text-dark fw-bold">
                                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h5>
                            <p class="text-muted small">
                                <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="fw-bold text-danger fs-5">
                                <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND
                            </p>
                            <div class="d-flex justify-content-between mt-3">
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                                   class="btn btn-primary btn-sm flex-grow-1 rounded-pill d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Không tìm thấy sản phẩm nào.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
