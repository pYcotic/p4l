<!DOCTYPE html>
<html>
	<head>
		<title>P4L - code test</title>
		<link rel="stylesheet" typr="text/css" href="../Assets/css/styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Assets/javascript/script.js"></script>
	</head>
	<body>
	<?php include './Assets/php/navbar/navbar.php'; ?>
		<div class='center'>
			<?php
			// Include the JSON reading logic
			include 'read.php';

			// Get the request URI
			$requestUri = $_SERVER['REQUEST_URI'];

			// Extract the ID from the URI (e.g., /products.php/1 => 1)
			$parts = explode('/', $requestUri);
			$productId = end($parts); // Get the last part of the URL

			// Ensure $productId is numeric to prevent invalid access
			if (!is_numeric($productId)) {
			    echo "Invalid product ID.";
			    exit;
			}

			// Find the product with the given ID
			$selectedProduct = null;
			foreach ($products as $product) {
			    if ($product['id'] == $productId) {
				$selectedProduct = $product;
				break;
			    }
			}

			// Display the product if found
			if ($selectedProduct) {
			    echo "<div id='" . $selectedProduct['id'] . "' class='product'>";
			    echo "<img src='../Assets/" . $selectedProduct['image'] . "' alt='" . $selectedProduct['description'] . "' class='product_img'>";
			    echo "<h2 class='product_name'>" . $selectedProduct['name'] . "</h2>";
			    echo "<p class='product_desc'>" . $selectedProduct['description'] . "</p>";
			    echo "<p class='product_price'>R " . $selectedProduct['price'] . "</p>";
			    echo "<div class='button_div'>";
			    echo "<button class='btn_delete'>Delete</button>";
			    echo "<button class='btn_update'>Update</button>";
			    echo "</div>";
			    echo "</div>";
			} else {
			    echo "Product not found.";
			}
			?>
		</div>
		<a href="/products.php">Back to Products</a>
	</body>
</html>
