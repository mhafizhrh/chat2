<?php

require 'koneksi.php';
session_start();

if (isset($_POST['btnLogin'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) || empty($password)) {

		$_SESSION['login_gagal'] = "Username dan Password harus diisi!";
		header("location:login.php");
	} else {

		$query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
		$data = mysqli_fetch_array($query);
		
		if (mysqli_num_rows($query) <= 0) {
			
			$_SESSION['login_gagal'] = "Username tidak terdaftar!";
			header("location:login.php");
		} else if ($password != $data['password']) {
			
			$_SESSION['login_gagal'] = "Password salah!";
			header("location:login.php");
		} else {

			$_SESSION['user_id'] = $data['user_id'];
			header("location: index.php");
		}
	}
} else {

	$_SESSION['login_gagal'] = "Silahkan login terlebih dahulu!";
	header("location:login.php");
}

?>