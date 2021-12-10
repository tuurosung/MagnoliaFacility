<?php
    require_once '../serverscripts/dbcon.php';
    require_once '../serverscripts/Classes/Tickets.php';
    require_once '../serverscripts/Classes/Users.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Magnolia Recreational Center</title>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

  <!-- v5.6.3 -->
<link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">


<link href="../mdb/css/bootstrap.css" rel="stylesheet">
<link href="../mdb/css/mdb.css" rel="stylesheet">
<link href="../mdb/css/datepicker.css" rel="stylesheet">
<link href="../datatables/datatables.css" rel="stylesheet">

<link href="../mdb/css/style.css" rel="stylesheet">
<link href="../mdb/css/style.min.css" rel="stylesheet">
<link href="../mdb/css/magnolia.css" rel="stylesheet">



  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- MDB -->


</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;600;700;800&display=swap');

.Montserrat{
  font-family: 'Montserrat',sans-serif;
}
.montserrat{
  font-family: 'Montserrat',sans-serif;
}
.Poppins{
  font-family: 'Poppins',sans-serif;
}

body, h1, h2, h3, h4, h5, h6 {
    font-weight: 400;
}
body{
  font-family: 'Poppins',sans-serif;
}
table th,table td{
  font-size: 11px !important;
}
.btn{
  font-size: 11px;
}
.blockquote p {
    padding: 0px !important;
    font-size: 0.8rem;
}
.cardx{
  border-radius: 10px;
}
.nav-tabs .nav-link.active{
  color: #4285f4 !important;
}
.avatar{
  height: 30px;
  width: 30px;
  background-color: #4285f4;
  color: #fff;
  border-radius: 20px;
  font-weight: bold;
}
.avatar-1{
  height: 50px;
  width: 50px;
  background-color: #4285f4;
  color: #fff;
  border-radius: 20px;
  font-weight: bold;
  font-size: 23px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
    font-weight: 400;
}
.select2-container .select2-selection--single, .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
}
</style>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="topnavbar">

  <!-- Navbar brand -->
  <a class="navbar-brand Montserrat" href="#" style="font-size:16px">MAGNOLIA RECREATIONAL COMPLEX</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li> -->

      <!-- Dropdown -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->

    </ul>
    <!-- Links -->
    <p class="mr-3">Hi, <span class="font-weight-bold"> <?php echo $_SESSION['user_fullname']; ?> </span></p>
    <a href="../login.php" type="button" class="btn btn-black btn-rounded"><i class="fas fa-sign-out-alt mr-2"></i> Log out</a>
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->
<body class="">

  <!--Main Navigation-->
  <header>
