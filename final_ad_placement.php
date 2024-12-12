<?php
include 'links.php';
include 'nav.php';
include '../app/db.php';
include 'session.php';
include 'sessionstrict.php';

if (isset($_GET['date'])) {
    $dateget = json_encode(explode(',', $_GET['date']));
    $adtypeget = $conn->real_escape_string($_GET['adtype']);
    $sql = "SELECT * FROM transactions 
            WHERE JSON_CONTAINS(dates, '$dateget')
            AND ad_type = '$adtypeget' 
            AND email = '$usernameis' 
            AND status = 'success'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
            $dateArray = json_decode( $dateget);
            $simpleDate = $dateArray[0]; // Assuming you want to use the first date in the array
            $sql = "SELECT * FROM calendar WHERE date = '$simpleDate' AND added_by = '$usernameis' AND type = '$adtypeget'";
            $calendar_result = $conn->query($sql);
            if ($calendar_result && $calendar_result->num_rows == 0) {
                $owndate = true;
            }
             else {
                header('Location: userservice.php?error=adplaced');
            }
    } else {
        header('Location: userservice.php?error=notallowed');
    }
} else {
    header('Location: userservice.php?error=invalidparameters');
    exit;
}
if(isset($owndate) && $owndate == true){
    if(isset($adtypeget) && $adtypeget != 3 && $adtypeget != 4){  
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

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo implode(', ', json_decode($dateget)); ?> </td>
                            </tr>
                        </table>
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
                    <label for="url">Enter URL For Ad:</label>
            <input type="url" name="url" id="url" class="form-control">
            </div>
            <div class="form-row mt-2">
            <input type="file" name="image" id="" class="form-control">
            </div>
            <div class="form-row mt-2">
                <input type="hidden" name="type" value="<?php echo $adtypeget ?>">
                <input type="hidden" name="date" value="<?php echo implode(', ', json_decode($dateget)); ?> ">
            <button class="btn-primary btn" type="submit">Place Ad</button>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
    </div>
<?php }
if(isset($adtypeget) && $adtypeget == 3 || $adtypeget == 4){

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

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo implode(', ', json_decode($dateget)); ?> </td>
                            </tr>
                        </table>
                        </div>
            </div>
            
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header">
                <h3>Upload Assets</h3>    
            </div>
            <div class="card-body">
            <form action="placecoinad.php?image=0" method="post" enctype="multipart/form-data">
            <div class="form-group">
              
                <div class="form-row mt-2">
                    <select name="coinid" id="" >
                        <?php
                        $sql = "SELECT * FROM coins";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                            echo '<option value="'.$row['coin_id'].'">'.$row['name'].'</option>';
                        }
                        ?>
                    </select>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('select').select2();
                });
            </script>
            </div>
            <div class="form-row mt-2">
            </div>
            <div class="form-row mt-2">
                <input type="hidden" name="type" value="<?php echo $adtypeget ?>">
                <input type="hidden" name="date" value="<?php echo implode(', ', json_decode($dateget)); ?> ">
            <button class="btn-primary btn" type="submit">Plsace Ad</button>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
    </div>

<?php
}
}
?>
