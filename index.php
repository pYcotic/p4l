<?php
	$jsonData = file_get_contents('db/products.json');
	try {
		$products = json_decode($jsonData, true);
		if ($products === null) {
			throw new Exception("Failed to load JSON");
		}
	} catch (Exception $e) {
		echo "Error decoding JSON: " . $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>P4L - code test</title>
		<link rel="stylesheet" typr="text/css" href="Assets/css/styles.css">
	</head>
	<body>
		<?php
			foreach ($products as $product) {
				echo "<div id=" . $product['id'] . " class='product'>";
				echo "<img src='Assets/" . $product['image'] . "' alt='" . $product['description'] . "' class='product_img'>";
				echo "<h2 class='product_name'>" . $product['name'] . "</h2>";
				echo "<p class='product_desc'>" . $product['description'] . "</p>";
				echo "<p class='producr_price'>R " . $product['price'] . "</p>";
				echo "</div>";
				echo "<div class='button_div'>";
				echo "<button class='button_add_to_cart'>Add to cart</button>";
				echo "<button class='button_buy_now'>Buy Now!</button>";
				echo "</div>";
			}
		?>
	</body>
</html>

