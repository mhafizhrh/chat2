<?php

require 'koneksi.php';
session_start();

if (isset($_POST['btnRegister'])) {
	
	$name = strip_tags($_POST['name']);
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$password2 = strip_tags($_POST['password2']);

	if (trim($name) == "" || trim($username) == "" || trim($password) == "" || trim($password2) == "") {

		$_SESSION['register_gagal'] = "All fields must be filled.";
		header("location:register.php");
	} else {

		$_SESSION['name'] = $name;

		$query = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
		$data = mysqli_fetch_array($query);
		
		if (mysqli_num_rows($query) >= 1) {
			
			$_SESSION['register_gagal'] = "Username already exist!";
			header("location:register.php");
		} else if ($password != $password2) {
			
			$_SESSION['register_gagal'] = "Confirm Password doesn't match";
			header("location:register.php");
		} else {

			$query = mysqli_query($con, "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')");

			if ($query) {

				$_SESSION['register_berhasil'] = "Register Success, please login with your account.";
				header("location: register.php");
			} else {

				$_SESSION['register_gagal'] = "Register failed, please try again later.";
				header("location: register.php");
			}
		}
	}
} else {

	header("location:register.php");
}

?>