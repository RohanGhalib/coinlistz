<?php include 'head.php'; 
include 'db.php';
?>
     <?php
    $contactLabels = ['email', 'telegram', 'whatsapp'];
    $contactLinks = [];

    foreach ($contactLabels as $label) {
        $sql = 'SELECT * FROM contact_details WHERE label = "' . $label . '"';
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            $contactLinks[$label] = $row['link'];
        }
    }

    $emailLink = $contactLinks['email'] ?? '#';
    $telegramLink = $contactLinks['telegram'] ?? '#';
    $whatsappLink = $contactLinks['whatsapp'] ?? '#';


     ?>

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

                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Email</h6>
                                </div>
                                <div class="card-body">
                                    <form action="updatecontactdetails.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo $emailLink?>">
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Telegram</h6>
                                </div>
                                <div class="card-body">
                                    <form action="updatecontactdetails.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="telegram" placeholder="Enter Telegram handle" value="<?php echo $telegramLink ?>">
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">WhatsApp</h6>
                                </div>
                                <div class="card-body">
                                    <form action="updatecontactdetails.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="whatsapp" placeholder="Enter WhatsApp number" value="<?php echo $whatsappLink?>">
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>
                                </div>
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
<?php include 'footer.php'; ?>
</body>

</html>