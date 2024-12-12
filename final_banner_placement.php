<?php
include 'links.php';
include 'nav.php';
include '../app/db.php';
include 'session.php';
include 'sessionstrict.php';

if (isset($_GET['coin'])) {
    $coin = $_GET['coin'];
    $adtypeget = $conn->real_escape_string($_GET['adtype']);
    $sql = "SELECT * FROM transactions 
            WHERE ad_type = '$adtypeget' 
            AND email = '$usernameis' 
            AND securecoinid = '$coin'
            AND status = 'success'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
            $sql = "SELECT * FROM coins WHERE coin_id = '$coin' AND added_by = '$usernameis'";
            $calendar_result = $conn->query($sql);
            if ($calendar_result && $calendar_result->num_rows == 0) {
                $owndate = true;
            }
            else {
                header('Location: userservice.php?error=adplaced');
            }
    } else {
        echo 'Error: ' . $conn->error;
    }
} else {
    header('Location: userservice.php?error=invalidparameters');
    exit;
}
if(isset($owndate) && $owndate == true){
    if(isset($adtypeget)){  
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h3>Details</h3>
                    </div>
                    <div class="card-body">
                    <div class="card h-100 shadow-lg">
                            <img src="img/ad7.png" class="card-img-top" alt="Highlighted Coin Image">

                                <div class="card-body">
                                    <h4 class="card-title text-primary">
                                     <?php
                                        $sql = "SELECT * FROM services WHERE id = '$adtypeget'";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        echo $row['title'];
                                        ?>
                                    </h4>
                                    </div>
                            </div>

                        </div>
            </div>
            
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header">
                <h3>Upload Assets</h3>    
            </div>
            <div class="card-body">
            <form action="uploadadasset.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-row mt-2">
            </div>
            <div class="form-row mt-2">
            <input type="file" name="image" id="" class="form-control">
            </div>
            <div class="form-row mt-2">
                <input type="hidden" name="" value="<?php echo $adtypeget ?>">
                <input type="hidden" name="coin" value="<?php echo $coin ?> ">
            <button class="btn-primary btn" type="submit">Place Ad</button>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
    </div>
<?php } 
}?>
