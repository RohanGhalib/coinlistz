<head>
	<title>CoinListz | Crypto Votes , Listings & More!</title>
</head>
<?php
include 'session.php';
include 'functions.php';
include 'links.php';
include 'nav.php';
include '../app/db.php';
?> 
<div class="container-fluid" >
	<div class="row"> <?php include 'sidebar.php'; ?> <div class="col-lg-10" id="content" style="margin-top: 10px;">
			<div class="container"> <?php include 'adbannerlong.php' ?> <?php include 'adbanners.php' ?> <div class="row firstrowincontent justify-content-center">
					<h1 class="section-heading"> Highlighted Coins </h1>
					<div class="row flex-nowrap overflow-auto noscrollbar" id="highlightRow"> <?php 
$sql = "SELECT name, symbol, icon_link, coin_id FROM coins WHERE coin_id IN (SELECT extra_asset2 FROM calendar WHERE type = 4 AND date = '$date') ORDER BY votes DESC";
$result = $conn->query($sql);
if($result -> num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='highlight'>";
        echo "<img class='imgcryptoonhighlights' src='".$row['icon_link'] ."' alt=''>";
        echo "<div class='paragraphs'>";
        echo "<a href='coin.php?coinid=". $row['coin_id']."' class='linkwhite'><p><strong>". $row['name'] ."</strong></p></a>";
        echo "<p>". $row['symbol'] ."</p>";
        echo "</div>";
        echo "</div>";
    ?> <script>
							(function() {
								const highlightRow = document.getElementById('highlightRow');
								const highlights = document.querySelectorAll('.highlight');
								if (highlights.length === 0) return; // Exit if there are no highlights
								const highlightWidth = highlights[0].offsetWidth;
								let currentHighlightIndex = 0;

								function scrollHighlights() {
									currentHighlightIndex++;
									if (currentHighlightIndex >= highlights.length) {
										currentHighlightIndex = 0;
										highlightRow.scrollTo({
											left: 0,
											behavior: 'smooth'
										});
									} else {
										highlightRow.scrollTo({
											left: currentHighlightIndex * highlightWidth,
											behavior: 'smooth'
										});
									}
								}
								setInterval(scrollHighlights, 5000); // Scroll every 3 seconds
							})();
						</script> <?php
    }
   
}
else{
    echo 'no rows found';
}
?> </div>
					<br><br><br><br>
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
							</thead> <?php
$sql = "SELECT * FROM coins WHERE coin_id IN (SELECT extra_asset2 FROM calendar WHERE type = 3 AND date = '$date') ORDER BY votes DESC";
displayCoinTable($sql, $conn, $usernameis); 

?>
						</table>
					</div>
				</div>
				<br> <a name="coinstable"></a>
				<div class="row justify-content-center"> <?php include 'adbannerlong.php' ?> </div>
				<br>
				<div class="row">
					<h1 class="section-heading">Best Coins Today</h1>
					<div class="form">
						<form id="filterForm" method="GET" action="index.php">
							<div class="row">
								<div class="col">
									<label for="chainselector">Chain</label>
									<select class="form-select form-select-sm" name="chain" id="chainselector">
										<option value="">All Chains</option> <?php 
                $sql = "SELECT DISTINCT chain FROM coins ORDER BY chain DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $chainValue = $row['chain'] === '-' ? 'Other' : $row['chain'];
                        echo "<option value='" . htmlspecialchars($chainValue) . "'>" . $chainValue . "</option>";
                    }
                } 
                ?>
									</select>
								</div>
								<div class="col">
									<label for="categoryselector">Category</label>
									<select class="form-select form-select-sm" name="category" id="categoryselector">
										<option value="">All Categories</option> <?php 
                $sql = "SELECT DISTINCT category FROM coins ORDER BY category DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $categoryValue = $row['category'] === '-' ? 'Other' : $row['category'];
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
									<button type="button" class="btn btn-success" id="applyfilter">Apply Filters</button>
								</div>
							</div>
						</form>
						<div class="row" style="margin-top: 20px">
							<div class="table-container table-responsive bg-secondary-subtle col-lg-12">
								<table class="table  table-hover table-striped table-border-radius">
									<thead>
										<tr>
											<td class="sticky-td">Name</td>
											</select>
											<td>Badges</td>
											<td>Votes</td>
											<td>1h</td>
											<td>24h</td>
											<td>7D</td>
											<td>Volume</td>
											<td>Price</td>
											<td>Market Cap</td>
										</tr>
									</thead> <?php

                                    $coinIds = []; 


                                    $sql = "SELECT * FROM coins";
                                        if (isset($_GET['chain']) && $_GET['chain'] !== '') {
                                            $chain = $conn->real_escape_string($_GET['chain']);
                                            $sql .= " WHERE chain = '$chain'";
                                        }

                                    $sql .= " ORDER BY votes DESC LIMIT 150";

                                    displayCoinTable($sql, $conn, $usernameis); 
                                    ?>
								</table>
								<div class="container">
									<div class="row justify-content-center">
										<a href="allcoins.php"><button class="btn btn-primary">Show More >>></button></a>
									</div>
								</div>
							</div><br>
							<br>
						</div>
					</div>
				</div> <?php 
                include 'adbannerlong.php';
                include 'aboutcomponent.php';
                include 'newsletter.php' ?>
			</div>
			<br>
		</div>
	</div>
</div> <?php
include 'footer.php';
include 'scripts.php'
?> </p>