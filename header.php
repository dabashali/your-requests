<?php   require_once("admin/dbconnect.php") ?>
<!-- include database for all front end pages -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <title>Resturant</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/ali/tooplate-main.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--
Tooplate 2114 Pixie
https://www.tooplate.com/view/2114-pixie
-->
<!--  -------------------------------------------------------------------- -->
 <style>
  .animi{
   display: flex;
   width: 90px;
   justify-content: space-between;
   align-items: center;
   height:49%;
   
   flex-wrap: nowrap;
}

.animi div {
    background-color: rgb(0, 0, 0);
    width: 22px;
    height: 22px;
    border-radius: 50%;
    animation-duration: .9s;
    animation-iteration-count: infinite;
    animation-name: ali;
    animation-direction: alternate;
}
.tow{
    animation-delay: 0.2s;
}
.three{
    animation-delay: .4s;
}

@keyframes ali{
    to {
        display: none;
        transform: translateY(-20px);
    }
}


@media (max-width:500px) {
    
    .animi{
        justify-content: space-around;
    }
    .animi div{
        width: 14px;
        height: 15px;
    }
}

@media (min-width:880px) {
    .contain{
        width: 20%;
    }

} 
</style>
<!-- //------------------------------------------------------------------- -->
  </head>

  <body>
    
    <!-- Pre Header -->
    <div id="pre-header"STYLE="background-color:black;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <span STYLE="FONT-SIZE:17PX ;background-color:black;color:white"> 
              YEMENI TRADITIONAL FOOD THAT YOU DREAM TO TASTE IT ! </span>
                    
                      
          </div>
        </div>
      </div>
    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
      <div class="contain">
        <div class="animi">
          <div class="one"></div>
          <div class="tow "></div>
          <div class="three"></div>
        </div>
        </div>
        <a class="navbar-brand" href="admin/profile.php"style="width: 170px;
              display:flex;justify-content:flex-end ">
          <img src="assets/images/humman.png" alt="" style="width: 100px;
              height: 59px; ">
              </a>
 <!-- ------------------------------------------------------ -->
 <!-- ------------------------------------------------------ -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" style=" width:fit-content;top:100px !important;" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

