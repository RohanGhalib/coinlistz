<div class="col-lg-2 sidebar shadow bg-secondary-subtle sticky-top" id="sidebar">
	<h6>Chains</h6>
	<div class="blockeru">
		<a href="?chain=" class="sidebarlink active" id="allChains">All Chains</a>
		<a href='index.php?chain=Ethereum#coinstable' class='sidebarlink' id='chain-Ethereum'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1027.png" height="19" alt=""> Ethereum</a>
		<a href='index.php?chain=BNB+Smart+Chain+%28BEP20%29#coinstable' class='sidebarlink' id='chain-BNB+Smart+Chain+%28BEP20%29'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1839.png" height="19" alt=""> BNB Smart Chain</a>
		<a href='index.php?chain=Base#coinstable' class='sidebarlink' id='chain-Base'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/27789.png" height="19" alt=""> Base</a>
		<a href='index.php?chain=Solana#coinstable' class='sidebarlink' id='chain-Solana'> <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/5426.png" height="19" alt=""> Solana</a>
		<a href='index.php?chain=Arbitrum#coinstable' class='sidebarlink' id='chain-Arbitrum'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/11841.png" height="19" alt=""> Arbitrum</a>
		<a href='index.php?chain=Polygon#coinstable' class='sidebarlink' id='chain-Polygon'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/3890.png" height="19" alt=""> Polygon</a>
		<a href='index.php?chain=Avalanche+C-Chain#coinstable' class='sidebarlink' id='chain-Avalanche+C-Chain'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/5805.png" height="19" alt=""> Avalanche</a>
		<a href='index.php?chain=Tron20#coinstable' class='sidebarlink' id='chain-Tron20'><img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1958.png" height="19" alt=""> Tron (BEP20)</a>
		<a href='index.php#coinstable' class='sidebarlink'> Others >>></a>
	</div>
	<br>
	<h6>Advertise</h6>
	<div class="blockeru">
		<a href="ads.php" class="sidebarlink">Promoted coins</a>
		<a href="ads.php" class="sidebarlink">Rotating Banners</a>
		<a href="ads.php" class="sidebarlink">Premium banner ads</a>
		<a href="ads.php" class="sidebarlink">Sticky banner ads</a>
		<a href="ads.php" class="sidebarlink">Custom Profile Banner</a>
		<a href="ads.php" class="sidebarlink">Pop up ads</a>
	</div>
	<br>
	<a href="addcoin.php"><button class="btn btn-success">Submit Your Coin Free</button></a>
	<br>
	<br><br> <?php
                if (isset($usernameis) && $usernameis === 'none') {
                   echo "<a href='login.php'><button class='btn btn-primary'>Login / Register</button></a>";
                }
                else{
                    echo "<a href='logout.php'><button class='btn btn-danger'>Logout</button></a>";
                }
?> <br><br><br><br><br><br><br><br>
</div>