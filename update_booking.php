<?php
include 'utils/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id=$_POST['booking_id'];

   
       
        $query = "UPDATE booking_table SET status = 'Confirm' where booking_id = '$booking_id' ";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Booking successful!";
        } else {
            echo "Error occurred while booking. Please try again.";
        }
    } else {
    echo "Invalid request method";
}
?>
