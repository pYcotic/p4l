<?php

echo "Server is running";

// Set Content-Type header for JSON responses
header("Content-Type: application/json");

// Path to the JSON file
$jsonDbPath = __DIR__ . '/db/products.json';

// Helper function to read JSON database
function readDatabase($path) {
    if (!file_exists($path)) {
        return [];
    }
    $jsonData = file_get_contents($path);
    return json_decode($jsonData, true) ?? [];
}

// Helper function to write to the JSON database
function writeDatabase($path, $data) {
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
}

// Retrieve the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Retrieve the requested resource
$uri = $_SERVER['REQUEST_URI'];

// Parse the URI for routing
$path = parse_url($uri, PHP_URL_PATH);
$pathParts = explode('/', trim($path, '/'));

// Define a simple routing logic
switch ($method) {
    case 'GET':
        handleGet($pathParts);
        break;

    case 'POST':
        handlePost($pathParts);
        break;

    case 'PUT':
        handlePut($pathParts);
        break;

    case 'DELETE':
        handleDelete($pathParts);
        break;

    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(["error" => "Method not allowed"]);
        break;
}

// Define handlers for each method
function handleGet($pathParts) {
    global $jsonDbPath;
    $data = readDatabase($jsonDbPath);

    
}

function handlePost($pathParts) {
    global $jsonDbPath;
    $data = readDatabase($jsonDbPath);
    echo $data;

    
}

function handlePut($pathParts) {
    global $jsonDbPath;
    $data = readDatabase($jsonDbPath);

    
}

function handleDelete($pathParts) {
    global $jsonDbPath;
    $data = readDatabase($jsonDbPath);

    
}
?>
