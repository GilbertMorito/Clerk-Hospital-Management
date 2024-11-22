<?php
	if(file_exists('includes/database.php')) {include_once('includes/database.php');}
	if(file_exists('../includes/database.php')) {include_once('../includes/database.php');}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> NorthGate Hospital</title>
			  <!-- Style CSS -->
		<link rel="stylesheet" href="./css/style.css">
			  <!-- Demo CSS (No need to include it into your project) -->
		<link rel="stylesheet" href="./css/demo.css">
		<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
		<link rel='stylesheet' href='https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap'>
   </head>
   <body>
		<nav class="sidebar close">
		  <header>
			<div class="image-text"> 
				<a href="javascript:void();" onclick="loadPage('pages/empprofile.php', 'content')" class="text-logo-a">
				<span class="image">
				  <img src="img/logo.png" alt="">
				</span>
				<div class="text logo-text">
				  <span class="name">NorthGate Hospital</span>
				</a>
				<span class="profession">Gilbert Khen Morito</span>
			</div>
			</div>
			<i class='bx bx-chevron-right toggle'></i>
		  </header>
		  <div class="menu-bar">
			<div class="menu">
			  <li class="search-box">
				<i class='bx bx-search icon'></i>
				<input type="text" placeholder="Search...">
			  </li>
			  <ul class="menu-links">
				<li class="nav-link">
				  <a href="index.php">
					<i class='bx bx-home-alt icon'></i>
					<span class="text nav-text">Home</span>
				  </a>
				</li>
				<li class="nav-link">
				  <a href="javascript:void();" onclick="loadPage('pages/patient.php?patientid=0', 'content');">
					<i class='bx bx-bar-chart-alt-2 icon'></i>
					<span class="text nav-text">Patient Record</span>
				  </a>
				</li>
				<li class="nav-link">
				  <a href="javascript:void();">
					<i class='bx bx-book icon'></i>
					<span class="text nav-text">Contact</span>
				  </a>
				</li>
			  </ul>
			</div>
			<div class="bottom-content">
			  <li class="">
				<a href="login/login.php">
				  <i class='bx bx-log-out icon'></i>
				  <span class="text nav-text">Logout</span>
				</a>
			  </li>
			  <li class="mode">
				<div class="sun-moon">
				  <i class='bx bx-moon icon moon'></i>
				  <i class='bx bx-sun icon sun'></i>
				</div>
				<span class="mode-text text">Dark mode</span>
				<div class="toggle-switch">
				  <span class="switch"></span>
				</div>
			  </li>
			</div>
		  </div>
		</nav>
		<main class="cd__main">
			<div id="content">
				<h3>Hello Word</h3>
			</div>
		</main>
		<footer class="cd__credit">Author: Vincent Van Goggles - Distributed By: <a title="Free web design code & scripts" href="https://www.codehim.com?source=demo-page" target="_blank">CodeHim</a></footer>
			  
		<!-- Script JS -->
		<script src="js/script.js"></script>
		<script src="js/sweetalert.min.js"></script>
		<!--$%analytics%$-->
   </body>
</html>