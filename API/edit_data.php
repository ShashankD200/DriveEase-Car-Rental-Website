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

// Get the task ID and user ID from the request
$taskId = $_GET['id'];
$userId = $_GET['user_id']; // Assuming user ID is provided as a query parameter

// SQL to retrieve task details based on ID and user ID
$sqlRetrieveTask = "SELECT id, title, description FROM tasks WHERE id = $taskId AND user_id = '$userId'";

$result = $conn->query($sqlRetrieveTask);

$response = array();

if ($result === false) {
    $response['error'] = "Error executing the SQL query: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
        $response = $task;
    } else {
        $response['message'] = "Task not found";
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
