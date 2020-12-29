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
        <title>Posts</title>
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
                    <div class="card-body black text-white">
                        <h1 class="large-mistral-white"><i class="fab fa-readme" style="color:white;"></i> Posts</h1>
                    </div>
                    <br>
                    <table class="table table-striped">
                        <thead class="thead-dark small-times-white">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date&Time</th>
                                <th>Author</th>
                                <th>Banner</th>
                                <th>Comments</th>
                                <th></th>
                                <th></th>
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
                                $ShowPostFrom = ($Page * 10) - 10;
                            }
                            $SrNo = $ShowPostFrom;
                            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,10";
                            $stmt = $ConnectingDB->query($sql);
                        }
                        // The default SQL query
                        else {
                            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
                            $stmt = $ConnectingDB->query($sql);
                        }
                        while ($DataRows = $stmt->fetch()) {
                            $Id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $PostTitle = $DataRows["title"];
                            $Category = $DataRows["category"];
                            $Admin = $DataRows["author"];
                            $Image = $DataRows["image"];
                            $PostText = $DataRows["post"];
                            $SrNo++;
                            ?>
                            <tbody class="small-times-black">
                                <tr>
                                    <td><?php echo $SrNo; ?></td>
                                    <td>
                                        <?php
                                        if (strlen($PostTitle) > 20) {
                                            $PostTitle = substr($PostTitle, 0, 20) . '...';
                                        }
                                        echo $PostTitle;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (strlen($Category) > 8) {
                                            $Category = substr($Category, 0, 8) . '...';
                                        }
                                        echo $Category;
                                        ?>
                                    </td>
                                    <td>
    <?php
    if (strlen($DateTime) > 11) {
        $DateTime = substr($DateTime, 0, 11) . '...';
    }
    echo $DateTime;
    ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (strlen($Admin) > 6) {
                                            $Admin = substr($Admin, 0, 6) . '...';
                                        }
                                        echo $Admin;
                                        ?>
                                    </td>
                                    <td><img src="uploads/<?php echo $Image; ?>" width="150px;" height="90px;"</td>
                                    <td>
                                        <?php
                                        $Total = ApproveCommentsAccordingtoPost($Id);
                                        if ($Total > 0) {
                                            ?>
                                            <span class="badge badge-success">
                                            <?php echo $Total; ?>
                                            </span>
    <?php } ?>
    <?php $Total = DisApproveCommentsAccordingtoPost($Id);
    if ($Total > 0) {
        ?>
                                            <span class="badge badge-danger">
        <?php echo $Total; ?>
                                            </span>
    <?php } ?>
                                    </td>
                                    <td>
                                        <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning small-times-black">Edit</span></a>
                                        <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger small-times-white">Delete</span></a>
                                    </td>
                                    <td>
                                        <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary small-times-white">Preview</span></a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>
                        <!--  Ending of While loop -->
                    </table>
                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination pagination-lg">
                            <!-- Creating Backward Button -->
                            <?php if (isset($Page)) {
                                if ($Page > 1) {
                                    ?>
                                    <li class="page-item">
                                        <a href="Posts.php?page=<?php echo $Page - 1; ?>" class="page-link small-times-black-bold">&laquo;</a>
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
                            $PostPagination = $TotalPosts / 10;
                            $PostPagination = ceil($PostPagination);
                            //echo $PostPagination;
                            for ($i = 1; $i <= $PostPagination; $i++) {
                                ?>
                                <li class="page-item">
                                    <a href="Posts.php?page=<?php echo $i; ?>" class="page-link small-times-black-bold"><?php echo $i; ?></a>
                                </li>
<?php } ?>
                            <!-- Creating Forward Button -->
<?php if (isset($Page) && !empty($Page)) {
    if ($Page + 1 <= $PostPagination) {
        ?>
                                    <li class="page-item">
                                        <a href="Posts.php?page=<?php echo $Page + 1; ?>" class="page-link small-times-black-bold">&raquo;</a>
                                    </li>
    <?php }
} ?>
                        </ul>
                    </nav>
                    </section>
                    <!-- Main area end -->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <a href="AddNewPost.php" class="btn btn-primary btn-block small-times-white">
                                    <i class="fas fa-plus"></i> Add New Post
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
                    </body>
                    </html>
