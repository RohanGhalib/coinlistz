<?php
include 'session.php';
include 'functions.php';
include 'links.php';
include 'nav.php';
include '../app/db.php';
if(isset($_GET['skip'])){
    if (!is_numeric($_GET['skip'])) {
        $_GET['skip'] = 0;
    }
    $offset = $_GET['skip'];
    $nextPage = $_GET['skip'] + 300;
}
else{
    $offset = 0;
    $nextPage = 300;
}
?>

<div class="container-fluid" style="position: relative;">
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-lg-10" id="content" style="margin-top: 10px;">
            <div class="container-fluid">
                <?php include 'adbannerlong.php' ?>
                <?php include 'adbanners.php' ?>

                <br>
                <div class="row">
                    <h1 class="section-heading">All Coins</h1>
                    <div class="form">
                        <form id="filterForm" method="GET" action="index.php">
                            <div class="row">
                                <div class="col">
                                    <label for="chainselector">Chain</label>
                                    <select class="form-select form-select-sm" name="chain" id="chainselector">
                                        <option value="">All Chains</option>
                                        <?php 
                $sql = "SELECT DISTINCT chain FROM coins ORDER BY chain DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $chainValue = $row['chain'] === 'N/A' ? 'Other' : $row['chain'];
                        echo "<option value='" . htmlspecialchars($chainValue) . "'>" . $chainValue . "</option>";
                    }
                } 
                ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="categoryselector">Category</label>
                                    <select class="form-select form-select-sm" name="category" id="categoryselector">
                                        <option value="">All Categories</option>
                                        <?php 
                $sql = "SELECT DISTINCT category FROM coins ORDER BY category DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $categoryValue = $row['category'] === 'N/A' ? 'Other' : $row['category'];
                        echo "<option value='" . htmlspecialchars($categoryValue) . "'>" . $categoryValue . "</option>";
                    }
                } 
                ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="marketCapSelect">Market Cap</label>
                                    <select class="form-select form-select-sm" name="marketcap" id="marketCapSelect">
                                        <option value="0-1000">$0 - $1000</option>
                                        <option value="1000-2000">$1000 - $2000</option>
                                        <option value="2000-3000">$2000 - $3000</option>
                                        <option value="3000-4000">$3000 - $4000</option>
                                        <option value="4000-MAX">$4000 - MAX</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="auditselector">Audit</label>
                                    <select class="form-select form-select-sm" name="audit" id="auditselector">
                                        <option value="">All</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="kycselector">KYC</label>
                                    <select class="form-select form-select-sm" name="kyc" id="kycselector">
                                        <option value="">All</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="applyfilter">Action</label>
                                    <button type="button" class="btn btn-success" id="applyfilter">Apply
                                        Filters</button>
                                </div>
                            </div>
                        </form>


                        <div class="row" style="margin-top: 20px">
                            <div class="table-container table-responsive bg-secondary-subtle col-lg-12">
                                <table class="table  table-hover table-striped table-border-radius">
                                    <thead>
                                        <tr>
                                            <td class="sticky-td">All Tokens</td>
                                            <td>1h</td>
                                            <td>24h</td>
                                            <td>7d</td>
                                            <td>Volume</td>
                                            <td>Price</td>
                                            <td>Market Cap</td>
                                            <td>Votes</td>
                                        </tr>
                                    </thead>
                                    <?php
// Function to fetch live coin data from CoinMarketCap API


// Example usage in your table generation script
$coinIds = []; // Initialize an array to store coin IDs
// Default query
// Base SQL query
$sql = "SELECT * FROM coins ";

// Check if 'chain' filter is set in the URL
if (isset($_GET['chain']) && $_GET['chain'] !== '') {
    // Sanitize the chain value to prevent SQL injection
    $chain = $conn->real_escape_string($_GET['chain']);
    $sql .= " WHERE chain = '$chain'";
}

// Add ORDER BY and LIMIT clauses
$sql .= " ORDER BY votes DESC LIMIT 300 OFFSET $offset";

// Execute the query


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
            'price' => 'N/A',
            'marketCap' => 'N/A',
            'percentChange1h' => 'N/A',
            'percentChange6h' => 'N/A',
            'percentChange24h' => 'N/A',
            'circulating_supply' => 'N/A',
            'volume_24h' => 'N/A'
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
            echo "<td style='color:" . ($coinLiveData['percentChange1h'] < 0 ? '#ed3939' : '#3abf28') . ";'>" . 
            (is_numeric($coinLiveData['percentChange1h']) ? number_format($coinLiveData['percentChange1h'], 3) : 'N/A') . 
            "%</td>";
       
       echo "<td style='color:" . ($coinLiveData['percentChange6h'] < 0 ? '#ed3939' : '#3abf28') . ";'>" . (is_numeric($coinLiveData['percentChange6h']) ? number_format($coinLiveData['percentChange6h'], 3) : 'N/A') . "%</td>";
       echo "<td style='color:" . ($coinLiveData['percentChange24h'] < 0 ? '#ed3939' : '#3abf28') . ";'>" . (is_numeric($coinLiveData['percentChange24h']) ? number_format($coinLiveData['percentChange24h'], 3) : 'N/A') ."%</td>";
       echo "<td>$" . (is_numeric($coinLiveData['volume_24h']) ? number_format($coinLiveData['volume_24h'], 2) : 'N/A') . "</td>"; // Dynamic volume
       echo "<td>" . (is_numeric($coinLiveData['price']) ? '$' . number_format($coinLiveData['price'], 7) : 'N/A') . "</td>"; // Check for price
       echo "<td>" . (is_numeric($coinLiveData['marketCap']) ? '$' . number_format($coinLiveData['marketCap'], 2) : 'N/A') . "</td>"; // Dynamic market cap
       
        // Voting button logic
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
        echo "</tr>";
    }
} else {
    echo 'No rows found';
}
?>

                                </table>
                                <div class="container">
                                    <div class="row justify-content-center">
                                       <a href="?skip=<?php echo $nextPage ?>"> <button class="btn btn-primary">Show More >>></button></a>   
                                    </div>
                                </div>
                            </div><br>
                            <br>

                        </div>
<?php include 'adbannerlong.php' ?>

                    </div>
                </div>
                <div class="row mt-5 rounded">
                    <div class="col-lg-6 p-4 justify-content-center bg-secondary-subtle rounded">
                        <div class="descriptionimg rounded shadow" style="overflow: hidden;">
                            <img src="img/descriptionbanner.png" alt="" width="100%">
                        </div>
                        <br>
                        <h4><strong>Find DeFi tokens and coins that will take you to the Moon!
                            </strong></h4>
                        <p>
                            Coinlistz.com is a platform that aims to make cryptocurrencies more accessible, easy, and
                            fun to use. Coinlistz.com provides entertaining features, crypto-related news, tutorials, as
                            well as other valuable materials and tools.
                        </p>

                        <p>We want to keep up with the latest trends and provide our visitors with the most relevant
                            information. We are a team of crypto enthusiasts who believe that cryptocurrencies are the
                            future of the financial world. We are here to help you find the best projects and
                            opportunities that will take you to the Moon!</p>

                        <p>We are constantly working on improving our website and adding new features. If you have any
                            suggestions or ideas, feel free to contact us.</p>
                    </div>
                    <div class="col-lg-6 justify-content-center bg-secondary-subtle p-4 rounded">
                        <h5><strong>Your Favorite Coin Missing?
                            </strong></h5>
                        <p>Can't Find your coin? List your Favorite Coin Now!</p>
                        <p>Get your community to vote for your coin and gain exposure</p>
                        <br>
                        <button class="btn btn-primary">
                            Submit Coin
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <?php include 'newsletter.php' ?>
        </div>
    </div>
</div>
<?php
include 'footer.php';

?>
<script src="script.js"></script>
<script>
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Function to set the selected option based on URL parameter
    function setSelectedOption(selectorId, paramName) {
        const element = document.getElementById(selectorId);
        const paramValue = urlParams.get(paramName);
        if (paramValue) {
            element.value = paramValue;
        }
    }

    // Set the selected values for each dropdown
    setSelectedOption('chainselector', 'chain');
    setSelectedOption('categoryselector', 'category');
    setSelectedOption('marketCapSelect', 'marketcap');
    setSelectedOption('auditselector', 'audit');
    setSelectedOption('kycselector', 'kyc');

    // Apply filters and redirect with updated URL parameters
    document.getElementById('applyfilter').addEventListener('click', function (event) {
        event.preventDefault();  // Prevent form submission
        const form = document.getElementById('filterForm');
        const url = new URL(window.location.origin + '/crypto/model/index.php'); // Adjust the path if needed

        // Get all form data
        const formData = new FormData(form);

        // Loop through each form entry and add to URL if not empty
        formData.forEach((value, key) => {
            if (value !== "") {
                url.searchParams.append(key, value);
            }
        });

        // Redirect to the built URL
        window.location.href = url;
    });

    // Highlight the active chain link based on the 'chain' parameter in the URL
    const selectedChain = urlParams.get('chain'); 

    // If the 'chain' parameter exists in the URL
    if (selectedChain) {
        // Find the corresponding chain link by ID
        const chainLink = document.getElementById(`chain-${selectedChain}`);
        if (chainLink) {
            // Remove the active class from the 'All Chains' link
            document.getElementById('allChains').classList.remove('active');
            // Add the active class to the selected chain link
            chainLink.classList.add('active');
        }
    } else {
        // If no 'chain' parameter, keep the 'All Chains' link as active
        document.getElementById('allChains').classList.add('active');
    }
</script>

