<?php
include 'session.php';
include 'functions.php';
include 'links.php';
include 'nav.php';
include '../app/db.php';
?>

<div class="container-fluid" style="position: relative;">
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-lg-10" id="content" style="margin-top: 10px;">
            <div class="container-fluid">
             
                <div class="row firstrowincontent justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="text-center mb-4">KYC CERTIFICATE</h1>
                        
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="mb-4">Gain Trust From Potential Investors</h4>
                                
                                <p>Reveal your identity to everyone through our certificate. You'll receive:</p>
                                <ul>
                                    <li>Verification badge</li>
                                    <li>Official certificate confirming your identity verification</li>
                                </ul>

                                <h4 class="mt-4 mb-3">Smart Contract Verification</h4>
                                <p>Get your smart contracts verified by our trusted partner - a team of analysts specialized in blockchain technology.</p>
                                
                                <h5 class="mt-4">Our Process Includes:</h5>
                                <ul>
                                    <li>Complete analysis of smart contract codebase and architecture</li>
                                    <li>Rigorous testing of the project</li>
                                    <li>Code design pattern analytics</li>
                                    <li>Third-party contracts and libraries safety verification</li>
                                </ul>

                                <div class="mt-5">
                                    <h4>How to Apply:</h4>
                                    <a href="getservices.php?service=3" class="btn btn-success">Request KYC</a>
                                    <p>Contact us through:</p>
                                    <div class="d-flex flex-column">
                                        <a href="https://t.me/" class="btn btn-primary mb-2">
                                            <i class="fab fa-telegram"></i> Send us a Telegram Message
                                        </a>
                                        <a href="mailto:info@coinlistz.com" class="btn btn-secondary">
                                            <i class="fas fa-envelope"></i> Email: info@coinlistz.com
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
    </div>
</div>
<script >
    
let isSidebarHidden = false;

function checkScreenSize() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    
    if (window.innerWidth < 768) { // Assuming 768px as the breakpoint for smaller screens
        sidebar.classList.add('slide-out', 'displaynone');
        sidebar.classList.remove('col-lg-2');
        content.classList.remove('col-lg-10');
        content.classList.add('col-lg-12');
        isSidebarHidden = true;
    } else {
        sidebar.classList.remove('slide-out', 'displaynone');
        sidebar.classList.add('col-lg-2');
        content.classList.remove('col-lg-12');
        content.classList.add('col-lg-10');
        isSidebarHidden = false;
    }
}

document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (isSidebarHidden) {
        sidebar.classList.remove('slide-out', 'displaynone');
        sidebar.classList.add('slide-in', 'col-lg-2');
        content.classList.remove('col-lg-12');
        content.classList.add('col-lg-10');
    } else {
        sidebar.classList.remove('slide-in', 'col-lg-2');
        sidebar.classList.add('slide-out', 'displaynone');
        content.classList.remove('col-lg-10');
        content.classList.add('col-lg-12');
    }
    isSidebarHidden = !isSidebarHidden;
});

// Initial check on page load
checkScreenSize();

// Add event listener to handle window resize
window.addEventListener('resize', checkScreenSize);



</script>
<?php
include 'footer.php';
?>


