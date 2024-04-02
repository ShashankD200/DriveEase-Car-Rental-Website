<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dealer Registration Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>

<body style="background-color: #f5f5f5;">
    <div class="container shadow d-flex mt-5">
        <div class="image-container flex-grow-1">
            <img src="images/undraw_co_workers_re_1i6i .svg" width="380px" style="object-fit: contain"
                alt="Registration Image" class="image" />
        </div>
        <div class="form-container ml-3 d-flex flex-column rounded" style="background-color: #fff; padding: 20px;">
            <h2 class="mb-4 text-primary">Dealer SignUp</h2>
            <a style="position: absolute; right: 20px; top: 20px; color: #3498db; text-decoration: none;"
                href="login.php"><i class="bi bi-arrow-left"></i> Login</a>

            <form id="Dealer_register_form" method="post" enctype="multipart/form-data">
                <div id="form_screen1">
                    <label>Company Name :</label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        placeholder="Enter your company name." required />

                    <label>Company Address :</label>
                    <input type="email" class="form-control" id="c_address" name="c_address"
                        placeholder="Company Address." required />

                    <label>Company Logo :</label>
                    <input type="file" class="form-control" id="logo" name="logo" placeholder="Logo" />
                </div>

                <div id="form_screen2" style="display: none">
                    <label>Owner Name :</label>
                    <input type="text" class="form-control" id="owner_name" name="owner_name"
                        placeholder="Enter your name." required />

                    <label>Email :</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email."
                        required />

                    <label>Password :</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required />
                    <span id="passwordError" style="color: red"></span>
                </div>

                <div class="d-flex flex-row mt-auto">
                    <button type="button" id="screen_1" class="btn btn-outline-secondary m-1 mt-3"
                        style="display: none">Back</button>

                    <button type="button" id="screen_2" class="btn btn-primary btn-block m-1 mt-3 ml-auto">
                        Next
                    </button>

                    <button type="submit" id="Dealer_submitButton" class="m-1 btn btn-success btn-block mt-3"
                        style="display: none">Register as Dealer</button>
                </div>
            </form>
            <a class="text-primary mt-2" href="register_customer.php">Register as a Customer ?</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    

    <script>
        $(document).ready(function () {
            const form = $("form");
            const submitButton = $("#Dealer_submitButton");

            $("#screen_2").click(function () {
                const c_name = $("#company_name").val();
                const c_add = $("#c_address").val();

                if (c_name && c_add !== "") {
                    $("#screen_2")
                        .prop("disabled", true)
                        .addClass("btn-success")
                        .html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                        );
                    setTimeout(() => {
                        $("#form_screen1").hide();
                        $("#screen_1").show();

                        $("#Dealer_submitButton").show();
                        $("#form_screen2").fadeIn();
                        $("#screen_2").hide();
                    }, 1000);
                } else {
                    Toastify({
                        text: " Please fill all details",
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#C70039",
                    }).showToast();
                }
            });
            $("#screen_1").click(function () {
                $("#screen_2")
                    .removeClass("btn-success")
                    .addClass("btn-primary")
                    .prop("disabled", false)
                    .html("next");

                $("#screen_1").hide();
                $("#form_screen2").hide();
                $("#screen_2").show();
                $("#Dealer_submitButton").hide();
                $("#form_screen1").fadeIn();
            });
            $("#Dealer_submitButton").click(function (event) {
                event.preventDefault();

                const passwordInput = $("#password");
                const passwordValue = passwordInput.val();

                if (passwordValue.length < 6) {
                    Toastify({
                        text: "Password must be at least 6 characters long.",
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#C70039",
                    }).showToast();
                } else if (!/\d/.test(passwordValue)) {
                    Toastify({
                        text: "Password must contain at least one number.",
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#C70039",
                    }).showToast();
                } else {
                    submitButton
                        .prop("disabled", true)
                        .html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registering...'
                        );

                    const formdata = new FormData(
                        document.getElementById("Dealer_register_form")
                    );

                    console.log(formdata);

                    $.ajax({
                        url: "register_dealer_data.php",
                        type: "POST",
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            setTimeout(() => {
                                console.log(response);
                                Toastify({
                                    text: response,
                                    duration: 3000,
                                    gravity: "bottom",
                                    position: "center",
                                    backgroundColor: "#4caf50",
                                }).showToast();

                                submitButton
                                    .removeClass("btn-primary")
                                    .addClass("btn-success")
                                    .prop("disabled", true)
                                    .html('<span class="fas fa-check mr-2"></span> Done');

                                document.getElementById("Dealer_register_form").reset();
                            }, 3000);
                        },
                        error: function (xhr, status, error) {
                            var errorMessage = "Error: " + xhr.responseText;
                            console.log(errorMessage);
                            setTimeout(() => {
                                Toastify({
                                    text: errorMessage,
                                    duration: 3000,
                                    gravity: "bottom",
                                    position: "center",
                                    backgroundColor: "red",
                                }).showToast();

                                document.getElementById("Dealer_register_form").reset();
                                submitButton
                                    .removeClass("btn-danger")
                                    .addClass("btn-primary")
                                    .prop("disabled", false)
                                    .html(
                                        '<span class="fas fa-check mr-2"></span> Register as Dealer'
                                    );
                            }, 3000);
                        },
                    });
                }
            });
        });
    </script>
</body>

</html>