<?php
$url = 'https://c1cb-39-53-123-213.ngrok-free.app/coinlistz.com/ipn.php'; // Replace with your IPN URL
$merchant_id = 'ad31228c59f9be785a8693e737a33026';
$ipn_secret = '12345678';

$data = [
    'amount1' => '300',
    'amount2' => '2.95096',
    'currency1' => 'USDT',
    'currency2' => 'LTCT',
    'custom' => '104',
    'email' => 'muhammadrohanghalib@gmail.com',
    'fee' => '0.01475',
    'first_name' => 'Muhammad Rohan',
    'ipn_id' => '8a21b613c4d0d9edb8e4602cb7bbc6d3',
    'ipn_mode' => 'hmac',
    'ipn_type' => 'simple',
    'ipn_version' => '1.0',
    'item_amount' => '300',
    'item_name' => '2',
    'last_name' => 'Ghalib',
    'merchant' => 'ad31228c59f9be785a8693e737a33026',
    'net' => '2.93621',
    'received_amount' => '2.95096',
    'received_confirms' => '0',
    'shipping' => '0',
    'status' => '100',
    'status_text' => 'Complete',
    'subtotal' => '300',
    'tax' => '0',
    'txn_id' => 'CPIK0OTOZMH1XBDJJRVQUW86UW'
];

// Build the URL-encoded string
$request = http_build_query($data);

// Create HMAC hash from the request
$hmac = hash_hmac("sha512", $request, $ipn_secret);

// Set up headers for the request
$headers = [
    'Content-Type: application/x-www-form-urlencoded', // Content type for URL-encoded data
    'HTTP_HMAC: ' . $hmac, // Add the HMAC signature in the header
];

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url); // Target IPN URL
curl_setopt($ch, CURLOPT_POST, 1); // Set request method to POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // Attach the URL-encoded data
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Add the headers (including HMAC)
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute the request and capture the response
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Output the response for debugging purposes
echo $response;
?>
