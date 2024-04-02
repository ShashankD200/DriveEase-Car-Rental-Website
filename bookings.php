<?php
session_start();

include 'utils/conn.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Explore the world with DriveEase - Your Gateway to Effortless Exploration." />
    <meta name="author" content="" />
    <title>DriveEase - Your Gateway to Effortless Exploration</title>
    <style>

        body {
           
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .booking_container {
            width: 80vw;
            margin-left: 10%;
            
           margin-top:90px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
          
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff!important;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef;
        }
        .company_name{
            font-size:10px;
            color:red;
            font-weight:bold;
        }
        .vehicle_model{
            font-size:15px;
            color:green;
            font-weight:bold;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php' ?>

    <div class="booking_container">
    <?php
    $sno = 0;
    $query = "SELECT
        booking_table.*,
        dealer_details.*,
        car_details.*
    FROM
        booking_table
    JOIN
        dealer_details ON booking_table.dealer_id = dealer_details.id
    JOIN
        car_details ON booking_table.car_id = car_details.id
    WHERE 
        booking_table.user_id = '$user_id' 
    ORDER BY
        booking_table.booking_date DESC";

    $fetch_booking = mysqli_query($conn, $query);
    ?>
    <div class="table-responsive">
        <table class="table" id="bookingTable">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Vehicle</th>
                    <th>Booked From</th>
                    <th>Booked Till</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($fetch_booking)) {
                    $sno++;
                ?>
                    <tr>
                        <td><?= $sno ?></td>
                        <td>
                            <?= $row['vehicle_model'] ?>
                            <div class="vehicle_model"><?= $row['vehicle_number'] ?></div>
                            <div class="company_name"><?= $row['company_name'] ?></div>
                        </td>
                        <td><?= $row['booking_from'] ?></td>
                        <td><?= $row['booking_till'] ?></td>
                        <td>₹ <?= $row['total_amount'] ?></td>
                        <td>
                            <div class="company_name"><?= $row['booking_date'] ?></div>
                            <button disabled class="btn <?= $row['status'] == 'Confirm' ? 'btn-success' : 'btn-warning' ?> text-white fw-bold">
                                <?= $row['status'] ?>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger cancel_booking" data-id="<?= $row['booking_id'] ?>">Cancel</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php include 'footer.php';?>
<script>
    $(".cancel_booking").click(function(){
        var confirmation = confirm("Are you sure you want to Delete ?");
  if (confirmation) {
    
  
        $(this).prop("disabled", true).removeClass('btn-outline-danger').addClass('btn-danger').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...');

       const booking_id = $(this).data('id')
console.log(booking_id);
$.ajax({
    url:'cancel_booking.php',
    data:{booking_id:booking_id},
    type: 'POST',
    success: function(response){
        setTimeout(() => {

        get_data(); 
        }, 2000);

},
error:function (error) {
console.log(error);    
}
});

  }
});

function get_data(){
        console.log('user_id',user_id);
        $.ajax({
                url: 'get_booking.php',
                data: { user_id: user_id },
                dataType: 'json',
                type: 'POST',
                success: function (response) {
                    // Assuming the table has an id 'bookingTable'
                    const tableBody = $('#bookingTable tbody');
                    tableBody.empty(); // Clear existing rows

                    for (let i = 0; i < response.length; i++) {
                        const row = response[i];
                        const newRow = `<tr>
                            <td>${i + 1}</td>
                            <td>${row['vehicle_model']} <div class="vehicle_model">${row['vehicle_number']}</div><div class="company_name">${row['company_name']}</div></td>
                            <td>${row['booking_from']}</td>
                            <td>${row['booking_till']}</td>
                            <td>₹ ${row['total_amount']}</td>
                            <td><div class="company_name">${row['booking_date']}</div>
                                <button disabled class="btn ${row['status'] == 'Confirm' ? 'btn-success' : 'btn-warning'} text-white fw-bold">
                                    ${row['status']}
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger cancel_booking" onclick="get_data()" data-id="${row['booking_id']}"> Cancel </button>
                            </td>
                        </tr>`;

                        tableBody.append(newRow);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });

}

    
</script>
</body>

</html>
