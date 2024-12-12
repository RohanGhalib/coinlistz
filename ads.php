<head>
	<title>Advertise | CoinListz</title>
</head>
<?php
include 'links.php';
include 'nav.php';
include '../app/db.php';
?>
<div class="container-fluid" style="position: relative;">
    <div class="row">
        <div class="col-lg-12" id="content" style="margin-top: 10px;">
            <div class="row">
               
            <div class="container py-5">
               
                <!-- Services Section -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold ">Our Premium Services</h2>
                    <a href="dashboard.php"><button class="btn btn-success">Ads Dashboard</button></a>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <i class="bi bi-clock-history fs-1 text-warning mb-3"></i>
                            <h5>24/7 Support</h5>
                            <p>Fast support within 24 hours</p>
                        </div>
                        <div class="col-md-3">
                            <i class="bi bi-arrow-repeat fs-1 text-info mb-3"></i>
                            <h5>Unlimited Updates</h5>
                            <p>Unlimited updates for your project</p>
                        </div>
                        <div class="col-md-3">
                            <i class="bi bi-graph-up fs-1 text-success mb-3"></i>
                            <h5>Free Analytics</h5>
                            <p>Free graphs and pricing info</p>
                        </div>
                        <div class="col-md-3">
                            <i class="bi bi-megaphone fs-1 text-danger mb-3"></i>
                            <h5>Maximum Exposure</h5>
                            <p>Massive exposure for your project</p>
                        </div>
                    </div>
                </div>
 
                <!-- Stats Section -->
                <div class="bg-dark text-white p-4 rounded-3 mb-5">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h3 class="text-warning">1.5M+</h3>
                            <p>Active Monthly Users</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-info">39K+</h3>
                            <p>Projects Listed</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-success">300K+</h3>
                            <p>Views Per Day</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-danger">12.5M+</h3>
                            <p>Votes Placed</p>
                        </div>
                    </div>
                </div>

                <!-- Pricing Cards -->
                <div class="row">
                <h2>Most Common:</h2>
                <hr>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-lg">
                        <img src="img/ad2.png" class="card-img-top" alt="Highlighted Coin Image">

                            <div class="card-body">
                                <h4 class="card-title text-primary">Basic Banner Ads</h4>
                                <p>Your banners are shown on all pages, shared traffic</p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle text-success"></i> Desktop 728x90</li>
                                    <li><i class="bi bi-check-circle text-success"></i> Mobile 320x100</li>
                                </ul>
                                <h3 class="text-center">$150<small>/day</small></h3>
                                <a href="getservices.php?service=1"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-lg border-primary">
                        <img src="img/ad1.png" class="card-img-top" alt="Highlighted Coin Image">

                            <div class="card-body">
                                <h4 class="card-title text-primary">Premium Banner Ads</h4>
                                <p>Full width banner shown at bottom, dedicated spot</p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle text-success"></i> Desktop 1920x130</li>
                                    <li><i class="bi bi-check-circle text-success"></i> Tablet 1280x100</li>
                                    <li><i class="bi bi-check-circle text-success"></i> Mobile 500x150</li>
                                </ul>
                                <h3 class="text-center">$300<small>/day</small></h3>
                                <a href="getservices.php?service=2"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-lg">
                        <img src="img/ad5.png" class="card-img-top" alt="Highlighted Coin Image">

                            <div class="card-body">
                                <h4 class="card-title text-primary">Promoted Spots</h4>
                                <p>Featured placement in promoted coins section</p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle text-success"></i> Homepage Placement</li>
                                    <li><i class="bi bi-check-circle text-success"></i> Maximum Visibility</li>
                                </ul>
                                <h3 class="text-center">$50<small>/day</small></h3>
                                <a href="getservices.php?service=3"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                <h2>Exclusive Deals:</h2>
                <hr>
                <!-- Highlighted Coin Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-lg">
                        <img src="img/ad4.png" class="card-img-top" alt="Highlighted Coin Image">
                        <div class="card-body">
                            <h4 class="card-title text-primary">
                                <i class="bi bi-star-fill fs-4 me-2"></i>
                                Highlighted Coin
                            </h4>
                            <p>Feature your coin at the top of our listings for maximum visibility.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle text-success"></i> Top Placement</li>
                                <li><i class="bi bi-check-circle text-success"></i> Increased Traffic</li>
                            </ul>
                            <h3 class="text-center">$30<small>/day</small></h3>
                            <a href="getservices.php?service=4"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                            </div>
                    </div>
                </div>

                <!-- Custom Profile Banner Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-lg">
                    <img src="img/ad6.png" class="card-img-top" alt="Highlighted Coin Image">

                        <div class="card-body">
                            <h4 class="card-title text-primary">
                                <i class="bi bi-person-badge fs-4 me-2"></i>
                                Custom Profile Banner
                            </h4>
                            <p>Create a custom banner for your profile to stand out.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle text-success"></i> Unique Design</li>
                                <li><i class="bi bi-check-circle text-success"></i> High Visibility</li>
                            </ul>
                            <h3 class="text-center">$500<small>/Lifetime</small></h3>
                            <a href="unlockbanner.php"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                            </div>
                    </div>
                </div>
</div>


<!-- Discount Coupon Section -->
<div class="row mt-4" data-bs-theme="light">
    <div class="col-md-12 mb-4">
        <div class="card h-100 shadow-lg bg-light">

            <div class="card-body text-center">
                <h4 class="card-title text-danger">
                    <i class="bi bi-tags fs-4 me-2"></i>
                    Special Discounts
                </h4>
                <p>Get amazing discounts on extended plans!</p>
                <div class="row">
                    
                <div class="col-md-4">
                    
                        <div class="p-3 border rounded bg-dark text-white" >
                            <h3 class="text-success"><strong>15% OFF</strong></h3>
                            <p>On 3 days or more</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-dark text-white" >
                            <h3 class="text-primary"><strong>25% OFF</strong></h3>
                            <p>On 7 days or more</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-dark text-white" >
                            <h3 class="text-danger"><strong>40% OFF</strong></h3>
                            <p>On 14 days or more</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    <!-- Additional Services -->
                    <div class="row mt-4">
                        <h2>Additional Services:</h2>
                        <hr>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-lg">
                            <img src="img/ad3.png" class="card-img-top" alt="Highlighted Coin Image">

                                <div class="card-body">
                                    <h4 class="card-title text-primary">
                                        <i class="bi bi-envelope-paper fs-4 me-2"></i>
                                        Email Blast
                                    </h4>
                                    <p>Send your message to our 30,000+ email subscribers.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check-circle text-success"></i> Dedicated Email Campaign</li>
                                        <li><i class="bi bi-check-circle text-success"></i> Direct Community Access</li>
                                    </ul>
                                    <p class="fst-italic">1 Custom Email to all of our NewsLetter Subscribers</p>
                                    <h3 class="text-center">From $800</h3>

                                    <a href="getservices.php?service=6"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-lg">
                            <img src="img/ad7.png" class="card-img-top" alt="Highlighted Coin Image">

                                <div class="card-body">
                                    <h4 class="card-title text-primary">
                                        <i class="bi bi-shield-check fs-4 me-2"></i>
                                        Contract Audit
                                    </h4>
                                    <p>We will audit your smart contract for security vulnerabilities.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check-circle text-success"></i> Comprehensive Security Review</li>
                                        <li><i class="bi bi-check-circle text-success"></i> Detailed Report Provided</li>
                                    </ul>
                                    <p class="fst-italic">A report will be provided to share with your community.</p>
                                    <h3 class="text-center">From $550</h3>
                                    <a href="getservices.php?service=7"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-lg">
                            <img src="img/ad5.png" class="card-img-top" alt="Highlighted Coin Image">

                                <div class="card-body">
                                    <h4 class="card-title text-primary">
                                        <i class="bi bi-person-check fs-4 me-2"></i>
                                        KYC Verification
                                    </h4>
                                    <p>Ensure your project is verified with our KYC service.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check-circle text-success"></i> Identity Verification</li>
                                        <li><i class="bi bi-check-circle text-success"></i> Increased Trust</li>
                                    </ul>
                                    <p class="fst-italic">Verification badge will be displayed on your profile.</p>
                                    <h3 class="text-center">$300<small>/one-time</small></h3>
                                    <a href="getservices.php?service=8"><button class="btn btn-primary w-100 btn-glow">Get Started</button></a>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
            <style>
            .btn-glow {
                box-shadow: 0 0 15px rgba(0,123,255,0.5);
                transition: all 0.3s ease;
            }
            .btn-glow:hover {
                box-shadow: 0 0 30px rgba(0,123,255,0.8);
                transform: translateY(-2px);
            }
            .card {
                transition: transform 0.3s ease;
            }
            .card:hover {
                transform: translateY(-5px);
            }
            </style>
        </div>
    </div>
</div>
</div>
<?php
include 'footer.php';
include 'scripts.php'
?>
