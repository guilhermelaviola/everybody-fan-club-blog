<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

$SearchQueryParameter = $_GET["id"];
if (isset($_POST["Submit"])) {
    $Name = $_POST["CommenterName"];
    $Email = $_POST["CommenterEmail"];
    $Comment = $_POST["CommenterThoughts"];
    date_default_timezone_set("America/Los_Angeles");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if (empty($Name) || empty($Email) || empty($Comment)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out.";
        Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    } elseif (strlen($Comment) > 500) {
        $_SESSION["ErrorMessage"] = "The comment lenght is limited to 500 characters.";
        Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    } else {
        //Query to insert comment in DB when everything is fine...
        global $ConnectingDB;
        $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
        $sql .= "VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postIdFromURL)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime', $DateTime);
        $stmt->bindValue(':name', $Name);
        $stmt->bindValue(':email', $Email);
        $stmt->bindValue(':comment', $Comment);
        $stmt->bindValue(':postIdFromURL', $SearchQueryParameter);
        $Execute = $stmt->execute();

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Comment submitted successfully!";
            Redirect_to("FullPost.php?id={$SearchQueryParameter}");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again.";
            Redirect_to("FullPost.php?id={$SearchQueryParameter}");
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
        <title>Everybody Fan Club</title>
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
        <div class="container">
            <div class="row mt-4">
                <!--Main area start -->
                <div class="col-sm-8">
                    <?php
                    global $ConnectingDB;
                    // SQL query when the search button is active
                    if (isset($_GET["SearchButton"])) {
                        $Search = $_GET["Search"];
                        $sql = "SELECT * FROM posts
                        WHERE datetime LIKE :search
                        OR title LIKE :search
                        OR category LIKE :search
                        OR post LIKE :search";
                        $stmt = $ConnectingDB->prepare($sql);
                        $stmt->bindValue(':search', '%' . $Search . '%');
                        $stmt->execute();
                    }
                    // The default SQL query
                    else {
                        $PostIdFromURL = $_GET["id"];
                        if (!isset($PostIdFromURL)) {
                            $_SESSION["ErrorMessage"] = "Bad Request";
                            Redirect_to("Blog.php");
                        }
                        $sql = "SELECT * FROM posts WHERE id='$PostIdFromURL'";
                        $stmt = $ConnectingDB->query($sql);
                        $Result = $stmt->rowcount();
                        if ($Result != 1) {
                            $_SESSION["ErrorMessage"] = "Bad Request!";
                            Redirect_to("Blog.php?page=1");
                        }
                    }
                    while ($DataRows = $stmt->fetch()) {
                        $PostID = $DataRows["id"];
                        $DateTime = $DataRows["datetime"];
                        $PostTitle = $DataRows["title"];
                        $Category = $DataRows["category"];
                        $Admin = $DataRows["author"];
                        $Image = $DataRows["image"];
                        $PostDescription = $DataRows["post"];
                        ?>
                        <br>
                        <div class="card">
                            <img src="uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top"/>
                            <div class="card-body">
                                <h4 class="large-georgia-black-bold"><?php echo htmlentities($PostTitle); ?></h4>
                                <small class="extra-small-georgia-gray">Section: <span> <a class="extra-small-georgia-gray-bold" href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span> <a class="extra-small-georgia-gray-bold"> <?php echo htmlentities($Admin); ?></a></span> on <span class="extra-small-georgia-gray-bold"><?php echo htmlentities($DateTime); ?></span></small>
                                <hr>
                                <p class="small-times-black">
                                    <?php echo nl2br($PostDescription); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <br>
                    <!--Comment area start -->
                    <!-- Fetching existing comment start  -->
                    <span class="medium-georgia-red-bold text-danger">Comments:</span>
                    <br><br>
                    <?php
                    global $ConnectingDB;
                    $sql = "SELECT * FROM comments
                WHERE post_id='$SearchQueryParameter' AND status='ON'";
                    $stmt = $ConnectingDB->query($sql);
                    while ($DataRows = $stmt->fetch()) {
                        $CommentDate = $DataRows['datetime'];
                        $CommenterName = $DataRows['name'];
                        $CommentContent = $DataRows['comment'];
                        ?>
                        <div>
                            <div class="media CommentBlock">
                                <img class="d-block img-fluid align-self-start" src="img/comment.png" alt="">
                                <div class="media-body ml-2">
                                    <h6 class="small-georgia-black-bold"><?php echo $CommenterName; ?></h6>
                                    <p class="extra-small-georgia-gray">On <span class="extra-small-georgia-gray-bold"><?php echo $CommentDate; ?> </span></p>
                                    <p class="small-times-black"><?php echo $CommentContent; ?></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <br>
                    <!--  Fetching existing comment end -->
                    <div class="small-times-black">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                    </div>
                    <div class="">
                        <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="medium-georgia-red-bold text-danger">Share your thoughts about this post!</h5>
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
                                        <textarea name="CommenterThoughts" class="form-control small-times-black" rows="6" cols="80" placeholder="Comment..."></textarea>
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
                    <br>
                    <!--Comment area end -->
                </div>
                <!--Main area end -->
                <!--Side area start -->
                <div class="col-sm-4">
                        <div>
                            <img src="img/ad.png" class="d-block img-fluid mb-3" alt="">
                            <div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header black black text-light">
                            <h2 class="medium-mistral-white">Sections</h2>
                        </div>
                        <div class="card-body">
                            <?php
                            global $ConnectingDB;
                            $sql = "SELECT * FROM category ORDER BY id desc";
                            $stmt = $ConnectingDB->query($sql);
                            while ($DataRows = $stmt->fetch()) {
                                $CategoryId = $DataRows["id"];
                                $CategoryName = $DataRows["title"];
                                ?>
                                <a class="small-times-red-bold text-danger" href="Blog.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> +<?php echo $CategoryName; ?></span> </a><br>
                            <?php } ?>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header black text-white">
                            <h2 class="medium-mistral-white">Recent Posts</h2>
                        </div>
                        <div class="card-body">
                            <?php
                            global $ConnectingDB;
                            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
                            $stmt = $ConnectingDB->query($sql);
                            while ($DataRows = $stmt->fetch()) {
                                $Id = $DataRows['id'];
                                $Title = $DataRows['title'];
                                $DateTime = $DataRows['datetime'];
                                $Image = $DataRows['image'];
                                ?>
                                <div class="media">
                                    <a href="FullPost.php?id=<?php echo $Id; ?>">
                                        <img src="uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                                    </a>
                                    <div class="media-body ml-2">
                                        <a style="text-decoration:none;"href="FullPost.php?id=<?php echo htmlentities($Id); ?>" target="_blank">  <h6 class="medium-georgia-black-bold"><?php echo htmlentities($Title); ?></h6> </a>
                                        <p class="extra-small-georgia-gray"><?php echo htmlentities($DateTime); ?></p>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--Side area end -->
            </div>
        </div>
        <!-- Header end -->
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
        </script>
    </body>
</html>
