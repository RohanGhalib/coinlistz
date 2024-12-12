<?php
// Your API key
$apiKey = 'ADD YOUR API KEY HERE';
if(isset($_GET['coinid'])){
    $coinId = $_GET['coinid'];
}
else{
    $coinId = 1;
}
// API endpoint URL
$url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/info?id=$coinId";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-CMC_PRO_API_KEY: ' . $apiKey
]);

// Execute the request
$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check for errors in response
if ($data['status']['error_code'] === 0) {
    // Access the coin data
    $coinData = $data['data'][$coinId];
    
    // Store URLs in variables
    $website = $coinData['urls']['website'][0] ?? null;
    $technicalDoc = $coinData['urls']['technical_doc'][0] ?? null;
    $twitter = $coinData['urls']['twitter'][0] ?? '#';
    $reddit = $coinData['urls']['reddit'][0] ?? '#';
    $messageBoard = $coinData['urls']['message_board'][0] ?? null;
    $announcement = $coinData['urls']['announcement'][0] ?? null;
    $chat = $coinData['urls']['chat'][0] ?? null;
    $explorers = $coinData['urls']['explorer'] ?? [];
    $sourceCode = $coinData['urls']['source_code'][0] ?? null;
    $contractAddress = $coinData['platform']['token_address'] ?? null;

    // Store other information in variables
    $name = $coinData['name'] ?? null;
    $symbol = $coinData['symbol'] ?? null;
    $slug = $coinData['slug'] ?? null;
    $description = $coinData['description'] ?? null;
    $dateAdded = $coinData['date_added'] ?? null;
    $dateLaunched = $coinData['date_launched'] ?? null;
    $tags = $coinData['tags'] ?? [];
    $platform = $coinData['platform'] ?? null;
    $category = $coinData['category'] ?? null;
    $selfReportedCirculatingSupply = $coinData['self_reported_circulating_supply'] ?? null;
    $selfReportedMarketCap = $coinData['self_reported_market_cap'] ?? null;

} else {
    // Handle error
    echo "Error: " . $data['status']['error_message'];
}


$quoteUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?id=$coinId";

// Initialize cURL for the new endpoint
$chQuote = curl_init();
curl_setopt($chQuote, CURLOPT_URL, $quoteUrl);
curl_setopt($chQuote, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($chQuote, CURLOPT_HTTPHEADER, [
    'X-CMC_PRO_API_KEY: ' . $apiKey
]);

// Execute the request
$quoteResponse = curl_exec($chQuote);
curl_close($chQuote);

// Decode the JSON response
$quoteData = json_decode($quoteResponse, true);

// Check for errors in response
if ($quoteData['status']['error_code'] === 0) {
    // Access the quote data
    $quote = $quoteData['data'][$coinId]['quote']['USD'];
    
    // Store dynamic information in variables
    $price = $quote['price'] ?? null;
    $volume24h = $quote['volume_24h'] ?? null;
    $marketCap = $quote['market_cap'] ?? null;
 

} else {
    // Handle error
    echo "Error: " . $quoteData['status']['error_message'];
}
?>
