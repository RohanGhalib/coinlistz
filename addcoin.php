<head>
	<title>Submit a New Coin | CoinListz</title>
</head>
<?php
include 'session.php';
include 'functions.php';
include 'links.php';
include 'nav.php';
include '../app/db.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-fluid" style="position: relative;">
    <div class="row">
        <div class="col-lg-12" id="content" style="margin-top: 10px;">
            <div class="container ">
                <div class="row">
                <div class="form">
                    
                    <br><br><br>
                    <h1>Add a Coin</h1>
                    <div class="col-lg-12 coindetailsform bg-secondary-subtle rounded shadow p-4">
                    <h3>Coin Details</h3>
                    <form action="processcoinsubmission.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <label for="coinname">Name:</label>
                                <input type="text" class="form-control" id="coinname" name="name">
                            </div>
                            <div class="col">
                                <label for="upload">Logo:</label>
                                <input type='file' id="input" name="logo" accept=".png, .jpg, .jpeg, .webp" />
                                <script>
                                    $(document).ready(function() {
                                        $('#input').change(function() {
                                            var file = this.files[0];
                                            var fileType = file.type;
                                            var match = ['image/jpeg', 'image/png', 'image/webp'];
                                            if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
                                                alert('Sorry, only JPG, PNG, and WEBP files are allowed.');
                                                this.value = '';
                                                return false;
                                            }
                                            if (file.size > 307200) {
                                                alert('Sorry, your file is too large. Maximum size allowed is 1 MB.');
                                                this.value = '';
                                                return false;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#blah').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(file);
                                        });
                                    });
                                </script>
                                <img id="blah" src="https://placehold.it/150" alt="your image" height="100px" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="symbol">Symbol:</label>
                                <input type="text" class="form-control" id="symbol" name="symbol">
                            </div>
                            <div class="col">
                                <label for="launchDate">Launch Date:</label>
                                <input type="date" class="form-control" id="launchDate" name="launchDate">
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="col-lg-12 coindetailsform bg-secondary-subtle rounded shadow p-4">
                        <h3>Token Contract Address</h3>
                        <div class="row">
                            <div class="col">
                                <label for="chain">Chain:</label>
                                <select name="chain" id="chain" class="form-control">
                                    <option value="-" selected>Select A Chain</option>
                                    <?php
                                        $sql = "SELECT DISTINCT chain FROM coins";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='".$row['chain']."'>".$row['chain']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12 coindetailsform bg-secondary-subtle rounded shadow p-4">
                        <h3>More Details</h3>
                        <div class="row">
                            <div class="col">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12 coindetailsform bg-secondary-subtle rounded shadow p-4">
                        <h3>Presale Information</h3>
                        <div class="row">
                            <div class="col">
                                <label for="presale">Do you have a Presale?</label><br>
                                <input type="checkbox" id="presale" name="presale" value="yes"><span>Yes</span>&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="presale" name="presale" value="no"><span>No</span>
                            </div>
                            <div class="col">
                                Want to be featured in our Newsletter? Fill this information as precisely as possible.
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="container">
                        <button class="btn btn btn-success">Submit Coin</button>
                    </div>
                    </div>
                    </form>
            </div>
        </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
</div>

<?php
include 'footer.php';
include 'scripts.php'; 
?>


