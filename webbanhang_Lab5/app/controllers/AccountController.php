<?php

require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function register()
    {
        include_once 'app/views/account/register.php';
    }

    public function login()
    {
        include_once 'app/views/account/login.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';

            $errors = [];

            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập Username!";
            }
            if (empty($fullName)) {
                $errors['fullname'] = "Vui lòng nhập Full Name!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập Password!";
            }
            if ($password !== $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu và xác nhận chưa đúng";
            }

            // Kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username);

            if ($account) {
                $errors['account'] = "Tài khoản này đã có người đăng ký!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password);

                if ($result) {
                    header('Location: /webbanhang/account/login');
                    exit;
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /webbanhang/product');
        exit;
    }
    public function dashbroad()
    {

        if (!isset($_SESSION['id'])) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if ($_SESSION['role'] !== 'admin') {
            echo "Bạn không có quyền truy cập trang này!";
            exit;
        }

        $growth = 65;
        $newUsers = $this->accountModel->countNewUsersInMonth();
        $profit = $this->accountModel->getTotalRevenue();

        include_once 'app/views/account/dashboard.php';
    }
    public function manageUsers()
    {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
            echo "Bạn không có quyền truy cập.";
            exit;
        }

        $users = $this->accountModel->getAllAccounts();

        include 'app/views/account/manageUsers.php';
    }
    public function addUserForm() {
        include 'app/views/account/addUser.php';
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // ✅ Mã hoá mật khẩu tại controller
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $this->accountModel->addAccount($username, $hashedPassword, $role);
            header('Location: /webbanhang/Account/manageUsers');
            exit;
        }
    }


    public function editUserForm($id) {
        $user = $this->accountModel->getAccountById($id);
        include 'app/views/account/editUser.php';
    }

    public function updateUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $role = $_POST['role'];

            $this->accountModel->updateAccount($id, $username, $role);
            header('Location: /webbanhang/Account/manageUsers');
            exit;
        }
    }

    public function deleteUser($id) {
        $this->accountModel->deleteAccount($id);
        header('Location: /webbanhang/Account/manageUsers');
        exit;
    }

    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $pwd_hashed = $account->password;
                
                if (password_verify($password, $pwd_hashed)) {
                    session_start();
                    $_SESSION['id'] = $account->id;
                    $_SESSION['username'] = $account->username;
                    $_SESSION['role'] = $account->role;
                    
                    header('Location: /webbanhang/product');
                    exit;
                } else {
                    echo "Mật khẩu không chính xác.";
                }
            } else {
                echo "Lỗi: Không tìm thấy tài khoản.";
            }
        }
    }
    // Hiển thị form nhập username
    public function forgotPasswordForm() {
        include 'app/views/account/forgotPassword.php';
    }

    // Kiểm tra username, nếu đúng thì hiển thị form đặt lại mật khẩu
    public function verifyUsername() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $user = $this->accountModel->getAccountByUsername($username);

            if ($user) {
                header('Location: /webbanhang/Account/resetPasswordForm/' . $user->id);
                exit;
            } else {
                $error = "Không tìm thấy tài khoản!";
                include 'app/views/account/forgotPassword.php';
            }
        }
    }

    // Hiển thị form đặt lại mật khẩu
    public function resetPasswordForm($id) {
        $user = $this->accountModel->getAccountById($id);
        if (!$user) {
            echo "Tài khoản không tồn tại!";
            exit;
        }
        include 'app/views/account/resetPassword.php';
    }

    // Cập nhật mật khẩu mới (sau xác minh)
    public function updatePassword($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPass = $_POST['password'];
            $confirm = $_POST['confirm'];

            if ($newPass !== $confirm) {
                $error = "Mật khẩu xác nhận không khớp!";
                $user = $this->accountModel->getAccountById($id);
                include 'app/views/account/resetPassword.php';
                return;
            }

            $hashed = password_hash($newPass, PASSWORD_BCRYPT);
            $this->accountModel->updatePassword($id, $hashed);

            echo "<script>alert('Đặt lại mật khẩu thành công!');window.location.href='/webbanhang/account/login';</script>";
            exit;
        }
    }
    public function profile() {
    if (!isset($_SESSION['id'])) {
        header("Location: /webbanhang/account/login");
        exit;
    }

    $userId = $_SESSION['id'];
    $user = $this->accountModel->getAccountById($userId);

    // Lấy đơn hàng của user
    $orders = $this->accountModel->getOrdersByUser($userId);

    // Tính tổng chi
    $totalSpent = $this->accountModel->getTotalSpentByUser($userId);

    include 'app/views/account/profile.php';
}

public function changePassword() {
    if (!isset($_SESSION['id'])) {
        header("Location: /webbanhang/account/login");
        exit;
    }

    $userId = $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $current = $_POST['current_password'];
        $new = $_POST['new_password'];
        $confirm = $_POST['confirm_password'];

        $account = $this->accountModel->getAccountById($userId);

        if (!password_verify($current, $account['password'])) {
            $error = "Mật khẩu hiện tại không đúng.";
        } elseif ($new !== $confirm) {
            $error = "Mật khẩu xác nhận không khớp.";
        } else {
            $hashed = password_hash($new, PASSWORD_BCRYPT);
            $this->accountModel->updatePassword($userId, $hashed);
            $success = "Đổi mật khẩu thành công!";
        }
    }

    $user = $this->accountModel->getAccountById($userId);
    $orders = $this->accountModel->getOrdersByUser($userId);
    $totalSpent = $this->accountModel->getTotalSpentByUser($userId);

    include 'app/views/account/profile.php';
}


}
