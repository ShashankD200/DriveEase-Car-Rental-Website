<?php
include 'utils/conn.php';

if(!$user_id){
  session_start();

  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
  $user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
  
}



if (isset($_GET['logout']) && $_GET['logout'] == 1) {
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}


?>
<style>
  #logoutButton{
  cursor: pointer;
}
  </style>
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
   


<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white py-3 " >
    <div class="container px-5">
        <a class="navbar-brand" href="index.php"><span class="fw-bolder text-primary">DriveEase</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              
                <li class="nav-item"><a class="nav-link" href="Rent-car.php"><?= $user_type == 'Dealer' ? 'All Cars' : 'Rent-Cars' ?> </a></li>
                <?php
                if (!$user_id) {
    ?>
            <li class="nav-item"><a class="nav-link " href="login.php">Log in</a></li>
            <li class="nav-item"><a class="nav-link " href="register_customer.php">Sign up</a></li>
            <?php
                  
              }else{
if($user_type == 'Dealer'){
?>
<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard
</a></li>
<?php
}else{
?>
<li class="nav-item"><a class="nav-link" href="bookings.php">
  <?php
  $check_bookings = mysqli_query($conn, "SELECT COUNT(*) FROM booking_table WHERE user_id = $user_id");
  $booking_count = mysqli_fetch_row($check_bookings)[0];
  ?>  
 
  My Bookings <?php echo ($booking_count > 0) ? "<span class='badge bg-danger rounded-circle'>$booking_count</span>" : ""; ?>
    
  
</a></li>
<?php
}

?>

  
            <li class="nav-item">
              <a class="nav-link" id="logoutButton">Logout</a>
            </li>
            <?php
              }
                ?>
                
                
            </ul>
        </div>
    </div>
</nav>
<script>
 
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