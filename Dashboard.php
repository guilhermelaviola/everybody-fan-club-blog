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
        <title>Dashboard</title>
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
        <section class="container py-2 mb-4">
            <div class="small-times-black">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
            </div>
            <div class="card-body black text-white">
                <h1 class="large-mistral-white"><i class="fas fa-cog" style="color:white;"></i> Dashboard</h1>
            </div>
            <br>
            <div class="row">
                <!-- Left Side Area Start -->
                <div class="col-lg-2 d-none d-md-block">
                    <div class="card text-center black text-white mb-3">
                        <div class="card-body">
                            <h1 class="medium-times-white-bold">Posts</h1>
                            <h4 class="display-5 small-times-white">
                                <i class="fab fa-readme"></i>
                                <?php TotalPosts(); ?>
                            </h4>
                        </div>
                    </div>

                    <div class="card text-center black text-white mb-3">
                        <div class="card-body">
                            <h1 class="medium-times-white-bold">Sections</h1>
                            <h4 class="display-5 small-times-white">
                                <i class="fas fa-folder"></i>
                                <?php TotalCategories(); ?>
                            </h4>
                        </div>
                    </div>

                    <div class="card text-center black text-white mb-3">
                        <div class="card-body">
                            <h1 class="medium-times-white-bold">Admins</h1>
                            <h4 class="display-5 small-times-white">
                                <i class="fas fa-users"></i>
                                <?php TotalAdmins(); ?>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center black text-white mb-3">
                        <div class="card-body">
                            <h1 class="medium-times-white-bold">Comments</h1>
                            <h4 class="display-5 small-times-white">
                                <i class="fas fa-comments"></i>
                                <?php TotalComments(); ?>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center black text-white mb-3">
                        <div class="card-body">
                            <h1 class="medium-times-white-bold">Messages</h1>
                            <h4 class="display-5 small-times-white">
                                <i class="fas fa-comments"></i>
                                <?php TotalMessages(); ?>
                            </h4>
                        </div>
                    </div>

                </div>
                <!-- Left Side Area End -->
                <!-- Right Side Area Start -->
                <div class="col-lg-10">
                    <div class="card-body bg-info">
                        <h2 class="large-georgia-white-bold">Top Posts</h2>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark small-times-white">
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Date&Time</th>
                                <th>Author</th>
                                <th>Comments</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <?php
                        $SrNo = 0;
                        global $ConnectingDB;
                        // Query When Pagination is Active i.e Dashboard.php?page=1
                        if (isset($_GET["page"])) {
                            $Page = $_GET["page"];
                            if ($Page == 0 || $Page < 0) {
                                $ShowPostFrom = 0;
                            } else {
                                $ShowPostFrom = ($Page * 8) - 8;
                            }
                            $SrNo = $ShowPostFrom;
                            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,8";
                            $stmt = $ConnectingDB->query($sql);
                        }
                        // The default SQL query
                        else {
                            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
                            $stmt = $ConnectingDB->query($sql);
                        }
                        while ($DataRows = $stmt->fetch()) {
                            $PostId = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Author = $DataRows["author"];
                            $Title = $DataRows["title"];
                            $SrNo++;
                            ?>
                            <tbody class="small-times-black">
                                <tr>
                                    <td><?php echo $SrNo; ?></td>
                                    <td><?php echo $Title; ?></td>
                                    <td><?php echo $DateTime; ?></td>
                                    <td><?php echo $Author; ?></td>
                                    <td>
                                        <?php
                                        $Total = ApproveCommentsAccordingtoPost($PostId);
                                        if ($Total > 0) {
                                            ?>
                                            <span class="badge badge-success">
                                                <?php echo $Total; ?>
                                            </span>
                                        <?php } ?>
                                        <?php $Total = DisApproveCommentsAccordingtoPost($PostId);
                                        if ($Total > 0) {
                                            ?>
                                            <span class="badge badge-danger">
                                                <?php echo $Total; ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td> <a target="_blank" href="FullPost.php?id=<?php echo $PostId; ?>">
                                            <span class="btn btn-info">Preview</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>

                    </table>
                    <!-- Right Side Area End -->
                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination pagination-lg">
                            <!-- Creating Backward Button -->
                            <?php if (isset($Page)) {
                                if ($Page > 1) {
                                    ?>
                                    <li class="page-item">
                                        <a href="Dashboard.php?page=<?php echo $Page - 1; ?>" class="page-link small-times-black-bold">&laquo;</a>
                                    </li>
                                <?php }
                            } ?>
                            <?php
                            global $ConnectingDB;
                            $sql = "SELECT COUNT(*) FROM posts";
                            $stmt = $ConnectingDB->query($sql);
                            $RowPagination = $stmt->fetch();
                            $TotalPosts = array_shift($RowPagination);
                            //echo $TotalPosts."<br>";
                            $PostPagination = $TotalPosts / 8;
                            $PostPagination = ceil($PostPagination);
                            //echo $PostPagination;
                            for ($i = 1; $i <= $PostPagination; $i++) {
                                ?>
                                <li class="page-item">
                                    <a href="Dashboard.php?page=<?php echo $i; ?>" class="page-link small-times-black-bold"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <!-- Creating Forward Button -->
<?php if (isset($Page) && !empty($Page)) {
    if ($Page + 1 <= $PostPagination) {
        ?>
                                    <li class="page-item">
                                        <a href="Dashboard.php?page=<?php echo $Page + 1; ?>" class="page-link small-times-black-bold">&raquo;</a>
                                    </li>
    <?php }
} ?>
                        </ul>
                    </nav>
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
