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
                        <h1 class="text-center mb-4">Disclaimer</h1>
                        
                        <div class="card shadow">
                            <div class="card-body">
                                <p class="mb-4">
                                    All content provided herein our website, hyperlinked sites, associated applications, 
                                    forums, blogs, social media accounts and other platforms ("Site") is for your general 
                                    information only, procured from third party sources.
                                </p>

                                <p class="mb-4">
                                    We make no warranties of any kind in relation to our content, including but not limited 
                                    to accuracy and updatedness. No part of the content that we provide constitutes financial 
                                    advice, legal advice or any other form of advice meant for your specific reliance for any purpose.
                                </p>

                                <p class="mb-4">
                                    Any use or reliance on our content is solely at your own risk and discretion. You should 
                                    conduct your own research, review, analyse and verify our content before relying on them.
                                </p>

                                <p class="mb-4">
                                    Trading is a highly risky activity that can lead to major losses, please therefore consult 
                                    your financial advisor before making any decision. No content on our Site is meant to be a 
                                    solicitation or offer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
    </div>
</div>

<script>
let isSidebarHidden = false;

function checkScreenSize() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    
    if (window.innerWidth < 768) {
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

checkScreenSize();
window.addEventListener('resize', checkScreenSize);
</script>

<?php
include 'footer.php';
?>