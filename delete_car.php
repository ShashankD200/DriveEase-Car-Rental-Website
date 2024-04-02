<?php
include 'utils/conn.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $id = $_POST['id'];

  
    $query = "DELETE FROM car_details WHERE id = $id";
    $rs = mysqli_query($conn, $query);

  
    if ($rs === TRUE) {
        echo "Successfully Deleted";
    } else {
       
        echo "Couldn't Delete: " . mysqli_error($conn);
    }
}
?>
