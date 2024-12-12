<?php
include 'db.php';
if(isset($_POST['shuffle'])){
// Fetch all votes from the coins table
$query = "SELECT id, votes FROM coins";
$result = mysqli_query($conn, $query);

$coins = [];
$totalVotes = 0;
$maxVotes = 0;

// Calculate total votes and find the maximum votes a coin has
while ($row = mysqli_fetch_assoc($result)) {
    $coins[$row['id']] = $row['votes'];
    $totalVotes += $row['votes'];
    if ($row['votes'] > $maxVotes) {
        $maxVotes = $row['votes'];
    }
}

// Shuffle votes
$remainingVotes = $totalVotes;
$newVotes = array_fill_keys(array_keys($coins), 0);

while ($remainingVotes > 0) {
    foreach ($coins as $id => $votes) {
        if ($remainingVotes <= 0) {
            break;
        }
        $randomVotes = rand(0, min($remainingVotes, $maxVotes));
        $newVotes[$id] += $randomVotes;
        $remainingVotes -= $randomVotes;
    }
}

// Update the coins table with new votes
foreach ($newVotes as $id => $votes) {
    $updateQuery = "UPDATE coins SET votes = $votes WHERE id = $id";
    mysqli_query($conn, $updateQuery);
}
header('Location: allcoins.php');
exit();
}
?>