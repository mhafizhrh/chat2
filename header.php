<?php

session_start();

if (!isset($_SESSION['user_id'])) {
	
	$_SESSION['login_gagal'] = "Silahkan login terlebih dahulu.";
	header("location:login.php");
} else {

	$user_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SanChat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/dist/css/bootstrap-select.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/dist/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/dist/css/font-awesome.min.css">
</head>
<body>
	<div class="container-fluid"  style="padding-top: 70px;">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		    <a class="navbar-brand" href="index.php">SanChat</a>
		</nav>

		<div class="row">
			<div class="col-sm-12">
				<!-- <div class="list-group list-group-horizontal list-group-sm">
					<a href="" class="list-group-item list-group-item-action list-group-item-secondary flex-fill text-center active">Home</a>
					<a href="" class="list-group-item list-group-item-action list-group-item-secondary flex-fill text-center">Homeds</a>
					<a href="" class="list-group-item list-group-item-action list-group-item-secondary flex-fill text-center">Homeasdaasd</a>
					<a href="" class="list-group-item list-group-item-action list-group-item-secondary flex-fill text-center">Ho</a>
					<a href="" class="list-group-item list-group-item-action list-group-item-secondary flex-fill text-center">Homeasdasdsdasd</a>
				</div> -->
				<div class="btn-group btn-block">
					<a href="index.php" class="btn btn-outline-secondary"><span class="fa fa-home"></span> Home</a>
					<a href="friends.php" class="btn btn-outline-secondary"><span class="fa fa-users"></span> Friends</a>
					<a href="profiles.php" class="btn btn-outline-secondary"><span class="fa fa-user-circle"></span> Profiles</a>
					<!-- <div class="btn-group">
						<button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">Settings</button>
						<div class="dropdown-menu">
							<a href="#" class="dropdown-item">Profiles</a>
							<a href="#" class="dropdown-item">Friends</a>
						</div>
					</div> -->
					<a href="logout.php" class="btn btn-outline-secondary"><span class="fa fa-power-off"></span> Logout</a>
				</div>
			</div>
		</div>
		<br>