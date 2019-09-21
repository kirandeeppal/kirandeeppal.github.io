<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<!--script for validation-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<title>Store APP</title>
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<script src="bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

	  <a class="navbar-brand text-primary" href="index.php">Kiran's Sports Store</a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	      <a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
	      <a class="nav-item nav-link" href="itemlisting.php">Products</a>
	      <a class="nav-item nav-link" href="cart.php">My Cart</a>
	      <a class="nav-item nav-link" href="contact.php">Contact</a>

	      <?php
	      		if(isset($_SESSION['isAdmin']) && $_SESSION["isAdmin"])
	      		{
	      			//User is logged-in and is the administrator. So we will show him links to administrative pages
	      ?>

	      			<a class="nav-item nav-link float-right text-success" href="item.php">Edit Products</a>
  		 			<a class="nav-item nav-link float-right text-success" href="add.php">Add Products</a>
  		 			<a class="nav-item nav-link float-right text-success" href="manage_orders.php">Manage Orders</a>

	      <?php
	      		}

	      ?>
	      
	      <?php 
	      		if(! isset($_SESSION['userid']))
	      		{
	      			//If not logged-in we will show user a login button
	      ?>
	      			<a class="nav-item nav-link float-right" href="login.php">Login</a>
  		 			<a class="nav-item nav-link float-right" href="registration.php">Register</a>

  		 <?php
	      		}
	      		else
	      		{
	      ?>
	      			<a class="nav-item nav-link float-right text-danger" href="logoutsessiondestroy.php">Logout</a>
	      <?php

	      		}

	      ?>

	    


  		 

	     
	    </div>
	  </div>

</nav>