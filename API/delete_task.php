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

// Get the task ID from the request
$taskId = $_POST['id'];

// SQL to delete the task based on ID
$sqlDeleteTask = "DELETE FROM tasks WHERE id = $taskId";

$response = array();

if ($conn->query($sqlDeleteTask) === TRUE) {
    $response['message'] = "Task deleted successfully";
} else {
    $response['error'] = "Error deleting task: " . $conn->error;
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
