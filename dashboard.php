<?php
include 'links.php';
include 'nav.php';
include '../app/db.php';
include 'session.php';
include 'sessionstrict.php';
?>
<div class="container">
    <div class="row mt-4">
        <div class="col">
            <h3>Dashboard</h3>
            <strong><?php  echo $usernameis ?></strong><br>

            <a href="userservice.php" class="btn btn-success">
                Use Bought Services
            </a>
            <hr>
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Dates</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <?php 
                        $sql = "SELECT * FROM transactions WHERE email = '$usernameis'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $resultservice = $conn->query("SELECT * FROM services where id = ".$row["ad_type"]);
                                $rowservice = $resultservice->fetch_assoc();
                                $titleservice = $rowservice["title"];
                                $dates = json_decode($row["dates"], true);
                                echo "<tr><td>".$titleservice."</td><td>";
                                foreach ($dates as $date) {
                                    echo '<span class="badge badge-pill text-bg-primary">' . htmlspecialchars($date) . '</span> ';
                                }
                                echo "</td><td>$".$row["total"]."</td><td>".$row["status"]."</td>";
                                if ($row["status"] == "pending") {
                                    echo '<td><button class="btn btn-success">Complete Payment</button></td>';
                                } else {
                                    echo '<td></td>';
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>