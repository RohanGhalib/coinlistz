<?php include 'head.php'; 
include 'db.php';
if(isset($_GET['success'])){
    $successid = $_GET['success'];
    echo '<script>
        alert("Transaction Approved Successfully");
        window.location.href = window.location.href.split("?")[0];
    </script>'; 
}
if(isset($_GET['cancelled'])){
    $cancelledid = $_GET['cancelled'];
    echo '<script>
        alert("Transaction Cancelled ");
        window.location.href = window.location.href.split("?")[0];
    </script>'; 
}
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
                        <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
<div class="table-responsive  rounded shadow ">
                      <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>trx ID</th>
                                <th>Service</th>
                                <th>Dates (If applicable)</th>
                                <th>Bill</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                     
                        <?php
                        $sql = "SELECT * FROM transactions ORDER BY id DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                echo '<td>'.$row['ad_type'].'</td>';
                                echo '<td>'.$row['dates'].'</td>';
                                echo '<td>$'. $row['total'] .'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                echo '<td>'.$row['status'].'</td>';
                                echo '<td>';
                                if ($row['status'] == 'pending' || $row['status'] == 'cancelled') {
                                    echo '<a href="process_transaction.php?approve='.$row['id'] .'" class="btn btn-success">Approve</a> ';
                                }
                                echo '<a href="process_transaction.php?cancel='. $row['id'] .'" class="btn btn-danger">Cancel</a>';
                                echo '</td>';
                                echo '<td><a href="transaction_details.php?trxid='. $row['id'] .'" class="btn btn-primary"> View Details</a></td>';
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