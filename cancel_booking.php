<?php
include 'utils/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $booking_id = $_POST['booking_id'];
echo $booking_id;
    
    $delete_data = mysqli_query($conn, "DELETE FROM booking_table WHERE booking_id = $booking_id ");

    if ($delete_data) {
        echo "Deleted Successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

?>
