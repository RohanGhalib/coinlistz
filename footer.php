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
    <footer class="bg-secondary-subtle shadow">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h5>QUICK LINKS</h5>
                    <ul>
                        <a href="allcoins.php"><li>List of all Coins</li></a>
                        <a href="addcoin.php"><li>Request a Token Update</li></a>
                        <a href="addcoin.php"><li>Submit a Coin</li></a>
                    </ul>
                    <h5>ADD ASSETS</h5>
                    <ul>
                        <a href="addcoin.php"><li>Submit A Token</li></a>
                        <a href="contact.php"><li>Request an Update</li></a>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>ADVERTISING </h5>
                    <ul>
                        <a href="ads.php"><li>Promoted coins</li></a>
                        <a href="ads.php"><li>Premium banner ads</li></a>
                        <a href="ads.php"><li>Basic Rotating banner ads</li></a>
                        <a href="ads.php"><li>Sticky banner ads</li></a>
                        <a href="ads.php"><li>Custom Profile Banner</li></a>
                        <a href="ads.php"><li>Pop up ads</li></a>
                        <a href="ads.php"><li>Email to our subscribers</li></a>

                    </ul>
                    
                </div>
                <div class="col-lg-3">
                    <h5>Services</h5>
                    <ul>
                        <a href="ads.php"><li>KYC Badges </li></a>
                        <a href="ads.php"><li>Audit project</li></a>
                        <a href="addcoin.php"><li><button class="btn btn-success mt-4">Submit Your Coin Free</button></li></a>

                    </ul>
                    
                </div>
                <div class="col-lg-3">
                   
                    <h5>Legal</h5>
                    <ul>
                        <a href="terms.php"><li>Terms & Conditions</li></a>
                        <a href="privacypolicy.php"><li>Privacy Policy</li></a>
                        
                        <a href="disclaimer.php"><li>Disclaimer</li></a>
                        
                    </ul>
                </div>

            </div>
            <br><br><br>
            <div class="row d-flex align-items-center">
                <div class="col-lg-4"><h1>CoinListz</h1></div>
                <div class="col-lg-4 mt-4">
                    <div class="row">
                        <div class="col">
                        
                        <button class="btn btn-outline-light"><a href="<?php echo $telegramLink ?>"><i class="bi bi-telegram"></i></a></button></div>
                        <div class="col">
                        
                            <button class="btn btn-outline-light"><a href="<?php echo $whatsappLink ?>"><i class="bi bi-whatsapp"></i></a></button></div>
                        <div class="col">
                        <button class="btn btn-outline-light"><a href="<?php echo $emailLink ?>"><i class="bi bi-envelope-fill"></i></a></button></div>
                        

                    </div>
                </div>
                <div class="col-lg-4 mt-4">
                    <i class="bi bi-info-circle-fill"></i>
                    Any Questions?<br>
                    <a href="<?php echo $emailLink?>">Contact Us</a>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
        <div class="row justify-content-center"> &copy; 2024 CoinListz.com All Rights Reserved</div>
        </div>
        <br>
    </footer>
    </body>
