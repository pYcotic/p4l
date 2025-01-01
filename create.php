<?php

header('Content-Type: application/json');

// Check if the form was submitted and the file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$response = [];
	// Set the directory where you want to save the file
	$uploadDir = './Assets/images/';
	$jsonDest = 'images/';
	
	// Check if the image was uploaded without errors
	if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
		// Get the file name and move the uploaded file
		$fileName = rand(100000, 999999) . '-' . basename($_FILES['image']['name']); // Get the original file name
		$fileTmpPath = $_FILES['image']['tmp_name'];
		$fileDestination = $uploadDir . $fileName;
		
		// Move the uploaded file to the destination folder
		if (move_uploaded_file($fileTmpPath, $fileDestination)) {
			$response['file'] = [
				'message' => 'File uploaded',
				'image' => $fileDestination
			];
		} else {
			$response['file'] = [
				'error' => 'Failed to move uploaded file'
			];
		}
	} else {
		$response['file'] = [
			'error' => 'Problem with upload'
		];
	}
	$fileDestinationJSON = $jsonDest . $fileName;

	// Process other form data (product details)
	$productData = [
		'name' => $_POST['name'],
		'description' => $_POST['description'],
		'image' => $fileDestinationJSON, // Store the saved file path
		'price' => $_POST['price']
	];

	// Load existing products
	$dataFile = './db/products.json';
	$products = json_decode(file_get_contents($dataFile), true);
	
	// Create a new product entry
	$newProduct = [
		'id' => end($products)['id'] + 1,  // Set the new ID
		'name' => $productData['name'],
		'description' => $productData['description'],
		'image' => $productData['image'],
		'price' => $productData['price']
	];

	// Add the new product to the existing products list
	$products[] = $newProduct;

	// Save the updated product list to the JSON file
	file_put_contents($dataFile, json_encode($products, JSON_PRETTY_PRINT));

	$response['product'] = $newProduct;

	// Respond with the new product
	echo json_encode($response);
	exit;
} else {
	echo json_encode(['error' => 'Invalid request method']);
}
