<?php

session_start();

require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {

	header("location:index.php");
} else {

	$user_id = $_SESSION['user_id'];
	$column = $_GET['column'];

	if ($column == "user1_id") {
		
		$column1 = "user1_id";
		$column2 = "user2_id";
	} else {

		$column1 = "user2_id";
		$column2 = "user1_id";
	}

	if (isset($_GET['friend_id']) && isset($_GET['request']) == "1") {

		$friend_id = $_GET['friend_id'];
		
		$query = mysqli_query($con, "UPDATE user_friends SET status = 1 WHERE {$column1} = '$friend_id' AND {$column2} = '$user_id'");

		if ($query) {
			
			echo "<script>alert('Request accepted!'); window.location.href = 'friends.php'</script>";
		} else {

			echo "<script>alert('Error, please try again.'); window.location.href = 'friends.php'</script>";
		}
	} else if (isset($_GET['friend_id'])) {
		
		$friend_id = $_GET['friend_id'];
		
		$query = mysqli_query($con, "UPDATE user_friends SET status = 2 WHERE {$column1} = '$friend_id' AND {$column2} = '$user_id'");

		if ($query) {
			
			echo "<script>alert('Request declined.'); window.location.href = 'friends.php'</script>";
		} else {

			echo "<script>alert('Error, please try again.'); window.location.href = 'friends.php'</script>";
		}
	}
}