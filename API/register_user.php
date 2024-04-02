<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the request
    $un = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userId = $_POST['userId'];

    // Perform basic validation (you should enhance this based on your requirements)
    if (empty($un) || empty($email) || empty($password)) {
        $response = array('status' => 'error', 'message' => 'All fields are required.');
    } else {
        // Hash the password for security (use a stronger hashing mechanism in production)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Perform user registration and database insertion
      $servername = "localhost";
$username = "id21338512_root";
$password = "aS?\&65mi@_?pU~^";
$dbname = "id21338512_car_rental";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the 'task_user' table
        $sql = "INSERT INTO task_user (username, email, password,user_id) VALUES ('$un', '$email', '$hashedPassword','$userId')";

        if ($conn->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => array(
                    'username' => $username,
                    'email' => $email,
                ),
            );
        } else {
            $response = array('status' => 'error', 'message' => 'Error inserting data into the database: ' . $conn->error);
        }

        // Close the database connection
        $conn->close();
    }

    // Send the JSON response
   
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
