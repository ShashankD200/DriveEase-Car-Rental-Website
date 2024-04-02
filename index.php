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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Explore the world with DriveEase - Your Gateway to Effortless Exploration." />
    <meta name="author" content="" />
    <title>DriveEase - Your Gateway to Effortless Exploration</title>
    
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        
        <?php include "navbar.php"?>


       
        <header class="py-5" style="margin-top:35px;">
            <div class="container px-5 pb-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-xxl-5">
                        
                        <div class="text-center text-xxl-start">
                            <div class="fs-3 fw-light text-muted">DriveEase</div>
                            <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline"> Your Gateway to Effortless Exploration.</span></h1>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                                <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="Rent-car.php">Rent a Car </a>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Benefits Section -->
        <section class="bg-light py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
            <div class="col-md-6 order-md-1">
                    <img src="assets/illus_1.png" class="img-fluid" alt="Illustration" width="100%" srcset="">
                </div>
                <div class="col-md-6 order-md-2">
                    <div class="text-center my-5">
                        <div class="d-flex flex-column">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Why Choose DriveEase?</span></h2>
                            <p class="lead fw-light mb-4">Enjoy competitive prices, 24/7 support, and a fleet meticulously maintained for your safety and comfort. Drive freely, knowing you're backed by DriveEase's commitment to excellence.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    

        <!-- Testimonials Section -->
        <section class="py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-md-12">
                    <div class="text-center my-5">
                        <div class="d-flex flex-column flex-md-row">
                            <img src="assets/illus_2.png" class="img-fluid mb-3 mb-md-0" height="500px" alt="Illustration">
                            <div class="flex-column d-flex ml-md-3">
                                <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Happy Journeys, Happy Customers</span></h2>
                                <div class="card mt-auto mb-auto mx-auto w-75">
                                    <div class="card-body">
                                        <p class="card-text">"My road trip with DriveEase was fantastic! The car was in excellent condition, and the entire rental process was smooth. I highly recommend DriveEase for a hassle-free travel experience."</p>
                                        <p class="card-subtitle text-muted">- Sarah W.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4"></div>
            </div>
        </div>
    </section>

        
    <style>
        /* Adjust styles as needed */
        .section-img {
            max-width: 100%;
            height: auto;
        }

        .text-container {
            max-width: 100%;
        }

        @media (min-width: 768px) {
            /* Adjust styles for larger screens (desktop) */
            .section-img {
                max-width: 50%;
            }

            .text-container {
                max-width: 50%;
            }
        }
    </style>
         <section class="bg-white py-5" style="border: 2px dashed #E0E0E0;">
        <div class="container">
            <div class="row gx-5 justify-content-center">
                <div class="col-md-12">
                    <div class="text-center my-5">
                        <div class="d-flex flex-column flex-md-row">
                            <img src="assets/illus_3.jpg" class="img-fluid section-img" alt="Illustration" height="500px" srcset="">
                            <div class="text-container">
                                <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Your Safety, Our Priority</span></h2>
                                <p class="lead fw-light mb-4">At DriveEase, your safety is paramount. Our vehicles undergo rigorous checks, and we adhere to strict sanitation protocols. Travel confidently, experience the DriveEase difference.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


        <!-- Dealer Admin Panel Section -->
        <section class="bg-light py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Become a DriveEase Partner</span></h2>
                            <p class="lead fw-light mb-4">Are you a car owner? Join our community! With the DriveEase Dealer Admin Panel, easily upload your cars for rent. Partner with us to connect your vehicles with eager travelers.</p>
                            <button class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder">Join Now </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
       <script src="js/scripts.js"></script>
        <?php include 'footer.php' ?>
       <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
       </script>
   
</body>
</html>
