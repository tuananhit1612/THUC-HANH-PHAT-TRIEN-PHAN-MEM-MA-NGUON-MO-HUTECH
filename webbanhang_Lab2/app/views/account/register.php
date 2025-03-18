<?php include 'app/views/shares/header.php'; ?>

<?php
if (isset($errors)) {
    echo "<ul>";
    foreach ($errors as $err) {
        echo "<li class='text-danger'>$err</li>";
    }
    echo "</ul>";
}
?>

<div class="card-body p-5 text-center">
    <form class="user" action="/webbanhang/account/save" method="post">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="fullname" name="fullname" placeholder="Full Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-icon-split p-3">Register</button>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>
