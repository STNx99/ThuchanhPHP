<?php

class DeliveryController
{
    public function status()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("
                SELECT o.*, 
                       COUNT(oi.id) as item_count,
                       COALESCE(o.customer_name, 'Khách hàng') as customer_name,
                       COALESCE(o.customer_phone, '') as customer_phone,
                       COALESCE(o.total_amount, 0) as total_amount,
                       COALESCE(o.status, 'pending') as status
                FROM orders o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                GROUP BY o.id
                ORDER BY o.created_at DESC
            ");
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Calculate total amounts for orders that don't have it set
            foreach ($orders as &$order) {
                if ($order['total_amount'] == 0) {
                    $itemStmt = $conn->prepare("
                        SELECT SUM(oi.price * oi.quantity) as total
                        FROM order_items oi
                        WHERE oi.order_id = :order_id
                    ");
                    $itemStmt->bindParam(':order_id', $order['id']);
                    $itemStmt->execute();
                    $result = $itemStmt->fetch(PDO::FETCH_ASSOC);
                    $order['total_amount'] = $result['total'] ?? 0;
                }
            }
            
            // Show the delivery status page with all orders
            include 'app/views/delivery/status.php';
            
        } catch (Exception $e) {
            // Log error and show error message
            error_log("Error loading orders: " . $e->getMessage());
            $orders = [];
            $error = "Có lỗi xảy ra khi tải danh sách đơn hàng. Vui lòng thử lại sau.";
            include 'app/views/delivery/status.php';
        }
    }

    public function trackOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /webbanhang/Delivery/status');
            exit;
        }

        $orderCode = trim($_POST['order_code'] ?? '');
        
        if (empty($orderCode)) {
            header('Location: /webbanhang/Delivery/status');
            exit;
        }

        try {
            // Get database connection
            $db = new Database();
            $conn = $db->getConnection();
            
            // Search for order by order code
            $stmt = $conn->prepare("
                SELECT o.*, 
                       COALESCE(o.customer_name, 'Khách hàng') as customer_name,
                       COALESCE(o.customer_phone, 'Chưa cập nhật') as customer_phone,
                       COALESCE(o.delivery_address, 'Chưa cập nhật') as delivery_address,
                       COALESCE(o.payment_method, 'cod') as payment_method,
                       COALESCE(o.total_amount, 0) as total_amount,
                       COALESCE(o.status, 'pending') as status,
                       o.created_at
                FROM orders o 
                WHERE o.order_code = :order_code
            ");
            $stmt->bindParam(':order_code', $orderCode);
            $stmt->execute();
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $orderItems = [];
            
            if ($order) {
                // Get order items with product details
                $stmt = $conn->prepare("
                    SELECT oi.*, p.name as product_name, p.image as product_image, p.price
                    FROM order_items oi
                    LEFT JOIN products p ON oi.product_id = p.id
                    WHERE oi.order_id = :order_id
                ");
                $stmt->bindParam(':order_id', $order['id']);
                $stmt->execute();
                $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Calculate total if not set
                if ($order['total_amount'] == 0 && !empty($orderItems)) {
                    $total = 0;
                    foreach ($orderItems as $item) {
                        $total += $item['price'] * $item['quantity'];
                    }
                    $order['total_amount'] = $total;
                }
            }
            
            // Include the view with data
            include 'app/views/delivery/status.php';
            
        } catch (Exception $e) {
            // Log error and show error message
            error_log("Error tracking order: " . $e->getMessage());
            $error = "Có lỗi xảy ra khi tra cứu đơn hàng. Vui lòng thử lại sau.";
            include 'app/views/delivery/status.php';
        }
    }

    public function updateStatus()
    {
        // This method can be used by admin to update order status
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('HTTP/1.0 405 Method Not Allowed');
            exit;
        }

        $orderId = $_POST['order_id'] ?? '';
        $newStatus = $_POST['status'] ?? '';
        
        if (empty($orderId) || empty($newStatus)) {
            echo json_encode(['success' => false, 'message' => 'Thiếu thông tin cần thiết']);
            exit;
        }

        try {
            $db = new Database();
            $conn = $db->getConnection();
            
            $stmt = $conn->prepare("UPDATE orders SET status = :status, updated_at = NOW() WHERE id = :id");
            $stmt->bindParam(':status', $newStatus);
            $stmt->bindParam(':id', $orderId);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không thể cập nhật trạng thái']);
            }
            
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi hệ thống: ' . $e->getMessage()]);
        }
    }

    public function getAllOrders()
    {
        // Method for admin to view all orders
        try {
            $db = new Database();
            $conn = $db->getConnection();
            
            $stmt = $conn->prepare("
                SELECT o.*, 
                       COUNT(oi.id) as item_count,
                       COALESCE(o.total_amount, 0) as total_amount
                FROM orders o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                GROUP BY o.id
                ORDER BY o.created_at DESC
            ");
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            include 'app/views/admin/orders.php';
            
        } catch (Exception $e) {
            error_log("Error getting orders: " . $e->getMessage());
            $error = "Có lỗi xảy ra khi tải danh sách đơn hàng.";
            $orders = [];
            include 'app/views/admin/orders.php';
        }
    }
}
