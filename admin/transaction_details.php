<?php
include 'head.php'; 
include("db.php");
if(isset($_GET['trxid'])){
    $id = $_GET['trxid'];
    $sql = "SELECT * FROM transactions WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        echo "Error: " . $conn->error;
    }
    
}


?>

<body id="page-top">
    <div id="wrapper">
       <?php include "sidebar.php"?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               <?php include "nav.php" ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Transaction Details</h1>
                    </div>


                    <div class="row">
                        <div class="table-responsive rounded shadow">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Coin</th>
                                        <th>Votes</th>
                                        <th>UVotes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Coinlistz Powered By <a href="https://ideafydigital.com">Ideafy Digital</a>, 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<?php include 'footer.php'; ?>
</body>
</html>