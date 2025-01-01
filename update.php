<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['id']) ? (int)$_POST['id'] : null;

    if ($productId === null) {
        echo json_encode(['error' => 'Product ID is missing']);
        exit;
    }

    // Process the form data (e.g., update the product in the database)
    // For example:
    $dataFile = './db/products.json';
    $products = json_decode(file_get_contents($dataFile), true);

    if (!isset($products[$productId])) {
        echo json_encode(['error' => 'Product not found']);
        exit;
    }

    // Update product data
    $products[$productId]['name'] = $_POST['name'];
    $products[$productId]['description'] = $_POST['description'];
    $products[$productId]['price'] = $_POST['price'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = './Assets/images/' . basename($_FILES['image']['name']);
	$pathToSave= 'images/';
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $products[$productId]['image'] = $pathToSave . basename($_FILES['image']['name']);
    }

    // Save updated data
    file_put_contents($dataFile, json_encode($products, JSON_PRETTY_PRINT));

    echo json_encode(['success' => 'Product updated successfully']);
}
?>
