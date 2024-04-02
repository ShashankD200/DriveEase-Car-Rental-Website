<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform basic validation (you should enhance this based on your requirements)
    if (empty($email) || empty($password)) {
        $response = array('status' => 'error', 'message' => 'All fields are required.');
    } else {
        // Connect to the database
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

        // Fetch user data from the database based on the provided email
        $sql = "SELECT * FROM task_user WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, verify the password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => array(
                        'username' => $row['username'],
                        'email' => $row['email'],
                    ),
                );
            } else {
                // Password does not match
                $response = array('status' => 'error', 'message' => 'Invalid email or password.');
            }
        } else {
            // User not found
            $response = array('status' => 'error', 'message' => 'User not found.');
        }

        // Close the database connection
        $conn->close();
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
