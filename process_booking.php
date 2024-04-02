<?php
include 'utils/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $dealer_id = $_POST['dealer_id'];
    $car_id = $_POST['car_id'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $des = $_POST['des'];
    $drivingLicense = $_POST['drivingLicense'];
    $mobile = $_POST['mobile'];

    // Calculate the total days between booking_from and booking_till
    $datetime1 = new DateTime($fromDate);
    $datetime2 = new DateTime($toDate);
    $interval = $datetime1->diff($datetime2);
    $totalDays = $interval->days;

    // Fetch the price from the car_details table based on car_id
    $fetchPriceQuery = "SELECT rent_per_day FROM car_details WHERE id = '$car_id'";
    $priceResult = mysqli_query($conn, $fetchPriceQuery);

    if ($priceResult) {
        $row = mysqli_fetch_assoc($priceResult);
        $price = $row['rent_per_day'];

        // Calculate the total amount
        $totalAmount = $totalDays * $price;

        // Check for existing bookings
        $checkBookingQuery = "SELECT * FROM booking_table 
                              WHERE car_id = '$car_id' 
                              AND dealer_id = '$dealer_id' 
                              AND (('$fromDate' BETWEEN booking_from AND booking_till) OR ('$toDate' BETWEEN booking_from AND booking_till))";

        $existingBookingResult = mysqli_query($conn, $checkBookingQuery);

        if (mysqli_num_rows($existingBookingResult) > 0) {
            echo "There is already an existing booking for the specified car. We have processed your booking. If your booking is successful, we will inform you!";
        } else {
            // Insert the booking with the calculated total amount
            $insertQuery = "INSERT INTO booking_table (car_id, dealer_id, user_id, booking_from, booking_till, des, drivingLicense, mobile, total_amount, days) 
                            VALUES ('$car_id', '$dealer_id', '$user_id', '$fromDate', '$toDate', '$des', '$drivingLicense', '$mobile', '$totalAmount','$totalDays')";

            $result = mysqli_query($conn, $insertQuery);

            if ($result) {
                echo "Booking successful!";
            } else {
                echo "Error occurred while booking. Please try again.";
            }
        }
    } else {
        echo "Error fetching the price. Please try again.";
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
