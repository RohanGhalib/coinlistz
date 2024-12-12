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
                        <h1 class="h3 mb-0 text-gray-800">All Coins</h1><form action="voteshuffle.php" method="POST"><input type="hidden" name="shuffle" value="1">
                        <button class="btn btn-danger" type="submit">Shuffle Votes</button>
                        </form>
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
                        $sql = "SELECT * FROM coins ORDER BY votes DESC LIMIT 200 OFFSET $start";                        
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                <td>
                                <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/'.$row['coin_id'].'.png" alt="">    
                                '.$row['name'].'</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-8">
                                        <form action="votesupdate.php" method="GET">
                                    <input type="text" class="form-control" value="'.$row['votes'].'" name="votes">
                                    <input type="hidden" class="form-control" value="'.$row['coin_id'].'" name="coinid">

                                        </div>
                                        <div class="col-lg-4">
                                   
                                    <button class="btn btn-primary " type="submit">Save</button>
                                        </div>
                                        </form>
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
                      <?php
// Assume $totalRows is the total number of rows fetched from the database
$totalRows = $conn->query("SELECT * FROM coins")->num_rows; // Replace with actual row count, e.g., $totalRows = $db->query("SELECT COUNT(*) FROM your_table")->fetchColumn();
$rowsPerPage = 200;

// Calculate total pages needed
$totalPages = ceil($totalRows / $rowsPerPage);
echo '<div class="container">';

echo '<div class="row flex-nowrap">';
echo '<ul class="pagination">';

// Generate each page button
for ($i = 0; $i <= $totalPages; $i++) {
    // Calculate start and stop values
    $start = ($i - 0) * $rowsPerPage + 0;
    $stop = min($i * $rowsPerPage, $totalRows); // Ensures we don't exceed total rows on the last page

    echo '<li class="page-item"><a class="page-link" href="?start='.$start.' ">' . $i . '</a></li>';
}
echo '</div>';
echo '</div>';
echo '</ul>';
?>

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