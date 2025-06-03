<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/SessionHelper.php');

class AccountController
{
    private $accountModel;
    private $db;

    private function isAdmin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    }

    private function isLoggedIn()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['username']);
    }

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
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
            $role = $_POST['role'] ?? 'user';
            $errors = [];
            if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";
            if (!in_array($role, ['admin', 'user'])) $role = 'user';
            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $result = $this->accountModel->save(
                    $username,
                    $fullName,
                    $password,
                    $role
                );
                if ($result) {
                    header('Location: /webbanhang/account/login');
                    exit;
                }
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        session_destroy();
        header('Location: /webbanhang/product');
        exit;
    }
    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account && password_verify($password, $account->password)) {
                $_SESSION['username'] = $account->username;
                $_SESSION['role'] = $account->role;
                header('Location: /webbanhang/product');
                exit;
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản!";
                include_once 'app/views/account/login.php';
                exit;
            }
        }
    }
    public function authorize()
    {
        include_once 'app/views/account/authorize.php';
    }

    public function profile()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }
        
        $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
        include_once 'app/views/account/profile.php';
    }

    public function updateProfile()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            $errors = [];
            $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
            
            if (empty($fullname)) {
                $errors[] = "Vui lòng nhập họ và tên!";
            }
            
            if (empty($currentPassword)) {
                $errors[] = "Vui lòng nhập mật khẩu hiện tại!";
            } elseif (!password_verify($currentPassword, $user->password)) {
                $errors[] = "Mật khẩu hiện tại không đúng!";
            }
            
            if (!empty($newPassword)) {
                if (strlen($newPassword) < 6) {
                    $errors[] = "Mật khẩu mới phải có ít nhất 6 ký tự!";
                }
                if ($newPassword !== $confirmPassword) {
                    $errors[] = "Mật khẩu mới và xác nhận không khớp!";
                }
            }
            
            if (count($errors) > 0) {
                include_once 'app/views/account/profile.php';
            } else {
                $updatePassword = !empty($newPassword);
                $result = $this->accountModel->updateProfile(
                    $_SESSION['username'],
                    $fullname,
                    $updatePassword ? $newPassword : null
                );
                
                if ($result) {
                    $success = "Cập nhật thông tin thành công!";
                    $user = $this->accountModel->getAccountByUsername($_SESSION['username']);
                } else {
                    $errors[] = "Có lỗi xảy ra khi cập nhật thông tin!";
                }
                include_once 'app/views/account/profile.php';
            }
        }
    }

    public function admin()
    {
        SessionHelper::requireAdmin();
        
        // Load additional models for admin dashboard
        require_once('app/models/ProductModel.php');
        require_once('app/models/CategoryModel.php');
        
        $productModel = new ProductModel($this->db);
        $categoryModel = new CategoryModel($this->db);
        
        // Get data for dashboard
        $products = $productModel->getProducts();
        $categories = $categoryModel->getCategories();
        $users = $this->getAllUsers();
        
        include_once 'app/views/account/admin.php';
    }
    
    private function getAllUsers()
    {
        $query = "SELECT username, fullname, role, created_at FROM account ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
