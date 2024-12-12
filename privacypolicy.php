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
                    <div class="col-lg-10">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h1 class="text-center mb-5">Privacy Policy</h1>

                                <p class="lead">This privacy notice for COINLISTZ describes how and why we might collect, store, use, and/or share ("process") your information when you use our services ("Services").</p>

                                <h4 class="mt-4">Table of Contents</h4>
                                <nav class="mb-4">
                                    <ul>
                                        <li><a href="#collect">What Information Do We Collect?</a></li>
                                        <li><a href="#process">How Do We Process Your Information?</a></li>
                                        <li><a href="#legal">What Legal Bases Do We Rely On?</a></li>
                                        <li><a href="#share">When and With Whom Do We Share Your Information?</a></li>
                                        <li><a href="#third-party">Third-Party Websites</a></li>
                                        <li><a href="#cookies">Cookies and Tracking</a></li>
                                        <li><a href="#social">Social Logins</a></li>
                                        <li><a href="#retention">Information Retention</a></li>
                                        <li><a href="#security">Information Security</a></li>
                                        <li><a href="#minors">Information from Minors</a></li>
                                        <li><a href="#rights">Your Privacy Rights</a></li>
                                        <li><a href="#dnt">Do-Not-Track Features</a></li>
                                        <li><a href="#us-rights">US Residents' Privacy Rights</a></li>
                                        <li><a href="#updates">Privacy Notice Updates</a></li>
                                        <li><a href="#contact">Contact Information</a></li>
                                    </ul>
                                </nav>

                                <section id="collect">
                                    <h3>1. What Information Do We Collect?</h3>
                                    <p><strong>Personal information you disclose to us</strong></p>
                                    <p><em>In Short: We collect personal information that you provide to us.</em></p>
                                    
                                    <p>We collect personal information that you voluntarily provide to us when you express an interest in obtaining information about us or our products and Services, when you participate in activities on the Services, or otherwise when you contact us.</p>
                                    
                                    <p><strong>Personal Information Provided by You:</strong> The personal information that we collect depends on the context of your interactions with us and the Services, the choices you make, and the products and features you use. The personal information we collect may include the following:</p>
                                    <ul>
                                        <li>Email addresses</li>
                                        <li>Usernames</li>
                                        <li>Passwords</li>
                                        <li>Contact preferences</li>
                                        <li>Contact or authentication data</li>
                                    </ul>

                                    <p><strong>Sensitive Information:</strong> We do not process sensitive information.</p>

                                    <p><strong>Information automatically collected</strong></p>
                                    <p><em>In Short: Some information — such as your Internet Protocol (IP) address and/or browser and device characteristics — is collected automatically when you visit our Services.</em></p>

                                    <p>We automatically collect certain information when you visit, use, or navigate the Services. This information includes:</p>
                                    <ul>
                                        <li>Log and Usage Data</li>
                                        <li>Device Data</li>
                                        <li>Location Data</li>
                                    </ul>
                                </section>

                                <section id="process">
                                    <h3>2. How Do We Process Your Information?</h3>
                                    <p><em>In Short: We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply with law.</em></p>
                                    
                                    <p>We process your personal information for a variety of reasons, including:</p>
                                    <ul>
                                        <li>To facilitate account creation and management</li>
                                        <li>To deliver services to users</li>
                                        <li>To send marketing communications</li>
                                        <li>To deliver targeted advertising</li>
                                        <li>To identify usage trends</li>
                                        <li>To determine marketing effectiveness</li>
                                        <li>To protect vital interests</li>
                                    </ul>
                                </section>

                                <section id="legal">
                                    <h3>3. What Legal Bases Do We Rely On?</h3>
                                    <p><em>In Short: We only process your information when we have valid legal reasons to do so.</em></p>
                                    
                                    <p>We rely on several legal bases to process your information, including:</p>
                                    <ul>
                                        <li>Consent</li>
                                        <li>Performance of a Contract</li>
                                        <li>Legitimate Interests</li>
                                        <li>Legal Obligations</li>
                                        <li>Vital Interests</li>
                                    </ul>
                                </section>

                                <!-- Additional sections -->
                                <section id="share">
                                    <h3>4. When and With Whom Do We Share Your Personal Information?</h3>
                                    <p><em>In Short: We may share information in specific situations described in this section and/or with the following categories of third parties.</em></p>
                                    
                                    <p><strong>Vendors, Consultants, and Other Third-Party Service Providers:</strong> We may share your data with third parties who perform services for us or on our behalf. We have contracts in place to safeguard your personal information. The third parties we may share with include:</p>
                                    <ul>
                                        <li>Ad Networks</li>
                                        <li>Data Analytics Services</li>
                                        <li>Communication & Collaboration Tools</li>
                                        <li>Cloud Computing Services</li>
                                        <li>Performance Monitoring Tools</li>
                                        <li>Payment Processors</li>
                                    </ul>
                                    
                                    <p><strong>Other Situations:</strong></p>
                                    <ul>
                                        <li>Business Transfers</li>
                                        <li>Google Analytics sharing</li>
                                    </ul>
                                </section>

                                <section id="third-party">
                                    <h3>5. What is Our Stance on Third-Party Websites?</h3>
                                    <p><em>In Short: We are not responsible for the safety of information shared with third parties.</em></p>
                                    
                                    <p>We do not control third-party websites, services, or applications linked from our Services. We are not liable for their privacy practices or content. Review their policies directly for questions.</p>
                                </section>

                                <section id="cookies">
                                    <h3>6. Do We Use Cookies and Other Tracking Technologies?</h3>
                                    <p><em>In Short: We may use cookies and tracking technologies to collect and store information.</em></p>
                                    
                                    <p>We may use cookies, web beacons, and pixels. See our Cookie Statement for details.</p>
                                </section>

                                <section id="social">
                                    <h3>7. How Do We Handle Your Social Logins?</h3>
                                    <p><em>In Short: If you use social media login, we receive certain profile information.</em></p>
                                    
                                    <p>When using social login, we receive profile information from your provider. We use this information as described in this privacy notice.</p>
                                </section>

                                <section id="retention">
                                    <h3>8. How Long Do We Keep Your Information?</h3>
                                    <p><em>In Short: We keep information as long as necessary for the purposes stated.</em></p>
                                    
                                    <p>We retain personal information for no longer than three months after account termination, unless legally required otherwise.</p>
                                </section>

                                <section id="security">
                                    <h3>9. How Do We Keep Your Information Safe?</h3>
                                    <p><em>In Short: We use technical and organizational security measures to protect your data.</em></p>
                                    
                                    <p>While we implement security measures, no electronic transmission is 100% secure. Access Services only in secure environments.</p>
                                </section>

                                <section id="minors">
                                    <h3>10. Do We Collect Information From Minors?</h3>
                                    <p><em>In Short: We do not knowingly collect data from people under 18.</em></p>
                                    
                                    <p>Users must be 18+ or have parental consent. Contact us if you believe we have collected minor data.</p>
                                </section>

                                <section id="rights">
                                    <h3>11. What Are Your Privacy Rights?</h3>
                                    <p><em>In Short: You have certain rights regarding your personal information, varying by region.</em></p>
                                    
                                    <p>Depending on location, rights may include:</p>
                                    <ul>
                                        <li>Access and copy your data</li>
                                        <li>Request rectification or erasure</li>
                                        <li>Restrict processing</li>
                                        <li>Data portability</li>
                                        <li>Object to processing</li>
                                        <li>Withdraw consent</li>
                                        <li>Opt out of marketing</li>
                                        <li>Account termination</li>
                                    </ul>
                                </section>
                                <section id="dnt">
                                    <h3>12. Controls for Do-Not-Track Features</h3>
                                    <p><em>In Short: We do not currently respond to DNT browser signals.</em></p>
                                    
                                    <p>Most web browsers include a Do-Not-Track ("DNT") feature. No uniform technology standard for DNT signals exists yet. We do not currently respond to DNT browser signals or other automatic tracking prevention mechanisms.</p>
                                </section>

                                <section id="us-rights">
                                    <h3>13. Do United States Residents Have Specific Privacy Rights?</h3>
                                    <p><em>In Short: Yes, US residents have specific rights regarding their personal information.</em></p>

                                    <p><strong>Categories of Personal Information We Collect:</strong></p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Examples</th>
                                                    <th>Collected</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>A. Identifiers</td>
                                                    <td>Contact details, IP address, email, account name</td>
                                                    <td>Yes</td>
                                                </tr>
                                                <tr>
                                                    <td>E. Internet Activity</td>
                                                    <td>Browsing history, online behavior</td>
                                                    <td>Yes</td>
                                                </tr>
                                                <tr>
                                                    <td>F. Geolocation</td>
                                                    <td>Device location</td>
                                                    <td>Yes</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <p><strong>Retention Periods:</strong></p>
                                    <ul>
                                        <li>Category A: Duration of account</li>
                                        <li>Category E: 14 months</li>
                                        <li>Category F: 14 months</li>
                                    </ul>
                                </section>

                                <section id="updates">
                                    <h3>14. Do We Make Updates to This Notice?</h3>
                                    <p><em>In Short: Yes, we update this notice as needed to comply with relevant laws.</em></p>
                                    
                                    <p>We may update this privacy notice periodically. The updated version will be indicated by a new "Revised" date. We'll notify you of material changes either through a notice or direct notification.</p>
                                </section>

                                <section id="review">
                                    <h3>15. How Can You Review, Update, or Delete Your Data?</h3>
                                    <p>To request review, update, or deletion of your personal information, please contact us at info@coinlistz.com.</p>
                                </section>
                                <section id="contact" class="mt-5">
                                    <h3>Contact Us</h3>
                                    <p>If you have questions about this privacy policy, please contact us at:</p>
                                    <p><strong>Email:</strong> info@coinlistz.com</p>
                                </section>

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

<?php include 'footer.php'; ?>