<?php
include 'utils/conn.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;



if (isset($_GET['logout']) && $_GET['logout'] == 1) {
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}

if (isset($_SESSION['user_type']) == 'Dealer') {
    
    $session_email = $_SESSION['user_email'];
    
    $query="Select * from dealer_details where owner_email = '$session_email' ";
    $rs= mysqli_query($conn,$query);
    $row= mysqli_fetch_assoc($rs);

    $dealer_id=$row['id'];
    $company_name= $row['company_name'];
    $company_address= $row['company_address'];
    $company_logo_url= $row['company_logo_url'];
    
  }else{
    header("Location: index.php");
    exit();
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Dealers Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <style>
        body {
    font-family: "Gabarito", cursive;
    background-color: white;
}

#sidebar {
    color: #fff;
    padding-top: 20px;
    height: 100vh;
    display: flex;
    position: fixed;
    left: 0;
}

/* Media query for screens with a maximum width of 768px (tablet and below) */
@media (max-width: 768px) {
    #sidebar {
        flex-direction: column; /* Display sidebar items in a row */
        position: relative;
        height: auto;
    }

    #sidebar img {
        margin-right: 10px; /* Add some space between the logo and text */
    }

    #content {
        margin-left: 0; /* Adjust content margin when sidebar is in a row */
    }
}

/* Media query for screens with a maximum width of 450px (mobile view) */
@media (min-width: 350px) {
    #sidebar {
        max-width: 100%;
    }
    .nav{
    flex-direction: row!important;
}
    #sidebar img {
        border-radius: 50%;
        margin-bottom: 20px;
    }
}

/* Add any other styles you need for the remaining screen sizes */

/* Rest of your existing styles */


        #sidebar img {
            border-radius: 50%;
            margin-bottom: 20px;
        }

        #content {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }





        .card11 {

            margin-left: -8px;
            border
            background-color: #F0F0F0;

        }

        @media (max-width: 450px) {
            .card11 {
                min-width: 320px;
            }

            .booking_container {
                min-width: 310px;
                min-height: 70px;
            }

        }

        .car_image {
            min-width: 80px;
        }


        nav {
            background: white;
            border: 2px solid #F0F0F0;
            color: #213555;
        }

        .nav-link {
            color: black !important;
            margin: 5px;
        }

        .nav-link:hover {
            display: block;

            background: #F0F0F0;
            font-weight: bold;
            border-radius: 10px;
            color: #6499E9 !important;
        }

        .des {
            margin: 10px;
        }

        a {
            cursor: pointer;
        }

        .hei {
            height: 500px;
        }

        .booking_container {

            padding: 5px;
            background-color: white;
            margin: 8px;
            border-radius: 10px;

        }

        .car_detail {
            margin-left: 5px;
            min-width: 100px;
        }

        .car_name {
            font-size: 12px;
            font-weight: bold;

        }

        .booking_detail {
            padding: 5px;
            font-size: 10px;
        }

        .confirm_button {
            padding: 5px;
            margin-top: 10px;
            margin-left: auto;
        }

        .user_detail {
            font-weight: bold;
            min-width: 200px;
            font-size: 20px;
            color: #6499E9;
            margin-left: 10px;
            padding: 5px;
        }

        .title_dasboard {
            padding: 10px;
            background-color: #F0F0F0;
            border-radius: 10px;
            font-weight: bold;
            color: #6499E9;
        }

        .card_header {
            background-color: #6499E9;

            color: white ;
            font-weight: bold;

        }


        .total_booking {
            font-weight: bold;
            font-size: 30px;

        }

        .count {
            font-weight: bold;
            font-size: 30px;

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
            background-color: #007bff;
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
 

    <div class="container-fluid">
        <div class="row">
      


            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block ">
                <div class="text-center text-dark">
                    <img src="uploads/<?= $company_logo_url ?>" alt="Logo" width="100">
                    <p class="title_dasboard">
                        <?= $company_name ?>
                    </p>

                </div>

                <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php" style="cursor:pointer"  >Website</a></li>
                    <li class="nav-item"><a class="nav-link" href="#card11">
                    <?php
  $check_cars = mysqli_query($conn, "SELECT COUNT(*) FROM car_details WHERE dealer_id = $dealer_id");
  $car_count = mysqli_fetch_row($check_cars)[0];
  ?>      
                    Add Car
                    <?php echo ($car_count > 0) ? "<span class='badge bg-danger rounded-circle mx-3'>$car_count</span>" : ""; ?>    
                </a></li>

                    <li class="nav-item"><a class="nav-link" href="#bookingTable">
                    <?php
  $check_bookings = mysqli_query($conn, "SELECT COUNT(*) FROM booking_table WHERE dealer_id = $dealer_id");
  $booking_count = mysqli_fetch_row($check_bookings)[0];
  ?>  
 
Bookings <?php echo ($booking_count > 0) ? "<span class='badge bg-danger rounded-circle mx-3'>$booking_count</span>" : ""; ?>    
                    
                </a></li>
                <li class="nav-item"><a class="nav-link" href="all_cars.php" >All Cars</a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor:pointer" id="logoutButton">Logout</a></li>
                </ul>
            </nav>

            <main id="content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card11 shadow" id="card11">
                    <h2 class="card-header card_header">Add Car</h2>
                    <div class="card-body">
                        <form id="add_car" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="carName" class="form-label">Vehicle model:</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-aspect-ratio-fill"></i></span>
                                            <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="model" class="form-label">Vehicle number :</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-card-checklist"></i></span>
                                            <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="seating_capacity" class="form-label">Seating capacity:</label>
                                        <input type="text" class="form-control" id="seating_capacity" name="seating_capacity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rent_per_day" class="form-label">Rent Per Day :</label>
                                        <input type="text" class="form-control" id="rent_per_day" name="rent_per_day">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="images" class="form-label">Images :</label>
                                        <input type="file" class="form-control " id="image" name="image">
                                    </div>
                                    <button type="button" id="upload_car" class="btn btn-primary w-100" style="margin-top:31px;">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container">
        <div class="col-md-12">
            <div class="card card11" id="recent-uploads">
                <h2 class="card-header card_header">Bookings</h2>
                <div class="table-responsive">
                    <?php
                    $sno = 0;
                    $query = "SELECT
                        booking_table.*,
                        dealer_details.*,
                        car_details.*,
                        users.*
                    FROM
                        booking_table
                    JOIN
                        dealer_details ON booking_table.dealer_id = dealer_details.id
                    JOIN
                        car_details ON booking_table.car_id = car_details.id
                    JOIN
                        users ON booking_table.user_id = users.user_id

                    WHERE 
                        booking_table.dealer_id =  $dealer_id

                    ORDER BY
                    booking_date DESC
                    ";

                    $fetch_booking = mysqli_query($conn, $query);

                    if ($fetch_booking->num_rows > 0) {
                        ?>
                        <table id="bookingTable" class="table">
                           <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Customer Detail</th>
                                <th>Vehicle</th>
                                <th>Description</th>
                                <th>Driving License</th>
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

                                    if ($row['status'] == 'Cancelled') {
                                        ?>
                                        <tr style="border-left:3px solid red;background-color:#F78CA2">
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                        <?php
                                    }
                                    ?>

                                    <td class="d-sm-table-cell"><?= $sno ?></td>

                                    <td class="d-sm-table-cell"><?= $row['full_name'] ?> <div class="company_name"><?= $row['mobile'] ?></div></td>
                                    <td class="d-sm-table-cell"><?= $row['vehicle_model'] ?> <div class="vehicle_model"><?= $row['vehicle_number'] ?></div></td>

                                    <td class="d-sm-table-cell"><?= $row['des'] ?></td>
                                    <td class="d-sm-table-cell"><?= $row['drivingLicense'] ?></td>

                                    <td class="d-sm-table-cell"><?= $row['booking_from'] ?></td>
                                    <td class="d-sm-table-cell"><?= $row['booking_till'] ?></td>
                                    <td class="d-sm-table-cell">₹ <?= $row['total_amount'] ?></td>
                                    <td class="d-sm-table-cell">
                                        
                                        <div class="company_name"><?= $row['booking_date'] ?></div>
                                        <button disabled class="btn <?= $row['status'] == 'Confirm' ? 'btn-success' : 'btn-warning' ?> text-white fw-bold">
                                            <?= $row['status'] ?>
                                        </button>
                                    </td>

                                    <td>
                                        <button class="btn btn-outline-danger cancel_booking m-1" <?= $row['status'] == 'Cancelled' ? 'disabled' : '' ?> data-id="<?= $row['booking_id'] ?>"> Cancel </button><br>

                                        <button class="btn btn-success m-1 confirm_booking" <?= $row['status'] == 'Confirm' ? 'disabled' : '' ?> data-id="<?= $row['booking_id'] ?>"> Confirm </button>
                                    </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<p>No bookings found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
document.getElementById("logoutButton").addEventListener("click", confirmLogout);

function confirmLogout() {
    var confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
        var currentLocation = window.location.href;
        var logoutURL = currentLocation.substring(0, currentLocation.lastIndexOf("/") + 1) + "dashboard.php?logout=1";
        window.location.href = logoutURL;
    }
}
       

        $(".cancel_booking").click(function(){
        const booking_id = $(this).data("id");
console.log(booking_id);
   
            var confirmation = confirm("Are you sure you want Cancel this Booking ?");
            if (confirmation) {
                $.ajax({
                    url: "cancel_booking_dealer.php",
                    type: "post",
                    data: { booking_id: booking_id },
                    success: function (response) {



                        setTimeout(() => {

                            Toastify({
                                text: "Booking successfully Cancelled",
                                duration: 2000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#4caf50",
                            }).showToast();

                            window.location.reload();

                        }, 2000);

                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }

        }); 

       $(".confirm_booking").click(function(){
        const booking_id = $(this).data("id");
console.log(booking_id);
   
            var confirmation = confirm("Are you sure you want Confirm this Booking ?");
            if (confirmation) {
               
                console.log(booking_id);
                $.ajax({
                    url: "update_booking.php",
                    type: "post",
                    data: { booking_id: booking_id },
                    success: function (response) {



                        setTimeout(() => {

                            Toastify({
                                text: "Booking Confirmed successfully",
                                duration: 2000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#4caf50",
                            }).showToast();

                            window.location.reload();

                        }, 2000);

                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            }

        }); 

        $("#recent_upload").click(function () {

        })
        function handleFileInputChange() {
            const input = document.getElementById('image');
            const previewImages = document.getElementById('previewImages');
            previewImages.innerHTML = '';

            for (const file of input.files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');


                    img.style.width = '100%';
                    img.style.objectFit = 'contain';
                    img.style.height = '550px';

                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');
                    previewImages.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }



        document.getElementById('image').addEventListener('change', handleFileInputChange);


        $("#upload_car").on("click", function () {
            validateCarUpload();
        });


    function validateCarUpload() {
        
        const vehicleModel = $("#vehicle_model").val().trim();
        const vehicleNumber = $("#vehicle_number").val().trim();
        const seatingCapacity = $("#seating_capacity").val().trim();
        const rentPerDay = $("#rent_per_day").val().trim();
        const image = $("#image").val().trim(); // Assuming file input

        // Basic validation
        if (!vehicleModel || !vehicleNumber || !seatingCapacity || !rentPerDay || !image) {
            Toastify({
                            text: "Please fill All the Details ! ",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#4caf50",
                        }).showToast();
            return;
        }
        uploadCar();
    }







        function uploadCar() {
            $("#upload_car")
                .prop("disabled", true)
                .html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Inserting...'
                );

            const formData = new FormData(document.querySelector('form'));
            const dealer_id = <?= $dealer_id ?>;

            formData.append('dealer_id', dealer_id);

            console.log(dealer_id);
            $.ajax({
                url: 'car_details.php',
                type: 'POST',

                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    setTimeout(() => {
                        Toastify({
                            text: response,
                            duration: 3000,
                            gravity: "bottom",
                            position: "center",
                            backgroundColor: "#4caf50",
                        }).showToast();

                        document.getElementById("add_car").reset();
                        $("#upload_car")
                            .prop("disabled", false)
                            .html(
                                ' Upload'
                            );
                    }, 2000);

                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

    </script>

</body>

</html>