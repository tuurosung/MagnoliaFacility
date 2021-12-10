<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="mdb/css/mdb.min.css"> -->
    <!-- Font Awesome -->
      <link   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"   rel="stylesheet"/>
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"  rel="stylesheet" />
      <!-- MDB -->

      <link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"  rel="stylesheet"/>


      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <!-- MDB -->
      <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
    <title>Welcome To Magnolia Recreational Center</title>
  </head>
  <body>

  </body>
</html>



<!--Main Navigation-->
  <header>
    <style>
      #intro {
        background-image: url("images/bg2.jpg");
        height: 100vh;
      }
      .Montserrat{
        font-family: 'Montserrat',sans-serif;
      }
      .Poppins{
        font-family: 'Poppins',sans-serif;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
      .headline{
        font-size: 65px;
        font-weight: 800;
        font-family: 'Montserrat',sans-serif;
      }
      #left-handle{
        min-width: 60%;
      }
      .browser-default,.form-control{
        min-height: 40px;
        width: 100%;
        padding:15px;
        border-radius: 15px;
        border:none;
        border:solid 3px #fff;
        background-color: #ffffffa6;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
      }
      .form-group{
        margin-bottom:30px;
      }
      .wide{
        width: 100%;
      }
      .btn{
        border-radius: 15px;
        font-size: 20px;
      }
      body{
        font-family: 'Poppins',sans-serif;
      }
      .nav-item{
        margin-right: 20px;
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
      <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand nav-link Montserrat" target="_blank" href="#">
          <strong>MAGNOLIA</strong>
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          </ul>

          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item active">
              <a class="nav-link active" aria-current="page" href="#intro">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" rel="nofollow"
                target="_blank">Tickets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" target="">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="">Login / Signup</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask" style="bacakground-color: #4285f4;">
        <div class="container d-flex align-items-center justify-content-center  h-100">

          <div class="text-white text-left" id="left-handle">
            <h1 class="mb-3 headline text-uppercase">Book Magnolia</h1>
            <section style="width:80%" class="mt-5">

              <div class="form-group">
                <select class="custom-select browser-default" name="">
                  <option value="">Children's Play Ground</option>
                  <option value="">Swimming Pool</option>
                  <option value="">Soccer Pitch</option>
                </select>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Valid From</label>
                    <input type="text" name=""  class="form-control" value="<?php echo date('d-M-Y'); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">To</label>
                    <input type="text" name="" class="form-control" value="<?php echo date('d-M-Y'); ?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Number Of Tickets</label>
                    <input type="text" name=""  class="form-control" value="" placeholder="1">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">E-Mail</label>
                    <input type="text" name="" class="form-control" value="" placeholder="email address">
                  </div>
                </div>
              </div>

              <button type="button"  class="btn btn-success wide px-3 py-4">
                <i class="fas fa-ticket-alt" aria-hidden></i>
                Book Ticket
              </button>
            </section>



          </div>
          <div class="">
            <img src="images/play.png" alt="" class="img-fluid" style="width:500px">
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">


      <!--Section: Content-->
      <section class="text-left mt-5">
        <h2 class="mb-5 Montserrat"><strong>Upcoming Events</strong></h2>

        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="images/magnolia.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Event title</h5>
                <p class="card-text">
                  ...
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="images/magnolia.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Event title</h5>
                <p class="card-text">
                  ...
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="images/magnolia.jpg" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Event Title</h5>
                <p class="card-text">
                  ...
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />


    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">





    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-dark" href="">The Magnolia Recreational Center</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
