<?php
include 'session.php';
include 'sessionstrict.php';
include 'nav.php';
include 'links.php';
include '../app/db.php';
if(isset($_GET['q'])){
    $id = $_GET['q'];
    $sql = "SELECT * FROM coins WHERE coin_id = '$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $symbol = $row['symbol'];
        $banner = $row['icon_link'];
    }
}
else{
    header('location: index.php');
    exit();}
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
                    <img src="<?php echo $banner ?>" alt="Banner" class="img-fluid">
                </div>
                <div class="col">
                    <h5><?php echo $name ?></h5>
                    <p><?php echo $symbol ?></p>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col">
<div class="card">
    <div class="card-header">
        <h4>Upload Documentation</h4>
    </div>
    <div class="card-body">
        <form action="uploadrequest.php" method="post" enctype="multipart/form-data">
            <select name="service" id="" class="">
                <option value="7">Audit Badge</option>
                <option value="8">KYC Badge</option>
            </select>
            <br>
            <label for="name">Enter Your Name (Secured)</label>
            <input type="text" class="form-control" placeholder="Contact Name" id="name" name="name">
            <br>
            <label for="email">Enter Your Email (Secured)</label>
            <input type="email" class="form-control" placeholder="Contact Email" id="email" name="email">
            <br>
            <label for="file">Upload Proof Document</label>
            <input type="file" name="file" id="file" class="form-control">
            <br>
            <input type="hidden" name="coinid" value="<?php echo $id ?>">
            <button type="submit" class="btn btn-success">
            Submit Request
            </button>
        </form>
    </div>
</div>
</div>
</div>
</div>