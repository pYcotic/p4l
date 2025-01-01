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
