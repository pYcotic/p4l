<!DOCTYPE html>
<html lang="en">
<?php include './Assets/php/head/head.php'; ?>
<body>
<?php include './Assets/php/navbar/navbar.php'; ?>
	<div class="center">
		<form id="productForm">
			<h2>Add a New Product</h2>
			<label for="name">Product Name:</label>
			<input type="text" id="name" name="name" placeholder="Enter product name" required>
			
			<label for="description">Description:</label>
			<textarea id="description" name="description" rows="4" placeholder="Enter product description" required></textarea>
			
			<label for="image">Choose product image:</label>
			<input type="file" id="image" name="image" accept="image/jpg, image/png, image/jpeg" >
			
			<label for="price">Price:</label>
			<input type="number" id="price" name="price" step="0.01" placeholder="Enter price" required>
			
			<button type="submit">Add Product</button>
		</form>
	</div>
</body>
</html>

