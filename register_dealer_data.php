<?php

include 'utils/conn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file = $_FILES['logo'];
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $c_address = mysqli_real_escape_string($conn, $_POST['c_address']);
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user_type= "Dealer";

    if (isset($file['tmp_name']) && $file['error'] == 0) {
        $img_name = $company_name . '_' . $file['name'];
        $upload_path = 'uploads/' . $img_name;
        move_uploaded_file($file['tmp_name'], $upload_path);

        $sql = "INSERT INTO dealer_details(owner_name, owner_email, owner_password, company_name, company_address, company_logo_url) 
                VALUES('$owner_name', '$email', '$hashed_password', '$company_name', '$c_address', '$img_name')";

        if (mysqli_query($conn, $sql)) {
            $last_dealer_id = mysqli_insert_id($conn);
            

            $query2 = "INSERT INTO users(full_name, password, email, user_type, dealer_id) VALUES ('$owner_name', '$hashed_password', '$email', '$user_type','$last_dealer_id')";
            $rs = mysqli_query($conn, $query2);
            $last_user_id = mysqli_insert_id($conn);
         
            if ($rs === TRUE) {
                
                $query3 = "UPDATE  dealer_details SET user_id = $last_user_id where id = $last_dealer_id";
                
                $rs3 = mysqli_query($conn, $query3);

                if ($rs3 === TRUE) {
                    echo "Dealer successfully Registered !";
                } else {
                    echo "Error: " . $query3 . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error: " . $query2 . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "File upload failed with error code " . $file['error'];
    }

    $conn->close();
}

?>
