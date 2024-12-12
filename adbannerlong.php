
<?php
// Prepare and execute the query securely
$stmt = $conn->prepare("SELECT * FROM calendar WHERE type = 2 AND date = ? ORDER BY RAND() LIMIT 1");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = htmlspecialchars($row['asset'], ENT_QUOTES, 'UTF-8');
        $link = htmlspecialchars($row['link'], ENT_QUOTES, 'UTF-8');
        echo '<div class="row justify-content-center mb-2 text-align-center">';
        echo '<div class="col-lg-12 adbannerlong">';
        echo '<a href="'. $link .'"><img src="' . $imagePath . '" alt="Ad Banner"></a>';
        echo '</div>';
        echo '</div>';
} else {
        echo '<div class="row justify-content-center mb-2">';
        echo '<div class="col-lg-12 adbannerlong">';
        echo '<img src="img/longbanner.png" alt="Default Ad Banner">';
        echo '</div>';
        echo '<a href="ads.php" class="text-align-center">Want Your Ads Here?</a>';
        echo '</div>';
}
?>
