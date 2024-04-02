<?php

include 'utils/conn.php';

$search = $_POST['search'];
$fromDate = $_POST['from_date'];
$toDate = $_POST['to_date'];

$query = "SELECT * FROM car_details 
          WHERE id NOT IN (
              SELECT car_id FROM booking_table 
              WHERE (
                  (booking_till >= '$fromDate' AND booking_from <= '$fromDate') OR
                  (booking_from <= '$toDate' AND booking_till >= '$toDate')
              )
          )
          ORDER BY created_at DESC";


$result = mysqli_query($conn, $query);

if ($result) {
    $rows = array(); 

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row; 
    }

    echo json_encode($rows); 
} else {
    echo "Error executing query: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
