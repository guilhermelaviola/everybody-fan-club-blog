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
        <header>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <!-- Slide One - Set the background image for this slide in the line below -->
              <div class="carousel-item active" style="background-image: url('img/slide01.png')">
                <div class="carousel-caption">
                  <div class="card-body black">
                    <h3 class="large-mistral-white">Welcome to Everybody Fan Club!</h3>
                    <p class="small-times-white">Welcome to the home of one of the original Madonna Fan Club's! We started in 1991 with a printed zine and today we are back with this website and social media! Our club is open to anyone who loves the Queen of Pop and here we celebrate through pictures, video, collectibles, stories and monthly contests! We look forward to you joining our community and helping us build a strong and supportive fan club for our favorite ICON!</p>
                  </div>
                </div>
              </div>
              <!-- Slide Two - Set the background image for this slide in the line below -->
              <div class="carousel-item" style="background-image: url('img/slide02.png')">
                <div class="carousel-caption d-none d-md-block">
                  <div class="card-body black">
                    <h3 class="large-mistral-white">Fan Of The Month!</h3>
                    <p class="small-times-white">The chosen the Fan Of The Month shares their Madonna Journey with us through photos, stories and their personal favorites! Be a part of this exciting monthly feature!</p>
                  </div>
                </div>
              </div>
              <!-- Slide Three - Set the background image for this slide in the line below -->
              <div class="carousel-item" style="background-image: url('img/slide03.png')">
                <div class="carousel-caption d-none d-md-block">
                  <div class="card-body black">
                    <h3 class="large-mistral-white">Mega Collectors!</h3>
                    <p class="small-times-white">Take a peek at the collections of some of the biggest Madonna fans and learn about their favorite items and what they are on the hunt for. Share your collection in this great monthly feature!</p>
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </header>
        <!--Main area start -->
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
