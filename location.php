<?php
header('Content-Type: application/json');

// Get the input data
$data = json_decode(file_get_contents('php://input'), true);

// Extract latitude and longitude from the input data
$latitude = $data['latitude'];
$longitude = $data['longitude'];

// Replace 'YOUR_OPENCAGE_API_KEY' with your actual OpenCage API key
$apiKey = 'bc95c80f60494a07aa2ab13e9d897e5c';
$url = "https://api.opencagedata.com/geocode/v1/json?q={$latitude}+{$longitude}&key={$apiKey}";

// Send a request to the OpenCage API
$response = file_get_contents($url);
$response = json_decode($response, true);

// Extract the address from the API response
if ($response && isset($response['results'][0])) {
    $address = $response['results'][0]['formatted'];
} else {
    $address = 'Address not found';
}

// Print location details to the terminal (optional for debugging)
error_log("Latitude: $latitude, Longitude: $longitude, Address: $address");

// Return the latitude, longitude, and address as a JSON response
echo json_encode([
    'latitude' => $latitude,
    'longitude' => $longitude,
    'address' => $address
]);
?>
