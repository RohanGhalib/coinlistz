<?php include 'head.php'; 
include 'db.php';
?>

<style>
    table td img{
        border-radius: 50px;
        height: 40px;
    }
</style>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include "sidebar.php"?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <?php include "nav.php" ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manual Processes</h1> 
                    </div>

                    <!-- Content Row -->
                    <div class="row">
<div class="table-responsive  rounded shadow ">
                      <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>trx ID</th>
                                <th>Service</th>
                                <th>Name Contact</th>
                                <th>Phone Contact</th>
                                <th>User</th>
                                <th>Coin</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                     
                        <?php
                        $sql = "SELECT * FROM transactions WHERE ad_type IN (6, 7, 8) AND status = 'success'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $coin_id = $row['securecoinid'];
                                $coin_sql = "SELECT name FROM coins WHERE coin_id = $coin_id";
                                $coin_result = $conn->query($coin_sql);
                                echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                $services = [
                                    6 => 'Email Blast',
                                    7 => 'Audit Badge',
                                    8 => 'KYC Verification'
                                ];
                                echo '<td>'.$services[$row['ad_type']].'</td>';
                                echo '<td>'.$row['securename'].'</td>';
                                echo '<td>'.$row['securemail'].'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                echo '<td>';
                                if ($coin_result->num_rows > 0) {
                                    $coin_row = $coin_result->fetch_assoc();
                                    echo $coin_row['name'];
                                } else {
                                    echo 'Unknown Coin';
                                }
                                echo '</td>';
                                echo '<td>';
                                if ($row['ad_type'] == 6) {
                                    echo '<a href="process_request.php?fulfill='. $row['id'] .'" class="btn btn-primary">Mark As Sent</a>';
                                } elseif ($row['ad_type'] == 7) {
                                    echo '<a href="process_request.php?audit='. $row['securecoinid'] .'&adder='. $row['email'] .'&trxid='. $row['id'] .'" class="btn btn-primary">Add Audit Badge</a>';
                                } elseif ($row['ad_type'] == 8) {
                                    echo '<a href="process_request.php?kyc='. $row['securecoinid'] .'&adder='. $row['email'] .'&trxid='. $row['id'] .'" class="btn btn-primary">Add KYC Badge</a>';
                                }
                                echo '<a href="process_transaction.php?cancel='. $row['id'] .'&return=requests.php" class="btn btn-danger">Reject</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                      </table>



                      
                      </div>
                    </div>



                     <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                        <h1 class="h3 mb-0 text-gray-800">Free Requests</h1> 
                    </div>

                    <!-- Content Row -->
                    <div class="row">
<div class="table-responsive  rounded shadow ">
                      <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Service</th>
                                <th>Name Contact</th>
                                <th>Phone Contact</th>
                                <th>User</th>
                                <th>Coin</th>
                                <th>Proof</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                     
                        <?php
                        $sql = "SELECT * FROM requests WHERE service_type IN (7, 8) AND status = 'pending'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $coin_id = $row['coinid'];
                                $coin_sql = "SELECT name FROM coins WHERE coin_id = $coin_id";
                                $coin_result = $conn->query($coin_sql);
                                echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                $services = [
                                    7 => 'Audit Badge',
                                    8 => 'KYC Verification'
                                ];
                                echo '<td>'.$services[$row['service_type']].'</td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                echo '<td>'.$row['user'].'</td>';
                                echo '<td>';
                                if ($coin_result->num_rows > 0) {
                                    $coin_row = $coin_result->fetch_assoc();
                                    echo $coin_row['name'];
                                } else {
                                    echo 'Unknown Coin';
                                }
                                echo '</td>';
                                echo '<td><a href="../' . $row['proof'] . '" download><button class="btn btn-primary">Download</button></a></td>';

                                echo '<td>';
                                if ($row['service_type'] == 7) {
                                    echo '<a href="process_request.php?auditfree='. $row['coinid'] .'&adder='. $row['email'] .'&trxid='. $row['id'] .'" class="btn btn-primary">Add Audit Badge</a>';
                                } elseif ($row['service_type'] == 8) {
                                    echo '<a href="process_request.php?kycfree='. $row['coinid'] .'&adder='. $row['email'] .'&trxid='. $row['id'] .'" class="btn btn-primary">Add KYC Badge</a>';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                      </table>



                      
                      </div>
                    </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Coinlistz Powered By <a href="https://ideafydigital.com">Ideafy Digital</a>, 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
</body>

</html>