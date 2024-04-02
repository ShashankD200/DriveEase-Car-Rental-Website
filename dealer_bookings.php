<?php
include 'utils/conn.php';
session_start();

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
</head>
<?php include 'navbar.php'; ?>
<body>
    
    
</body>
</html>