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
                        <h1 class="h3 mb-0 text-gray-800">All Coins</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
<div class="table-responsive  rounded shadow ">
                      <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Coin</th>
                                <th>Votes</th>
                                <th>UVotes</th>
          
                                <th>Action</th>

                            </tr>
                        </thead>
                     
                        <?php
                        $start = 0;
                        if(isset($_GET['start'])){
                            $start = $_GET['start'];
                        }
                        $sql = "SELECT * FROM calendar";                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                
                                <td>
                                    <div class="row">
                                        <div class="col-lg-8">
                                    <input type="text" class="form-control" value="'.$row['adtype'].'">
                                        </div>
                                        <div class="col-lg-4">
                                    <button class="btn btn-primary form-control">Save</button>
                                        </div>
                                    </div>
                                </td>
                                <td>';
                                $sql2 = "SELECT * FROM votes WHERE coin_id = ".$row['coin_id'];
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) {
                                        echo $result2->num_rows;
                                }else{
                                    echo "-";
                                }
                                echo
                                '
                                </td>
                            ';                                 
                            
                               echo '
                                </td>
                                <td>
                                    <button class="btn btn-primary"><i class="fas fa-edit fa-sm"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash fa-sm"></i></button>
        
                                </td>
                               
                            </tr>';
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