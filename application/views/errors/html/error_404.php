<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    <title><?php echo $heading; ?></title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- CSS -->
    <link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/css/base.css" rel="stylesheet">
	
    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
        
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
        
</head>
<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

    <!-- Header================================================== -->
    <header>
        
    
<section id="hero">
 	<div class="intro_title error">
    	<h1 class="animated fadeInDown"><?php echo $heading; ?></h1>
        <p class="animated fadeInDown"><?php echo $message; ?></p>
       <a href="/" class="animated fadeInUp button_intro">Back to home</a> <a href="/tours" class="animated fadeInUp button_intro outline">View all tours</a>
	</div>
                
</section><!-- End hero --> 

<div id="toTop"></div><!-- Back to top button -->

 <!-- Common scripts -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/jquery-1.11.2.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/common_scripts_min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/js/functions.js"></script>

  </body>
</html>