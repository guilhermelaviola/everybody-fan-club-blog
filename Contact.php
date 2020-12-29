<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

if (isset($_POST["Submit"])) {
    $Name = $_POST["CommenterName"];
    $Email = $_POST["CommenterEmail"];
    $Message = $_POST["CommenterMessage"];
    date_default_timezone_set("America/Los_Angeles");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if (empty($Name) || empty($Email) || empty($Message)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out.";
        Redirect_to("Contact.php");
    } elseif (strlen($Message) > 500) {
        $_SESSION["ErrorMessage"] = "The message lenght is limited to 500 characters.";
        Redirect_to("Contact.php");
    } else {
        //Query to insert message in DB when everything is fine...
        global $ConnectingDB;
        $sql = "INSERT INTO messages(datetime,name,email,message,markedasreadby,status)";
        $sql .= "VALUES(:dateTime,:name,:email,:message,'Pending','OFF')";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime', $DateTime);
        $stmt->bindValue(':name', $Name);
        $stmt->bindValue(':email', $Email);
        $stmt->bindValue(':message', $Message);
        $Execute = $stmt->execute();

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Message submitted successfully! We will be responding you as soon as we can!";
            Redirect_to("Contact.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again.";
            Redirect_to("Contact.php");
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
        <title>Contact Us</title>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark black text-dark medium-mistral-white">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="Home.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="About.php" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="Blog.php?page=1" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="Contact.php" class="nav-link">FAQ / Contact Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <form class="form-inline d-none d-sm-block" action="Blog.php">
                            <div class="form-group">
                                <input class="form-control mr-2 small-times-black" type="text" name="Search" placeholder="Type here" value="">
                                <button class="btn btn-danger small-times-white" name="SearchButton">Search</button>
                            </div>
                        </form>
                    </ul>
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
        <br>
        <!--Main area start -->
        <div class="container">
            <div class="CommentBlock">
                <div class="card-body black text-white">
                    <h1 class="large-mistral-white"><i class="fas fa-question" style="color:white;"></i> Frequently Asked Questions</h1>
                </div>
                <br>
                <h1 class="medium-georgia-black-bold">1. How can I become a fan club member?</h1>
                <p class="small-times-black">You can be a fan club member by participating at our <a href="www.everybodyfanclub.com">website</a> and getting involved by entering contests or submitting content ideas. You can also join our <a href="https://www.facebook.com/groups/everybodyfanclub/?ref=bookmarks">Facebook Community</a> and like our <a href="https://www.facebook.com/Everybody-Fan-Club-584656684946852/">Facebook Page</a>.</p>
                <br>
                <h1 class="medium-georgia-black-bold">2. Is it free?</h1>
                <p class="small-times-black">All our services and features are free as well as contests and promotions. Down the road, we will have fan club merchandise to purchase and items for sale.</p>
                <br>
                <h1 class="medium-georgia-black-bold">3. What ways can I participate in Everybody Fan Club?</h1>
                <p class="small-times-black">There are so many! From entering contests to suggesting story ideas or being featured as a fan of the month, the spotlight is on you! Email us your ideas and watch for opportunities to be a part of the club!</p>
                <br>
                <h1 class="medium-georgia-black-bold">4. Do you have special events, promotions, and contests?</h1>
                <p class="small-times-black">We have monthly contests, and many other promotions like Fan Of The Month and Mega Collectors for you to participate in. We have had events all along the west coast and look forward to meeting many fans in the future! Keep an eye out for our event announcements as well as promotions and contests happening now!</p>
                <br>
                <h1 class="medium-georgia-black-bold">5. How can I get more involved?</h1>
                <p class="small-times-black">If you have any questions, ideas or suggestions and want to help us out, please contact us down below! We look forward to hearing from you and thank you for being a part of one of the longest-running Madonna fan clubs!</p>
                <br>
            </div>
        </div>

        <section class="container py-1 mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="small-times-black">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                    </div>
                    <form class="" action="" method="post">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="medium-georgia-red-bold text-danger">Contact us!</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control small-times-black" type="text" name="CommenterName" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control small-times-black" type="text" name="CommenterEmail" placeholder="Email" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="CommenterMessage" class="form-control small-times-black" rows="6" cols="80" placeholder="Message..."></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <button type="submit" name="Submit" class="btn btn-danger btn-block small-times-white"> <i class="fas fa-check"></i> Submit </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--Main area end -->
        <br>
        <!-- Footer -->
        <footer class="black text-white">
            <div class="container-fluid text-center text-md-left">
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3" style="text-align: center;">
                        <br>
                        <p class="extra-small-times-white"><a target="_blank"><img src="img/logo.png" class="footer-img"></a><br>Everybody Fan Club is not endorsed by Madonna or her companies, nor does it seek to represent the official word on Madonna. We are expressly a fan-based site and any questions or concerns otherwise should be brought to Mariam's attention. Thank you very much!</p>
                    </div>
                    <hr class="clearfix w-100 d-md-none pb-3">
                    <div class="col-md-3 mb-md-0 mb-3"></div>
                    <div class="col-md-3 mb-md-0 mb-3">
                        <br>
                        <h5 class="medium-mistral-white">Follow Us:</h5>

                        <ul class="list-unstyled">
                            <li>
                                <div class="col-mb-12">
                                    <a href="https://www.facebook.com/Everybody-Fan-Club-584656684946852/" class="btn btn-primary social-media-btn">
                                        <i class="fab fa-facebook-f pr-1"></i> Page
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="col-mb-12">
                                    <a href="https://www.facebook.com/groups/everybodyfanclub/?ref=bookmarks" class="btn btn-primary social-media-btn">
                                        <i class="fab fa-facebook-f pr-1"></i> Group
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="col-mb-12">
                                    <a href="https://www.youtube.com/channel/UCvDESWkJZQmjIxai7SDHSnw" class="btn btn-danger social-media-btn">
                                        <i class="fab fa-youtube-square pr-1"></i> Channel
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="col-mb-12">
                                    <a href="" class="btn btn-light social-media-btn">
                                        <i class="fab fa-instagram pr-1"></i> Instagram
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bg-danger" style="height:60px; text-align: center;"><br>
                <div class="extra-small-times-white">Copyright © <span id="year"></span> - Everybody Fan Club. All rights reserved
                    <a href="Privacy Policy/Privacy Policy.pdf" class="extra-small-times-white"> Privacy Policy</a>
                </div>
            </div>
        </footer>
        <!-- Footer end-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script>
            $('#year').text(new Date().getFullYear());
            $('#yearsActive').text(new Date().getFullYear() - 1991);
            $('#yearsActiveConfirmation').text(new Date().getFullYear() - 1991);
            $('#yearsOnFacebook').text(new Date().getFullYear() - 2014);
        </script>
    </body>
</html>
