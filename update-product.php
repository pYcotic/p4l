<?php
// Get the product ID from the URL query string
$productId = isset($_GET['id']) ? $_GET['id'] : null;
$productId = $productId - 1;
// If there's no ID, redirect to another page or show an error
if (!$productId) {
	header('Location: products.php'); // Redirect to a product listing page or error page
	exit;
}

// Assuming your product data is stored in a JSON file
$dataFile = './db/products.json';
$products = json_decode(file_get_contents($dataFile), true);

// Check if the product exists in the database
$product = isset($products[$productId]) ? $products[$productId] : null;

if (!$product) {
	echo "Product not found";
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include './Assets/php/head/head.php'; ?>
<body>
<?php include './Assets/php/navbar/navbar.php'; ?>
	<div class="center">
		<form id="updateForm">
			<h2>Update Product</h2>
				
			<input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($productId); ?>">

			<label for="name">Product Name:</label>
			<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" placeholder="Enter product name" required>
			
			<label for="description">Description:</label>
			<textarea id="description" name="description" rows="4" placeholder="Enter product description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
			
			<label for="image">Choose product image:</label>
			<input type="file" id="image" name="image" accept="image/jpg, image/png, image/jpeg">
			
			<label for="price">Price:</label>
			<input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" placeholder="Enter price" required>
			
			<button type="submit" class='update_button'>Update Product</button>
		</form>
	</div>
		<a href='/products.php'>Back to Products</a>

	<script>
	document.addEventListener('DOMContentLoaded', () => {
		const productId = <?php echo json_encode($productId); ?>; // Pass product ID from PHP to JS

		// Fetch the product data from read.php
		fetch(`read.php?id=${productId}`)
			.then(response => response.json())
			.then(product => {
				if (product.error) {
					alert(product.error);
				} else {
					// Clear previous form data
					document.getElementById('name').value = '';
					document.getElementById('description').value = '';
					document.getElementById('price').value = '';

					// Pre-populate the form with the new product data
					document.getElementById('name').value = product.name;
					document.getElementById('description').value = product.description;
					document.getElementById('price').value = product.price;

					// Optional: If you want to display the current image
					// document.getElementById('currentImage').src = `../Assets/images/${product.image}`;
				}
			})
			.catch(error => {
				console.error('Error fetching product:', error);
			});
	});
	</script>
</body>
</html>
