<?php
include 'session.php';
include 'sessionstrict.php';
include 'nav.php';
include 'links.php';
include '../app/db.php';
if(isset($_GET['q'])){
    $coin_id = $_GET['q'];
}else{
    header('location:coin.php?coinid=1');
}
   
    $sql = "SELECT name,icon_link,symbol,banner_link FROM coins WHERE coin_id = $coin_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $coin_name = $row['name'];
        $coin_image = $row['icon_link'];
        $symbol = $row['symbol'];
        if($row['banner_link'] != null){
            $banner = "<span>Following Banner is already Placed which will be replaced!</span><img src='". $row['banner_link'] ."' alt='Banner' class='img-fluid' height='20px'>";
        }
        else{
            $banner = '';
        }
    }
    $result = $conn->query('SELECT * FROM services WHERE id = 5');
    $row = $result->fetch_assoc();
    $price = $row['price'];


?>
<div class="container mt-2">
    <div class="row">
<div class="col">
    <div class="card">
        <div class="card-header">
            <h4>Coin Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img src="<?php echo $coin_image?>" alt="Banner" class="img-fluid">
                </div>
                <div class="col">
                    <h5><?php echo $coin_name ?></h5>
                    <p><?php echo $symbol?></p>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col">
<div class="card">
    <div class="card-header">
        <h4>Billing Details</h4>
    </div>
    <h5>Price: <?php echo $price;  ?></h5>
    <?php echo $banner ?>
    <form action="process_reservation.php" method="POST">
        <input type="hidden" name="unlock">
        <input type="hidden" name="coinid" value="<?php echo $coin_id ?>">
        <input type="hidden" name="total" value="<?php echo $price ?>">
        <button class="btn btn-success" type="submit">Reserve & Pay</button>
    </form>

</div>
</div>
</div>
</div>