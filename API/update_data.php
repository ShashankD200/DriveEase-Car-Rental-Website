<?php
header("Access-Control-Allow-Origin: *");

// Other headers you may need to add, depending on your requirements
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600");

// Replace these with your MySQL database credentials
$servername = "localhost";
$username = "id21338512_root";
$password = "aS?\&65mi@_?pU~^";
$dbname = "id21338512_car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the request
$taskId = $_POST['id'];
$newTitle = $_POST['title'];
$newDescription = $_POST['description'];
$userId = $_POST['user_id']; // Assuming user ID is provided as a parameter

// SQL to update task details based on ID and user ID
$sqlUpdateTask = "UPDATE tasks SET title = '$newTitle', description = '$newDescription' WHERE id = $taskId AND user_id = '$userId'";

$response = array();

if ($conn->query($sqlUpdateTask) === TRUE) {
    $response['message'] = "Task updated successfully";
} else {
    $response['error'] = "Error updating task: " . $conn->error;
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
