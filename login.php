<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login Form</title>
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
            <img src="images/undraw_welcoming_re_x0qo.svg" alt="Login Image" class="image" />
        </div>
        <div class="form-container ml-3 d-flex flex-column rounded">
            <h2 class="mb-4">Login</h2>

            <form id="loginForm" method="post">
                <label>Email :</label>
                <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email."
                    required />

                <label>Password :</label>
                <input type="password" class="form-control" id="loginPassword" name="loginPassword"
                    placeholder="Password" required />

                <button type="submit" id="loginButton" class="btn btn-primary btn-block mt-3">
                    Login
                </button>

                <a class="text-white" href="register_customer.php">New User? Register here...</a>
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
</body>
<script>
    $(document).ready(function () {
        $("#loginForm").submit(function (event) {
            $("#loginButton").prop("disabled", true).addClass('btn-success').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            event.preventDefault();
            var email = $("#loginEmail").val();
            var password = $("#loginPassword").val();


            var formData = {
                email: email,
                password: password
            };

            $.ajax({
                type: "POST",
                url: "check_user.php",
                data: formData,
                dataType: 'json',
                success: function (response) {


                    setTimeout(() => {

                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "bottom",
                            position: "center",
                            backgroundColor: "green",
                        }).showToast();

                        console.log(response);
                        if (response.user_type == "Customer") {
                            window.location.href = "index.php";
                        } else {
                            window.location.href = "dashboard.php";
                        }


                    }, 2000);


                },
                error: function (xhr, status, error) {
                    setTimeout(() => {
                        $("#loginButton").prop("disabled", false).removeClass('btn-success').addClass('btn-primary').html('Login');
                        console.error("Error:", xhr.responseText);
                        Toastify({
                            text: xhr.responseText,
                            duration: 3000,
                            gravity: "bottom",
                            position: "center",
                            backgroundColor: "red",
                        }).showToast();
                    }, 2000);



                    
                }
            });
        });
    });
</script>

</html>