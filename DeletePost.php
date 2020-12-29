<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

Confirm_Login();

$SearchQueryParameter = $_GET['id'];
// Fetching existing content
global $ConnectingDB;
$sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
$stmt = $ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
    $TitleToBeDeleted = $DataRows['title'];
    $CategoryToBeDeleted = $DataRows['category'];
    $ImageToBeDeleted = $DataRows['image'];
    $PostToBeDeleted = $DataRows['post'];
}
//echo $ImageToBeDeleted;
if (isset($_POST["Submit"])) {
    // Query to delete the posts in DB When everything is fine
    global $ConnectingDB;
    $sql = "DELETE FROM posts WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if ($Execute) {
        $Target_Path_To_DELETE_Image = "uploads/$ImageToBeDeleted";
        unlink($Target_Path_To_DELETE_Image);
        $_SESSION["SuccessMessage"] = "Post deleted successfully!";
        Redirect_to("Posts.php?page=1");
    } else {
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again.";
        Redirect_to("Posts.php?page=1");
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
        <title>Delete Post</title>
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
        <!-- Navbar endorsed -->
        <br>
        <!-- Main area -->
        <section class="container py-1 mb-4">
            <div class="row">
                <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
                    <div class="small-times-black">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                    </div>
                    <form class="" action="DeletePost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                        <div class="card bg-secondary text-light mb-3">
                            <div class="card-header">
                                <h1 class="large-mistral-white"><i class="fas fa-edit" style="color:white;"></i> Delete Post</h1>
                            </div>
                            <div class="card-body bg-dark">
                                <div class="form-group">
                                    <label for="title"> <span class="small-times-white">Post Title: </span></label>
                                    <input disabled class="form-control small-times-gray" type="text" name="PostTitle" id="title" placeholder="Type the title here" value="<?php echo $TitleToBeDeleted; ?>">
                                </div>
                                <div class="form-group">
                                    <span class="small-times-white">Existing Category: </span>
                                    <span class="small-times-white-bold">
                                        <?php echo $CategoryToBeDeleted; ?>
                                    </span>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <span class="small-times-white">Existing Image: </span>
                                    <img class="mb-1" src="uploads/<?php echo $ImageToBeDeleted; ?>" width="150px"; height="90px";>
                                </div>
                                <div class="form-group">
                                    <label for="Post"><span class="small-times-white">Post: </span></label>
                                    <textarea disabled class="form-control small-times-gray" id="Post" name="PostDescription" rows="8" cols="80">
                                        <?php echo $PostToBeDeleted; ?>
                                    </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <a href="Posts.php" class="btn btn-warning btn-block small-times-black"><i class="fas fa-arrow-left"></i> Back to Posts </a>
                                    </div>
                                    <div class="col-lg-6" mb-2>
                                        <button type="submit" name="Submit" class="btn btn-danger btn-block small-times-white"> <i class="fas fa-trash"></i> Delete </button>
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
