<?php
// API Routes
if (strpos($_SERVER['REQUEST_URI'], '/webbanhang/api/') === 0) {
    $uri = str_replace('/webbanhang/api/', '', $_SERVER['REQUEST_URI']);
    $uriParts = explode('/', $uri);
    
    switch ($uriParts[0]) {
        case 'product':
            require_once('app/controllers/ProductApiController.php');
            $controller = new ProductApiController();
            
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (isset($uriParts[1]) && is_numeric($uriParts[1])) {
                    $controller->show($uriParts[1]);
                } else {
                    $controller->index();
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                $controller->update($uriParts[1]);
            } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $controller->destroy($uriParts[1]);
            }
            exit;
            
        case 'category':
            require_once('app/controllers/CategoryApiController.php');
            $controller = new CategoryApiController();
            
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller->index();
            }
            exit;
    }
}
?>
