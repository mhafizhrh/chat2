<?php

session_start();

require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {

	header("location:index.php");
} else {

	$user_id = $_SESSION['user_id'];
	$username = $_POST['username'];

	$q_users1 = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$user_id'");
	$q_users2 = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
	$my_data = mysqli_fetch_array($q_users1);
	$friend_data = mysqli_fetch_array($q_users2);

	if (trim($username) == "") {
		
		echo "<script>alert('Username must be filled.'); window.location.href = 'friends.php'</script>";
	} else if ($username == $my_data['username']) {
		
		echo "<script>alert('You cant add yourself XD..'); window.location.href = 'friends.php'</script>";
	} else {

		if (mysqli_num_rows($q_users2) <= 0) {
			
			echo "<script>alert('Username not found.'); window.location.href = 'friends.php'</script>";
		} else {


			$q_check = mysqli_query($con, "SELECT * FROM user_friends WHERE (user1_id = '$user_id' AND user2_id = '$friend_data[user_id]') OR (user1_id = '$friend_data[user_id]' AND user2_id = '$user_id')");

			if (mysqli_num_rows($q_check) >= 1) {
				
				echo "<script>alert('Username already added.'); window.location.href = 'friends.php'</script>";
			} else {

				$query = mysqli_query($con, "INSERT INTO user_friends VALUES ('$user_id', '$friend_data[user_id]', '0', '$user_id')");

				if ($query) {
				
					echo "<script>alert('Request friend success.'); window.location.href = 'friends.php'</script>";
				} else {

					echo "<script>alert('Error, please try again.'); window.location.href = 'friends.php'</script>";
				}
			}
		}
	}
}