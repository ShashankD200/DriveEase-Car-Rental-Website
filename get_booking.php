<?php
include "utils/conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $sno = 0;
    $query = "SELECT
        Booking_table.*,
        dealer_details.*,
        car_details.*
    FROM
        Booking_table
    JOIN
        dealer_details ON Booking_table.dealer_id = dealer_details.id
    JOIN
        car_details ON Booking_table.car_id = car_details.id
    WHERE 
        user_id = $user_id 
    ORDER BY booking_date DESC ";

    $fetch_booking = mysqli_query($conn, $query);

    if ($fetch_booking->num_rows > 0) {
        $rows = array();

        while ($row = mysqli_fetch_assoc($fetch_booking)) {
            $rows[] = $row;
        }

        // Return the JSON response
        header('Content-Type: application/json');
        echo json_encode($rows);
        exit();
    } else {
        // Return a JSON response indicating no data
        header('Content-Type: application/json');
        echo json_encode(array("message" => "No Data"));
        exit();
    }
}
?>
