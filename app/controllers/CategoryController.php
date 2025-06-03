<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');
class CategoryController
{
    private $categoryModel;
    private $db;

    private function isAdmin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    }
    
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Default index method to display the list
    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    public function list()
    {
        if (!$this->isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    public function show($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/show.php';
        } else {
            echo "Không tìm thấy danh mục.";
        }
    }

    public function add()
    {
        if (!$this->isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
        include_once 'app/views/category/add.php';
    }

    public function save()
    {
        if (!$this->isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $result = $this->categoryModel->addCategory($name, $description);

            if (is_array($result)) {
                $errors = $result;
                include 'app/views/category/add.php';
            } else {
                header('Location: /webbanhang/category');
            }
        }
    }

    public function edit($id)
    {
        if (!$this->isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Không tìm thấy danh mục.";
        }
    }

    public function update()
    {
        if (!$this->isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];

            $edit = $this->categoryModel->updateCategory($id, $name, $description);
            if ($edit) {
                header('Location: /webbanhang/category');
            } else {
                echo "Đã xảy ra lỗi khi lưu danh mục.";
            }
        }
    }

    public function delete($id)
    {
        if (!$this->isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /webbanhang/category');
        } else {
            echo "Đã xảy ra lỗi khi xóa danh mục.";
        }
    }
}
