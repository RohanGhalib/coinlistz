<?php include 'head.php'; include 'db.php'; ?>
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

              

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        <a href="users.php">

                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                            
                                            $sql = "SELECT id FROM users";
                                            $result = $conn->query($sql);
                                            if($result->num_rows > 0){
                                                echo $result->num_rows;
                                            }
                                                else{
                                                    echo '0';
                                                }
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>

                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            
                        <a href="allcoins.php">

                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Coins</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                            
                                            $sql = "SELECT id FROM coins";
                                            $result = $conn->query($sql);
                                            if($result->num_rows > 0){
                                                echo $result->num_rows;
                                            }
                                                else{
                                                    echo '0';
                                                }
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                  
                       
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                    
                        <!-- Latest API Status -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Live API Status</h6>
                                </div>
                                <div class="card-body">
                                    <h4>CoinMarketCap API Status:</h4>
                                    <?php
                                        $cmcUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest";
                                        $headers = ['X-CMC_PRO_API_KEY: e1b40f48-8430-4f45-8f26-f49d499009f9'];
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, $cmcUrl);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        $response = curl_exec($ch);
                                        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                        curl_close($ch);
                                        
                                        echo '<button class="btn ' . ($httpCode == 200 ? 'btn-success">Active' : 'btn-danger">Inactive') . '</button>';
                                    ?>
                                    
                                    <h4>CoinGecko API Status:</h4>
                                    <?php
                                        $geckoUrl = "https://api.coingecko.com/api/v3/ping";
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, $geckoUrl);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        $response = curl_exec($ch);
                                        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                        curl_close($ch);
                                        
                                        echo '<button class="btn ' . ($httpCode == 200 ? 'btn-success">Active' : 'btn-danger">Inactive') . '</button>';
                                    ?>
                                </div>
                            </div>
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

  <?php include 'scripts.php' ?>  
</body>

</html>