<?php
// Replace these with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data based on the search input
$search = $_POST['search'] ?? '';
$sql = "SELECT id, fullname FROM user_form WHERE fullname LIKE '%$search%' LIMIT 1";
$result = $conn->query($sql);

// Process the result into an array
$users = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Close the database connection
$conn->close();

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($users);
?>
