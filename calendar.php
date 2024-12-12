<?php
include '../app/db.php';

try {
    // Get 'adtype' from URL parameters
    $adtype = isset($_GET['adtype']) ? $_GET['adtype'] : '';

    // Write the SQL query directly
    $sql = "
        SELECT dates 
        FROM transactions 
        WHERE ad_type = '$adtype' 
        AND (
            status = 'success' 
            OR 
            (status = 'pending' AND time_created BETWEEN NOW() - INTERVAL 60 MINUTE AND NOW())
        )
    ";

    // Execute the query
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Error in query: " . $conn->error);
    }

    // Initialize an array to store individual dates
    $slots = [];

    // Process each transaction's dates
    while ($transaction = $result->fetch_assoc()) {
        // Decode JSON dates into an array
        $dates = json_decode($transaction['dates'], true);

        // Convert each date in the array to the correct format (YYYY-MM-DD)
        foreach ($dates as $date) {
            $slots[] = [
                'start' => date('Y-m-d', strtotime($date)),
                'end' => date('Y-m-d', strtotime($date)) // Assuming start and end are the same here
            ];
        }
    }

    // Output the results in JSON format
    echo json_encode($slots);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    $conn->close();
}
?>
