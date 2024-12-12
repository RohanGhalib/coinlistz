<?php
include 'session.php';
include 'functions.php';
include 'links.php';
include 'nav.php';
include '../app/db.php'; // Assuming this is the correct path to your db.php

// Your API key
$apiKey = 'ADD YOUR API KEY HERE';
if(isset($_GET['coinid'])){
    $coinId = $_GET['coinid'];
} else {
    $coinId = 1;
}
$sql = "SELECT source FROM coins WHERE coin_id = $coinId";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();


if($row["source"] == "api"){
$infoUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/info?id=$coinId";
$quoteUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?id=$coinId";

// Function to fetch data from API
function fetchData($url, $apiKey) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-CMC_PRO_API_KEY: ' . $apiKey
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

$infoData = fetchData($infoUrl, $apiKey);
$quoteData = fetchData($quoteUrl, $apiKey);

// Check for errors in responses
if ($infoData['status']['error_code'] === 0 && $quoteData['status']['error_code'] === 0) {
    // Access the coin data
    $coinData = $infoData['data'][$coinId];

    // Store URLs in variables
    $website = $coinData['urls']['website'][0] ?? null;
    $twitter = $coinData['urls']['twitter'][0] ?? '#';
    $reddit = $coinData['urls']['reddit'][0] ?? '#';
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

    // Access the quote data
    $quote = $quoteData['data'][$coinId]['quote']['USD'];
    
    // Store dynamic information in variables
    $price = $quote['price'] ?? null;
    $volume24h = $quote['volume_24h'] ?? null;
    $marketCap = $quote['market_cap'] ?? null;

} else {
    // Handle error
    echo "Error: " . ($infoData['status']['error_message'] ?? $quoteData['status']['error_message']);
}

}
else{
    $sql = "SELECT * FROM coins WHERE coin_id = $coinId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    $name =  $row["name"] ?? null;
    $symbol = $row["symbol"] ?? null;
    $contractAddress = $row["contract_address"] ?? null;
    $description = $row['description'] ?? null;
    $tags = ['custom'] ?? [];
    $price = '-';
    $marketCap = '-';
    $volume24h = '-';
    $dateLaunched = $row['date_launched'] ?? null;
    $dateAdded = $row['date_created'] ?? null;
    $category = $row['category'] ?? null; 
    $platform = $row['chain']  ?? null;
}
}

$sql = "SELECT * FROM coins WHERE coin_id = $coinId";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $votes = $row['votes'];
    $audited = $row['audited'] == 1 ? "Yes" : "No";
    $kyc = $row['kyc'] == 1 ? "Yes" : "No";
    $imagelink = $row["icon_link"];
    $banner = $row["banner_link"];
}
else{
    $votes = 0;
}
$sql = "SELECT * FROM votes WHERE coin_id = $coinId AND username = '$usernameis'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $voted = true;
}
else{
    $voted = false;    
}

?>
<head>
    <title><?php echo $name  ?> | Coinlistz</title>
</head>

<div class="container-fluid" style="position: relative;">
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-lg-10" id="content" style="margin-top: 10px;">
                <?php include 'adbannerlong.php' ?>
                <?php include 'adbanners.php' ?>
                <br>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 bg-secondary customprofilebanner rounded d-flex align-items-center justify-content-center overflow-hidden">   
                        <?php if($banner): ?>
                            <img src="<?php echo $banner; ?>" alt="Banner Image" class="">
                        <?php else: ?>
                            <div class="row justify-content-center text-align-center">
                                <h4>Custom Profile Banner (Locked)</h4>
                                 <a href="unlockbanner.php?q=<?php echo $coinId ?>">
                                <button class="btn btn-dark ">
                                    Unlock
                                </button>
                                </a>
                            </div>
                        <?php endif; ?>
                      
                        </div>
                        <div class="col-lg-12 bg-secondary-subtle firstmaindetailsrow shadow ">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12"><img src="<?php echo $imagelink; ?>" alt=""></div>
                                <div class="col-lg-8 col-sm-12 bg-secondary-subtle rounded">
                                    <h1 class="titlecoininmaindetailsrow mb-1 mt-3">
                                        <?php echo $name; ?> 
                                        <span class="badge text-bg-secondary"><?php echo $symbol; ?></span>
                                        <?php if ($kyc === "Yes"): ?>
                                            <span class="badge text-bg-light ms-2">KYC</span>
                                        <?php endif; ?>
                                        <?php if ($audited === "Yes"): ?>
                                            <span class="badge text-bg-dark ms-2">Audit</span>
                                        <?php endif; ?>
                                    </h1>
                                    <p class="token-address-display bg-dark shadow mt-2"><?php echo $contractAddress; ?> &nbsp; <i class="bi bi-copy"></i></p>
                                    <p>
                                    <div class="row" style="width: 200px; margin-left: 1px;">
                                        <div class="icon-quicklink col btn btn-success me-2"><a href="<?php echo $reddit; ?>"><i class="bi bi-reddit"></i></a></div>
                                        <div class="icon-quicklink col btn btn-success me-2"><a href="<?php echo $twitter; ?>"><i class="bi bi-twitter"></i></a></div>
                                        <div class="icon-quicklink col btn btn-success me-2"><a href="<?php echo $website; ?>"><i class="bi bi-globe"></i></a></div>
                                        <div class="icon-quicklink col btn btn-success me-2"><a href="#"><i class="bi bi-files"></i></a></div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between">

                        <div class="col-sm-12 gridbanner3 bg-secondary-subtle shadow mt-2 rounded p-3">
                            <h4>Description:</h4>
                            <br>
                            <p><?php echo $description; ?></p>
                        </div>
                        <div class="col-sm-12 gridbanner4 bg-secondary-subtle shadow mt-2 rounded p-3">
                            <h4>Votes</h4>
                            <p>Total Votes: <strong><?php echo $votes ?></strong></p>
                            <?php
                                if($voted){
                                    echo '<button class="btn btn-dark">Voted</button>';
                                }
                                else{
                                    echo '<a href="vote.php?id='. $coinId .'"><button class="btn btn-success">Vote</button></a>';
                                }
                            ?>

                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-sm-12 gridbanner bg-secondary-subtle shadow mt-2 rounded p-3">
                           
                            <script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<gecko-coin-price-chart-widget locale="en" transparent-background="true"  dark-mode="true" coin-id="<?php echo $slug ?>" initial-currency="usd"></gecko-coin-price-chart-widget>
 <hr>
<h4>Trade:</h4>
<a href="https://flooz.xyz/trade/<?php echo $contractAddress; ?>"><button class="btn btn-dark shadow">Flooz.trade</button></a>&nbsp;
<a href="https://pancakeswap.finance/?outputCurrency=<?php echo $contractAddress; ?>"><button class="btn btn-dark shadow">Pancake Swap</button></a>&nbsp;
<a href="https://mobula.io/swap?outputCurrency=<?php echo $contractAddress; ?>"><button class="btn btn-dark shadow">Mobula</button></a>&nbsp;
<a href="https://app.uniswap.org/swap?outputCurrency=<?php echo $contractAddress; ?>"><button class="btn btn-dark shadow">Uniswap</button></a>&nbsp;

<br>
<hr>
<h4>Charts:</h4>
<a href="https://poocoin.app/tokens/<?php echo $contractAddress; ?>"><button class="btn btn-dark shadow">PooCoin</button></a>&nbsp;
<a href="https://www.dextools.io/app/en/<?php 
    if (is_array($platform) && count($platform) > 1) {
        echo htmlspecialchars(strtolower($platform['name']));
    }
?>/pair-explorer/<?php echo $contractAddress; ?>" target="_blank"><button class="btn btn-dark shadow">DexTools</button></a>&nbsp;
<a href="https://coinbrain.com/coins/<?php 
    if (is_array($platform) && count($platform) > 1) {
        echo htmlspecialchars(strtolower($platform['name']));
    }
?>-<?php 
if (is_array($platform) && count($platform) > 1) {
    echo htmlspecialchars(strtolower($platform['token_address']));
}
?>" target="_blank"><button class="btn btn-dark shadow">CoinBrain</button></a>&nbsp;
                        </div>
                        <div class="col-sm-12 gridbanner2 bg-secondary-subtle shadow mt-2 rounded p-3">
                            <h4>Market Data</h4>
                            <br>
                            <p>Price: <strong>$<?php echo $price; ?></strong></p>
                            <hr>
                            <p>Market Cap: <strong>$<?php echo $marketCap; ?></strong></p>
                            <hr>
                            <p>Volume (24H): <strong>$<?php echo $volume24h; ?></strong></p>
                            <hr>
                            <h4>Summary</h4>
                            <br>
                            <p>Launch Date: <strong><?php echo $dateLaunched; ?></strong></p>
                            <hr>
                            <p>Submitted: <strong><?php echo $dateAdded; ?></strong></p>
                            <hr>
                            <p>Category: <strong><?php echo $category; ?></strong></p>
                            <hr>
                            <p>Tags: 
                                <?php 
                                foreach ($tags as $tag) {
                                    echo '<strong>' . htmlspecialchars($tag) . '</strong> ';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php include 'adbannerlong.php' ?>

                    <div class="row  mt-2 g-2 justify-content-between">
                        <h1 class="section-heading">
                            Security Details of <?php echo $name ?>
                        </h1>

                        <div class="col-lg-5 ml-1 p-2 rounded shadow bg-secondary-subtle">
                            <h4>KYC</h4>
                            <hr>
                            <p><?php echo $kyc; ?></p>
                            <?php if ($kyc === "Yes"): ?>
                                <button class="btn btn-outline-secondary" disabled>Verified</button>
                            <?php else: ?>
                                <a href="audit.php?q=<?php echo $coinId ?>" class="btn btn-outline-success">Submit KYC</a>
                                <a href="ads.php">Get yourself kyc verified</a>

                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 p-2 rounded shadow bg-secondary-subtle">
                            <h4>Audit</h4>
                            <hr>
                            <p><?php echo $audited; ?></p>
                            <?php if ($audited === "Yes"): ?>
                                <button class="btn btn-outline-secondary" disabled>Audited</button>
                            <?php else: ?>
                                <a href="audit.php?q=<?php echo $coinId ?>" class="btn btn-outline-success">Submit Audit</a>
                                <a href="ads.php">Get yourself Audited</a>

                            <?php endif; ?>
                        </div>
                    </div>
                    <?php include 'adbannerlong.php' ?>

                </div>
                <br>










                <h1 class="section-heading">Promoted Coins</h1>

                <div class="table-container table-responsive bg-secondary-subtle col-lg-12">
                        <table class="table  table-hover table-striped table-border-radius">
                            <thead>
                                <tr>
                                <td class="sticky-td">Name</td>
									<td>Badges</td>
									<td>Votes</td>
									<td>1h</td>
									<td>24h</td>
									<td>7D</td>
									<td>Volume</td>
									<td>Price</td>
									<td>Market Cap</td>
                                </tr>
                            </thead>
               
<?php
$sql = "SELECT * FROM coins WHERE coin_id IN (SELECT extra_asset2 FROM calendar WHERE type = 3 AND date = '$date') ORDER BY votes DESC";
displayCoinTable($sql, $conn, $usernameis); 

?>


                        </table>
                    </div>
                <br><br><br>
            </div>
    </div>
</div>
<script>
    
let isSidebarHidden = false;

function checkScreenSize() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    
    if (window.innerWidth < 768) { // Assuming 768px as the breakpoint for smaller screens
        sidebar.classList.add('slide-out', 'displaynone');
        sidebar.classList.remove('col-lg-2');
        content.classList.remove('col-lg-10');
        content.classList.add('col-lg-12');
        isSidebarHidden = true;
    } else {
        sidebar.classList.remove('slide-out', 'displaynone');
        sidebar.classList.add('col-lg-2');
        content.classList.remove('col-lg-12');
        content.classList.add('col-lg-10');
        isSidebarHidden = false;
    }
}

document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (isSidebarHidden) {
        sidebar.classList.remove('slide-out', 'displaynone');
        sidebar.classList.add('slide-in', 'col-lg-2');
        content.classList.remove('col-lg-12');
        content.classList.add('col-lg-10');
    } else {
        sidebar.classList.remove('slide-in', 'col-lg-2');
        sidebar.classList.add('slide-out', 'displaynone');
        content.classList.remove('col-lg-10');
        content.classList.add('col-lg-12');
    }
    isSidebarHidden = !isSidebarHidden;
});

// Initial check on page load
checkScreenSize();

// Add event listener to handle window resize
window.addEventListener('resize', checkScreenSize);



</script>
<?php
include 'footer.php';
include 'scripts.php';
?>
