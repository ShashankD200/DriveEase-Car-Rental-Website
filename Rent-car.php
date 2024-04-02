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

<body class="d-flex flex-column h-100 bg-light">
    <main class="flex-shrink-0" style="margin-top:35px;">

        <?php include 'navbar.php'; ?>

        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger modal -->
        <div class="modal-content">
            <div class="modal-header text-white fw-bold" style="background-color: #6499E9; border: none;">
                <h5 class="modal-title" id="bookingModalLabel">Book Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="dealer_id" id="dealer_id" />
                    <input type="hidden" name="car_id" id="car_id" />
                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="fromDate" class="form-label fw-bold">From Date:</label>
                            <input type="date" class="form-control" id="fromDate" name="fromDate" required />
                        </div>
                        <div class="col-md-6">
                            <label for="toDate" class="form-label fw-bold">To Date:</label>
                            <input type="date" class="form-control" id="toDate" name="toDate" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="des" class="form-label fw-bold">Description :</label>
                        <textarea type="text" class="form-control" id="des" name="des" rows="5"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="hasDrivingLicense" onchange="toggleDrivingLicenseField()">
                        <label class="form-check-label fw-bold" for="hasDrivingLicense">I have a Driving License</label>
                    </div>
                    <!-- Add a field for Driving License -->
                    <div class="mb-3" id="drivingLicenseField" style="display: none;">
                        <label for="drivingLicense" class="form-label fw-bold">Driving License:</label>
                        <input type="text" class="form-control" id="drivingLicense" name="drivingLicense">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label fw-bold">Mobile Number :</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" required>
                    </div>
                    <button type="button" id="confirm_book" class="btn btn-primary" onclick="submitBooking()">
                        Submit Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>





        <section class="py-5">
    <div class="container px-2 px-md-5 mb-5"> <!-- Reduced padding for smaller screens -->
        <div class="text-center mb-4">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Cars Available</span></h1>
        </div>
        <div class="row gx-2 gx-md-5 justify-content-center">
            <?php
            $fetch1 = mysqli_query(
                $conn,
                "SELECT * FROM car_details 
                WHERE id NOT IN ( SELECT car_id FROM booking_table WHERE
                booking_till >= CURDATE() AND status = 'Confirm' ) ORDER BY
                created_at DESC"
            );
            $counter = 0;
            while ($row = mysqli_fetch_assoc($fetch1)) {
                $dealer_id = $row['dealer_id'];
                $car_id = $row['id'];
                $dealer_q = mysqli_query($conn, "SELECT company_name FROM dealer_details WHERE
                    id = $dealer_id ");
                $dealer_d = mysqli_fetch_assoc($dealer_q);
                $counter++;
            ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card overflow-hidden shadow rounded-4 border-0">
                        <img class="card-img-top" src="car_details/<?= $row['car_image_url']; ?>" alt="..." style="object-fit: cover; height: 200px;">
                        <div class="card-body">
                            <p class="fw-bold text-danger">
                                <?= $dealer_d['company_name'] ?>
                            </p>
                            <h2 class="fw-bolder">
                                <?= $row['vehicle_model'] ?>
                            </h2>
                            <p>
                                <?= $row['vehicle_number'] ?>
                            </p>
                            <p>
                                <?= $row['seating_capacity'] ?> Seater
                            </p>
                            <button class="btn btn-outline-primary set-booking" data-dealer="<?= $dealer_id ?>" data-id="<?= $car_id ?>">
                                Starts from ₹<?= $row['rent_per_day'] ?><span class="text-danger fw-bold"> per day</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>


    </main>

    <?php include 'footer.php' ?>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
        function toggleDrivingLicenseField() {
            var drivingLicenseField = $("#drivingLicenseField");
            var hasDrivingLicenseCheckbox = $("#hasDrivingLicense");

            // Toggle the visibility of the driving license field based on the checkbox state
            if (hasDrivingLicenseCheckbox.prop("checked")) {
                drivingLicenseField.show();
            } else {
                drivingLicenseField.hide();
            }
        }

        // Attach the function to the change event of the checkbox
        $("#hasDrivingLicense").on("change", toggleDrivingLicenseField);

        $(".set-booking").click(function setBookingData() {
    const id = $(this).data('id');
    const dealer_id = $(this).data('dealer');
console.log(id,dealer_id,user_id);
    $('#bookingForm #car_id').val(id);
    $('#bookingForm #dealer_id').val(dealer_id);
    $('#user_id').val(user_id);
    $('#bookingModal').modal('show');
});


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
                            document.getElementById("bookingForm").reset();
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