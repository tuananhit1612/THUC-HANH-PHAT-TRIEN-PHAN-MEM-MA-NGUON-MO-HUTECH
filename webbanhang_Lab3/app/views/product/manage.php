<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Danh sách sản phẩm</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/webbanhang/Product/add" class="btn btn-success">Thêm sản phẩm mới</a>
    </div>
    
    <div class="row">
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
                            <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                               class="btn btn-warning btn-sm flex-grow-1 me-2 rounded-pill d-flex align-items-center justify-content-center">
                                <i class="bi bi-pencil-square me-1"></i> Sửa
                            </a>
                            <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" 
                               class="btn btn-danger btn-sm flex-grow-1 me-2 rounded-pill d-flex align-items-center justify-content-center" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                <i class="bi bi-trash me-1"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>