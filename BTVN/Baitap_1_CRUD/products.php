<?php
if (isset($_COOKIE['products'])) {
    $products = json_decode($_COOKIE['products'], true); // Giải mã JSON từ cookie
} else {
    // Nếu không có cookie, khởi tạo mảng sản phẩm mặc định
    $products = [
        ['id' => 1, 'name' => 'Sản phẩm 1', 'price' => '10000'],
        ['id' => 2, 'name' => 'Sản phẩm 2', 'price' => '20000'],
        ['id' => 3, 'name' => 'Sản phẩm 3', 'price' => '30000'],
        ['id' => 4, 'name' => 'Sản phẩm 4', 'price' => '22000'],
        ['id' => 5, 'name' => 'Sản phẩm 5', 'price' => '27000'],
    ];
}

// Xử lý khi có request POST (thêm, sửa, xóa sản phẩm)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null; // Lấy action từ form

    if ($action === "addProduct") { 
        $newProduct = [
            'id' => end($products)['id'] + 1,  
            'name' => $_POST['name'],
            'price' => $_POST['price']
        ];
        $products[] = $newProduct;  

    } else if ($action === "deleteProduct") {
        $products = array_filter($products, function ($product) {
            return $product['id'] != $_POST['id'];
        });
        $products = array_values($products);

    } else if ($action === "editProduct") {
        foreach ($products as &$product) {
            if ($product['id'] == $_POST['id']) {
                $product['name'] = $_POST['name'];
                $product['price'] = $_POST['price'];
            }
        }
    }
    else {
        echo "Không tìm thấy action nào";
    }

    setcookie('products', json_encode($products), time() + 3700, '/'); 

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
