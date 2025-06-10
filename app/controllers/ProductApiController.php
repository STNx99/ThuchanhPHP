<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
class ProductApiController
{
    private $productModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    // Lấy danh sách sản phẩm
    public function index()
    {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }
    // Lấy thông tin sản phẩm theo ID
    public function show($id)
    { 
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Product not found']);
        }
    }
    // Thêm sản phẩm mới
    public function store()
    {
        header('Content-Type: application/json');
        
        // Handle form data instead of JSON for file upload
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? '';
        $category_id = $_POST['category_id'] ?? null;
        
        $imagePath = null;
        
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($imageFileType, $allowedTypes)) {
                $fileName = uniqid() . '.' . $imageFileType;
                $imagePath = $uploadDir . $fileName;
                
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    http_response_code(400);
                    echo json_encode(['errors' => ['Image upload failed']]);
                    return;
                }
            } else {
                http_response_code(400);
                echo json_encode(['errors' => ['Invalid file type. Only JPG, JPEG, PNG & GIF allowed']]);
                return;
            }
        }
        
        $result = $this->productModel->addProduct($name, $description, $price, $category_id, $imagePath);
        
        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Product created successfully']);
        }
    }
    // Cập nhật sản phẩm theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        
        // Check if this is a multipart form (with file upload)
        if (isset($_POST['name'])) {
            // Handle form data with potential file upload
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            
            $imagePath = null;
            
            // Handle image upload if provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (in_array($imageFileType, $allowedTypes)) {
                    $fileName = uniqid() . '.' . $imageFileType;
                    $imagePath = $uploadDir . $fileName;
                    
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                        http_response_code(400);
                        echo json_encode(['errors' => ['Image upload failed']]);
                        return;
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['errors' => ['Invalid file type. Only JPG, JPEG, PNG & GIF allowed']]);
                    return;
                }
            }
        } else {
            // Handle JSON data (no file upload)
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';
            $price = $data['price'] ?? '';
            $category_id = $data['category_id'] ?? null;
            $imagePath = null;
        }
        
        $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $imagePath);
        
        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else if ($result) {
            echo json_encode(['message' => 'Product updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product update failed']);
        }
    }
    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $result = $this->productModel->deleteProduct($id);
        if ($result) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product deletion failed']);
        }
    }
}?>