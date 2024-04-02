<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password_c = $_POST["password"];
    $user_type = "Customer";

    $hashed_password = password_hash($password_c, PASSWORD_DEFAULT);

    include 'utils/conn.php';

 
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        header('HTTP/1.1 400 Bad Request');
        echo "This email has already been registered.";
    } else {
        
        $query = "INSERT INTO users (full_name, password, email,user_type) VALUES ('$full_name', '$hashed_password', '$email','$user_type')";
         $rs = mysqli_query($conn, $query);

        if ($rs) {
            echo "Congratulations ! You have been  Successfully Registered !";
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo "Registration failed. Please try again.";
        }
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    echo "Invalid request method.";
}
?>
