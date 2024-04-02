<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Registration Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
</head>

<body>
    <div class="container shadow d-flex">
        <div class="image-container flex-grow-1">
            <img src="images/undraw_welcoming_re_x0qo.svg" alt="Registration Image" class="image" />
        </div>
        <div class="form-container ml-3 d-flex flex-column rounded">
            <h2 class="mb-4">SignUp</h2> <a style="position:absolute;
            right:50px;top:40px;"class="text-white" href="login.php">Login</a>

            <form id="Register_form" method="post">
                <label>Full Name :</label>
                <input type="text" class="form-control" id="full_name" name="full_name"
                    placeholder="Enter your full name." required />

                <label>Email :</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email." required />

                <label>Password :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required />
                <span id="passwordError" style="color: red;"></span>

                <button type="submit" id="submitButton" class="btn btn-primary btn-block mt-3">
                    Register
                </button>
                <a class="text-white" href="register_dealer.php">Register as a Dealer ?</a>
            </form>
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
            const submitButton = $("#submitButton");

            $("form").submit(function (event) {
                event.preventDefault();

                const passwordInput = $("#password");
                const passwordValue = passwordInput.val();
                const passwordError = $("#passwordError");

                if (passwordValue.length < 6) {
                    passwordError.text("Password must be at least 6 characters long.");
                } else if (!/\d/.test(passwordValue)) {
                    passwordError.text("Password must contain at least one number.");
                } else {
                    passwordError.text("");

                    submitButton
                        .prop("disabled", true)
                        .html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registering...'
                        );

                    const formdata = $("#Register_form").serialize();

                    console.log(formdata);

                    $.ajax({
                        url: "register_user.php",
                        type: "POST",
                        data: formdata,
                        success: function (response) {
                            setTimeout(() => {
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
                            }, 3000);
                            document.getElementById("Register_form").reset();
                        },
                        error: function (xhr, status, error) {
                            var errorMessage = "Error: " + xhr.responseText;

                            setTimeout(() => {
                                Toastify({
                                    text: errorMessage,
                                    duration: 3000,
                                    gravity: "bottom",
                                    position: "center",
                                    backgroundColor: "red",
                                }).showToast();

                                document.getElementById("Register_form").reset();
                                submitButton
                                    .removeClass("btn-danger")
                                    .addClass("btn-primary")
                                    .prop("disabled", false)
                                    .html('<span class="fas fa-check mr-2"></span> Register');
                            }, 3000);
                        },
                    });
                }
            });
        });
    </script>
</body>

</html>