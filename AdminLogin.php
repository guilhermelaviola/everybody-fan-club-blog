<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

if (isset($_SESSION["UserId"])) {
    Redirect_to("Dashboard.php?page=1");
}

if (isset($_POST["Submit"])) {
    $UserName = $_POST["Username"];
    $Password = $_POST["Password"];
    if (empty($UserName) || empty($Password)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out.";
        Redirect_to("AdminLogin.php");
    } else {
        // code for checking username and password from Database
        $Found_Account = Login_Attempt($UserName, $Password);
        if ($Found_Account) {
            $_SESSION["UserId"] = $Found_Account["id"];
            $_SESSION["UserName"] = $Found_Account["username"];
            $_SESSION["AdminName"] = $Found_Account["aname"];
            $_SESSION["SuccessMessage"] = "Welcome " . $_SESSION["AdminName"] . "!";
            if (isset($_SESSION["TrackingURL"])) {
                Redirect_to($_SESSION["TrackingURL"]);
            }
            Redirect_to("Dashboard.php?page=1");
        } else {
            $_SESSION["ErrorMessage"] = "Incorrect username or password.";
            Redirect_to("AdminLogin.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="Css/Styles.css">
        <title>Login</title>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg black">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                </div>
            </div>
        </nav>
        <!-- Navbar end -->
        <!-- Header -->
        <div class="home">
            <a href="Home.php">
                <img src="img/logo.png" style="height: 200px; width: auto; display:block; margin:auto;">
            </a>
        </div>
        <!-- Header end -->
        <br>
        <!-- Main area start -->
        <section class="container py-2 mb-4">
            <div class="row">
                <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
                    <br><br><br>
                    <div class="small-times-black">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                    </div>
                    <div class="card bg-light text-light mb-3">
                        <div class="card-header black text-white">
                            <h1 class="large-mistral-white"><i class="fas fa-user" style="color:white;"></i> Login</h1>
                        </div>
                        <div class="card-body bg-light small-times-black">
                            <form class="" action="AdminLogin.php" method="post">
                                <div class="form-group">
                                    <label for="username"><span>Username:</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white bg-danger"> <i class="fas fa-user"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="Username" id="username" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password"><span>Password:</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white bg-danger"> <i class="fas fa-lock"></i> </span>
                                        </div>
                                        <input type="password" class="form-control" name="Password" id="password" value="">
                                    </div>
                                </div>
                                <input type="submit" name="Submit" class="btn btn-danger btn-block" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main area end -->
        <br>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
