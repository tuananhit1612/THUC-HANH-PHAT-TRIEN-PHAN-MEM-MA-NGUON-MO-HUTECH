<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Sửa sản phẩm</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow p-4">
        <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" class="form-control"
                       value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá:</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01"
                       value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục:</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="file" id="image" name="image" class="form-control">
                <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                
                <?php if ($product->image): ?>
                    <div class="mt-2">
                        <img src="/<?php echo $product->image; ?>" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Lưu thay đổi</button>
        </form>
    </div>

    <div class="text-center mt-3">
        <a href="/webbanhang/Product/index" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
