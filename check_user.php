<?php
include 'utils/conn.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT user_id, email, password, user_type FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $userId = $row['user_id'];
            $userEmail = $row['email'];
            $hashedPassword = $row['password'];
            $user_type = $row['user_type'];

            if ($hashedPassword && password_verify($password, $hashedPassword)) {
              
              session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_email'] = $userEmail;
                $_SESSION['user_type'] = $user_type;
                
                
                $response = array(
                    'status' => 'success',
                    'message' => 'Login successful!',
                    'user_type' => $user_type,
                    'user_id' =>$_SESSION['user_id']
                );


                
                echo json_encode($response);
                
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo "Invalid email or password.";
            }
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo "Invalid email or password.";
        }

        mysqli_free_result($result);
    } else {
    
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Please provide email and password.";
}
?>
