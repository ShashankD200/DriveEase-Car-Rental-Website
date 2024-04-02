<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600");

$servername = "localhost";
$username = "id21338512_root";
$password = "aS?\&65mi@_?pU~^";
$dbname = "id21338512_car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the request
$title = $_POST['title'];
$description = $_POST['description'];
$userid = $_POST['userid']; // Add userid

$response = array();

// Using prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO tasks (title, description, user_id) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $description, $userid);

if ($stmt->execute()) {
    $response['message'] = "Task added successfully";
} else {
    $response['error'] = "Error adding task: " . $conn->error;
}

$stmt->close();

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
