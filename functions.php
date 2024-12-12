<?php
function fetchCoinData($coinIds) {
    $cmcApiKey = 'bab8e54c-dd42-4468-b09b-b4d96a56fcfe'; // Replace with your actual CoinMarketCap API key

    // Convert the array of coin IDs into a comma-separated string for API request
    $coinIdsString = implode(',', $coinIds);
    $cmcApiUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?id=$coinIdsString";

    // Set up cURL request to CoinMarketCap API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $cmcApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-CMC_PRO_API_KEY: $cmcApiKey",
        'Accept: application/json'
    ]);

    // Execute and decode JSON response
    $apiResponse = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($apiResponse, true);

    // Check if the response contains valid data
    if (isset($data['data'])) {
        $result = [];
        
        // Process each coin's data
        foreach ($coinIds as $coinId) {
            if (isset($data['data'][$coinId])) {
                $coinData = $data['data'][$coinId];
                $coinQuote = $coinData['quote']['USD'];
                
                $result[$coinId] = [
                    'price' => $coinQuote['price'],
                    'marketCap' => $coinQuote['market_cap'],
                    'percentChange1h' => $coinQuote['percent_change_1h'],
                    'percentChange6h' => $coinQuote['percent_change_24h'] ?? null, // Optional field
                    'percentChange24h' => $coinQuote['percent_change_7d'],
                    'circulating_supply' => $coinData['circulating_supply'] ,// Retrieve from the main coin data, not from quote['USD']
                    'volume_24h' => $coinQuote['volume_24h'],
                    'dateadded' => $coinData['date_added']
                ];
            } else {
                $result[$coinId] = null; // Indicate no data found for this coin
            }
        }
    
        
        return $result; // Return the array with live data for each coin
    } else {
        return []; // Return empty array if no valid data found
    }
}











function displayCoinTable($sql, $conn, $usernameis) {
    $coinIds = []; // Initialize an array to store coin IDs
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Collect coin IDs from database result
        while ($row = $result->fetch_assoc()) {
            $coinIds[] = $row['coin_id'];
        }

        // Fetch live data from CoinMarketCap API for these coin IDs
        $liveCoinData = fetchCoinData($coinIds);

        // Reset the result pointer and output the table rows with live data
        $result->data_seek(0); // Reset the result pointer to loop again
        while ($row = $result->fetch_assoc()) {
            $coinId = $row['coin_id'];
            $coinLiveData = $liveCoinData[$coinId] ?? [
                'price' => '-',
                'marketCap' => '-',
                'percentChange1h' => '-',
                'percentChange6h' => '-',
                'percentChange24h' => '-',
                'circulating_supply' => '-',
                'volume_24h' => '-'
            ];

            // Display the row with both static and live data
            echo "<tr>";
            echo "<td class='sticky-td'><a href='coin.php?coinid=". $row['coin_id']."'>
                    <div class='d-flex titlecoin'>
                        <div class='imgcoinontable'><img src='" . $row['icon_link'] . "' height='40px' alt=''></div>
                        <div class='cointitledetails'>
                            <div class='coinname'>" . $row["name"] . "</div><br>";
            echo "<div class='tokenname'>" . $row["symbol"] . "</div>
                        </div>
                    </div>
                </a></td>";

            echo '<td>';
            if ($row['audited'] == true) {
                echo '<span class="badge text-bg-success ms-2"><i class="bi bi-shield"></i> AUDIT</span>';
            }
            if ($row['kyc'] == true) {
                echo '<span class="badge text-bg-light ms-2"><i class="bi bi-fingerprint"></i> KYC</span>';
            }
            echo '</td>';

            echo "<td>
            <div class='votebutton'>
                <div class='totalvotesbutton container-fluid'>
                    " . $row['votes'] . " &nbsp;";

            // Check if the user has already voted
            $sql2 = "SELECT * FROM votes WHERE coin_id = " . $row['coin_id'] . " AND username = '$usernameis'";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                echo "<button style='cursor: default; background-color: gray !important;'>Voted</button>";
            } else {
                echo "<a href='vote.php?id=" . $row['coin_id'] . "'><button>Vote</button></a>";
            }

            echo "</div></div></td>";
            echo "<td style='color:" . ($coinLiveData['percentChange1h'] < 0 ? '#ed3939' : '#3abf28') . ";'>" . 
            (is_numeric($coinLiveData['percentChange1h']) ? number_format($coinLiveData['percentChange1h'], 3) : '-') . 
            "%</td>";
       
            echo "<td style='color:" . ($coinLiveData['percentChange6h'] < 0 ? '#ed3939' : '#3abf28') . ";'>" . (is_numeric($coinLiveData['percentChange6h']) ? number_format($coinLiveData['percentChange6h'], 3) : '-') . "%</td>";
            echo "<td style='color:" . ($coinLiveData['percentChange24h'] < 0 ? '#ed3939' : '#3abf28') . ";'>" . (is_numeric($coinLiveData['percentChange24h']) ? number_format($coinLiveData['percentChange24h'], 3) : '-') ."%</td>";
            echo "<td>$" . (is_numeric($coinLiveData['volume_24h']) ? number_format($coinLiveData['volume_24h'], 2) : '-') . "</td>"; // Dynamic volume
            echo "<td>" . (is_numeric($coinLiveData['price']) ? '$' . number_format($coinLiveData['price'], 7) : '-') . "</td>"; // Check for price
            echo "<td>" . (is_numeric($coinLiveData['marketCap']) ? '$' . number_format($coinLiveData['marketCap'], 2) : '-') . "</td>"; // Dynamic market cap

            echo "</tr>";
        }
    } else {
        echo 'No rows found';
    }
}
?>