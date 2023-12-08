<?php
// Assuming you have a database connection established already
include 'config.php';
// Get user_id from the query parameters
$user_id = $_GET['user_id'];

// Fetch user information from the database based on user_id
// Replace 'your_database_table' with the actual name of your table
$query = "SELECT archipelago FROM user_form WHERE user_id = $user_id";

$result = mysqli_query($conn, $query);

if ($result) {
    // Assuming the user_id is unique, so there should be at most one result
    $row = mysqli_fetch_assoc($result);

    // Return the user information in JSON format
    header('Content-Type: application/json');
    echo json_encode(['archipelago' => $row['archipelago']]);
} else {
    // Handle the case where the query fails
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Failed to retrieve user information']);
}
?>
