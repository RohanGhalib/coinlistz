<?php
// Define the log file
$logFile = 'log.txt';

try {
    // Get raw POST data
    $postData = file_get_contents('php://input');
    parse_str($postData, $ipnData);

    // Log raw data for debugging
    file_put_contents($logFile, "Raw IPN Data: " . print_r($ipnData, true) . "\n", FILE_APPEND);

    // Define your IPN secret and merchant ID
    $merchantId = 'YOUR_MERCHANT_ID'; // Replace with your actual merchant ID
    $ipnSecret = 'rohan40006@';   // Replace with your actual IPN secret

    // Validate merchant ID
    if (!isset($ipnData['merchant']) || $ipnData['merchant'] !== $merchantId) {
        file_put_contents($logFile, "Error: Invalid merchant ID\n", FILE_APPEND);
        die('Invalid merchant ID');
    }

    // Validate HMAC signature
    $hmac = hash_hmac("sha512", http_build_query($ipnData), $ipnSecret);
    if (!isset($_SERVER['HTTP_HMAC']) || $hmac !== $_SERVER['HTTP_HMAC']) {
        file_put_contents($logFile, "Error: Invalid HMAC signature\n", FILE_APPEND);
        die('Invalid HMAC signature');
    }

    // Store response in variables
    $transactionId = $ipnData['txn_id'] ?? 'N/A';
    $customData = $ipnData['custom'] ?? 'N/A';
    $status = $ipnData['status'] ?? 'N/A';
    $amountReceived = $ipnData['amount1'] ?? 'N/A';
    $currency = $ipnData['currency1'] ?? 'N/A';

    // Log valid data
    $logData = [
        'Transaction ID' => $transactionId,
        'Custom Data' => $customData,
        'Status' => $status,
        'Amount Received' => $amountReceived,
        'Currency' => $currency,
    ];

    file_put_contents($logFile, "Valid IPN Data: " . print_r($logData, true) . "\n", FILE_APPEND);

    // Respond to CoinPayments to acknowledge receipt of IPN
    echo "IPN received and logged";

} catch (Exception $e) {
    // Log any exceptions
    file_put_contents($logFile, "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    die("IPN error");
}
?>
