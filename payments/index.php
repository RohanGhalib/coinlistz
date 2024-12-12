<?php
// Define the URL of your IPN handler
$ipnUrl = "http://localhost/coinlistz.com/payments/services.php";

// Create a sample IPN data array to mimic CoinPayments
$ipnData = [
    'merchant' => 'YOUR_MERCHANT_ID', // Your merchant ID
    'amount1' => '0.01',             // Original amount (in currency1)
    'amount2' => '0.00045',          // Amount in cryptocurrency
    'currency1' => 'USD',            // Original currency
    'currency2' => 'BTC',            // Cryptocurrency
    'status' => '2',                 // Full payment received
    'txn_id' => 'TEST_TXN_ID_12345', // Sample transaction ID
    'custom' => '22324',        // Custom field for order ID
];

// Generate a fake HMAC signature for testing
$ipnSecret = 'rohan40006@'; // Replace with your actual IPN secret
$hmac = hash_hmac("sha512", http_build_query($ipnData), $ipnSecret);

// Add the fake HMAC to the headers
$headers = [
    'Content-Type: application/x-www-form-urlencoded',
    'HMAC: ' . $hmac,
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ipnUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ipnData));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request and capture the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
} else {
    echo "Response: " . $response;
}

// Close the cURL session
curl_close($ch);
?>
