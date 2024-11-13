<?php
$products = [];
function addProduct($name, $price, $quantity) {
    global $products;
    $products[] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
}
function displayProducts($products) {
    foreach ($products as $product) {
        echo "<p>{$product['name']} - {$product['price']} VND - Số lượng: {$product['quantity']}</p>";
    }
}
function searchProduct($products, $keyword) {
    return array_filter($products, fn($product) => stripos($product['name'], $keyword) !== false);
}
function sortProductsByName($products) {
    usort($products, fn($a, $b) => strcmp($a['name'], $b['name']));
    return $products;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        addProduct($_POST['product_name'], $_POST['product_price'], $_POST['product_quantity']);
    } elseif (isset($_POST['search_product'])) {
        $products = searchProduct($products, $_POST['search_keyword']);
    } elseif (isset($_POST['sort_product'])) {
        $products = sortProductsByName($products);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Quản lý sản phẩm</h1>
<form method="POST">
    <input type="text" name="product_name" placeholder="Tên sản phẩm" required>
    <input type="number" name="product_price" placeholder="Giá" required>
    <input type="number" name="product_quantity" placeholder="Số lượng" required>
    <button type="submit" name="add_product">Thêm sản phẩm</button>
</form>
<form method="POST">
    <input type="text" name="search_keyword" placeholder="Tìm kiếm sản phẩm">
    <button type="submit" name="search_product">Tìm kiếm</button>
</form>
<form method="POST">
    <button type="submit" name="sort_product">Sắp xếp sản phẩm</button>
</form>
<h2>Danh sách sản phẩm</h2>
<?php displayProducts($products); ?>

</body>
</html>
