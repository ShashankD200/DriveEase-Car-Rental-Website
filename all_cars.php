<?php
include 'utils/conn.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if($user_id){

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

}else{
    header("Location: error404.html");
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
height:100vh;
display:flex;position:fixed;left:0;
        }

        /* Media query for screens with a maximum width of 450px (mobile view) */
        @media (max-width: 450px) {
            #sidebar {
                min-width: 310px;
            }
        }


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
            border: none;
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
            border: none;
            color: white;
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
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <div class="text-center text-dark">
                    <img src="uploads/<?= $company_logo_url ?>" alt="Logo" width="100">
                    <p class="title_dasboard">
                        <?= $company_name ?>
                    </p>

                </div>

                <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php" style="cursor:pointer"  >Website</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php?#bookingTable">
                    <?php
  $check_cars = mysqli_query($conn, "SELECT COUNT(*) FROM car_details WHERE dealer_id = $dealer_id");
  $car_count = mysqli_fetch_row($check_cars)[0];
  ?>      
                    Dashboard
                    <?php echo ($car_count > 0) ? "<span class='badge bg-danger rounded-circle mx-3'>$car_count</span>" : ""; ?>    
                </a></li>

                    <li class="nav-item"><a class="nav-link" href="dashboard.php?#bookingTable">
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

            <main id="content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
                <div class="container-fluid col-md-12">
                <div class="row">
<?php
$rs=mysqli_query($conn,"SELECT * FROM dealer_details JOIN car_details ON dealer_details.id = car_details.dealer_id  where user_id = $user_id");
if($rs->num_rows>0){
while($row=mysqli_fetch_assoc($rs)){


?>
            <div class="col-md-4">
            <div class="card">
                <div class="card-header  text-white fs-3" style=" background-color: #6499E9;
            border: none;"><?=$row['vehicle_model']?></div>
                <div class="card-body d-flex flex-column">
                <img src="car_details/<?=$row['car_image_url']?>" style="object-fit:cover" class="rounded" height="300px" >
                <div class="mt-1 fs-4"><?=$row['vehicle_number']?></div>
                <div class="mt-1 fw-bold text-success fs-5">₹<?=$row['rent_per_day']?>.00</div>
                <button class="btn btn-outline-danger mt-3 delete_car" data-id ="<?=$row['id']?>">Delete Car</button>
                </div>
            </div>
            </div>
                  <?php
                  }
                }
                  ?>  
                  </div>
</div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        $(".delete_car").click(function (){
            const id = $(this).data("id");
            var confirmation = confirm("Are you sure you want to delete this car?");
            if (confirmation){
                $.ajax({
                url:"delete_car.php",
                type:"post",
                data:{id:id},
                success:function(response){
console.log(response);
console.log("Deleted Succesfully");
window.location.reload();

                },
                error:function(error){
                    console.log(error);
                }
            });
            }
          
        });
document.getElementById("logoutButton").addEventListener("click", confirmLogout);

function confirmLogout() {
    var confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
        var currentLocation = window.location.href;
        var logoutURL = currentLocation.substring(0, currentLocation.lastIndexOf("/") + 1) + "index.php?logout=1";
        window.location.href = logoutURL;
    }
}
       

       
    </script>

</body>

</html>