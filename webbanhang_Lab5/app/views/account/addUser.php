<?php include 'app/views/shares/header.php'; ?>
<h2>➕ Thêm người dùng</h2>
<form method="POST" action="/webbanhang/Account/addUser">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Vai trò</label>
        <select name="role" class="form-select">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button class="btn btn-success">Thêm</button>
</form>
<?php include 'app/views/shares/footer.php'; ?>