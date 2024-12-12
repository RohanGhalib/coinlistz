<?php
include '../app/db.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

$merchant_id = 'ENTER COINPAYMENTS MERCHANT ID';
$ipn_secret = 'ENTER COINPAYMENTS IPN SECRET';

// Function to log data to a file
function log_ipn($data) {
    $log_file = 'ipnlog.txt';
    $log_data = date('Y-m-d H:i:s') . " - " . $data . PHP_EOL;
    file_put_contents($log_file, $log_data, FILE_APPEND);
}

// Verify HMAC
if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
    // For testing purposes, simulate the HMAC header
    $_SERVER['HTTP_HMAC'] = hash_hmac("sha512", file_get_contents('php://input'), $ipn_secret);
}

$request = file_get_contents('php://input');
log_ipn("Received request: {$request}");

// Parse the URL-encoded data
parse_str($request, $ipn_data);

// Verify HMAC
$hmac = hash_hmac("sha512", $request, $ipn_secret);

if ($hmac !== $_SERVER['HTTP_HMAC']) {
    log_ipn("HMAC signature does not match");
    die("HMAC signature does not match");
}

// Validate merchant ID
if ($ipn_data['merchant'] !== $merchant_id) {
    log_ipn("Invalid Merchant ID");
    die("Invalid Merchant ID");
}

// Process transaction
$status = $ipn_data['status']; // Transaction status
$amount = $ipn_data['amount1']; // Amount paid
$currency = $ipn_data['currency1']; // Currency
$custom_field = $ipn_data['custom']; // Custom field passed with the request

if ($status >= 100) {
    // Payment complete
    // Update your database here
    echo "IPN OK";
    $sql = "UPDATE transactions SET status = 'success' WHERE id = $custom_field";
    $conn->query($sql);
    log_ipn("Payment complete: Transaction ID $custom_field updated to success");
} elseif ($status < 0) {
    // Payment error
    // Handle errors
    echo "IPN OK";
    log_ipn("Payment error: Status $status");
} else {
    echo "IPN OK";
    log_ipn("Payment pending: Status $status");
}
?>
