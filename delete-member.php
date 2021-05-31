<?php

session_start();

if (!isset($_SESSION['user_id'])) {
	
	echo "<script>window.location.href = 'index.php';</script>";
} else {

	require 'koneksi.php';

	$user_id = $_SESSION['user_id'];
	$group_id = $_GET['group_id'];
	$group_user_id = $_GET['user_id'];

	$sql_groups = mysqli_query($con,
		"SELECT owner_id
		FROM groups 
		WHERE group_id = '{$group_id}' AND owner_id = '{$user_id}'");

	if (mysqli_num_rows($sql_groups) <= 0) {
		
		echo "<script>alert('You are not the owner!'); window.location.href = 'room.php?group_id={$group_id}'; </script>";
	} else {

		$delete = mysqli_query($con, "DELETE FROM group_user WHERE user_id = '$group_user_id' AND group_id = '$group_id'");

		if ($delete) {
			
			echo "<script>alert('Member removed'); window.location.href = 'room.php?group_id={$group_id}'; </script>";
		} else {

			echo "<script>alert('Failed to remove member.'); window.location.href = 'room.php?group_id={$group_id}'; </script>";
		}
	}
}