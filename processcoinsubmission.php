<?php
include 'session.php';
include 'sessionstrict.php';
include '../app/db.php';

if(isset($_POST['name'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $target_dir = "user_assets/";
    $target_file = $target_dir . basename($_FILES["logo"]["name"]);
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        $logo = $target_file;
    } else {
        header('location: addcoin.php?error=1');
        exit;
    }
    $symbol = filter_input(INPUT_POST, 'symbol', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $launchDate = filter_input(INPUT_POST, 'launchDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $chain = filter_input(INPUT_POST, 'chain', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = htmlspecialchars(strip_tags($_POST['description']), ENT_QUOTES, 'UTF-8');
    function generateUniqueCoinId($conn) {
        $count = 0;
        do {
            $coin_id = '989' . rand(1, 99999);
            $stmt = $conn->prepare("SELECT COUNT(*) FROM coins WHERE coin_id = ? AND coin_id IS NOT NULL");
            $stmt->bind_param("s", $coin_id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
        } while ($count > 0);
        return $coin_id;
    }

    $coin_id = generateUniqueCoinId($conn);
    // Further processing of the sanitized data
    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO coins (name, icon_link, symbol, date_launched, chain, contract_address, description, coin_id, added_by, source) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssssssss", $name, $logo, $symbol, $launchDate, $chain, $address, $description, $coin_id, $usernameis, $usernameis);
        $stmt->execute();
        $stmt->close();
        // Redirect to coin.php with the coin_id
        header('Location: coin.php?coinid=' . $coin_id);
        exit;
    } else {
       header('location: addcoin.php?error=1');
    }
    $conn->close();
    exit;
}