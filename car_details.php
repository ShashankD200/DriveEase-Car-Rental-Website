<?php
include 'utils/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleModel = $_POST['vehicle_model'];
    $vehicleNumber = $_POST['vehicle_number'];
    $seatingCapacity = $_POST['seating_capacity'];
    $rentPerDay = $_POST['rent_per_day'];
    $car_image_name = $_FILES['image']['name'];
    $car_image_tmp = $_FILES['image']['tmp_name'];
    $dealer_id = $_POST['dealer_id'];


    $targetDir = 'car_details/';
    $car_image_url = $vehicleNumber . '_' . $car_image_name;
    $targetFile = $targetDir . basename($car_image_url);

       
        $sql = "INSERT INTO car_details (vehicle_model, vehicle_number, seating_capacity, rent_per_day, car_image_url,dealer_id) VALUES ('$vehicleModel', '$vehicleNumber', '$seatingCapacity', '$rentPerDay', '$car_image_url','$dealer_id')";

        move_uploaded_file($car_image_tmp, $targetFile);

        if(mysqli_query($conn, $sql)) {

            echo " Inserted Succesfully ! ";
          
        } else {
            echo "Error inserting car details: " . mysqli_error($conn);
        }
    $conn->close();
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request method'];
    echo json_encode($response);
}
?>
