<!DOCTYPE html>
<html lang="en">
<head>
    <title>CoinListz | Crypto Votes , Listings & More!</title>
</head>
<body data-bs-theme="dark">
    <nav class="navbar sticky-top shadow bg-secondary-subtle justify-content-center" data-bs-theme="dark">
    <script src="https://widgets.coingecko.com/gecko-coin-price-marquee-widget.js"></script>
    <gecko-coin-price-marquee-widget class="noscrollbar" locale="en" dark-mode="true" transparent-background="true" coin-ids="" initial-currency="usd"></gecko-coin-price-marquee-widget>
      
       <br>
        <div class="container">
            <button class="navbar-toggler ms-2" id="sidebarToggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="index.php" class="navbar-brand">CoinListz</a>
            <div class="nav-item">
                <a href="addcoin.php" class="btn btn-primary">Submit a Coin</a>
            </div>
            <div class="nav-item">
                <a href="ads.php" class="btn btn-success btn-glow w-100">Advertise</a>
            </div>
            <div class="nav-item">
            <form action="search.php" class="d-flex displayhideonsmallscreen">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
            <div class="nav-item">
                <button id="themeToggle" class="btn btn-primary"><i class="bi bi-lightbulb-fill"></i></button>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('themeToggle').addEventListener('click', function() {
            var body = document.body;
            var currentTheme = body.getAttribute('data-bs-theme');
            if (currentTheme === 'light') {
                body.setAttribute('data-bs-theme', 'dark');
            } else {
                body.setAttribute('data-bs-theme', 'light');
            }
        });
    </script>
