<?php
header('Content-Type: application/json');

	// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = json_decode(file_get_contents("php://input"), true);
	$productId = $data['id'] - 1;
	$response = [];

	$dataFile = './db/products.json';
	$products = json_decode(file_get_contents($dataFile), true);

	$imagePath = './Assets/' . $products[$productId]['image'];

	if (file_exists($imagePath)) {
		unlink($imagePath);
	}

	unset($products[$productId]);
	file_put_contents($dataFile, json_encode($products, JSON_PRETTY_PRINT));
	
	$response['success'] = $products;

	echo json_encode($response);
	exit;
} else {
	$response['error'] = ['Error' => 'delete unsuccessful'];
	echo json_encode($response);
}
