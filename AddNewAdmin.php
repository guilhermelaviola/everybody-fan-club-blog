<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();

if (isset($_POST["Submit"])) {
    $UserName = $_POST["Username"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $ConfirmPassword = $_POST["ConfirmPassword"];
    $Admin = $_SESSION["UserName"];
    date_default_timezone_set("America/Los_Angeles");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if (empty($UserName) || empty($Password) || empty($ConfirmPassword)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out.";
        Redirect_to("AddNewAdmin.php");
    } elseif (strlen($Password) < 4) {
        $_SESSION["ErrorMessage"] = "The password must be greater than 3 characters.";
        Redirect_to("AddNewAdmin.php");
    } elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"] = "The confirmation password must match with the password.";
        Redirect_to("AddNewAdmin.php");
    } elseif (CheckIfUsernameExistOrNot($UserName)) {
        $_SESSION["ErrorMessage"] = "This username already exists. Try another one.";
        Redirect_to("AddNewAdmin.php");
    } else {
        //Query to insert new admin in DB when everything is fine...
        global $ConnectingDB;
        $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
        $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime', $DateTime);
        $stmt->bindValue(':userName', $UserName);
        $stmt->bindValue(':password', $Password);
        $stmt->bindValue(':aName', $Name);
        $stmt->bindValue(':adminName', $Admin);
        $Execute = $stmt->execute();
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Admin added successfully!";
            Redirect_to("AddNewAdmin.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again.";
            Redirect_to("AddNewAdmin.php");
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
        <title>Add New Admin</title>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark black medium-mistral-white">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="Dashboard.php?page=1" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="Posts.php?page=1" class="nav-link">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a href="Categories.php?page=1" class="nav-link">Sections</a>
                        </li>
                        <li class="nav-item">
                            <a href="Admins.php?page=1" class="nav-link">Admins</a>
                        </li>
                        <li class="nav-item">
                            <a href="Comments.php" class="nav-link">Comments</a>
                        </li>
                        <li class="nav-item">
                            <a href="Messages.php" class="nav-link">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a href="Blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
                                <i class="fas fa-user-times"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar end -->
        <br>
        <!-- Main area -->
        <section class="container py-1 mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="small-times-black">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                    </div>
                    <form class="" action="AddNewAdmin.php" method="post">
                        <div class="card bg-light text-light mb-3">
                            <div class="card-header black text-white">
                                <h1 class="large-mistral-white"><i class="fas fa-users" style="color:white;"></i> Add New Admin</h1>
                            </div>
                            <div class="card-body bg-light small-times-black">
                                <div>
                                    <label for="username"> <span class="small-times-black"> Username: </span></label>
                                    <input class="form-control" type="text" name="Username" id="username" value="">
                                </div>
                                <div class="form-group">
                                    <label for="Name"> <span class="small-times-black"> Name: </span></label>
                                    <input class="form-control" type="text" name="Name" id="Name" value="">
                                    <small class="extra-small-times-gray">*Optional</small>
                                </div>
                                <div class="form-group">
                                    <label for="Password"> <span class="small-times-black"> Password: </span></label>
                                    <input class="form-control" type="password" name="Password" id="Password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmPassword"> <span class="small-times-black"> Confirm password: </span></label>
                                    <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" value="">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <button type="submit" name="Submit" class="btn btn-success btn-block small-times-white"> <i class="fas fa-check"></i> Add </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
