<?php include 'app/views/shares/header.php'; ?>
<a href="/webbanhang/Account/addUserForm" class="btn btn-success mb-3">➕ Thêm người dùng</a>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Vai trò</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td>
                <a href="/webbanhang/Account/editUserForm/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a href="/webbanhang/Account/deleteUser/<?= $user['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'app/views/shares/footer.php'; ?>
