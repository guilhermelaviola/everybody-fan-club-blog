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
        <title>Messages</title>
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
                        <h1 class="large-mistral-white"><i class="fas fa-comments" style="color:white;"></i> Messages</h1>
                    </div>
                    <br>
                    <div class="card-body bg-danger">
                        <h2 class="large-georgia-white-bold">Unread Messages</h2>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark small-times-white">
                            <tr>
                                <th>No.</th>
                                <th>Date&Time</th>
                                <th>Fan Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        global $ConnectingDB;
                        $sql = "SELECT * FROM messages WHERE status='OFF' ORDER BY id desc";
                        $Execute = $ConnectingDB->query($sql);
                        $SrNo = 0;
                        while ($DataRows = $Execute->fetch()) {
                            $MessageId = $DataRows["id"];
                            $MessageDate = $DataRows["datetime"];
                            $FanName = $DataRows["name"];
                            $FanEmail = $DataRows["email"];
                            $FanMessage = $DataRows["message"];
                            $SrNo++;
                            ?>
                            <tbody class="small-times-black">
                                <tr>
                                    <td><?php echo htmlentities($SrNo); ?></td>
                                    <td><?php
                                        if (strlen($MessageDate) > 11) {
                                            $MessageDate = substr($MessageDate, 0, 11) . '...';
                                        }
                                        echo $MessageDate
                                        ?></td>
                                    <td><?php echo htmlentities($FanName); ?></td>
                                    <td><?php echo htmlentities($FanEmail); ?></td>
                                    <td><?php echo htmlentities($FanMessage); ?></td>
                                    <td> <a href="CheckMessages.php?id=<?php echo $MessageId; ?>" class="btn btn-success small-times-white">Check</a>  </td>
                                    <td> <a href="DeleteMessages.php?id=<?php echo $MessageId; ?>" class="btn btn-danger small-times-white">Delete</a>  </td>
                                </tr>
                            </tbody>
<?php } ?>
                    </table>
                    <br>
                    <div class="card-body bg-success">
                        <h2 class="large-georgia-white-bold">Checked Messages</h2>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark small-times-white">
                            <tr>
                                <th>No.</th>
                                <th>Date&Time</th>
                                <th>Fan Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        global $ConnectingDB;
                        $sql = "SELECT * FROM messages WHERE status='ON' ORDER BY id desc";
                        $Execute = $ConnectingDB->query($sql);
                        $SrNo = 0;
                        while ($DataRows = $Execute->fetch()) {
                            $MessageId = $DataRows["id"];
                            $MessageDate = $DataRows["datetime"];
                            $FanName = $DataRows["name"];
                            $FanEmail = $DataRows["email"];
                            $FanMessage = $DataRows["message"];
                            $SrNo++;
                            ?>
                            <tbody class="small-times-black">
                                <tr>
                                    <td><?php echo htmlentities($SrNo); ?></td>
                                    <td><?php
                                        if (strlen($MessageDate) > 11) {
                                            $MessageDate = substr($MessageDate, 0, 11) . '...';
                                        }
                                        echo $MessageDate
                                        ?></td>
                                    <td><?php echo htmlentities($FanName); ?></td>
                                    <td><?php echo htmlentities($FanEmail); ?></td>
                                    <td><?php echo htmlentities($FanMessage); ?></td>
                                    <td style="min-width:140px;"> <a href="MarkMessageAsUnread.php?id=<?php echo $MessageId; ?>" class="btn btn-warning small-times-black">Mark as unread</a>  </td>
                                    <td> <a href="DeleteMessages.php?id=<?php echo $MessageId; ?>" class="btn btn-danger small-times-white">Delete</a>  </td>
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
