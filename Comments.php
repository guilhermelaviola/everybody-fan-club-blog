<?php
require_once("includes/DB.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
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
        <title>Comments</title>
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
        <!-- Main Area Start -->
        <section class="container py-2 mb-4">
            <div class="row" style="min-height:30px;">
                <div class="col-lg-12" style="min-height:400px;">
                    <div class="small-times-black">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                    </div>
                    <div class="card-body black text-white">
                        <h1 class="large-mistral-white"><i class="fas fa-comments" style="color:white;"></i> Comments</h1>
                    </div>
                    <br>
                    <div class="card-body bg-danger">
                        <h2 class="large-georgia-white-bold">Unapproved Comments</h2>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark small-times-white">
                            <tr>
                                <th>No.</th>
                                <th>Date&Time</th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        global $ConnectingDB;
                        $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
                        $Execute = $ConnectingDB->query($sql);
                        $SrNo = 0;
                        while ($DataRows = $Execute->fetch()) {
                            $CommentId = $DataRows["id"];
                            $DateTimeOfComment = $DataRows["datetime"];
                            $CommenterName = $DataRows["name"];
                            $CommentContent = $DataRows["comment"];
                            $CommentPostId = $DataRows["post_id"];
                            $SrNo++;
                            ?>
                            <tbody class="small-times-black">
                                <tr>
                                    <td><?php echo htmlentities($SrNo); ?></td>
                                    <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                                    <td><?php echo htmlentities($CommenterName); ?></td>
                                    <td><?php echo htmlentities($CommentContent); ?></td>
                                    <td> <a href="ApproveComments.php?id=<?php echo $CommentId; ?>" class="btn btn-success small-times-white">Approve</a>  </td>
                                    <td> <a href="DeleteComments.php?id=<?php echo $CommentId; ?>" class="btn btn-danger small-times-white">Delete</a>  </td>
                                    <td style="min-width:140px;"> <a class="btn btn-primary small-times-white" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Preview</a> </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                    <br>
                    <div class="card-body bg-success">
                        <h2 class="large-georgia-white-bold">Approved Comments</h2>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark small-times-white">
                            <tr>
                                <th>No.</th>
                                <th>Date&Time</th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th>Approver</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        global $ConnectingDB;
                        $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
                        $Execute = $ConnectingDB->query($sql);
                        $SrNo = 0;
                        while ($DataRows = $Execute->fetch()) {
                            $CommentId = $DataRows["id"];
                            $DateTimeOfComment = $DataRows["datetime"];
                            $CommenterName = $DataRows["name"];
                            $ApprovedBy = $DataRows["approvedby"];
                            $CommentContent = $DataRows["comment"];
                            $CommentPostId = $DataRows["post_id"];
                            $SrNo++;
                            ?>
                            <tbody class="small-times-black">
                                <tr>
                                    <td><?php echo htmlentities($SrNo); ?></td>
                                    <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                                    <td><?php echo htmlentities($CommenterName); ?></td>
                                    <td><?php echo htmlentities($CommentContent); ?></td>
                                    <td><?php echo htmlentities($ApprovedBy); ?></td>
                                    <td style="min-width:140px;"> <a href="DisapproveComments.php?id=<?php echo $CommentId; ?>" class="btn btn-warning small-times-black">Disapprove</a>  </td>
                                    <td> <a href="DeleteComments.php?id=<?php echo $CommentId; ?>" class="btn btn-danger small-times-white">Delete</a>  </td>
                                    <td style="min-width:140px;"> <a class="btn btn-primary small-times-white" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Preview</a> </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>
        <br>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
