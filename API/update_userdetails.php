<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userId = $_POST['userId'];
    $newUsername = $_POST['username'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE task_user SET username = ? WHERE user_id = ?");
    $stmt->bind_param("ss", $newUsername, $userId); // Assuming 's' for string and 'i' for integer

    if ($stmt->execute()) {
        echo "Successful!";
    } else {
        echo "Failed!";
    }

    $stmt->close();
       
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>