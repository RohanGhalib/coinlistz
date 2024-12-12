<?php
// Assuming $conn is your database connection
$stmt = $conn->prepare("SELECT * FROM calendar WHERE type = ? AND date = ?");
$type = 1;
$stmt->bind_param("is", $type, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    echo "<div class='row flex-nowrap overflow-auto noscrollbar' id='adsContainer'>";
    while($row = $result->fetch_assoc()){
        $link = htmlspecialchars($row['link'], ENT_QUOTES, 'UTF-8');
        $asset = htmlspecialchars($row['asset'], ENT_QUOTES, 'UTF-8');
        echo '<div class="col-lg-4 adsdiv shadow">
            <div class="innerads"><a href="'. $link .'"><img src="'. $asset .'" alt=""></a></div>
        </div>';
    }
    echo "</div>";
    echo "<a href='ads.php' class='text-align-center'>Want Your Ads Here?</a>";
    echo "<br>";
    ?>
    
    <script>
        (function () {
            const adsContainer = document.getElementById('adsContainer');
            const ads = document.querySelectorAll('.adsdiv');
            const adWidth = ads[0].offsetWidth;
            let currentIndex = 0;
            const totalAds = ads.length;
            const scrollInterval = 3000; // 3 seconds

            function scrollToNextAd() {
                currentIndex = (currentIndex + 1) % totalAds;
                adsContainer.scrollTo({
                    left: currentIndex * adWidth,
                    behavior: 'smooth'
                });
            }

            const autoScroll = setInterval(scrollToNextAd, scrollInterval);

            let isScrolling;

            adsContainer.addEventListener('scroll', function () {
                clearTimeout(isScrolling);
                isScrolling = setTimeout(function () {
                    const scrollPosition = adsContainer.scrollLeft;
                    const newIndex = Math.round(scrollPosition / adWidth);
                    adsContainer.scrollTo({
                        left: newIndex * adWidth,
                        behavior: 'smooth'
                    });
                    currentIndex = newIndex;
                }, 200);
            });

            adsContainer.addEventListener('mouseenter', function () {
                clearInterval(autoScroll);
            });

            adsContainer.addEventListener('mouseleave', function () {
                setInterval(scrollToNextAd, scrollInterval);
            });
        })();
    </script>
    
    <?php
} else {
    ?>
    <div class='row flex-nowrap overflow-auto noscrollbar' id='adsContainer'>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad1.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad2.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    <div class="col-lg-4 adsdiv shadow">
        <div class="innerads"><a href="ads.php"><img src="img/ad3.png" alt=""></a></div>
    </div>
    </div>
    <a href='ads.php' class='text-align-center'>Want Your Ads Here?</a>

    <script>
        (function () {
            const adsContainer = document.getElementById('adsContainer');
            const ads = document.querySelectorAll('.adsdiv');
            const adWidth = ads[0].offsetWidth;
            let currentIndex = 0;
            const totalAds = ads.length;
            const scrollInterval = 3000; // 3 seconds

            function scrollToNextAd() {
                currentIndex = (currentIndex + 1) % totalAds;
                adsContainer.scrollTo({
                    left: currentIndex * adWidth,
                    behavior: 'smooth'
                });
            }

            const autoScroll = setInterval(scrollToNextAd, scrollInterval);

            let isScrolling;

            adsContainer.addEventListener('scroll', function () {
                clearTimeout(isScrolling);
                isScrolling = setTimeout(function () {
                    const scrollPosition = adsContainer.scrollLeft;
                    const newIndex = Math.round(scrollPosition / adWidth);
                    adsContainer.scrollTo({
                        left: newIndex * adWidth,
                        behavior: 'smooth'
                    });
                    currentIndex = newIndex;
                }, 200);
            });

            adsContainer.addEventListener('mouseenter', function () {
                clearInterval(autoScroll);
            });

            adsContainer.addEventListener('mouseleave', function () {
                setInterval(scrollToNextAd, scrollInterval);
            });
        })();
    </script>
    <?php
}
?>
