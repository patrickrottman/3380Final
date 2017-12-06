<!--code taken from https://bootsnipp.com/snippets/featured/clean-modal-login-form -->


<!DOCTYPE html>
<html>

<head>
    <title>Permanency Team</title>

    <link rel="stylesheet" href="loginStyle.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <style>
        .modal {
            background: green;
            position: absolute;
            float: left;
            left: 50%;
            top: 40%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<html>

<body>

    <div class="modal" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <h1>Login to Your Account</h1><br>
                <form method="POST" action="checkLogin.php">
                    <input type="text" name="user" placeholder="Username">
                    <input type="password" name="pass" placeholder="Password">
                    <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
