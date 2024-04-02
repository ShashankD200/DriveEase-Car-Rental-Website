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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Car Rental Service</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
 w

  <style>
    body {
      font-family: "Gabarito", cursive;
      background: rgba(255, 255, 255, 0.196);
    }

    .hei {
      height: 500px;
      margin: 5px;
    }

    .book_now {
      position: absolute;
      bottom: 0;
      left: 0;
      background: #6499e9;
      color: white;
      font-weight: bold;
      padding: 10px;
    }

    .book_now:hover {
      background: #213555;
      color: #e5d283;
    }

    .price_card {
      position: absolute;
      bottom: 45px;
      width: 100%;
      left: 0;
      font-weight: bold;
      color: white;
      background-color: #4f709c;
    }

    .latest_tag {
      position: absolute;
      top: 45px;
      left: 0px;
      background: linear-gradient(to right, #ec008c, #fc6767);
      color: #fff;
      padding: 5px;
      font-size: 12px;
      font-weight: bold;
      border-radius: 2px;
    }

    .des {
      border: 1px solid #f1efef;
      padding: 10px;
      position: absolute;
      left: 0;
      margin: 2px;
      color: #e5d283;
      font-weight: bold;
      background-color: black;
      font-size: 15px;
    }

    .loading_spinner {
      display: none;
      z-index: 1;
      position: absolute;
      top: 50%;
      left: 50%;
      width: 200px;
      height: 100px;
      padding: 35px;
      background-color: white;
      border: 1px solid grey;
      border-radius: 10px;
    }

    .seat {
      position: absolute;
      top: 10px;
      padding: 5px;
      left: 0;
      width: 30%;

      background: #e5d283;
      color: white;
    }

    .popular_container {
      position: absolute;
      display: flex;
      left: 0;
      height: 100%;
      width: 250px;
      margin-top: 30px;
      background: rgba(255, 255, 255, 0.69);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }

    #search_form {
      width: 400px;
    }

    @media (max-width:450px) {
      nav {
        min-width: 320px;
      }
    }

    .vehicle_name {
      font-weight: bold;
      font-size: 30px;
      color: #213555;
    }

    #logoutButton {
      cursor: pointer;
    }

    a {
      color: white !important;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand">Car Rental</a>
      <div class="d-flex">

        <ul class="navbar-nav mx-auto d-flex flex-row mb-2 mb-lg-0">

          <li class="nav-item mx-3  ">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>

          <?php
          if (!$user_id) {
            ?>
            <li class="nav-item mx-5">
              <a class="nav-link" href="login.php">Log in</a>
            </li>
            <?php

          } else {
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


  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Book Now</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="bookingForm">
            <input type="hidden" name="user_id" id="user_id" />
            <input type="hidden" name="dealer_id" id="dealer_id" />
            <input type="hidden" name="car_id" id="car_id" />
            <div class="mb-3">
              <label for="fromDate" class="form-label">From Date:</label>
              <input type="date" class="form-control" id="fromDate" name="fromDate" required />
            </div>
            <div class="mb-3">
              <label for="toDate" class="form-label">To Date:</label>
              <input type="date" class="form-control" id="toDate" name="toDate" required />
            </div>
            <button type="button" id="confirm_book" class="btn btn-primary" onclick="submitBooking()">
              Submit Booking
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <?php

    if ($user_id) {
      ?>
      <form id="search_form" method="post" class="d-flex mx-auto " style="margin-top:80px;">
        <input class="form-control me-2" type="date" id="from_date" name="from_date" placeholder="Select Date"
          aria-label="Select Date" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" />

        <!-- To Date -->
        <input class="form-control me-2" type="date" id="to_date" name="to_date" placeholder="Select Date"
          aria-label="Select Date" min="<?= date('Y-m-d'); ?>" />

        <button class="btn btn-outline-success" id="filter_cars" type="button">
          Filter
        </button>
      </form>
      <?php
    }
    ?>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <div class="loading_spinner">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading....
        </div>

        <div class="row mt-4" id="car_data">
          <h1>Need a Family Vacation ?</h1>
          <h4>We have wide range of collection.</h4>
          <?php
          $fetch1 = mysqli_query(
            $conn,
            "SELECT * FROM car_details 
     WHERE seating_capacity >
            4 AND id NOT IN ( SELECT car_id FROM booking_table WHERE
            booking_till >= CURDATE() AND status = 'Confirm' ) ORDER BY
            created_at DESC"
          );
          $counter = 0;
          while (
            $row =
            mysqli_fetch_assoc($fetch1)
          ) {
            $counter++; ?>

            <div class="col-md-4" id="car_detail_div">
              <div class="card hei d-flex flex-column shadow">
                <?php if ($counter <= 5) { ?>
                  <div class="latest_tag">Trending</div>
                <?php } ?>

                <div class="card-body" style="background: #f0f0f0">
                  <img src="car_details/<?= $row['car_image_url']; ?>" alt="" width="250px" height="300px"
                    style="object-fit: contain" />
                  <div>
                    <div class="vehicle_name">
                      <?= $row['vehicle_model']; ?>
                    </div>
                    <p class="des">
                      Vehicle Number:
                      <?= $row['vehicle_number'] ?>
                    </p>
                    <p class="seat">
                      <?= $row['seating_capacity'] ?>
                      Seater
                    </p>
                  </div>
                  <div class="card-footer price_card">
                    Starts from ₹
                    <?= $row['rent_per_day'] ?>.00
                  </div>
                  <button class="btn w-100 book_now" data-bs-toggle="modal" data-bs-target="#bookingModal"
                    onclick="setBookingData(<?= $row['id'] ?>, <?= $row['dealer_id'] ?>)">
                    Book Now
                  </button>
                </div>
              </div>
            </div>
            <?php
          }
          ?>

          <h1 style="margin-top: 50px">Up for a Couple Date ?</h1>
          <h4>We have something Auspicious for you.</h4>
          <?php
          $fetch1 = mysqli_query(
            $conn,
            "SELECT * FROM car_details 
     WHERE seating_capacity < 3  AND id NOT IN (
         SELECT car_id FROM booking_table 
         WHERE booking_till >= CURDATE() AND status = 'Confirm' ) ORDER BY
            created_at DESC"
          );
          $counter = 0;
          while (
            $row =
            mysqli_fetch_assoc($fetch1)
          ) {
            $counter++; ?>

            <div class="col-md-4" id="car_detail_div">
              <div class="card hei d-flex flex-column shadow">
                <?php if ($counter <= 5) { ?>
                  <div class="latest_tag">Trending</div>
                <?php } ?>

                <div class="card-body" style="background: #f0f0f0">
                  <img src="car_details/<?= $row['car_image_url']; ?>" alt="" width="250px" height="300px"
                    style="object-fit: contain" />
                  <div>
                    <div class="vehicle_name">
                      <?= $row['vehicle_model']; ?>
                    </div>
                    <p class="des">
                      Vehicle Number:
                      <?= $row['vehicle_number'] ?>
                    </p>
                    <p class="seat">
                      <?= $row['seating_capacity'] ?>
                      Seater
                    </p>
                  </div>
                  <div class="card-footer price_card">
                    Starts from ₹
                    <?= $row['rent_per_day'] ?>.00
                  </div>
                  <button class="btn w-100 book_now" data-bs-toggle="modal" data-bs-target="#bookingModal"
                    onclick="setBookingData(<?= $row['id'] ?>, <?= $row['dealer_id'] ?>)">
                    Book Now
                  </button>
                </div>
              </div>
            </div>
            <?php
          }
          ?>

          <h1 style="margin-top: 50px">Group of 4 ?</h1>
          <h4>Don't Worry !.</h4>
          <?php
          $fetch1 = mysqli_query(
            $conn,
            "SELECT * FROM car_details 
     WHERE   seating_capacity BETWEEN 2 AND 5  AND id NOT IN (
         SELECT car_id FROM booking_table 
         WHERE booking_till >= CURDATE() AND status = 'Confirm' ) ORDER BY
            created_at DESC"
          );
          $counter = 0;
          while (
            $row =
            mysqli_fetch_assoc($fetch1)
          ) {
            $counter++; ?>

            <div class="col-md-4" id="car_detail_div">
              <div class="card hei d-flex flex-column shadow">
                <?php if ($counter <= 5) { ?>
                  <div class="latest_tag">Trending</div>
                <?php } ?>

                <div class="card-body" style="background: #f0f0f0">
                  <img src="car_details/<?= $row['car_image_url']; ?>" alt="" width="250px" height="300px"
                    style="object-fit: contain" />
                  <div>
                    <div class="vehicle_name">
                      <?= $row['vehicle_model']; ?>
                    </div>
                    <p class="des">
                      Vehicle Number:
                      <?= $row['vehicle_number'] ?>
                    </p>
                    <p class="seat">
                      <?= $row['seating_capacity'] ?>
                      Seater
                    </p>
                  </div>
                  <div class="card-footer price_card">
                    Starts from ₹
                    <?= $row['rent_per_day'] ?>.00
                  </div>
                  <button class="btn w-100 book_now" data-bs-toggle="modal" data-bs-target="#bookingModal"
                    onclick="setBookingData(<?= $row['id'] ?>, <?= $row['dealer_id'] ?>)">
                    Book Now
                  </button>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script>

    var user_id = <?php echo json_encode($user_id); ?>;
    var user_type = <?php echo json_encode($user_type); ?>;

    function confirmLogout() {
      var confirmation = confirm("Are you sure you want to log out?");
      if (confirmation) {
        window.location.href = "index.php?logout=1";
      }
    }
    document.getElementById("logoutButton").addEventListener("click", confirmLogout);

    $("#filter_cars").click(function () {
      $("#car_detail_div").hide();

      var searchdata = $("#search_form").serialize();
      console.log(searchdata);


      $.ajax({
        type: "POST",
        url: "filter_cars.php",
        data: searchdata,
        dataType: 'json',
        success: function (response) {

          console.log(response);

          if (Array.isArray(response)) {
            $("#car_data").empty();
            if (response.length === 0) {

              $("#car_data").html('<p>No cars available.</p>');
            } else {

              response.forEach(function (car) {

                appendCarToCard(car);
                console.log('car', car);
              });
            }
          } else {
            console.error("Invalid response format. Expected an array.");
          }
        },

        error: function (error) {
          console.log(error);
        }
      });

    });

    function appendCarToCard(car) {

      var card = document.createElement("div");
      card.className = "col-md-4";
      card.innerHTML = `
            <div class="card hei d-flex flex-column">
              <div class="card-header"  style="font-weight:bold;font-size:20px;background: #213555;color:white;">${car.vehicle_model}</div>
              <div class="card-body " style="background:#F0F0F0">
                <img src="car_details/${car.car_image_url}" alt="" width="250px" height="300px" style="object-fit: contain;">
                <div>

                  <p class="des">Vehicle Number: ${car.vehicle_number}</p>

                </div>
                <div class="card-footer price_card">Starts from  ₹ ${car.rent_per_day}.00</div>
                <button class="btn  w-100 book_now" data-bs-toggle="modal" data-bs-target="#bookingModal" onclick="setBookingData(${car.id}, ${car.dealer_id})">Book Now</button>
              </div>
            </div>
          `;


      document.querySelector("#car_data").appendChild(card);
    }

    function setBookingData(id, dealerId) {

      $('#bookingForm #car_id ').val(id);
      $('#bookingForm #dealer_id').val(dealerId);
      $('#bookingForm #user_id').val(<?= $user_id ?>);


      $('#bookingModal').modal('show');
    }

    function submitBooking() {

      if (user_id) {



        $("#confirm_book").prop("disabled", true).addClass('btn-warning').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

        const formdata = $("#bookingForm").serialize();
        console.log(formdata);

        $.ajax({
          type: "POST",
          url: "process_booking.php",
          data: formdata,
          success: function (response) {
            setTimeout(() => {
              $("#confirm_book").prop("disabled", true).removeClass('btn-warning').addClass('btn-success').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Confirmed ');

              $('#bookingModal').modal('hide');

              console.log(response);
              Toastify({
                text: response,
                duration: 5000,
                gravity: "top",
                position: "center",
                backgroundColor: "#4caf50",
              }).showToast();


            }, 3000);
          },
          error: function (error) {
            console.error(error);
            alert("Error occurred while booking. Please try again.");
          },
          complete: function () {
            setTimeout(() => {
              $("#confirm_book").prop("disabled", false).removeClass('btn-success').addClass('btn-warning').html('Confirm Booking');

            }, 3000);

          }
        });



      } else {

        Toastify({
          text: "Please Login first !",
          duration: 5000,
          gravity: "top",
          position: "center",
          backgroundColor: "#4caf50",
        }).showToast();

      }




    }
  </script>
</body>

</html>