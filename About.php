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
        <br>
        <!--Main area start -->
        <div class="container small-times-black">
          <div class="CommentBlock">
          <div class="card-body black text-white">
           <h1 class="large-mistral-white"><i class="fas fa-question" style="color:white;"></i> About Us</h1>
          </div>
          <br>
          <figure>
            <img src="img/mariam.jpg" class="about-us-img">
            <figcaption class="extra-small-georgia-gray-it" style="text-align: center;">Mariam Ayub, club founder and owner.</figcaption>
          </figure>
            <p>Well, there you have it. You've clicked to yet another website filled with Madonna content. Pics, articles, and more memorabilia than you can shake a finger at. But, how did this particular website come together? More importantly, what's up with the Everybody Fanzine? All in due time, my friends. Since it took us <span id="yearsActive"></span> years to get here, I think I can take a little time in giving you the facts. <span id="yearsActiveConfirmation"></span> years? Yep, that's when I started the zine, back in 1991. I was one of the first group of ICON members (my number had four digits!), and I really liked the idea of sharing my enormous Madonna collection with other like-minded fans. Plus, being a writer who can't stop expressing myself might have had something to do with it.</p>
            <p>Anyway, I wrote up my first issue, about 8-10 folded pages, hand-written, and filled it with video reviews, items for sale, and my thoughts and artwork, and it was free. I shared it with friends, family and fellow pen-pals. Soon, I did a few more, and thought to myself: "This is pretty fun!" I was religiously poring over the ads in ICON with each issue, and when I read an ad to help compile great fan stuff for an upcoming book, I was definitely interested! His name was Matthew Rettenmund and the book was Encyclopedia Madonnica. I sent in my little creation for consideration and soon I received a waiver form allowing my work to be used in the book. I was thrilled! When the book was released, there I was, under fanzines, with quite a glowing review. That was the point of no return. Everyone and their brother wrote me for a copy.</p>
            <figure>
              <img src="img/mariam-zine.jpg" class="about-us-img">
              <figcaption class="extra-small-georgia-gray-it" style="text-align: center;">Mariam holding one of her zines.</figcaption>
            </figure>
            <p>I decided to rethink my strategy, (so I wouldn't go broke). The zine went full-size and I started typing it, adding more fan content and articles. This was in 1995. From that point on, the zine has flourished in many ways. I have met some of my best friends from it, gone to great events through it, networked and connected with Madonna's manager, and built a great community of Madonna fans through ever-changing technology and trends.</p>
            <p>Which brings us to the present day, and it brings me so much joy to say we are back and for the last <span id="yearsOnFacebook"></span> years we have built a strong community on Facebook. We have grown in numbers and I've also had monthly contests, great content, promotions, and features. We are so excited to have you join us once again for the latest news, pictures, fan features, contests and more. We are looking for your participation and feedback as we grow and continue to evolve. Our journey has been such a great one and we have you to thank for it, because it's all about everybody! Welcome to Everybody Fan Club!</p>
            <figure>
              <img src="img/club-members.jpg" class="about-us-img">
              <figcaption class="extra-small-georgia-gray-it" style="text-align: center;">Everybody Fan Club members.</figcaption>
            </figure>
            </div>
        </div>
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
