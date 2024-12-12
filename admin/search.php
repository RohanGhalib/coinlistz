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
    <div id="wrapper">
       <?php include "sidebar.php"?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               <?php include "nav.php" ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Search Coins</h1>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form method="GET" class="form-inline">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Search coins..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
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
                                <?php
                                if(isset($_GET['search']) && !empty($_GET['search'])) {
                                    $search = $conn->real_escape_string($_GET['search']);
                                    $sql = "SELECT * FROM coins WHERE
                                           coin_id LIKE '%$search%' OR
                                           name LIKE '%$search%' OR 
                                           symbol LIKE '%$search%' OR 
                                           slug LIKE '%$search%'";
                                    
                                    $result = $conn->query($sql);
                                    if ($result && $result->num_rows > 0) {
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
                                            echo $result2->num_rows > 0 ? $result2->num_rows : "-";
                                            echo '</td>
                                          
                                            <td>';

                                            echo '</td>
                                            <td>
                                                <button class="btn btn-primary"><i class="fas fa-edit fa-sm"></i></button>
                                                <button class="btn btn-danger"><i class="fas fa-trash fa-sm"></i></button>
                                            </td>
                                        </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No results found</td></tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">Enter a search term to find coins</td></tr>';
                                }
                                ?>
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