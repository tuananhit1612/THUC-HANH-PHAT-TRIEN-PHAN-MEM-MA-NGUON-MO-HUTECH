<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script>
        function validateForm() {
            let name = document.getElementById('name').value;
            let price = document.getElementById('price').value;
            let errorContainer = document.getElementById('error-messages');
            let errors = [];

            // Validate name length
            if (name.length < 10 || name.length > 100) {
                errors.push('Tên sản phẩm phải có từ 10 đến 100 ký tự.');
            }

            // Validate price (positive number)
            if (price <= 0 || isNaN(price)) {
                errors.push('Giá phải là một số dương lớn hơn 0.');
            }

            // Display error messages
            if (errors.length > 0) {
                errorContainer.innerHTML = '<div class="alert alert-danger"><ul><li>' + errors.join('</li><li>') + '</li></ul></div>';
                return false;  // Prevent form submission
            }

            return true;  // Allow form submission if no errors
        }
    </script>
</head>
<body class="container mt-5">

    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary">Thêm sản phẩm mới</h2>
        <h5 class="text-center text-warning">🔥Trần Tuấn Anh🔥</h5>
        
        <!-- Display validation errors -->
        <div id="error-messages"></div>

        <form method="POST" action="/Lab1/Product/add" onsubmit="return validateForm();">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá:</label>
                <input type="number" id="price" name="price" step="0.01" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Thêm sản phẩm</button>
        </form>
        
        <!-- Link to go back to the product list -->
        <div class="text-center mt-3">
            <a href="/Lab1/Product/list" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
        </div>
    </div>

    <!-- Thêm Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
