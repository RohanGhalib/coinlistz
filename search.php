<?php
include 'session.php';
include 'functions.php';
include 'links.php';
include 'nav.php';
include '../app/db.php';

if(isset($_GET['q'])){
    $searchThing = $_GET['q'];
} else {
    $searchThing = 'Search Something';
}

if(isset($_GET['skip'])){
    if (!is_numeric($_GET['skip'])) {
        $_GET['skip'] = 0;
    }
    $offset = $_GET['skip'];
    $nextPage = $_GET['skip'] + 300;
} else {
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
                    <h1 class="section-heading">Search Results</h1>

                    <div class="row">
                        <form action="">
                            <div class="row">
                                <div class="col">
                                    <input type="search" name="q" id="" class="form-control" value="<?php echo htmlspecialchars($searchThing); ?>">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <div class="table-container table-responsive bg-secondary-subtle col-lg-12">
                            <table class="table table-hover table-striped table-border-radius">
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
                                   if (isset($_GET['q']) && !empty($_GET['q'])) {
                                     $searchQuery = '%' . $_GET['q'] . '%';
                                      $sql = "SELECT * FROM coins WHERE name LIKE '$searchQuery' OR symbol LIKE '$searchQuery' LIMIT 300 OFFSET $offset";
                                      displayCoinTable($sql, $conn, $usernameis);
                                   } else {
                                      $sql = "SELECT * FROM coins ORDER BY votes DESC LIMIT 300 OFFSET $offset";
                                      displayCoinTable($sql, $conn, $usernameis);
                                   }
                                ?>
                            </table>

                            <div class="container">
                                <div class="row justify-content-center">
                                    <a href="allcoins.php"> <button class="btn btn-primary">Show More >>></button></a>
                                </div>
                            </div>
                        </div><br>
                        <br>
                    </div>
                    <?php include 'adbannerlong.php' ?>
                </div>
            </div>
            <?php include 'aboutcomponent.php'; ?>

            <br>
            <?php include 'newsletter.php' ?>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
<script src="script.js"></script>