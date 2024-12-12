<?php 
include 'links.php';
include 'nav.php';
include '../app/db.php';
include 'session.php';
include 'sessionstrict.php';
?>
<div class="container">
    <div class="row mt-4">
        <?php
        if(isset($_GET['error']) && $_GET['error'] == 'notallowed'){
            echo '<div class="alert alert-danger" role="alert">
            The Date is not owned by you! Please select a date from below or <a href="ads.php" class="btn btn-success">Buy One From Here</a>
          </div>';
        }
        if(isset($_GET['error']) && $_GET['error'] == 'adplaced'){
            echo '<div class="alert alert-danger" role="alert">
            You have already uploaded and placed ad for this date! Please select a date from below or <a href="ads.php" class="btn btn-success">Buy One From Here</a>
          </div>';
        }
        ?>
        <div class="col">
            <h1>Use Services</h1>
            <hr>
        
<?php 

$ad_types = [
    1 => 'Basic Banner Ads',
    2 => 'Premium Banner Ads',
    3 => 'Promoted Spots',
    4 => 'Highlighted Spots',
];

foreach ($ad_types as $ad_type => $ad_name) {
    $sql = "SELECT * FROM transactions WHERE status = 'success' AND email = '$usernameis' AND ad_type = $ad_type";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) { 
        echo '
        <table class="table table-hover table-striped table-border-radius shadow">
        <thead>  
                <th>' . $ad_name . '</th>
                <th>Date:</th>
                <th>Action:</th>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $dates = json_decode($row['dates'], true);
            foreach ($dates as $date) {
                $calendar_sql = "SELECT * FROM calendar WHERE date = '$date' AND added_by = '$usernameis' AND type = $ad_type";
                $calendar_result = $conn->query($calendar_sql);
                echo "<tr>";
                echo "<td>" . $row['securename'] . "</td>";
                echo "<td>" . $date . "</td>";
                if ($calendar_result && $calendar_result->num_rows > 0) {
                    echo "<td>Ad Placed / Scheduled</td>";
                } else {
                    echo "<td><a href='final_ad_placement.php?date=" . $date . "&adtype=" . $row['ad_type'] . "' class='btn btn-primary '><i class='bi bi-pencil'></i> Upload Assets</a></td>";
                }
                echo "</tr>";
            }
        }
        echo '</table>';
    } 
}


$ad_types = [
    5 => 'Custom Profile Banner',

];

foreach ($ad_types as $ad_type => $ad_name) {
    $sql = "SELECT * FROM transactions WHERE status = 'success' AND email = '$usernameis' AND ad_type = $ad_type";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) { 
        echo '
        <table class="table table-hover table-striped table-border-radius shadow">
        <thead>  
                <th>' . $ad_name . '</th>
                <th>Action:</th>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $dates = json_decode($row['dates'], true);
            foreach ($dates as $date) {
                $calendar_sql = "SELECT * FROM coins WHERE added_by = '$usernameis' AND coin_id = " . $row['securename'];
                $calendar_result = $conn->query($calendar_sql);
                echo "<tr>";
                echo "<td>" . $row['securename'] . "</td>";
                if ($calendar_result && $calendar_result->num_rows > 0) {
                    echo "<td>Ad Placed / Scheduled</td>";
                } else {
                    echo "<td><a href='final_banner_placement.php?coin=" . $row['securename'] . "&adtype=" . $row['ad_type'] . "' class='btn btn-primary '><i class='bi bi-pencil'></i> Upload Assets</a></td>";
                }
                echo "</tr>";
            }
        }
        echo '</table>';
    } 
}



$ad_types = [
    7 => 'KYC Badge',
    8 => 'Audit Badge',
    6 => 'Email Blast'

];

foreach ($ad_types as $ad_type => $ad_name) {
    $sql = "SELECT * FROM transactions WHERE status = 'success' AND email = '$usernameis' AND ad_type = $ad_type";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) { 
        echo '
        <table class="table table-hover table-striped table-border-radius shadow">
        <thead>  
                <th>' . $ad_name . '</th>
                <th>Action:</th>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $dates = json_decode($row['dates'], true);
            foreach ($dates as $date) {
               
                echo "<tr>";
                echo "<td>" . $row['securename'] . "</td>";
                if ($calendar_result && $calendar_result->num_rows > 0) {
                    echo "<td>Requested</td>";
                } else {
                    echo "Requested";
                }
                echo "</tr>";
            }
        }
        echo '</table>';
    } 
}
?>
        </div>
    </div>
</div>
