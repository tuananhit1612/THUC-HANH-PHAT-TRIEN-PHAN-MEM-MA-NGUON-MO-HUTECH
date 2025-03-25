<?php include 'app/views/shares/header.php'; ?>
<h2>✏️ Sửa người dùng</h2>
<form method="POST" action="/webbanhang/Account/updateUser/<?= $user['id'] ?>">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Vai trò</label>
        <select name="role" class="form-select">
            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </div>
    <button class="btn btn-primary">Cập nhật</button>
</form>

<?php include 'app/views/shares/footer.php'; ?>