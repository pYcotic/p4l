<!DOCTYPE html>
<html>
	<?php include './Assets/php/head/head.php'; ?>
		<body>
		<?php include './Assets/php/navbar/navbar.php'; ?>
		<div class='center'>
		<?php include 'read.php';
		foreach ($products as $product) {
			
			echo "<div id='" . $product['id'] . "' class='product'>";
			echo "<a href='product.php/" . $product['id'] . "' class='product_link'>";
			echo "<img src='Assets/" . $product['image'] . "' alt='" . $product['description'] . "' class='product_img'>";
			echo "<div class='product_text'>";
			echo "<h2 class='product_name'>" . $product['name'] . "</h2>";
			echo "<p class='product_desc'>" . $product['description'] . "</p>";
			echo "<p class='product_price'>R " . $product['price'] . "</p>";
			echo "</div>";
			echo "</a>";
			echo "<div class='button_div'>";
			echo "<button class='button_add_to_cart'>Add to cart</button>";
			echo "<button class='button_buy_now'>Buy Now!</button>";
			echo "</div>";
			echo "</div>";
		}
		?>
		</div>
	</body>
</html>
