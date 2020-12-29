<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();

if (isset($_POST["Submit"])) {
    $PostTitle = $_POST["PostTitle"];
    $Category = $_POST["Category"];
    $Image = $_FILES["Image"]["name"];
    $Target = "uploads/" . basename($_FILES["Image"]["name"]);
    $PostText = $_POST["PostDescription"];
    $Admin = $_SESSION["UserName"];
    date_default_timezone_set("America/Los_Angeles");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if (empty($PostTitle)) {
        $_SESSION["ErrorMessage"] = "The title must not be empty.";
        Redirect_to("AddNewPost.php");
    } elseif (strlen($PostTitle) <= 5) {
        $_SESSION["ErrorMessage"] = "The post title must be greater than 5 characters.";
        Redirect_to("AddNewPost.php");
    } elseif (strlen($PostText) > 10000) {
        $_SESSION["ErrorMessage"] = "The post description is limited to 10000 characters.";
        Redirect_to("AddNewPost.php");
    } else {
        // Query to insert the posts in DB When everything is fine
        global $ConnectingDB;
        $sql = "INSERT INTO posts(datetime,title,category,author,image,post)";
        $sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime', $DateTime);
        $stmt->bindValue(':postTitle', $PostTitle);
        $stmt->bindValue(':categoryName', $Category);
        $stmt->bindValue(':adminName', $Admin);
        $stmt->bindValue(':imageName', $Image);
        $stmt->bindValue(':postDescription', $PostText);
        $Execute = $stmt->execute();
        move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Post added successfully!";
            Redirect_to("AddNewPost.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again.";
            Redirect_to("AddNewPost.php");
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
        <title>Add New Post</title>
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
                    <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
                        <div class="card bg-light text-light mb-3">
                            <div class="card-header black text-white">
                                <h1 class="large-mistral-white"><i class="fas fa-blog" style="color:white;"></i> Add New Post</h1>
                            </div>
                            <div class="card-body bg-light">
                                <div class="form-group">
                                    <label for="title"> <span class="small-times-black"> Post Title: </span></label>
                                    <input class="form-control small-times-gray" type="text" name="PostTitle" id="title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="title"> <span class="small-times-black"> Choose Section: </span></label>
                                    <select class="form-control small-times-gray" id="CategoryTitle" name="Category">
                                        <?php
                                        //Fetching all the categories from the category mysql_list_table
                                        global $ConnectingDB;
                                        $sql = "SELECT id,title FROM category";
                                        $stmt = $ConnectingDB->query($sql);
                                        while ($DateRows = $stmt->fetch()) {
                                            $id = $DateRows["id"];
                                            $CategoryName = $DateRows["title"];
                                            ?>
                                            <option><?php echo $CategoryName; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="imageSelect"><span class="small-times-black"> Select Image </span></label>
                                    <input type="File" name="Image" id="imageSelect" value="">
                                </div>
                                <div class="form-group">
                                    <label for="Post"><span class="small-times-black"> Post: </span></label>
                                    <pre><textarea class="form-control small-times-gray" id="Post" name="PostDescription" rows="8" cols="80"></textarea></pre>
                </div>
                <div class="row">
                  <div class="col-lg-12 mb-2">
                    <button type="submit" name="Submit" class="btn btn-success btn-block small-times-white"> <i class="fas fa-check"></i> Publish </button>
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
