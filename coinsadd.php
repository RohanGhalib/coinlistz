<?php

// Include database connection
include '../app/db.php';

// CoinMarketCap API URL and headers
$apiUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 17ceb5ce-b840-4f96-b12f-2264d93fe75f' // Replace with your actual API key
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute API request
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (isset($data['data'])) {
    foreach ($data['data'] as $coin) {
        $symbol = $coin['symbol'];
        $coin_id = $coin['id'];
        $cmc_coin_id = $coin['id'];
        $slug = $coin['slug'];
        $category = $coin['category'] ?? 'unknown';
        $marketcap = $coin['quote']['USD']['market_cap'] ?? 0;
        $chain = $coin['platform']['name'] ?? 'N/A';

        // Simple SQL query to insert or update data in the coins table
        $sql = "INSERT INTO coins (symbol, coin_id, cmc_coin_id, slug, category, marketcap, chain) 
                VALUES ('$symbol', '$coin_id', '$cmc_coin_id', '$slug', '$category', '$marketcap', '$chain')
                ON DUPLICATE KEY UPDATE marketcap = '$marketcap'";

        // Execute the query
        $conn->query($sql);
    }

    echo "Data inserted successfully.";
} else {
    echo "Failed to fetch data from CoinMarketCap API.";
}

// Close the connection
$conn->close();
?>
